<?php
include_once '../dbconfig.php';

if(isset($_POST['save-btn'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d H:i:s');

    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = '../admin/upload/' . $image_name;
        
        move_uploaded_file($image_tmp, $image_path);

        $insertquery = "INSERT INTO articles_posted(title, descriptions, dates, image_path) VALUES ('$title', '$description', '$date', '$image_path')";
        $insertqueryresults = mysqli_query($con, $insertquery);

        if($insertqueryresults) {
            ?>
            <script type="text/javascript">
                alert('Success');
                </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert('Error');
                </script>
            <?php

        }
    } else {
        ?>
        <script type="text/javascript">
            alert('File Upload Error');
            </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" required/>
        <input type="text" name="description" required/>
        <input type="file" name="image" accept="image/*" required/>
        <button type="submit" name="save-btn
        "><strong>Save</strong></button>
    </form>
</body>
</html>