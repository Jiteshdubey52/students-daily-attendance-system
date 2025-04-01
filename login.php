<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_POST['student_id'];
$password = $_POST['password']; // In a real system, you would hash this.

$sql = "SELECT * FROM students WHERE student_id = '$student_id' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['student_id'] = $student_id;
    header("Location: index.php");
} else {
    echo "Invalid student ID or password.";
}

$conn->close();
?>