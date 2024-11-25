<link rel="stylesheet" href="../css/yey.scss">


<?php
session_start();
include "../db/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo '<p style="color:red;">User is not authenticated. Please log in.</p>';
        exit;
    }

    $session_ID = $_SESSION['user_id']; 
    $new_first_name = trim($_POST['first_name']);
    $new_last_name = trim($_POST['last_name']);
    $new_email = trim($_POST['email']);
    $new_password = trim($_POST['password']); 

    $query = "SELECT first_name, last_name, email, password_hash FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $session_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            $updates = [];
            $params = [];
            $param_types = "";

            if ($new_first_name !== $user['first_name']) {
                $updates[] = "first_name = ?";
                $params[] = $new_first_name;
                $param_types .= "s";
            }

            if ($new_last_name !== $user['last_name']) {
                $updates[] = "last_name = ?";
                $params[] = $new_last_name;
                $param_types .= "s";
            }

            if ($new_email !== $user['email']) {
                $updates[] = "email = ?";
                $params[] = $new_email;
                $param_types .= "s";
            }

            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $updates[] = "password_hash = ?";
                $params[] = $hashed_password;
                $param_types .= "s";
            }

            if (!empty($updates)) {
                $update_query = "UPDATE users SET " . implode(", ", $updates) . " WHERE user_id = ?";
                $params[] = $session_ID;
                $param_types .= "i";

                $update_stmt = $conn->prepare($update_query);
                if ($update_stmt) {
                    $update_stmt->bind_param($param_types, ...$params);
                    if ($update_stmt->execute()) {
                        $_SESSION['first_name'] = $new_first_name;
                        $_SESSION['last_name'] = $new_last_name;
                        echo "
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const frbg = document.querySelector('.frbg');

                                    frbg.style.visibility = 'hidden';
                                    setTimeout(() => {
                                        frbg.classList.add('fade-in');
                                        frbg.style.visibility = 'visible';
                                    }, 100);

                                    setTimeout(() => {
                                        frbg.classList.remove('fade-in');
                                        frbg.classList.add('fade-out');
                                    }, 2000);

                                    setTimeout(() => {
                                        frbg.style.visibility = 'hidden';
                                        frbg.classList.remove('fade-out');
                                        window.location.href = '../". $_SESSION['role'] ."/edit';
                                    }, 2500);
                                });
                            </script>
                        ";
                    } else {
                        echo '<p style="color:red;">Error updating account: ' . $conn->error . '</p>';
                    }
                    $update_stmt->close();
                } else {
                    echo '<p style="color:red;">Failed to prepare update query: ' . $conn->error . '</p>';
                }
            } else {
                echo '<p style="color:orange;">No changes detected. Nothing to update.</p>';
            }
        } else {
            echo '<p style="color:red;">User not found.</p>';
        }
    } else {
        echo '<p style="color:red;">Database query failed: ' . $conn->error . '</p>';
    }
}
?>
<style>
    body {
        margin: 0;
        padding: 0;
    }
</style>
<div class="frbg" style="margin-bottom: 20px; width: 100%; height: 100%; display: flex; justify-content: center;">
    <div class="notif">
        <div class="imghere" style="display: flex; justify-content: center;">
            <img src="../imgs/updated.png" alt="" />
        </div>
        <div class="teksto" style="display: flex; text-align: center; justify-content: center;">
            <p>
                Account Updated!
            </p>
        </div>
    </div>
</div>

