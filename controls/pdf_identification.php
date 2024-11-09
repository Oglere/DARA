<link rel="stylesheet" href="../../css/pdf_identification.scss">

<?php 

if ($_SESSION['role'] == "Teacher") {
    echo "
    <script> 
        alert('hello world');
    </script>
    ";
} elseif ($_SESSION['role'] == "Student") {
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

    <div id="abandonModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Abandon Document</h2>
            <p>Are you sure you want to abandon this document?</p>
            <div class="modal-actions">
                <button id="confirmAbandon" class="batan confirm">Confirm</button>
                <button class="batan cancel" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>
    ';
}

?>

<script>
    // Get modal elements
const modal = document.getElementById("abandonModal");
const abandonBtn = document.getElementById("abandonBtn");
const closeModalBtn = document.querySelector(".close");
const confirmAbandon = document.getElementById("confirmAbandon");

// Function to open the modal
abandonBtn.onclick = () => {
    modal.style.display = "block";
};

// Function to close the modal
closeModalBtn.onclick = closeModal;

function closeModal() {
    modal.style.display = "none";
}

// Close modal if user clicks outside of the modal content
window.onclick = (event) => {
    if (event.target == modal) {
        closeModal();
    }
};

// Confirmation button click handler
confirmAbandon.onclick = () => {
    // Add your form submission or abandonment logic here
    console.log("Document abandoned");
    closeModal();
};

</script>