<?php
// Connect to the database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize user inputs

// Hash the password
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO users (first_name, middle_name, last_name, family_name, email, mobile, password, dob)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['familyname'], $_POST['email'], $_POST['mobile'], $hashedPassword, $_POST['dob']);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: welcome.php");
exit();
?>
