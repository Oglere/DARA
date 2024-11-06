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