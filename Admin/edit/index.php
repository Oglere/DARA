<?php
include '../../db/db.php';
include '../../controls/utils.php';
session_start();

if (!isLoggedIn() || $_SESSION['role'] !== 'Admin') {
    header('Location: ../../view/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DARA - Edit Account</title>
    <link rel="stylesheet" href="../../css/std.scss">
    <link rel="stylesheet" href="../../css/mainpage.scss">
    <link rel="stylesheet" href="../../css/std_control.scss">
    <link rel="stylesheet" href="../../css/usercontrol.scss">
    <link rel="stylesheet" href="../../css/atayaanioy.scss">
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
                    <a href="../messages">
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
                    <a href="" class="unq" style="color: #8e0404; font-weight: normal;">Edit Account</a>
                    <a href="../recovery" class="unq">Recovery</a>

                    <div class="asd2" style=" width: 100%; display: flex; justify-content: center;">
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
                <div id="edit-account-section">
                    <div id="verify-user" class="VYI">
                        <h2>VERIFY YOUR IDENTITY</h2>
                        <form id="verify-form" method="post">
                            <label for="password">Enter your password:</label>
                            <input type="password" id="password" name="password" required>
                            <button type="submit" class="kapoya">Verify</button>
                        </form>
                    </div>

                    <div id="edit-account-container">
                        <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $password = trim($_POST['password']);
                                $session_ID = $_SESSION['user_id'];
                            
                                $query = "SELECT user_id, first_name, last_name, usn, email, password_hash FROM users WHERE user_id = ?";
                                $stmt = $conn->prepare($query);
                            
                                if ($stmt) {
                                    $stmt->bind_param("i", $session_ID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $user = $result->fetch_assoc();
                            
                                    if ($user && password_verify($password, $user['password_hash'])) {
                                        echo <<<HTML
                                            <style> 
                                                .VYI {
                                                    display: none;
                                                }
                                            </style>

                                            <h2>Edit Your Account</h2>

                                            <div class="HiOy">
                                                <form id="edit-account-form" method="post" action="../../controls/update-account.php">
                                                    <div class="nalain">
                                                        <label for="usn">Username</label>
                                                        <input class="halaoy" type="text" name="usn" value="{$user['usn']}" disabled>
                                                    </div>

                                                    <div class="tanawara">
                                                        <div class="kilidra">
                                                            <label for="edit_first_name">Edit First Name</label>
                                                            <input type="text" id="first_name" name="first_name" value="{$user['first_name']}">
                                                        </div>
                                                    </div>

                                                    <div class="tanawara">
                                                        <div class="kilidra">
                                                            <label for="edit_last_name">Edit Last Name</label>
                                                            <input type="text" id="last_name" name="last_name" value="{$user['last_name']}">
                                                        </div>
                                                    </div>

                                                    <div class="tanawara">
                                                        <div class="kilidra">
                                                            <label for="edit_email">Edit Email</label>
                                                            <input type="email" id="email" name="email" value="{$user['email']}">
                                                        </div>
                                                    </div>

                                                    <div class="tanawara">
                                                        <div class="kilidra">
                                                            <label for="password">New Password (leave blank to keep current password)</label>
                                                            <input type="password" id="password" name="password" placeholder="Enter new password">
                                                        </div>
                                                    </div>

                                                    <div class="botoning">
                                                        <button type="submit" class="sab">Update Account</button>
                                                        <button type="button" class="nac" id="closeModal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        HTML;
                                    } else {
                                        echo '<p style="color:red;">Invalid password. Please try again.</p>';
                                    }
                            
                                    $stmt->close();
                                } else {
                                    echo '<p style="color:red;">Database query failed: ' . $conn->error . '</p>';
                                }
                            } 
                            ?>

                    </div>
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