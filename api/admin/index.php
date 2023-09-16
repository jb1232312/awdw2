<?php 
if(isset($_SESSION['username'])) {
    header('Location: home.php');
}

require_once '../dbconfig.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginquery = "SELECT * FROM users WHERE username ='$username'";
    $loginresult = mysqli_query($con, $loginquery);
    mysqli_num_rows($loginresult) === 1;
    $row = mysqli_fetch_assoc($loginresult);
}
?>