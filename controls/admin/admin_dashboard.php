<style>
<style>
/* General Styling */
.dashboard-container {
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    color: #333;
    margin: 10px;
}

h1 {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #4CAF50;
}

/* Stats Section */
.stats {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    flex: 1 1 calc(20% - 20px);
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.stat-card h2 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #4CAF50;
}

.stat-card p {
    font-size: 18px;
    font-weight: bold;
}

/* User Overview Section */
.user-stats {
    background: #f7f7f7;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.user-stats h2 {
    font-size: 22px;
    margin-bottom: 10px;
    color: #4CAF50;
}

.user-stats ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.user-stats ul li {
    margin: 5px 0;
    font-size: 16px;
}

/* Recent Documents Table */
.recent-docs {
    padding: 15px;
    background: #f7f7f7;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.recent-docs h2 {
    font-size: 22px;
    margin-bottom: 10px;
    color: #4CAF50;
}

.recent-docs table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.recent-docs th {
    background-color: #4CAF50;
    color: white;
    text-align: left;
    padding: 10px;
    font-size: 14px;
}

.recent-docs td {
    padding: 10px;
    text-align: left;
    font-size: 14px;
    border: 1px solid #ddd;
}

.recent-docs tr:hover {
    background-color: #f1f1f1;
}
</style>

</style>

<?php
include '../db/db.php';

if ($_SESSION['role'] !== 'Admin') {
    header('Location: ../view/login.php');
    exit();
}

// Query for statistics
$total_docs = $conn->query("SELECT COUNT(*) AS total FROM document_repository")->fetch_assoc()['total'];
$pending_docs = $conn->query("SELECT COUNT(*) AS pending FROM document_repository WHERE status = 'Pending'")->fetch_assoc()['pending'];
$abandoned_docs = $conn->query("SELECT COUNT(*) AS abandoned FROM document_repository WHERE abandoned_date IS NOT NULL")->fetch_assoc()['abandoned'];
$lost_docs = $conn->query("SELECT COUNT(*) AS lost FROM document_repository WHERE lost_date IS NOT NULL")->fetch_assoc()['lost'];
$recovered_docs = $conn->query("SELECT COUNT(*) AS recovered FROM document_repository WHERE recovered_date IS NOT NULL")->fetch_assoc()['recovered'];

$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$student_users = $conn->query("SELECT COUNT(*) AS students FROM users WHERE role = 'Student'")->fetch_assoc()['students'];
$teacher_users = $conn->query("SELECT COUNT(*) AS teachers FROM users WHERE role = 'Teacher'")->fetch_assoc()['teachers'];
$admin_users = $conn->query("SELECT COUNT(*) AS admins FROM users WHERE role = 'Admin'")->fetch_assoc()['admins'];

// Query for recent documents
$recent_docs = $conn->query("SELECT title, date_submitted, status FROM document_repository ORDER BY date_submitted DESC LIMIT 5");
?>

<div class="dashboard-container">
        <h1>Admin Dashboard</h1>

        <!-- Statistics Summary -->
        <div class="stats">
            <div class="stat-card">
                <h2>Total Documents</h2>
                <p><?php echo $total_docs; ?></p>
            </div>
            <div class="stat-card">
                <h2>Pending Reviews</h2>
                <p><?php echo $pending_docs; ?></p>
            </div>
            <div class="stat-card">
                <h2>Abandoned</h2>
                <p><?php echo $abandoned_docs; ?></p>
            </div>
            <div class="stat-card">
                <h2>Lost</h2>
                <p><?php echo $lost_docs; ?></p>
            </div>
            <div class="stat-card">
                <h2>Recovered</h2>
                <p><?php echo $recovered_docs; ?></p>
            </div>
        </div>

        <!-- User Summary -->
        <div class="user-stats">
            <h2>User Overview</h2>
            <ul>
                <li>Total Users: <?php echo $total_users; ?></li>
                <li>Students: <?php echo $student_users; ?></li>
                <li>Teachers: <?php echo $teacher_users; ?></li>
                <li>Admins: <?php echo $admin_users; ?></li>
            </ul>
        </div>

        <!-- Recent Documents -->
        <div class="recent-docs">
            <h2>Recent Submissions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($doc = $recent_docs->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($doc['title']); ?></td>
                            <td><?php echo htmlspecialchars($doc['date_submitted']); ?></td>
                            <td><?php echo htmlspecialchars($doc['status']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>