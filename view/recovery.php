<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "If the email exists in our system, you will receive further instructions.";
    } else {
        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "dara");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if email exists in `users` table
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $asd = 0;

        if ($result->num_rows > 0) {
            $insertStmt = $conn->prepare("INSERT INTO notification_logs (notification_id, email, is_checked) VALUES (NULL, ?, ?)");
            $insertStmt->bind_param("si", $email, $asd);
            $insertStmt->execute();
            $insertStmt->close();
        }

        $stmt->close();
        $conn->close();

        // Generic message for all users
        $message = "If the email exists in our system, you will receive your account in your email.";
    }
}
?>

<style>
    .contents {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
}

.recovery-container {
    background: white;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

.recovery-container h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.recovery-container .instructions {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}

.message {
    padding: 10px 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    font-size: 14px;
}

.message.success {
    background: #e6f9e6;
    color: #2e7d32;
    border: 1px solid #2e7d32;
}

.message.error {
    background: #fbeaea;
    color: #d32f2f;
    border: 1px solid #d32f2f;
}

.recovery-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-label {
    font-size: 14px;
    color: #333;
    text-align: left;
}

.form-input {
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: all 0.3s;
}

.form-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

.submit-btn {
    background: #8e0404;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

.submit-btn:hover {
    background: rgb(172, 11, 11);
}

</style>

<?php 
    include "../controls/search material/results_and_control.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/results.scss">
    <link rel="stylesheet" href="../css/mainpage.scss">
    <link rel="stylesheet" href="../css/student_nav.scss">
    <title>DARA Main Page</title>
</head>
<body>
    <main>
        <header>
            <?php 
                session_start();
                if (isset($_SESSION['role']) && $_SESSION['role'] == "Teacher") {
                    echo '
                    <a href="../teacher/">
                        <div class="loginbutton">
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
                            class="feather feather-user"
                        >
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>

                        <h4>&nbsp' . htmlspecialchars($_SESSION['first_name']) .' </h4>
                        </div>
                    </a>
                    ';
                } elseif (isset($_SESSION['role']) && $_SESSION['role'] == "Student") {
                    echo '
                    <a href="../student/">
                        <div class="loginbutton">
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
                            class="feather feather-user"
                            >
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                            </svg>

                            <h4>&nbsp' . htmlspecialchars($_SESSION['first_name']) .' </h4>
                        </div>
                    </a>
                    ';
                } elseif (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
                    echo '
                    <a href="../admin">
                    <div class="loginbutton">
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
                        class="feather feather-user"
                        >
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                        </svg>

                        <h4>&nbsp' . htmlspecialchars($_SESSION['first_name']) .' </h4>
                    </div>
                    </a>
                    ';
                } else { 
                    echo '
                    <a class="death" href="../view/login.php">
                        <div class="loginbutton">
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
                            <h4> &nbsp Login</h4>
                        </div> 
                    </a>';
                }
                ?>
            
            <div class="ahh">
                    <a href="/dara" class="help">
                        <img src="../Imgs/DARA.png" alt="" style="height: 25px;">
                    </a>
                <?php 
                    include "../controls/search material/search_bar.php";
                ?>
            </div>
        </header>

        <div class="contents">
            <div class="recovery-container">
                <h2 style="color: #8e0404;">Account Recovery</h2>
                <p class="instructions" style="line-height: normal; color: #8e0404 !important;">
                    Enter your registered email address to request account recovery. If it exists in our system, you will receive further instructions.
                </p>
                <?php if (isset($message)): ?>
                    <div class="message success">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST" class="recovery-form">
                    <label for="email" class="form-label">Email Address:</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="Enter your email" 
                        required
                    >
                    <button type="submit" class="submit-btn">Request Recovery</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<script src="../js/results.js"></script>

