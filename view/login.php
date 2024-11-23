<?php 
    include "../controls/login/login_control.php";

    if ($_SESSION) {
        header('Location: ../');
    }
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
        <div class="lain"> 
            <div class="ahh">
                <?php 
                    include "../controls/search material/search_bar.php";
                ?>
            </div>
        </div>
        <div class="contents">
            <h1>D A R A</h1>
            
            <form method="post">
                <div class="inputs">
                    <div class="user">
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
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                        </svg>

                        <input type="text" name="usn" required><br>
                    </div>

                    <div class="pass">
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
                            class="feather feather-key"
                            >
                            <path
                                d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"
                            ></path>
                        </svg>

                        <input type="password" name="password" required><br>
                    </div>    
                </div>
                <div class="ubos">
                    <button type="submit">L O G I N</button>
                    <a href="request">Forgot password?</a>
                </div>
            </form>
            <?php if (isset($error)): ?> 
                <div style="color: red; margin-top: 10px;" class="error"><?= $error ?></div>
            <?php endif; ?>
        </div>
        <footer>
            <a href="#">About DARA</a>
            <p>&nbsp | &nbsp</p>
            <a href="#">Contact us</a>
        </footer>
    </main>
</body>
</html>