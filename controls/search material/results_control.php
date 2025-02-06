<?php if (isset($result) && $result->num_rows > 0): ?>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="cell">
                <li>
                    <a href="study.php?id=<?= htmlspecialchars($row['document_id']) ?>">
                        <?= htmlspecialchars($row['title']) ?>
                    </a>
                </li>
                <?php
                $authorsArray = json_decode($row['authors'], true);
                $authorsList = is_array($authorsArray) ? implode(', ', $authorsArray) : '';

                $keywordArray = json_decode($row['keywords'], true);
                $keywords = is_array($keywordArray) ? implode(', ', $keywordArray) : '';

                $studytypeArray = json_decode($row['study_type'], true);
                $studytype = is_array($studytypeArray) ? implode(', ', $studytypeArray) : ''; // Fixed typo

                $publicationDate = htmlspecialchars($row['publication_year']);
                $date = new DateTime($publicationDate);
                $year = $date->format('Y');
                
                $studentLastName = htmlspecialchars($row['last_name']);
                ?>
                <p>Authors: <?= $studentLastName ?>, <?= htmlspecialchars($authorsList) ?> (<?= $year ?>)</p>
                <p>Keywords: <?= htmlspecialchars($keywords) ?></p>
                <p>Study Type: <?= htmlspecialchars($studytype) ?></p> <!-- Fixed variable name -->
            </div>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p style="margin-left: 35px;">No results found.</p>
<?php endif; ?>
