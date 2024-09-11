<?php 
    include "../controls/login/login_control.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Login</title>
    <link rel="stylesheet" href="../css/mainpage.scss">
    <link rel="stylesheet" href="../css/login.scss">
</head>
<body>
    <main>
        <header> 
            <a href="login.php">
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
            </a>
        </header>
        <div class="contents">
            <h1>Login</h1>
            <?php if (isset($error)): ?> 
                <p><?= $error ?></p>
            <?php endif; ?>
            <form method="post">
                USN: <input type="text" name="usn" required><br>
                Password: <input type="password" name="password" required><br>
                <button type="submit">Login</button>
            </form>
        </div>
        <footer>
            <a href="#">About DARA</a>
            <p>&nbsp | &nbsp</p>
            <a href="#">Contact us</a>
        </footer>
    </main>
</body>
</html>