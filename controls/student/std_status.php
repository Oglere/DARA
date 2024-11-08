<div class="status-container">
    <h1 style="font-weight: lighter;">STATUS OF SUBMITTED DOCUMENTS</h1>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li style="
                <?php
                    if ($row['status'] == "Approved") {
                        echo "background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(105,255,78,1) 0%, rgba(149,254,255,1) 100%); border: none;";
                    } elseif ($row['status'] == "Pending") {
                        echo "background: linear-gradient(90deg, rgba(78,102,255,0.5) 0%, rgba(149,254,255,1) 100%);";
                    } elseif ($row['status'] == "Abandoned") {
                        echo "border: solid 1px black;";
                    }
                ?>
                ">
                    <div class="okok">
                        <span class="status <?= strtolower(str_replace(' ', '-', htmlspecialchars($row['status']))) ?>" >
                            <?php if ($row['status'] === "Approved"): ?>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="35"
                                    height="35"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="url(#gradient)"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-check-square"
                                >
                                    <defs>
                                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color: rgba(105,255,78,1); stop-opacity: 1" />
                                            <stop offset="100%" style="stop-color: rgba(149, 254, 255, 1); stop-opacity: 1" />
                                        </linearGradient>
                                    </defs>
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

                                <?php elseif ($row['status'] === "Abandoned"): ?>
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
                                        class="feather feather-trash"
                                        >
                                        <polyline points="3 6 5 6 21 6" />
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                        />
                                    </svg>

                            <?php endif; ?>
                        </span>
                        
                        <div class="continents">
                            <div class="top">
                                <span class="title" style="
                                    <?php
                                        if ($row['status'] != "Abandoned") {
                                            echo "color: #2E5256;";
                                        } else {
                                            echo "color: black;";
                                        } 
                                    ?>
                                    ">

                                    <?php
                                        if ($row['status'] != "Abandoned") {
                                            echo "<a href='pdf-reader.php?id=" . $row["document_id"] . "'>" . htmlspecialchars($row['title']) . "</a>";
                                        } else {
                                            echo htmlspecialchars($row['title']);
                                        }
                                    ?> 


                                    <?php
                                        if ($row['status'] == "Approved") {
                                            echo "(Approved)";
                                        } elseif ($row['status'] == "Pending") {
                                            echo "(Pending)";
                                        } elseif ($row['status'] == "Abandoned") {
                                            echo "(Aborted)";
                                        } 
                                    ?>
                                </span>
                            </div>
                            <div class="bottom">
                                <div class="wtf">
                                    <span class="date"style="
                                        <?php
                                            if ($row['status'] != "Abandoned") {
                                                echo "color: #2E5256;";
                                            } else {
                                                echo "color: black;";
                                            } 
                                        ?>
                                        "
                                    >
                                    
                                    Date submitted: 
                                    
                                    &nbsp;</span>
                                    <div class="datete"style="
                                        <?php
                                            if ($row['status'] != "Abandoned") {
                                                echo "color: #2E5256;";
                                            } else {
                                                echo "color: black;";
                                            } 
                                        ?>
                                        ">
                                        <?= htmlspecialchars(date("M d, Y", strtotime($row['date_submitted']))) ?> at
                                        <?= htmlspecialchars(date("h:i A", strtotime($row['date_submitted']))) ?>
                                    </div>

                                    <?php
                                        if ($row['status'] == "Approved") {
                                            echo "
                                                <span class='date' style='margin-left: 20px; color: #2E5256;'> Date approved: &nbsp;</span>
                                                <div class='datete' style='color: #2E5256;'>" .
                                                    htmlspecialchars(date('M d, Y', strtotime($row['date_reviewed']))) . " at " .
                                                    htmlspecialchars(date('h:i A', strtotime($row['date_reviewed']))) .
                                                "</div>";
                                        } elseif ($row['status'] == "Abandoned") {
                                            echo "
                                                <span class='date' style='margin-left: 20px; color: black;'> Date Abandoned: &nbsp;</span>
                                                <div class='datete' style='color: black;'>" .
                                                    htmlspecialchars(date('M d, Y', strtotime($row['date_reviewed']))) . " at " .
                                                    htmlspecialchars(date('h:i A', strtotime($row['date_reviewed']))) .
                                                "</div>";
                                        }
                                    ?>
                                </div>

                                <div class="actions">
                                    <?php
                                        if ($row['status'] == "Pending") {
                                            echo '
                                            <button class="btn abandon" onclick="openModal(\'abandonModal\', ' . $row['document_id'] . ')">
                                            
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="15"
                                                    height="15"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-trash"
                                                    >
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                                    />
                                                </svg>

                                            </button>
                                            ';
                                        }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No submissions found.</p>
    <?php endif; ?>
</div>

<form id="abandonModal" class="modal" action="../../controls/student/abandon_document.php" method="POST">
    <div class="modal-content">
        <span class="close" onclick="closeModal('abandonModal')">&times;</span>
        <h2>Abandon Document</h2>
        <p>Are you sure you want to abandon this document?</p>
        <input type="hidden" name="document_id" id="documentIdInput">
        <button type="submit">Confirm</button>
    </div>
</form>

<script>
    function openModal(modalId, documentId) {
        document.getElementById(modalId).style.display = "block";
        document.getElementById('documentIdInput').value = documentId;
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    window.onclick = function(event) {
        const modal = document.getElementById('abandonModal');
        if (event.target === modal) {
            closeModal('abandonModal');
        }
    };
</script>
