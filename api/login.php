<?php
session_start();
include 'connection.php';

if(isset($_POST['login'])){
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE student_id='$student_id' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();

        $_SESSION['student_id'] = $row['student_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Student ID or Password'); window.location='index.html';</script>";
    }
}
?>
