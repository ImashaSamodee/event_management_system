<?php 

include 'connection.php';

if(isset($_POST['register'])){
   $student_id = $_POST['student_id'];
   $full_name = $_POST['full_name'];
   $email = $_POST['email'];
   $contact_no = $_POST['contact_no'];
   $password = $_POST['password'];

   $checkStudentID = "SELECT * From users where student_id = '$student_id'";
   $result = $conn->query($checkStudentID);
   if($result -> num_rows > 0){
      echo "You Already Registered !";
   }
   else{
      $insertQuery = "INSERT INTO users (student_id, full_name, email, contact_no, password) VALUES ('$student_id', '$full_name', '$email', '$contact_no', '$password')";
      if($conn -> query($insertQuery) == TRUE){
         header("location: dashboard.php");
      }
      else{
         echo "Error:".$conn->error;
      }
   }
}