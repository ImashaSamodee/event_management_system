<?php
session_start();
if(!isset($_SESSION['student_id'])){
   header("Location: index.html");
   exit();
}

include 'connection.php';

// ADD USER
if(isset($_POST['add_user'])) {
   $student_id = trim($_POST['student_id']);
   $full_name = trim($_POST['full_name']);
   $email = trim($_POST['email']);
   $contact_no = trim($_POST['contact_no']);
   $role = trim($_POST['role']);
   $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

   // Check if user already exists
   $checkStmt = $conn->prepare("SELECT student_id FROM users WHERE student_id = ?");
   $checkStmt->bind_param("s", $student_id);
   $checkStmt->execute();
   $checkStmt->store_result();

   if($checkStmt->num_rows > 0){
      echo "<script>alert('Error: User with this Student ID already exists!');</script>";
   } else {
      $stmt = $conn->prepare("INSERT INTO users (student_id, full_name, email, contact_no, password, role) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssss", $student_id, $full_name, $email, $contact_no, $password, $role);
      if($stmt->execute()) {
         echo "<script>alert('User added successfully!'); window.location.href='user_management.php';</script>";
      } else {
         echo "<script>alert('Error adding user: ".$stmt->error."');</script>";
      }
      $stmt->close();
   }
   $checkStmt->close();
}

// DELETE USER
if(isset($_GET['delete_id'])){
   $delete_id = $_GET['delete_id'];
   $delStmt = $conn->prepare("DELETE FROM users WHERE student_id = ?");
   $delStmt->bind_param("s", $delete_id);
   if($delStmt->execute()){
      echo "<script>alert('User deleted successfully!'); window.location.href='user_management.php';</script>";
   } else {
      echo "<script>alert('Error deleting user!');</script>";
   }
   $delStmt->close();
}

// EDIT USER
if(isset($_POST['edit_user'])){
   $student_id = $_POST['edit_student_id'];
   $full_name = trim($_POST['edit_full_name']);
   $email = trim($_POST['edit_email']);
   $contact_no = trim($_POST['edit_contact_no']);
   $role = trim($_POST['edit_role']);

   $updateStmt = $conn->prepare("UPDATE users SET full_name=?, email=?, contact_no=?, role=? WHERE student_id=?");
   $updateStmt->bind_param("sssss", $full_name, $email, $contact_no, $role, $student_id);

   if($updateStmt->execute()){
      echo "<script>alert('User updated successfully!'); window.location.href='user_management.php';</script>";
   } else {
      echo "<script>alert('Error updating user!');</script>";
   }
   $updateStmt->close();
}

// Fetch all users
$sql = "SELECT * FROM users ORDER BY student_id ASC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Management</title>
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
               <li><a href="event_management.php"><i class="fa-solid fa-gear"></i> Event Management</a></li>
               <li><a href="user_management.php" class="active"><i class="fa-solid fa-users"></i> User Management</a></li>
               <li><a href="registrations.php"><i class="fa-solid fa-clipboard-list"></i> Registrations</a></li>
            <?php endif; ?>

            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
         </ul>
      </div>

      <!-- Main content -->
      <div class="main-content">
         <div class="wrapper" style="background: none; margin-top: -50px;">
            <form method="POST" style="box-shadow: none; background:#fff; width: 600px; padding:20px; border-radius:10px;">
               <h1>Add User</h1>
               <div class="input-box">
                  <input type="text" placeholder="Student ID" name="student_id" required>
                  <i class="fa-solid fa-id-badge"></i>
               </div>

               <div class="input-box">
                  <input type="text" placeholder="Full Name" name="full_name" required>
                  <i class="fa-solid fa-user"></i>
               </div>

               <div class="input-box">
                  <input type="email" placeholder="Email" name="email" required>
                  <i class="fa-solid fa-envelope"></i>
               </div>

               <div class="input-box">
                  <input type="text" placeholder="Contact Number" name="contact_no">
                  <i class="fa-solid fa-phone"></i>
               </div>

               <div class="input-box">
                  <select name="role" required>
                     <option value="" disabled selected>Select Role</option>
                     <option value="student">Student</option>
                     <option value="admin">Admin</option>
                  </select>
                  <i class="fa-solid fa-user-gear"></i>
               </div>

               <div class="input-box">
                  <input type="password" placeholder="Password" name="password" required>
                  <i class="fa-solid fa-lock"></i>
               </div>

               <button type="submit" class="btn" name="add_user">Add User</button>
            </form>
         </div>

         <div class="table" style="margin-top: 50px;">
            <h1>All Users</h1>
            <?php if($result->num_rows > 0): ?>
               <table>
                  <tr>
                     <th>Student ID</th>
                     <th>Full Name</th>
                     <th>Email</th>
                     <th>Contact No</th>
                     <th>Role</th>
                     <th>Action</th>
                  </tr>
                  <?php while($row = $result->fetch_assoc()): ?>
                     <tr>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td class="action-buttons">
                           <button type="button" class="action-btn edit-btn" onclick="openEditForm('<?php echo $row['student_id']; ?>','<?php echo htmlspecialchars($row['full_name']); ?>','<?php echo htmlspecialchars($row['email']); ?>','<?php echo htmlspecialchars($row['contact_no']); ?>','<?php echo htmlspecialchars($row['role']); ?>')">Edit</button>

                           <a href="user_management.php?delete_id=<?php echo $row['student_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">
                              <button type="button" class="action-btn delete-btn">Delete</button>
                           </a>
                        </td>
                     </tr>
                  <?php endwhile; ?>
               </table>
            <?php else: ?>
               <p>No users found.</p>
            <?php endif; ?>
         </div>

         <!-- Hidden Edit Form -->
         <div id="editForm" class="edit-form" style="display:none;">
            <h2>Edit User</h2>
            <form method="POST">
               <input type="hidden" name="edit_student_id" id="edit_student_id">
               <label>Full Name:</label>
               <input type="text" name="edit_full_name" id="edit_full_name" required><br><br>
               <label>Email:</label>
               <input style="font-size: 16px; width: 100%; height: 40px; border: 1px solid #ccc; border-radius: 8px; padding: 5px;" type="email" name="edit_email" id="edit_email" required><br><br>
               <label>Contact No:</label>
               <input type="text" name="edit_contact_no" id="edit_contact_no"><br><br>
               <label>Role:</label>
               <select name="edit_role" id="edit_role" required>
                  <option value="student">Student</option>
                  <option value="admin">Admin</option>
               </select><br><br>
               <div class="button">
                  <button type="submit" name="edit_user" class="btn">Update User</button>
                  <button type="button" class="btn cancel" onclick="closeEditForm()">Cancel</button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <script>
      function openEditForm(id, name, email, contact, role) {
         document.getElementById('editForm').style.display = 'block';
         document.getElementById('edit_student_id').value = id;
         document.getElementById('edit_full_name').value = name;
         document.getElementById('edit_email').value = email;
         document.getElementById('edit_contact_no').value = contact;
         document.getElementById('edit_role').value = role;
         window.scrollTo({ top: 0, behavior: 'smooth' });
      }
      function closeEditForm() {
         document.getElementById('editForm').style.display = 'none';
      }
   </script>
</body>
</html>
