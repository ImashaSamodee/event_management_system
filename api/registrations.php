<?php
session_start();
if(!isset($_SESSION['student_id'])){
    header("Location: index.html");
    exit();
}

include 'connection.php';

// Fetch joined user-event registration data
$sql = "SELECT u.student_id, u.full_name, u.email, u.contact_no, u.role,
               e.title AS event_title, e.date AS event_date, r.registered_at
        FROM registrations r
        JOIN users u ON r.student_id = u.student_id
        JOIN events e ON r.event_id = e.event_id
        ORDER BY r.registered_at DESC";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrations</title>
<link rel="stylesheet" href="dashboard_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
<style>
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
th { background-color: #f4f4f4; }
</style>
</head>
<body>
<div class="dashboard">
    <div class="sidebar">
        <div class="logo">
            <img src="https://lms.itum.mrt.ac.lk/pluginfile.php/1/theme_moove/logo/1717571353/site-logo.png" alt="">
        </div>
        <h2>ITUM Event Management</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fa-solid fa-home"></i> Home</a></li>
            <li><a href="event.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
            <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <li><a href="event_management.php"><i class="fa-solid fa-gear"></i> Event Management</a></li>
                <li><a href="user_management.php"><i class="fa-solid fa-users"></i> User Management</a></li>
                <li><a href="registrations.php" class="active"><i class="fa-solid fa-clipboard-list"></i> Registrations</a></li>
            <?php endif; ?>
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>User Registrations</h1>
        <?php if($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Role</th>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Registered At</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['registered_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No registrations found.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
