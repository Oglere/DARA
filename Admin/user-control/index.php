
<?php
include '../../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Admin') {
    header('Location: ../../view/login.php');
    exit();
}
?>

<style>
    svg {
        margin-right: 10px;
    }

    .right h1, .right h2 {
        color: #8e0404;
        margin-bottom: 15px;
    }

    .actions {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #8e0404;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
        box-shadow: 3px 3px 4px #7b7b7b, -3px -3px 4px #ffffff;
    }

    .btn-secondary {
        background-color: rgb(224, 224, 224);
        color: black;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
        transition: all 0.1s ease;
    }

    .btn-secondary:hover {
        box-shadow: 3px 3px 4px #7b7b7b, -3px -3px 4px #ffffff;
    }

    .hidden {
        display: none;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    table th {
        background-color: #8e0404;
        color: white;
    }

    .edit-btn, .delete-btn {
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .edit-btn {
        background-color: #28a745;
        color: white;
    }

    .delete-btn {
        background-color: #8e0404;
        color: white;
    }

    #search-bar {
        padding: 10px;
        width: 300px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .right {
        display: flex;
        align-content: flex-start;
    }

    #user-list {
        width: 100%;
    }

    svg {
        margin-right: 10px;
        }

    .right h1, .right h2 {
        color: #8e0404;
        margin-bottom: 15px;
    }

    .actions {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .hidden {
        display: none;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    table th {
        background-color: #8e0404;
        color: white;
    }

    .edit-btn, .delete-btn {
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        border: none;
        color: white;
    }

    .edit-btn {
        background-color: #28a745;
    }

    .delete-btn {
        background-color: #8e0404;
    }

    #search-bar {
        padding: 10px;
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #add-user-form {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        max-width: 400px;
        width: 90%;
    }

    #add-user-form h2 {
        margin-bottom: 15px;
        color: #8e0404;
    }

    #add-user-form .form-group {
        margin-bottom: 15px;
    }

    #add-user-form label {
        display: block;
        margin-bottom: 5px;
    }

    #add-user-form input, #add-user-form select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #add-user-form button {
        width: 48%;
        margin-right: 4%;
    }

    #add-user-form button:last-child {
        margin-right: 0;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    .adda {
        background-color: #8e0404;
        border-radius: 49px;
        width: 175px;
        font-weight: lighter;
        height: 36.58px;
        display: flex;
        border: none;
        cursor: pointer;
        transition: all 0.1s ease;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .adda:hover {
        box-shadow: 3px 3px 4px #7b7b7b, -3px -3px 4px #ffffff;
        color: white;
        font-weight: normal;
    }

    .botoning {
        display: flex;
    }

    .sab {
        border-radius: 49px;
        width: 175px;
        margin-top: 40px;
        font-weight: lighter;
        height: 40px;
        display: flex;
        border: none;
        cursor: pointer;
        transition: all 0.1s ease;
        align-items: center;
        font-family: "rubik";
        justify-content: center;
        background-color: #8e0404;
        color: white;
    }

    .sab:hover {
        box-shadow: 3px 3px 4px #7b7b7b, -3px -3px 4px #ffffff;
        font-weight: normal;
    }

    .nac {
        border-radius: 49px;
        width: 175px;
        margin-top: 40px;
        font-weight: lighter;
        height: 40px;
        display: flex;
        border: none;
        cursor: pointer;
        transition: all 0.1s ease;
        align-items: center;
        font-family: "rubik";
        justify-content: center;
    }
</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DARA - Admin Dashboard</title>
    <link rel="stylesheet" href="../../css/std.scss">
    <link rel="stylesheet" href="../../css/mainpage.scss">
    <link rel="stylesheet" href="../../css/std_control.scss">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Dashboard
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
                            class="feather feather-users"
                            >
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Manage Users
                    </a>
                    <a href="/dara/student/document-status">
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

                    <div class="divider"></div>

                    <a href="../../" class="unq">Search Studies</a>

                    <div class="divider"></div>
                    <a href="../../view/logout.php" class="logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                        Logout
                    </a>
                </nav>
            </div>

            <div class="right" style="overflow: auto; padding: 20px;">
                <div id="add-user-form" class="hidden">
                    <h2>Add New User</h2>
                    <form id="user-form">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role" required>
                                <option value="Admin">Admin</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Student">Student</option>
                            </select>
                        </div>
                        <div class="botoning">
                            <button type="submit" class="sab">Add</button>
                            <button type="button" class="nac" id="cancel-add">Cancel</button>
                        </div>
                    </form>
                </div>
                <div class="overlay hidden"></div>

                

                <div id="user-list">
                    <div class="actions">
                        <div class="filter-group">
                            <input type="text" id="search-bar" placeholder="Search users by name or email..." oninput="filterUsers()">
                            <button class="btn-primary filter-btn" data-role="all">All</button>
                            <button class="btn-secondary filter-btn" data-role="Admin">Admins</button>
                            <button class="btn-secondary filter-btn" data-role="Teacher">Teachers</button>
                            <button class="btn-secondary filter-btn" data-role="Student">Students</button>
                        </div>
                        <button id="add-user-btn" class="adda">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="22"
                                height="22"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-user-plus"
                                >
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                                <line x1="20" y1="8" x2="20" y2="14" />
                                <line x1="23" y1="11" x2="17" y2="11" />
                            </svg>

                            Add New User
                        </button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($row['user_id']) . "</td>
                                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['role']) . "</td>
                                    <td>
                                        <button class='edit-btn' data-id='" . $row['user_id'] . "'>Edit</button>
                                        <button class='delete-btn' data-id='" . $row['user_id'] . "'>Delete</button>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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

<script>
document.getElementById('add-user-btn').addEventListener('click', () => {
    document.getElementById('add-user-form').classList.remove('hidden');
    document.getElementById('user-list').classList.add('hidden');
});

document.getElementById('cancel-add').addEventListener('click', () => {
    document.getElementById('add-user-form').classList.add('hidden');
    document.getElementById('user-list').classList.remove('hidden');
});

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', () => {
        if (confirm('Are you sure you want to delete this user?')) {
            const userId = button.getAttribute('data-id');
            // Send AJAX request to delete user
            // Add your PHP backend handling here
        }
    });
});

document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', () => {
        const role = button.getAttribute('data-role');
        filterUsers(role);
        
        // Update button styling
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.replace('btn-primary', 'btn-secondary'));
        button.classList.replace('btn-secondary', 'btn-primary');
    });
});

function filterUsers(role = 'all') {
    const searchQuery = document.getElementById('search-bar').value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const name = row.children[1].textContent.toLowerCase() + ' ' + row.children[2].textContent.toLowerCase();
        const email = row.children[3].textContent.toLowerCase();
        const userRole = row.children[4].textContent;

        const matchesSearch = name.includes(searchQuery) || email.includes(searchQuery);
        const matchesRole = role === 'all' || userRole === role;

        row.style.display = matchesSearch && matchesRole ? '' : 'none';
    });
}

// Toggle Add User Modal
document.getElementById('add-user-btn').addEventListener('click', () => {
    document.getElementById('add-user-form').classList.remove('hidden');
    document.querySelector('.overlay').classList.remove('hidden');
});

document.getElementById('cancel-add').addEventListener('click', () => {
    document.getElementById('add-user-form').classList.add('hidden');
    document.querySelector('.overlay').classList.add('hidden');
});

// Filter and Search
document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', () => {
        const role = button.getAttribute('data-role');
        filterUsers(role);

        // Update button styles
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.replace('btn-primary', 'btn-secondary'));
        button.classList.replace('btn-secondary', 'btn-primary');
    });
});

function filterUsers(role = 'all') {
    const searchQuery = document.getElementById('search-bar').value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const name = row.children[1].textContent.toLowerCase() + ' ' + row.children[2].textContent.toLowerCase();
        const email = row.children[3].textContent.toLowerCase();
        const userRole = row.children[4].textContent;

        const matchesSearch = name.includes(searchQuery) || email.includes(searchQuery);
        const matchesRole = role === 'all' || userRole === role;

        row.style.display = matchesSearch && matchesRole ? '' : 'none';
    });
}

</script>

