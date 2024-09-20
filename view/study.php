<?php
include '../db/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    echo "Invalid document ID.";
    exit();
}

$document_id = intval($_GET['id']);

$sql = "SELECT title, metadata, file FROM Document_Repository WHERE document_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $document_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Document not found.";
    exit();
}

$row = $result->fetch_assoc();
$pdf_data = $row['file'];
$title = htmlspecialchars($row['title']);

$metadata = json_decode($row['metadata'], true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON metadata: ' . json_last_error_msg());
}

$abstract = htmlspecialchars($metadata['abstract'] ?? '');
$publication_date = htmlspecialchars($metadata['publication_date'] ?? '');
$keywords = json_decode($metadata['keywords'] ?? '[]', true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - <?= $title ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        main {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        nav {
            width: 200px;
            background: #f4f4f4;
            padding: 15px;
        }
        .contents {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: #fff;
        }
        aside {
            width: 300px;
            background: #f4f4f4;
            padding: 15px;
        }
        #pdf-container {
            height: 100%;
            overflow-y: scroll;
            border: 1px solid #ccc;
        }
        .page {
            margin: 10px 0;
            page-break-before: always;
        }
        canvas {
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>
    <main>
        <nav>
            <p>Page <span id="current-page">1</span> of <span id="total-pages"></span></p>
        </nav>
        <div class="contents">
            <div id="pdf-container"></div>
        </div>
        <aside>
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

        </aside>
    </main>
    
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
</body>
</html>

