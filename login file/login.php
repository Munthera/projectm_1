<?php
session_start();

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user data from the database based on email
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            // Update last login time
            $update_sql = "UPDATE users SET last_login_at = NOW() WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("i", $user_id);
            $update_stmt->execute();
            $update_stmt->close();
            $conn->close();

            header("Location: welcome.php");
            exit();
        } else {
            $login_error = "Invalid email or password.";
        }
    } else {
        $login_error = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($login_error)) { echo "<p>{$login_error}</p>"; } ?>
    <form method="post" action="login.php">
        <!-- Include form inputs for email and password -->
        <!-- Add proper input fields, labels, and submit button here -->
    </form>
</body>
</html>
