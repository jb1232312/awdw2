<?php
session_start();

// Check if the user is already logged in, redirect to home page if true
if (isset($_SESSION['username'])) {
    header('Location: home.php');
    exit;
}

// Include the database configuration file
require_once '../dbconfig.php';

// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the credentials against the database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 1) {
        // If the username is found, verify the password
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        if ($password === $stored_password) {
            // If the login is successful, set the session variable and redirect to the home page
            $_SESSION['username'] = $username;
            header('Location: home.php');
            exit;
        } else {
            // If login fails, show an error message
            $error_message = "Invalid username or password.";
        }
    } else {
        // If login fails, show an error message
        $error_message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
</body>
</html>
