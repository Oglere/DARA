<?php
include '../../db/db.php';

?>

<div class="pdfmain">
    <div class="navnav">
        <div class="leftnav">
            <div class="pdfaside">
                <div class="nav">
                    <p>Total Pages: <span id="total-pages"></span></p>
                </div>

                <h2>Document Metadata</h2>
                <p><strong>Title:</strong> <?= $title ?></p>
                <p><strong>Abstract:</strong> <?= $abstract ?></p>
                <p><strong>Publication Date:</strong> <?= $publication_date ?></p>
                <p><strong>Keywords:</strong> 
                    <?php 
                    if (is_array($keywords) && !empty($keywords)) {
                        echo implode(", ", $keywords) . ".";
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
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

    const url = 'data:application/pdf;base64,<?= base64_encode($pdf_data) ?>';
    let pdfDoc = null,
        pageNum = 1,
        scale = 1.5;

    const container = document.getElementById('pdf-container');

    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('total-pages').textContent = pdfDoc.numPages;
        renderAllPages();
    }).catch(function(error) {
        console.error('Error loading PDF:', error);
    });

    function renderAllPages() {
        for (let i = 1; i <= pdfDoc.numPages; i++) {
            renderPage(i);
        }
    }

    function renderPage(num) {
        pdfDoc.getPage(num).then(function(page) {
            const viewport = page.getViewport({scale: scale});
            const canvas = document.createElement('canvas');
            canvas.className = 'page';
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            container.appendChild(canvas);

            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            page.render(renderContext).promise.then(function() {
                document.getElementById('current-page').textContent = num;
            });
        }).catch(function(error) {
            console.error('Error rendering page:', error);
        });
    }
</script>
