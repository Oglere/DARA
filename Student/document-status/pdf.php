<?php
include '../../db/db.php';
?>

<div id="loading-overlay">
    <div class="loader"></div>
    <p>Loading...</p>
</div>

<div class="pdfmain" style="display: none; flex-direction: column;" id="pdf-content">
    <div class="navnav">
        <div class="leftnav">
            <div class="pdfaside">
                <div class="nav">
                    <p>Total Pages: <span id="total-pages"></span></p>
                </div>

                <h2><?= htmlspecialchars($title) ?></h2>
                <p><strong>Date Submitted</strong> <?= htmlspecialchars($publication_date) ?></p>
                <p><strong>Keywords:</strong> 
                    <?php 
                    if (is_array($keywords) && !empty($keywords)) {
                        echo htmlspecialchars(implode(", ", $keywords)) . ".";
                    } else {
                        echo "No keywords available.";
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>

    <div class="pdfcontents">
        <div id="pdf-container"></div>
    </div>
</div>

<style>
    #loading-overlay {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 1.5em;
        z-index: 9999;
    }

    .loader {
        border: 6px solid #f3f3f3;
        border-top: 6px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin-bottom: 20px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

    const url = 'data:application/pdf;base64,<?= base64_encode($pdf_data) ?>';
    let pdfDoc = null,
        scale = 1.5;

    const container = document.getElementById('pdf-container');

    // Load and render the PDF
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('total-pages').textContent = pdfDoc.numPages;
        renderAllPages();

        // Hide loading overlay and show PDF content
        document.getElementById('loading-overlay').style.display = 'none';
        document.getElementById('pdf-content').style.display = 'flex';
    }).catch(function(error) {
        console.error('Error loading PDF:', error);
    });

    // Render all pages in the PDF
    function renderAllPages() {
        for (let i = 1; i <= pdfDoc.numPages; i++) {
            renderPage(i);
        }
    }

    // Render individual page
    function renderPage(num) {
        pdfDoc.getPage(num).then(function(page) {
            const viewport = page.getViewport({ scale });
            const canvas = document.createElement('canvas');
            canvas.className = 'page';
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            container.appendChild(canvas);

            const renderContext = {
                canvasContext: context,
                viewport
            };
            page.render(renderContext);
        }).catch(function(error) {
            console.error('Error rendering page:', error);
        });
    }
</script>
