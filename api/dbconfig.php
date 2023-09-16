<?php 
$host = 'sql113.infinityfree.com';
$username = 'if0_35047726';
$password = 'XuAFVdTb6B7h';
$database = 'if0_35047726_tsuen_vb';
$port = '3306'; // You can include the port if it's not the default 3306

$con = mysqli_connect($host, $username, $password, $database, $port);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
