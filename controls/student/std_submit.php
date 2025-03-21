<h1 style="font-weight: lighter;">SUBMIT A DOCUMENT</h1>
<form id="documentForm" method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title" required><br>
    Abstract: <textarea name="abstract" required></textarea><br>
    Co-Authors (comma-separated): <input type="text" name="co_authors"><br>
    Teacher: 
    <select name="teacher_id" required>
        <option value="">Select a Teacher</option>
        <?php foreach ($teachers as $teacher): ?>
            <option value="<?= $teacher['user_id'] ?>"><?= htmlspecialchars($teacher['name']) ?></option>
        <?php endforeach; ?>
    </select><br>
    Publication Date: <input type="date" name="publication_date"><br>
    Keywords (comma-separated): <input type="text" name="keywords"><br>
    Citations (comma-separated): <input type="text" name="citations"><br>

    <div class="container">
        <div class="card"> 
            <h3>Upload File</h3> 
            <div class="drop_box">
                <div class="header">
                    <h4>Select File here</h4>
                </div>
                <p>Files Supported: PDF</p>
                <input type="file" name="file" accept=".pdf" id="fileID" style="display:none;" required>
                <button type="button" class="btn" id="chooseFileBtn">Choose File</button>
                <p id="fileNameDisplay"></p>
            </div>
        </div>
    </div>
    
    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
        <div class="asd3" style="border-bottom: 1px solid grey; width: 100%; margin-bottom: 20px;"></div>
    </div>

    <div class="checkboxes">
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="Case Study">
            <label class="tada">Case Study</label> 
        </div>
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="Thesis">
            <label class="tada">Thesis</label>
        </div>
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="Proposal">
            <label class="tada">Proposal</label>
        </div>
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="Capstone">
            <label class="tada">Capstone</label>
        </div>
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="System Studies">
            <label class="tada">System Studies</label>
        </div>
    </div>
    <button type="submit" id="submitButton" disabled>Submit</button>
    <p>Error</p>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chooseFileBtn = document.getElementById("chooseFileBtn");
        const inputFile = document.getElementById("fileID");
        const fileNameDisplay = document.getElementById("fileNameDisplay");
        const submitButton = document.getElementById("submitButton");
        const checkboxes = document.querySelectorAll('.chkbx input'); // Get all checkbox inputs

        chooseFileBtn.addEventListener("click", () => {
            inputFile.click();
        });

        inputFile.addEventListener("change", function () {
            const file = this.files[0];
            if (file && file.type === "application/pdf") {
                fileNameDisplay.textContent = `Selected file: ${file.name}`;
                submitButton.disabled = false;
            } else {
                alert("Error: Only PDF files are allowed.");
                fileNameDisplay.textContent = "No valid file selected";
                this.value = "";
                submitButton.disabled = true;
            }
        });

        // Checkbox click handling
        checkboxes.forEach(chkbx => {
            chkbx.addEventListener('click', (e) => {
                // Prevent double triggering when clicking on the input itself
                if (e.target.tagName !== 'INPUT') {
                    const checkbox = chkbx.querySelector('input[type="checkbox"]');
                    checkbox.checked = !checkbox.checked;
                }
                
                // Change background color of the chkbx
                const checkbox = chkbx.querySelector('input[type="checkbox"]');
                chkbx.style.backgroundColor = checkbox.checked ? '#04128e' : ''; // Red background if checked
                
                // Change the text color inside the chkbx to white
                const label = chkbx.querySelector('label');
                label.style.color = checkbox.checked ? 'white' : ''; // White text when checked
            });
        });

        // Form submission handler
        document.getElementById("documentForm").addEventListener("submit", function (event) {
            // Check if a PDF file is uploaded
            if (!inputFile.files[0] || inputFile.files[0].type !== "application/pdf") {
                event.preventDefault();
                alert("Please upload a valid PDF file.");
                return; // Prevent form submission
            }

            // Check if at least one checkbox is selected
            let checkboxSelected = false;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkboxSelected = true;
                }
            });

            if (!checkboxSelected) {
                event.preventDefault();
                alert("Please select at least one document type.");
            }
        });
    });

const checkboxes = document.querySelectorAll('.chkbx');

checkboxes.forEach(chkbx => {
    chkbx.addEventListener('click', (e) => {
        // Prevent double triggering when clicking on the input itself
        if (e.target.tagName !== 'INPUT') {
            const checkbox = chkbx.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
        }
        
        // Change background color of the chkbx
        const checkbox = chkbx.querySelector('input[type="checkbox"]');
        chkbx.style.backgroundColor = checkbox.checked ? '#04128e' : ''; // Red background if checked
        
        // Change the text color inside the chkbx to white
        const label = chkbx.querySelector('label'); // Get the label inside this specific chkbx
        label.style.color = checkbox.checked ? 'white' : ''; // White text when checked
    });
});

</script>
