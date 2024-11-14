<link rel="stylesheet" href="../../css/pdf_identification.scss">

<?php 
if ($_SESSION['role'] == "Teacher") {
    if ($row['status'] == "Pending"){
        echo '
            <button id="abandonBtn" class="btn">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-trash"
                    >
                    <polyline points="3 6 5 6 21 6" />
                    <path
                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                    />
                </svg>
                &nbsp;
                Abandon Document
            </button>
        ';
    }
} elseif ($_SESSION['role'] == "Student") {
    if ($row['status'] == "Pending"){
        echo '
            <button id="abandonBtn" class="btn">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-trash"
                    >
                    <polyline points="3 6 5 6 21 6" />
                    <path
                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                    />
                </svg>
                &nbsp;
                Abandon Document
            </button>
        ';
    }
}
?>

<div id="abandonModal" class="modal">
    <div class="modal-content">
        <h2>Abandon Document</h2>
        <p>Are you sure you want to abandon this document? <br> You can still recover this document later.</p>
        <div class="modal-actions">
            <form action="../../controls/student/abandon_document.php" method="POST">
                <input type="hidden" name="document_id" id="documentIdInput">
                <button type="submit" class="batan confirm">Confirm</button>
                <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script>
const modal = document.getElementById("abandonModal");
const abandonBtn = document.getElementById("abandonBtn");
const confirmAbandon = document.querySelector(".confirm");

abandonBtn.onclick = () => {
    const documentId = <?php echo json_encode($row['document_id']); ?>; // Assuming document ID is available in $row
    document.getElementById("documentIdInput").value = documentId;
    modal.style.display = "block";
};

function closeModal() {
    modal.style.display = "none";
}

window.onclick = (event) => {
    if (event.target == modal) {
        closeModal();
    }
};
</script>
