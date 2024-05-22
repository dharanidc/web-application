




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="register.php">
    <!-- Add form fields for username, password, etc. -->
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <!-- Add other fields as needed -->
    <button type="submit" name="register">Register</button>
</form>
<script>
    <?php
// Include your database connection
include 'Includes/dbcon.php';

if (isset($_POST['register'])) {
    // Retrieve and sanitize input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert data into the database
    $query = mysqli_query($conn, "INSERT INTO students (username, password) VALUES ('$username', '$password')");

    if ($query) {
        echo "Registration successful!";
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>

</script>
</body>
</html><!-- Your HTML structure -->
