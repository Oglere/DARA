<h1>Submit a New Document</h1>
<form method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title" required><br>
    Abstract: <textarea name="abstract" required></textarea><br>
    Main Author: <input type="text" name="main_author" required><br>
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

    <div class="checkboxes">
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="Case Study" checked="checked">
            <label>Case Study</label>
        </div>
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="Thesis">
            <label>Thesis</label>
        </div>
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="Proposal">
            <label>Proposal</label>
        </div>
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="Capstone">
            <label>Capstone</label>
        </div>
        <div class="chkbx">
            <input class="w3-check" type="checkbox" name="document_types[]" value="System Studies">
            <label>System Studies</label>
        </div>
    </div>
    <button type="submit">Submit</button>
</form>

<script>
    const chooseFileBtn = document.getElementById("chooseFileBtn");
    const inputFile = document.getElementById("fileID");
    const fileNameDisplay = document.getElementById("fileNameDisplay");

    chooseFileBtn.addEventListener("click", () => {
        inputFile.click();
    });

    inputFile.addEventListener("change", function () {
        const fileName = this.files[0].name;
        fileNameDisplay.textContent = `Selected file: ${fileName}`;
    });
</script>
