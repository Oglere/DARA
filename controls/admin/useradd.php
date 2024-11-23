
<link rel="stylesheet" href="../../css/yey.scss">

<?php
require '../../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $username = htmlspecialchars(trim($_POST['Username']));
    $password = password_hash(trim($_POST['pass']), PASSWORD_BCRYPT); 
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $role = htmlspecialchars(trim($_POST['role']));

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($username)) {
        $check_query = "SELECT COUNT(*) AS count FROM users WHERE usn = ?";
        $check_stmt = mysqli_prepare($conn, $check_query);

        if ($check_stmt) {
            mysqli_stmt_bind_param($check_stmt, "s", $username);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_bind_result($check_stmt, $count);
            mysqli_stmt_fetch($check_stmt);
            mysqli_stmt_close($check_stmt);

            if ($count > 0) {
                echo "Error: Username already exists. Please choose a different username.";
                exit(); 
            }
        } else {
            echo "Error: Could not prepare the statement: " . mysqli_error($conn);
            exit(); 
        }

        $query = "INSERT INTO users (first_name, last_name, usn, password_hash, email, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $username, $password, $email, $role);

            if (mysqli_stmt_execute($stmt)) {
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

                        window.location('../../admin/user-control');
                    </script>
                ";
            } else {
                echo "Error: Could not execute the query: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Could not prepare the statement: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid email or username.";
    }
} else {
    echo "Invalid request method.";
}

mysqli_close($conn);
?>

<div class="frbg" style="width: 100%; height: 100%; display: flex; justify-content: center;">
    <div class="notif">
        <div class="imghere">
            <img src="../../imgs/review.png" alt="" />
        </div>
        <div
            class="teksto"
            style="display: flex; margin-top: -16px; text-align: center"
        >
            <p>
            Submitted <br />
            Added!
            </p>
        </div>
    </div>
</div>