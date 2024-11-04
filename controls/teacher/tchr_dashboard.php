<h1>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>! You have</h1>

                <div class="cardco">
                    <div class="cards submit">
                        <div class="svg1">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="100"
                                height="100"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-book"
                                >
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                            </svg>
                        </div>

                        <div class="count">
                            <?php echo $data['to_review']; ?>
                        </div>

                        <div class="text">
                            <p> STUDIES TO REVIEW</p>
                        </div>
                    </div>

                    <div class="cards published">
                        <div class="svg2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="100"
                                height="100"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-check-square"
                                >
                                <polyline points="9 11 12 14 22 4" />
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                            </svg>
                        </div>

                        <div class="count">
                            <?php echo $data['published_count']; ?>
                        </div>

                        <div class="text">
                            <p>APPROVED STUDIES</p>
                        </div>
                    </div>
                    
                    <div class="cards rejected">
                        <div class="svg5">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="120"
                                height="120"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-x"
                                >
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </div>

                        <div class="count">
                            <?php echo $data['rejected_count']; ?>  
                        </div>

                        <div class="text">
                            <p>REJECTED STUDIES</p>
                        </div>
                    </div>
                </div>