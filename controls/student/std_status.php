<div class="status-container">
    <h1 style="font-weight: lighter;">STATUS OF SUBMITTED DOCUMENTS</h1>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <div class="okok">
                        <span class="status <?= strtolower(str_replace(' ', '-', htmlspecialchars($row['status']))) ?>">
                            <?php if ($row['status'] === "Approved"): ?>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="35"
                                    height="35"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-check-square"
                                    >
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                            <?php elseif ($row['status'] === "Pending"): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    width="35" 
                                    height="35" 
                                    viewBox="0 0 24 24" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    stroke-width="2" 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    class="feather feather-loader">
                                    <line x1="12" y1="2" x2="12" y2="6" />
                                    <line x1="12" y1="18" x2="12" y2="22" />
                                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76" />
                                    <line x1="16.24" y1="16.24" x2="19.07" y2="19.07" />
                                    <line x1="2" y1="12" x2="6" y2="12" />
                                    <line x1="18" y1="12" x2="22" y2="12" />
                                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24" />
                                    <line x1="16.24" y1="7.76" x2="19.07" y2="4.93" />
                                </svg>
                            <?php elseif ($row['status'] === "Needs Revision"): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    width="35" height="35" 
                                    viewBox="0 0 24 24" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    stroke-width="2" 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    class="feather feather-info">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="16" x2="12" y2="12" />
                                    <line x1="12" y1="8" x2="12.01" y2="8" />
                                </svg>
                            <?php elseif ($row['status'] === "Rejected"): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    width="35" 
                                    height="35" 
                                    viewBox="0 0 24 24" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    stroke-width="2" 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            <?php endif; ?>
                        </span>

                        <span class="title"><?= htmlspecialchars($row['title']) ?></span>
                    </div>
                    
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