
<?php
include '../../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Admin') {
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

            <div class="main" style="height: 100%;">
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
                        <a href="../edit" class="unq">Edit Account</a>
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
                    
                    <div id="add-user-form" class="hidden">
                        <h2>Add New User</h2>
                        <form id="user-form" method="post" action="../../controls/admin/useradd.php">
                            <div class="suloda">
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" id="first-name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" id="last-name" name="last_name" required>
                                </div> 
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="number" id="Username" name="Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="text" id="pass" name="pass" required>
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
                            <div class="filter-group"">
                                <input type="text" id="search-bar" placeholder="Search users by name or email..." oninput="filterUsers()">
                                <div class="aridiri">
                                    <button class="btn-primary filter-btn" data-role="all">All</button>
                                    <button class="btn-secondary filter-btn" data-role="Admin">Admins</button>
                                    <button class="btn-secondary filter-btn" data-role="Teacher">Teachers</button>
                                    <button class="btn-secondary filter-btn" data-role="Student">Students</button>
                                </div>
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
                                    <th style="display: none;">ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $admin = $_SESSION['user_id'];
                                $query = "SELECT * FROM users WHERE user_id != ? AND status != 'Deleted'";
                                $stmt = mysqli_prepare($conn, $query);
                                
                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "i", $admin);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                            
                                    $users = [];
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $users[] = $row;
                                    }
                            
                                    // Loop through the $users array
                                    foreach ($users as $user) {
                                        if ($user['role'] == "Admin") {
                                            echo '<tr style="color: #8e0404;" data-id="' . htmlspecialchars($user['user_id']) . '">';
                                            echo '<td style="display: none;">' . htmlspecialchars($user['user_id']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['first_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['last_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['role']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['status']) . '</td>';
                                            echo '<td>
                                                    <button class="edit-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Edit</button>
                                                    <button class="delete-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Delete</button>
                                                </td>';
                                            echo '</tr>';
                                        } elseif ($user['role'] == "Teacher") {
                                            echo '<tr style="color: #04128e;" data-id="' . htmlspecialchars($user['user_id']) . '">';
                                            echo '<td style="display: none;">' . htmlspecialchars($user['user_id']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['first_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['last_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['role']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['status']) . '</td>';
                                            echo '<td>
                                                    <button class="edit-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Edit</button>
                                                    <button class="delete-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Delete</button>
                                                </td>';
                                            echo '</tr>';
                                        } else {
                                            echo '<tr style="color: green;" data-id="' . htmlspecialchars($user['user_id']) . '">';
                                            echo '<td style="display: none;">' . htmlspecialchars($user['user_id']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['first_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['last_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['role']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['status']) . '</td>';
                                            echo '<td>
                                                    <button class="edit-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Edit</button>
                                                    <button class="delete-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Delete</button>
                                                </td>';
                                            echo '</tr>';
                                        }
                                        
                                    }
                             
                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "Error preparing the statement: " . mysqli_error($conn);
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div id="delete-modal" class="modal hidden">
                        <div class="modal-content">
                            <h2>Confirm Deletion</h2>
                            <p>Are you sure you want to delete this user?</p>
                            <div class="botoning">
                                <button type="submit" id="confirm-delete" class="sab">Delete</button>
                                <button id="cancel-delete" class="nac">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <div id="edit-modal" class="hidden tree">
                        <form id="edit-user-form" class="asdasd" data-user-id="USER_ID_PLACEHOLDER">
                            <label style="margin-bottom: 5px;" for="edit-fname">First Name</label>
                            <input type="text" id="edit-fname" name="fname" required>
                            <label style="margin-bottom: 5px;" for="edit-lname">Last Name</label>
                            <input type="text" id="edit-lname" name="lname" required>
                            <label style="margin-bottom: 5px;" for="edit-email">Email</label>
                            <input type="email" id="edit-email" name="email" required>
                            <label style="margin-bottom: 5px;" for="edit-password">Password (leave blank to keep current password)</label>
                            <input id="edit-password" name="password">
                            <label style="margin-bottom: 5px;" for="edit-role">Role</label>
                            <select id="edit-role" name="role" required>
                                <option value="Student">Student</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Admin">Admin</option>
                            </select>
                            <label style="margin-bottom: 5px;" for="edit-status">Status</label>
                            <select id="edit-status" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <div class="botoning">
                                <button type="submit" class="sab" onClick="updateUSR(id of user)">Save</button>
                                <button type="button" id="cancel-edit" class="nac">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
            <footer>
            </footer>
        </main>
    </body>
</html>

<script src="../../js/usercontrol.js"> </script>
