
<?php
include '../../db/db.php';
session_start();

if ($_SESSION && $_SESSION['role'] !== 'Admin') {
    header('Location: ../../view/login.php');
    exit();
}
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DARA - Admin Dashboard</title>
        <link rel="stylesheet" href="../../css/std.scss">
        <link rel="stylesheet" href="../../css/mainpage.scss">
        <link rel="stylesheet" href="../../css/std_control.scss">
        <link rel="stylesheet" href="../../css/usercontrol.scss">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <main>
            <header> 
                <div class="ahh">
                    <img src="../../Imgs/DARA.png" alt="DARA Logo" class="ahh">
                </div>
            </header>

            <div class="main" style="height: calc(100% - 121px);">
                <div class="left">
                    <div class="profile">
                        <h2><?php echo htmlspecialchars($_SESSION['first_name']); ?></h2>
                    </div>

                    <nav class="nav-links">
                        <a href="../"> 
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-home"
                                >
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>

                            Dashboard
                        </a>
                        <a href="../user-control">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-users"
                                >
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            Manage Users
                        </a>
                        <a href="" style="color: #04128e; font-weight: normal;">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-mail"
                                >
                                <path
                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>

                            Inbox
                        </a>

                        <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                            <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
                        </div>

                        <a href="../../" class="unq">Search Studies</a>
                        <a href="../edit" class="unq">Edit Account</a>
                        <a href="../recovery" class="unq">Recovery</a>

                        <div class="asd2" style=" width: 100%; 10px; display: flex; justify-content: center;">
                            <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
                        </div>

                        <a href="../../view/logout.php" class="logout-btn">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-log-in"
                                >
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>

                            Logout
                        </a>
                    </nav>
                </div>

                <div class="right" style="overflow: auto; padding: 20px;">
                </div>

            </div>
        </div>
            <footer>
                <a href="#">About DARA</a>
                <p>&nbsp;|&nbsp;</p>
                <a href="#">Contact us</a>
            </footer>
        </main>
    </body>
</html>

<script src="../../js/usercontrol.js"> </script>
