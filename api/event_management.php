<?php
session_start();
if(!isset($_SESSION['student_id'])){
   header("Location: index.html");
   exit();
}

include 'connection.php';

// ADD EVENT
if(isset($_POST['add_event'])) {
   $event_id = trim($_POST['event_id']);
   $title = trim($_POST['event_name']);
   $date = $_POST['event_date'];
   $location = trim($_POST['event_location']);
   $description = trim($_POST['description']);
   $status = $_POST['status'];

   // Check if event already exists
   $checkStmt = $conn->prepare("SELECT event_id FROM events WHERE event_id = ?");
   $checkStmt->bind_param("s", $event_id);
   $checkStmt->execute();
   $checkStmt->store_result();

   if($checkStmt->num_rows > 0){
      echo "<script>alert('Error: Event with this ID already exists!');</script>";
   } else {
      $stmt = $conn->prepare("INSERT INTO events (event_id, title, date, location, description, status) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssss", $event_id, $title, $date, $location, $description, $status);

      if($stmt->execute()) {
         echo "<script>alert('Event added successfully!'); window.location.href='event_management.php';</script>";
      } else {
         echo "<script>alert('Error: ".$stmt->error."');</script>";
      }
      $stmt->close();
   }
   $checkStmt->close();
}

// DELETE EVENT
if(isset($_GET['delete_id'])){
   $delete_id = $_GET['delete_id'];
   $delStmt = $conn->prepare("DELETE FROM events WHERE event_id = ?");
   $delStmt->bind_param("s", $delete_id);
   if($delStmt->execute()){
      echo "<script>alert('Event deleted successfully!'); window.location.href='event_management.php';</script>";
   } else {
      echo "<script>alert('Error deleting event!');</script>";
   }
   $delStmt->close();
}

// EDIT EVENT
if(isset($_POST['edit_event'])){
   $event_id = $_POST['edit_event_id'];
   $title = trim($_POST['edit_event_name']);
   $date = $_POST['edit_event_date'];
   $location = trim($_POST['edit_event_location']);
   $description = trim($_POST['edit_description']);
   $status = $_POST['edit_status'];

   $updateStmt = $conn->prepare("UPDATE events SET title=?, date=?, location=?, description=?, status=? WHERE event_id=?");
   $updateStmt->bind_param("ssssss", $title, $date, $location, $description, $status, $event_id);

   if($updateStmt->execute()){
      echo "<script>alert('Event updated successfully!'); window.location.href='event_management.php';</script>";
   } else {
      echo "<script>alert('Error updating event!');</script>";
   }
   $updateStmt->close();
}

// Fetch all events
$sql = "SELECT * FROM events ORDER BY event_id DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="dashboard_style.css">
   <link rel="stylesheet" href="../style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
   <style>
      
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
            <li><a href="event.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
            <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>

            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
               <li><a href="event_management.php" class="active"><i class="fa-solid fa-gear"></i> Event Management</a></li>
               <li><a href="user_management.php"><i class="fa-solid fa-users"></i> User Management</a></li>
               <li><a href="registrations.php"><i class="fa-solid fa-clipboard-list"></i> Registrations</a></li>
            <?php endif; ?>

            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
         </ul>
      </div>

      <!-- Main content -->
      <div class="main-content">
         <div class="wrapper" style="background: none; margin-top: -50px;" >
            <form method="POST" style="box-shadow: none; background:#fff; width: 600px; padding:20px; border-radius:10px;">
               <h1>Add Event</h1>
               <div class="input-box">
                  <input type="text" placeholder="ID" name="event_id" required>
               </div>
               <div class="input-box">
                  <input type="text" placeholder="Title" name="event_name" required>
               </div>
               <div class="input-box">
                  <input type="date" placeholder="Date" name="event_date" required>
               </div>
               <div class="input-box">
                  <input type="text" placeholder="Location" name="event_location" required>
               </div>
               <div class="input-box textarea-box">
                  <textarea name="description" placeholder="Description"></textarea>
               </div>
               <div class="input-box">
                  <select name="status" id="">
                     <option value="Upcoming">Upcoming</option>
                     <option value="Completed">Completed</option>
                  </select>
               </div>
               <button type="submit" class="btn" name="add_event">Add Event</button>
            </form>
         </div>

         <div class="table" style="margin-top: 100px;">
            <h1>All Events</h1>
            <?php if($result->num_rows > 0): ?>
               <table>
                  <tr>
                     <th>ID</th>
                     <th>Title</th>
                     <th>Date</th>
                     <th>Location</th>
                     <th>Description</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
                  <?php while($row = $result->fetch_assoc()): ?>
                     <tr>
                        <td><?php echo htmlspecialchars($row['event_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td class="action-buttons">
                           <form method="POST" style="display:inline-block;">
                              <input type="hidden" name="edit_event_id" value="<?php echo $row['event_id']; ?>">
                              <input type="hidden" name="edit_event_name" value="<?php echo $row['title']; ?>">
                              <input type="hidden" name="edit_event_date" value="<?php echo $row['date']; ?>">
                              <input type="hidden" name="edit_event_location" value="<?php echo $row['location']; ?>">
                              <input type="hidden" name="edit_description" value="<?php echo $row['description']; ?>">
                              <input type="hidden" name="edit_status" value="<?php echo $row['status']; ?>">
                              <button type="button" class="action-btn edit-btn" onclick="openEditForm('<?php echo $row['event_id']; ?>','<?php echo htmlspecialchars($row['title']); ?>','<?php echo $row['date']; ?>','<?php echo htmlspecialchars($row['location']); ?>','<?php echo htmlspecialchars($row['description']); ?>','<?php echo htmlspecialchars($row['status']); ?>')">Edit</button>
                           </form>

                           <a href="event_management.php?delete_id=<?php echo $row['event_id']; ?>" onclick="return confirm('Are you sure you want to delete this event?');">
                              <button type="button" class="action-btn delete-btn">Delete</button>
                           </a>
                        </td>
                     </tr>
                  <?php endwhile; ?>
               </table>
            <?php else: ?>
               <p>No events found.</p>
            <?php endif; ?>
         </div>

         <!-- Hidden Edit Form -->
         <div id="editForm" class="edit-form" style="display:none;">
            <form method="POST">
               <h2>Edit Event</h2>
               <input type="hidden" name="edit_event_id" id="edit_event_id">
               <label>Title:</label>
               <input type="text" name="edit_event_name" id="edit_event_name" required><br><br>
               <label>Date:</label>
               <input type="date" name="edit_event_date" id="edit_event_date" required><br><br>
               <label>Location:</label>
               <input type="text" name="edit_event_location" id="edit_event_location" required><br><br>
               <label>Description:</label>
               <textarea name="edit_description" id="edit_description" style="resize: none;"></textarea><br><br>
               <label>Status:</label>
               <select name="edit_status" id="edit_status">
                  <option value="Upcoming">Upcoming</option>
                  <option value="Completed">Completed</option>
               </select><br><br>
               <div class="button">
                  <button type="submit" name="edit_event" class="btn">Update Event</button>
                  <button type="button" class="btn" style="background:#777;" onclick="closeEditForm()">Cancel</button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <script>
      function openEditForm(id, title, date, location, desc) {
         document.getElementById('editForm').style.display = 'block';
         document.getElementById('edit_event_id').value = id;
         document.getElementById('edit_event_name').value = title;
         document.getElementById('edit_event_date').value = date;
         document.getElementById('edit_event_location').value = location;
         document.getElementById('edit_description').value = desc;
         window.scrollTo({ top: 0, behavior: 'smooth' });
      }
      function closeEditForm() {
         document.getElementById('editForm').style.display = 'none';
      }
   </script>
</body>
</html>
