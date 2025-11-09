<?php
session_start();
if(!isset($_SESSION['student_id'])){
   header("Location: index.html");
   exit();
}

include 'connection.php'; 

$student_id = $_SESSION['student_id'];

// Handle registration
if(isset($_GET['register_id'])){
    $event_id = $_GET['register_id'];

    // Check if already registered
    $checkStmt = $conn->prepare("SELECT * FROM registrations WHERE student_id=? AND event_id=?");
    $checkStmt->bind_param("ss", $student_id, $event_id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if($checkStmt->num_rows > 0){
        echo "<script>alert('You have already registered for this event.');</script>";
    } else {
        $insertStmt = $conn->prepare("INSERT INTO registrations (student_id, event_id) VALUES (?, ?)");
        $insertStmt->bind_param("ss", $student_id, $event_id);
        if($insertStmt->execute()){
            echo "<script>alert('Successfully registered for the event!');</script>";
        } else {
            echo "<script>alert('Error: ".$insertStmt->error."');</script>";
        }
        $insertStmt->close();
    }

    $checkStmt->close();
}

// Fetch events
$sql = "SELECT * FROM events ORDER BY event_id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="dashboard_style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
   <style>
       table { width: 100%; border-collapse: collapse; margin-top: 20px; }
       th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
       th { background-color: #f4f4f4; }
       .register-btn { padding: 5px 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
   </style>
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
               <li><a href="event.php" class="active"><i class="fa-solid fa-calendar"></i> Events</a></li>
               <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>

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
         <h1>All Events</h1>
         <?php if($result->num_rows > 0): ?>
            <table>
               <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>Description</th>
                  <th>Action</th>
               </tr>
               <?php while($row = $result->fetch_assoc()): ?>
                  <tr>
                     <td><?php echo htmlspecialchars($row['event_id']); ?></td>
                     <td><?php echo htmlspecialchars($row['title']); ?></td>
                     <td><?php echo htmlspecialchars($row['date']); ?></td>
                     <td><?php echo htmlspecialchars($row['location']); ?></td>
                     <td><?php echo htmlspecialchars($row['status']); ?></td>
                     <td><?php echo htmlspecialchars($row['description']); ?></td>
                     <td>
                        <a href="event.php?register_id=<?php echo $row['event_id']; ?>">
                            <button class="register-btn">Register</button>
                        </a>
                     </td>
                  </tr>
               <?php endwhile; ?>
            </table>
         <?php else: ?>
            <p>No events found.</p>
         <?php endif; ?>
      </div>
   </div>
</body>
</html>
