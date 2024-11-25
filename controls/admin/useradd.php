<link rel="stylesheet" href="../../css/yey.scss">

<?php
require '../../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $username = trim(strtolower($_POST['Username']));
    $password = password_hash(trim($_POST['pass']), PASSWORD_BCRYPT); 
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $role = htmlspecialchars(trim($_POST['role']));
    $stat = "Active";

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($username)) {
        // Check if the username already exists
        $check_query = "SELECT COUNT(*) AS count FROM users WHERE usn = ?";
        $check_stmt = $conn->prepare($check_query);

        if (!$check_stmt) {
            die("Error: Could not prepare check statement: " . $conn->error);
        }

        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            echo "Error: Username already exists. Please choose a different username. " . $count . "";
        } else {
            // Insert the new user into the database
            $insert_query = "INSERT INTO users (first_name, last_name, usn, password_hash, email, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);

            if (!$insert_stmt) {
                die("Error: Could not prepare insert statement: " . $conn->error);
            }

            $insert_stmt->bind_param("sssssss", $first_name, $last_name, $username, $password, $email, $role, $stat);

            if ($insert_stmt->execute()) {
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
                                window.location.href = '../../admin/user-control';
                            }, 2500);
                        });
                    </script>
                ";
            } else {
                echo "Error: Could not execute the query: " . $insert_stmt->error;
            }

            $insert_stmt->close();
        }
    } else {
        echo "Invalid email or username.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>

<div class="frbg" style="width: 100%; height: 100%; display: flex; justify-content: center;">
    <div class="notif">
        <div class="imghere">
            <img src="../../imgs/add-friend.png" alt="" />
        </div>
        <div class="teksto" style="display: flex; margin-top: -16px; text-align: center">
            <p>
                Account <br />
                Added!
            </p>
        </div>
    </div>
</div>
