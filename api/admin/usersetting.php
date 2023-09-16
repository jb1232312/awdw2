<?php
session_start();
require_once 'dbconfig.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $savedPassword = $row['password'];

        if ($currentPassword === $savedPassword) {
            if ($newPassword === $confirmPassword) {
                $updateQuery = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
                mysqli_query($conn, $updateQuery);

                $successMessage = "Password changed successfully.";
            } else {
                $errorMessage = "New passwords do not match.";
            }
        } else {
            $errorMessage = "Current password is incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
</head>
<body>
    <h2>Change Password</h2>
    <form method="post" action="">
        <label>Current Password:</label>
        <input type="password" name="current_password" required><br>
        <label>New Password:</label>
        <input type="password" name="new_password" required><br>
        <label>Confirm New Password:</label>
        <input type="password" name="confirm_password" required><br>
        <input type="submit" value="Change Password">
    </form>
    <?php if (isset($errorMessage)) { ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php } elseif (isset($successMessage)) { ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php } ?>
    <p><a href="home.php">Back to Home</a></p>
</body>
</html>
