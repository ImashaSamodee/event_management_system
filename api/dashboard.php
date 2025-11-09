<?php
session_start();
if(!isset($_SESSION['student_id'])){
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <li><a href="dashboard.php" class="active"><i class="fa-solid fa-home"></i> Home</a></li>
                <li><a href="event.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>

                <!-- Show these only if user is admin -->
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <li><a href="event_management.php"><i class="fa-solid fa-gear"></i> Event Management</a></li>
                    <li><a href="user_management.php"><i class="fa-solid fa-users"></i> User Management</a></li>
                    <li><a href="registrations.php"><i class="fa-solid fa-clipboard-list"></i> Registrations</a></li>
                <?php endif; ?>

                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main-content dashboard-content">
            <h1>Welcome to <?php echo $_SESSION['role']; ?> Dashboard !</h1>
            
            <div class="quick_button">
                <a href="event.php" class="btn"><i class="fa-solid fa-calendar-plus"></i> View Events</a>
                <a href="profile.php" class="btn"><i class="fa-solid fa-user"></i> View Profile</a>

                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="event_management.php" class="btn"><i class="fa-solid fa-gear"></i> Manage Events</a>
                    <a href="user_management.php" class="btn"><i class="fa-solid fa-users"></i> Manage Users</a>
                    <a href="registrations.php" class="btn"><i class="fa-solid fa-clipboard-list"></i> View Registrations</a>
                <?php endif; ?>


                
            </div>

        </div>
    </div>
</body>
</html>
