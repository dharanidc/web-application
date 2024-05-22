<?php
// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'attendance';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the directory to save uploaded files
$uploadDirectory = __DIR__ . '/uploads/'; // Assuming a directory named 'uploads' in the same directory as this script

// Check if the directory exists, and create it if it doesn't
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

// File upload handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    

    
    $name = $_POST["name"];
    $institutionid= $_POST["institutionid"];
    $department = $_POST["department"];
    $coursecode = $_POST["coursecode"];
    $mobile = $_POST["mobile"];
    $date = $_POST["date"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $image_data = file_get_contents($_FILES['image']['tmp_name']);
    $image_name = $_FILES['image']['name'];

    $sql = "INSERT INTO facultydetails ( name, institutionid, department, coursecode,mobile,date,email,address, image_data, image_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssss', $name, $institutionid, $department, $coursecode, $mobile, $date, $email, $address, $image_data, $image_name);
    if ($stmt->execute()) {
        // Move the uploaded file to the specified directory
        $uploadedFilePath = $uploadDirectory . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFilePath);

        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>






