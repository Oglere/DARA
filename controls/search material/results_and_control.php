<?php
include '../db/db.php';

$fromYear = isset($_GET['from-year']) ? $_GET['from-year'] : null;
$toYear = (isset($_GET['to-year']) + 1) ? ($_GET['to-year'] + 1) : null;
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$types = isset($_GET['types']) ? $_GET['types'] : [];

$sql = "SELECT dr.document_id, dr.student_id, dr.title, 
        JSON_UNQUOTE(JSON_EXTRACT(dr.metadata, '$.publication_date')) AS publication_year, 
        dr.authors, 
        JSON_UNQUOTE(JSON_EXTRACT(dr.metadata, '$.keywords')) AS keywords, 
        u.last_name
        FROM document_repository dr
        INNER JOIN users u ON dr.student_id = u.user_id
        WHERE dr.status = 'Approved'";


$bindTypes = '';
$bindParams = [];

// Add search query condition
if (!empty($searchQuery)) {
    $sql .= " AND (dr.title LIKE ? OR dr.metadata LIKE ?)";
    $searchTerm = "%$searchQuery%";
    $bindTypes .= 'ss';
    array_push($bindParams, $searchTerm, $searchTerm);
}

// Add year range condition
if ($fromYear && $toYear) {
    $sql .= " AND JSON_UNQUOTE(JSON_EXTRACT(dr.metadata, '$.publication_date')) BETWEEN ? AND ?";
    $bindTypes .= 'ss';
    array_push($bindParams, $fromYear, $toYear);
}

// Add types condition
if (!empty($types)) {
    $placeholders = implode(',', array_fill(0, count($types), '?'));
    $sql .= " AND dr.study_type IN ($placeholders)";
    $bindTypes .= str_repeat('s', count($types));
    foreach ($types as $type) {
        $bindParams[] = $type;
    }
}

$stmt = $conn->prepare($sql);

if ($bindParams) {
    $stmt->bind_param($bindTypes, ...$bindParams);
}

$stmt->execute();
$result = $stmt->get_result();
?>

