<?php
include '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $document_id = $_POST['document_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE Document_Repository SET status = ?, date_reviewed = NOW() WHERE document_id = ?");
    $stmt->bind_param("si", $status, $document_id);

    if ($stmt->execute()) {
        echo "Document status updated!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="post">
    <input type="hidden" name="document_id" value="<?php echo $_GET['id']; ?>">
    Status: 
    <select name="status">
        <option value="Approved">Approve</option>
        <option value="Rejected">Reject</option>
        <option value="Needs Revision">Needs Revision</option>
    </select>
    <button type="submit">Submit</button>
</form>
