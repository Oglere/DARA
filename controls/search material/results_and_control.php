<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    echo "<script> window.location.assign('../../') </script>";
}

include '../db/db.php';

$fromYear = isset($_GET['from-year']) ? $_GET['from-year'] : null;
$toYear = isset($_GET['to-year']) ? ((int)$_GET['to-year'] + 1) : null;
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$types = isset($_GET['document_types']) ? $_GET['document_types'] : []; // Checkbox values from the form

$sql = "SELECT dr.document_id, dr.student_id, dr.title, 
        JSON_UNQUOTE(JSON_EXTRACT(dr.metadata, '$.publication_date')) AS publication_year, 
        dr.authors, 
        JSON_UNQUOTE(JSON_EXTRACT(dr.metadata, '$.keywords')) AS keywords, 
        dr.study_type AS study_type, -- Removed unnecessary JSON_EXTRACT 
        u.last_name 
        FROM document_repository dr
        INNER JOIN users u ON dr.student_id = u.user_id
        WHERE dr.status = 'Approved'";


$bindTypes = '';
$bindParams = [];

// 1. If the search input is not empty, search by title or metadata
if (!empty($searchQuery)) {
    $sql .= " AND (dr.title LIKE ? OR dr.metadata LIKE ?)";
    $searchTerm = "%$searchQuery%";
    $bindTypes .= 'ss';
    array_push($bindParams, $searchTerm, $searchTerm);
}

// 2. If fromYear and toYear are set, filter by publication date
if ($fromYear && $toYear) {
    $sql .= " AND JSON_UNQUOTE(JSON_EXTRACT(dr.metadata, '$.publication_date')) BETWEEN ? AND ?";
    $bindTypes .= 'ss';
    array_push($bindParams, $fromYear, $toYear);
}

// 3. Filter by document types (Case Study, Thesis, etc.)
if (!empty($types)) {
    $typeConditions = [];
    foreach ($types as $type) {
        $typeConditions[] = "JSON_CONTAINS(dr.study_type, '\"$type\"')";
    }
    $sql .= " AND (" . implode(' OR ', $typeConditions) . ")";
}

$stmt = $conn->prepare($sql);

// 4. Bind the parameters if any exist
if (!empty($bindParams)) {
    $stmt->bind_param($bindTypes, ...$bindParams);
}

$stmt->execute();
$result = $stmt->get_result();
?>
