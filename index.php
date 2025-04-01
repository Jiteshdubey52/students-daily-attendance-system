<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h2>Student Attendance System</h2>

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

        if (isset($_SESSION['student_id'])) {
            // Student is logged in
            echo "<h3>Welcome, Student!</h3>";
            echo "<p>Student ID: " . $_SESSION['student_id'] . "</p>";

            // Mark Attendance Form
            echo "<form method='post' action='mark_attendance.php'>";
            echo "<label for='attendance_date'>Date:</label>";
            echo "<input type='date' name='attendance_date' required>";
            echo "<button type='submit'>Mark Attendance</button>";
            echo "</form>";

            //Display Attendance
            echo "<h3>Your Attendance Records</h3>";
            $student_id = $_SESSION['student_id'];
            $sql_attendance = "SELECT attendance_date, status FROM attendance WHERE student_id = '$student_id'";
            $result_attendance = $conn->query($sql_attendance);

            if ($result_attendance->num_rows > 0) {
                echo "<table class='attendance-table'>";
                echo "<tr><th>Date</th><th>Status</th></tr>";
                while($row = $result_attendance->fetch_assoc()) {
                    echo "<tr><td>" . $row["attendance_date"]. "</td><td>" . $row["status"]. "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "No attendance records found.";
            }

            echo "<p><a href='logout.php'>Logout</a></p>";

        } else {
            // Student login form
            echo "<form method='post' action='login.php'>";
            echo "<label for='student_id'>Student ID:</label>";
            echo "<input type='text' name='student_id' required>";
            echo "<label for='password'>Password:</label>";
            echo "<input type='password' name='password' required>";
            echo "<button type='submit'>Login</button>";
            echo "</form>";
        }

        $conn->close();
        ?>
    </div>
    <footer>
    <p>&copy; <?php echo date("Y"); ?> Student Attendance System</p>
    </footer>
</body>
</html>