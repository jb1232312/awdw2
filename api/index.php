<?php 
include_once 'dbconfig.php';

$fetchlistquery = "SELECT * FROM articles_posted";
$fetchlistqueryresults = mysqli_query($con, $fetchlistquery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        while($row = mysqli_fetch_assoc($fetchlistqueryresults)) {
            ?>
            <img src="<?php echo $row['image_path']; ?>" style="max-width:100px;">
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['descriptions']; ?></p>
            <p><?php echo $row['dates']; ?></p>
            <?php
        }
    ?>
</body>
</html>