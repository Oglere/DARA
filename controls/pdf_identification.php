<link rel="stylesheet" href="../../css/pdf_identification.scss">

<?php 
if ($_SESSION['role'] == "Teacher") {
    if ($row['status'] == "Pending"){
        echo '
            <div class="hellneh">
                <button id="approveBtn" class="btn">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="url(#gradient)"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-check-square"
                    >
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color: rgba(105,255,78,1); stop-opacity: 1" />
                                <stop offset="100%" style="stop-color: rgba(149, 254, 255, 1); stop-opacity: 1" />
                            </linearGradient>
                        </defs>
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    &nbsp;
                    Approve
                </button>

                <button id="revisionBtn" class="btn">
                   <svg xmlns="http://www.w3.org/2000/svg" 
                        width="24" height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        class="feather feather-info">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    &nbsp;
                    Needs Revisions
                </button>

                <button id="rejectBtn" class="btn">
                   <svg xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                    &nbsp;
                    Reject
                </button>
            </div>    
        ';
    }
} elseif ($_SESSION['role'] == "Student") {
    if ($row['status'] == "Pending"){
        echo '
            <button class="asd"
                id="abandonBtn"
                style="
                    background-color: #8e0404;
                    border-radius: 49px;
                    position: absolute;
                    margin-top: 140px;
                    margin-right: 40px;
                    width: 175px;
                    font-weight: lighter;
                    height: 40px;
                    display: flex;
                    border: none;
                    cursor: pointer;
                    transition: all 0.1s ease;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-family: `rubik`;
                ">
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

<div id="approveModal" class="modal">
    <div class="modal-content">
        <h2>Approve Document</h2>
        <p>Are you sure you want to approve this document?</p>
        <div class="modal-actions">
            <form action="../../controls/teacher/approval.php" method="POST">
                <input type="hidden" name="document_id" id="approveDocumentId">
                <input type="hidden" name="action" value="Approved">
                <button type="submit" class="batan confirm">Confirm</button>
                <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>
</div>

<div id="revisionModal" class="modal">
    <div class="modal-content">
        <h2>Request Revisions</h2>
        <p>Are you sure you want to request revisions for this document?</p>
        <div class="modal-actions">
            <form action="../../teacher/approval.php" method="POST">
                <input type="hidden" name="document_id" id="revisionDocumentId">
                <input type="hidden" name="action" value="Needs Revision">
                <button type="submit" class="batan confirm">Confirm</button>
                <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>
</div>

<div id="rejectModal" class="modal">
    <div class="modal-content">
        <h2>Reject Document</h2>
        <p>Are you sure you want to reject this document?</p>
        <div class="modal-actions">
            <form action="../../teacher/approval.php" method="POST">
                <input type="hidden" name="document_id" id="rejectDocumentId">
                <input type="hidden" name="action" value="Rejected">
                <button type="submit" class="batan confirm">Confirm</button>
                <button type="button" class="batan cancel" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
    const documentId = <?php echo json_encode($row['document_id']); ?>;

    // Button-to-Modal Mapping
    const buttons = {
        abandonBtn: "abandonModal",
        approveBtn: "approveModal",
        revisionBtn: "revisionModal",
        rejectBtn: "rejectModal"
    };

    // Open Modal Logic
    Object.keys(buttons).forEach((btnId) => {
        const button = document.getElementById(btnId);
        if (button) {
            button.onclick = () => {
                const modal = document.getElementById(buttons[btnId]);
                if (modal) {
                    modal.style.display = "block";
                    const input = modal.querySelector("input[type='hidden']");
                    if (input) input.value = documentId;
                }
            };
        }
    });

    // Close Modal Logic
    const modals = document.querySelectorAll(".modal");
    modals.forEach((modal) => {
        modal.querySelector(".cancel")?.addEventListener("click", () => {
            modal.style.display = "none";
        });
    });

    // Close Modal When Clicking Outside
    window.onclick = (event) => {
        modals.forEach((modal) => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    };
});

</script>


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
