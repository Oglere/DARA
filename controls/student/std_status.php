<div class="status-container">
    <h1>Status of Submitted Documents</h1>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <span class="title"><?= htmlspecialchars($row['title']) ?></span>
                    <span class="status <?= strtolower(str_replace(' ', '-', htmlspecialchars($row['status']))) ?>">
                        <?= htmlspecialchars($row['status']) ?>
                    </span>
                    <div class="actions">
                        <?php
                            if ($row['status'] == "Pending") {
                                // Display the Abandon button if status is "Pending"
                                echo '
                                <button class="btn abandon" onclick="openModal(\'abandonModal\', ' . $row['document_id'] . ')">Abandon</button>
                                ';
                            }
                        ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No submissions found.</p>
    <?php endif; ?>
</div>

<div id="abandonModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('abandonModal')">&times;</span>
        <h2>Abandon Document</h2>
        <p>Are you sure you want to abandon this document?</p>
        <button id="confirmAbandon">Confirm</button>
    </div>
</div>
