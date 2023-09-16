<?php
require_once '../dbconfig.php';

if (isset($_POST['save-btn'])) {
    $title = $_POST['title'];
    $description = $_POST['descriptions'];
    $date = date('Y-m-d H:i:s');

    // Check if a file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = '../admin/upload/' . $image_name;

        // Move the uploaded file to a designated folder
        move_uploaded_file($image_tmp, $image_path);

        $insert_article = "INSERT INTO articles_posted(title, descriptions, dates, image_path) VALUES ('$title', '$description', '$date', '$image_path')";
        $insert_result = mysqli_query($con, $insert_article);

        if ($insert_result) {
            ?>
            <script type="text/javascript">
                alert('Posted Successfully');
                window.location.href = "home.php";
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
            alert('File upload error.');
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
        <input type="text" name="title" placeholder="Article Title" required/>
        <textarea name="descriptions" placeholder="Write Something....." required></textarea>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit" name="save-btn"><strong>Post</strong></button>
    </form>
</body>
</html>
