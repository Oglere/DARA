<h1>Status of Submitted Documents</h1>
<?php if ($result->num_rows > 0): ?>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><?= $row['title'] ?> - Status: <?= $row['status'] ?></li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No submissions found.</p>
<?php endif; ?>