
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
                        <a href="../edit" class="unq">Edit Account</a>
                        <a href="" style="color: #8e0404; font-weight: normal;" class="unq">Recovery</a>

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
                    <div id="user-list" >
                        <div class="actions">
                            <div class="filter-group">
                                <input type="text" id="search-bar" placeholder="Search users by name or email..." oninput="filterUsers()">
                                <button class="btn-primary filter-btn" data-role="all">All</button>
                                <button class="btn-secondary filter-btn" data-role="Admin">Admins</button>
                                <button class="btn-secondary filter-btn" data-role="Teacher">Teachers</button>
                                <button class="btn-secondary filter-btn" data-role="Student">Students</button>
                            </div>
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
                                $query = "SELECT * FROM users WHERE status = 'Deleted'";
                                $stmt = mysqli_prepare($conn, $query);
                                
                                if ($stmt) {
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                            
                                    $users = [];
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $users[] = $row;
                                    }
                            
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
                                                    <button class="recover-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Recover</button>
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
                                                    <button class="recover-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Recover</button>
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
                                                    <button class="recover-btn" data-id="' . htmlspecialchars($user['user_id']) . '">Recover</button>
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

                    <div id="recover-modal" class="modal hidden">
                        <div class="modal-content">
                            <h2>Recover this account?</h2>
                            <p>Are you sure you want to recover this user?</p>
                            <div class="botoning">
                                <button type="submit" id="confirm-recover" class="sab">Recover</button>
                                <button id="cancel-delete" class="nac">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay hidden"></div>

            </div>
        </div>
            <footer>
            </footer>
        </main>
    </body>
</html>

<script>
    function filterUsers(role = "all") {
  const searchQuery = document.getElementById("search-bar").value.toLowerCase();
  const rows = document.querySelectorAll("tbody tr");

  rows.forEach((row) => {
    const name = `${row.children[1].textContent.toLowerCase()} ${row.children[2].textContent.toLowerCase()}`;
    const email = row.children[3].textContent.toLowerCase();
    const userRole = row.children[4].textContent.toLowerCase();

    const matchesSearch =
      name.includes(searchQuery) || email.includes(searchQuery);
    const matchesRole = role === "all" || userRole === role.toLowerCase();

    row.style.display = matchesSearch && matchesRole ? "" : "none";
  });
}

document.querySelectorAll(".filter-btn").forEach((button) => {
  button.addEventListener("click", () => {
    const role = button.getAttribute("data-role");
    filterUsers(role);

    // Update button styles for active state
    document.querySelectorAll(".filter-btn").forEach((btn) => {
      btn.classList.replace("btn-primary", "btn-secondary");
    });
    button.classList.replace("btn-secondary", "btn-primary");
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const recoverModal = document.getElementById("recover-modal");
  const confirmRecover = document.getElementById("confirm-recover");
  const cancelRecover = document.getElementById("cancel-delete");
  let currentUserId = null;

  // Show modal when "Recover" button is clicked
  document.querySelectorAll(".recover-btn").forEach((button) => {
    button.addEventListener("click", () => {
    document.querySelector(".overlay").classList.remove("hidden");
      currentUserId = button.getAttribute("data-id");
      recoverModal.classList.remove("hidden");
    });
  });

  // Recover the user
  confirmRecover.addEventListener("click", () => {
    if (currentUserId) {
      fetch("../../controls/admin/recover.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ user_id: currentUserId }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert("User recovered successfully!");
            location.reload(); // Reload to update the table
          } else {
            alert("Failed to recover user: " + data.message);
          }
        })
        .catch((err) => {
          console.error("Error:", err);
          alert("An error occurred while recovering the user.");
        });
    }
  });

  cancelRecover.addEventListener("click", () => {
    document.querySelector(".overlay").classList.add("hidden");
    recoverModal.classList.add("hidden");
    currentUserId = null;
  });
});

</script>
