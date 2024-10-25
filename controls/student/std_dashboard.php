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
                            <?php echo $data['total_submitted']; ?>
                        </div>

                        <div class="text">
                            <p>SUBMITTED STUDIES</p>
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
                            <p>PUBLISHED STUDIES</p>
                        </div>
                    </div>

                    <div class="cards pending">
                        <div class="svg3">
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
                                class="feather feather-loader"
                                >
                                <line x1="12" y1="2" x2="12" y2="6" />
                                <line x1="12" y1="18" x2="12" y2="22" />
                                <line x1="4.93" y1="4.93" x2="7.76" y2="7.76" />
                                <line x1="16.24" y1="16.24" x2="19.07" y2="19.07" />
                                <line x1="2" y1="12" x2="6" y2="12" />
                                <line x1="18" y1="12" x2="22" y2="12" />
                                <line x1="4.93" y1="19.07" x2="7.76" y2="16.24" />
                                <line x1="16.24" y1="7.76" x2="19.07" y2="4.93" />
                            </svg>
                        </div>

                        <div class="count">
                            <?php echo $data['pending_count']; ?>
                        </div>

                        <div class="text">
                            <p>PENDING STUDIES</p>
                        </div>
                    </div>

                    <div class="cards revisions">
                        <div class="svg4">
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
                                class="feather feather-info"
                                >
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="16" x2="12" y2="12" />
                                <line x1="12" y1="8" x2="12.01" y2="8" />
                            </svg>
                        </div>

                        <div class="count">
                            <?php echo $data['revision_count']; ?>
                        </div>

                        <div class="text">
                            <p>REVISIONS TO DO</p>
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