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
<?php
session_start();
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

// Check if the student is logged in
if (!isset($_SESSION['student_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Code for handling student profile and attendance view can go here

?>

<?php
session_start();
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

// Check if the student is logged in
if (!isset($_SESSION['student_id'])) {
    // Redirect to the login page if not logged in
    header("Location: student_login.php");
    exit();
}

// Retrieve student information from the database
$studentId = $_SESSION['student_id'];
$query = mysqli_query($conn, "SELECT firstName, lastName FROM tblstudents WHERE id='$studentId'");
$studentInfo = mysqli_fetch_assoc($query);

// Code for handling student profile and attendance view can go here

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... (your existing head content) ... -->
    <title>Student Dashboard</title>
    <!-- ... (your existing head content) ... -->
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include "Includes/sidebar.php";?>
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php include "Includes/topbar.php";?>

                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            Welcome, <?php echo $studentInfo['firstName'] . ' ' . $studentInfo['lastName']; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>

                    <!-- Add your HTML structure for the student profile and attendance view sections here -->
                    <!-- For example, you can create separate sections or include other PHP files -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Student Profile</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Add content for student profile section here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">View Course Attendance</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Add content for attendance view section here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include "Includes/footer.php";?>
                </div>
            </div>
        </div>
    </div>

    <!-- ... (existing scripts) ... -->
</body>

</html>
