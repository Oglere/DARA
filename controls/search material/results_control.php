<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    echo "<script> window.location.assign('../../') </script>";
}

if (isset($result) && $result->num_rows > 0): ?>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="cell">
                <li>
                    <a href="study.php?id=<?= htmlspecialchars($row['document_id']) ?>">
                        <?= htmlspecialchars($row['title']) ?>
                    </a>
                </li>
                
                <?php
                $authorsList = htmlspecialchars($row['authors']) ?: 'Unknown Author';
                $keywords = htmlspecialchars($row['keywords']) ?: 'No keywords available';
                $year = htmlspecialchars($row['publication_year']) ?: 'Unknown Year';
                $studyType = htmlspecialchars($row['study_type']);
                ?>
                
                <p>Authors: <?= htmlspecialchars($row['last_name']) ?>, <?= $authorsList ?> (<?= $year ?>)</p>
                <p>Keywords: <?= $keywords ?></p>
                <p>Study Type: <?= $studyType ?></p>
            </div>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p style="margin-left: 35px;">No results found.</p>
<?php endif; ?>
