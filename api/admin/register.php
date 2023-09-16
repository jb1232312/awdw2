<?php
require_once 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Perform basic validation
    $error_message = '';
    if (empty($username) || empty($password) || empty($password_confirm)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $password_confirm) {
        $error_message = "Passwords do not match.";
    } else {
        // Check if the username already exists
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $error_message = "Username already exists. Please choose a different username.";
        } else {
            // Insert the new user into the database with the plain password
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            mysqli_query($conn, $query);

            // Redirect to the login page after successful registration
            header('Location: login.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Confirm Password:</label>
        <input type="password" name="password_confirm" required><br>
        <input type="submit" value="Register">
    </form>
    <?php if (isset($error_message) && !empty($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
