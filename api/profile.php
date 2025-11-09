<?php
session_start();
if(!isset($_SESSION['student_id'])){
    header("Location: index.html");
    exit();
}

include 'connection.php';

// Fetch logged-in user info
$student_id = $_SESSION['student_id'];
$stmt = $conn->prepare("SELECT student_id, full_name, email, contact_no, role FROM users WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<link rel="stylesheet" href="dashboard_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
<div class="dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="https://lms.itum.mrt.ac.lk/pluginfile.php/1/theme_moove/logo/1717571353/site-logo.png" alt="">
        </div>
        <h2>ITUM Event Management</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fa-solid fa-home"></i> Home</a></li>
            <li><a href="event.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
            <li><a href="profile.php" class="active"><i class="fa-solid fa-user"></i> Profile</a></li>

            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <li><a href="event_management.php"><i class="fa-solid fa-gear"></i> Event Management</a></li>
                <li><a href="user_management.php"><i class="fa-solid fa-users"></i> User Management</a></li>
                <li><a href="registrations.php"><i class="fa-solid fa-clipboard-list"></i> Registrations</a></li>
            <?php endif; ?>

            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="profile-container">
            <h1>Your Profile</h1>
            <i class="fa-solid fa-user-tie"></i>
            <?php if($user): ?>
                <div class="profile-info">
                    <div><strong>Student ID:</strong> <span><?php echo htmlspecialchars($user['student_id']); ?></span></div>
                    <div><strong>Full Name:</strong> <span><?php echo htmlspecialchars($user['full_name']); ?></span></div>
                    <div><strong>Email:</strong> <span><?php echo htmlspecialchars($user['email']); ?></span></div>
                    <div><strong>Contact No:</strong> <span><?php echo htmlspecialchars($user['contact_no']); ?></span></div>
                    <div><strong>Role:</strong> <span><?php echo htmlspecialchars($user['role']); ?></span></div>
                </div>
            <?php else: ?>
                <p>User not found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
