<?php
// Include your database connection
include 'Includes/dbcon.php';

if (isset($_POST['login'])) {
    // Retrieve and sanitize input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Retrieve hashed password from the database based on the username
    $query = mysqli_query($conn, "SELECT id, password FROM students WHERE username='$username'");
    $result = mysqli_fetch_assoc($query);

    if ($result && password_verify($password, $result['password'])) {
        // Password is correct, create a session for the student
        session_start();
        $_SESSION['student_id'] = $result['id'];
        header("Location: student_dashboard.php"); // Redirect to student dashboard
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
    }
}
?>
