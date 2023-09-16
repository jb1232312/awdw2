<?php
require_once '../dbconfig.php';

if(isset($_GET['edit_id'])) {
    $fetcharticle = "SELECT * FROM articles_posted WHERE post_id=".$_GET['edit_id'];
    $resultslist = mysqli_query($con, $fetcharticle);
    $resultsfetch = mysqli_fetch_array($resultslist);
}

if(isset($_POST['update-btn'])){
    $title = $_POST['title'];
    $description = $_POST['descriptions'];
    $date = date('Y-m-d H:i:s');

    $updatearticle = "UPDATE articles_posted SET title='$title', descriptions='$description', dates='$date' WHERE post_id=".$_GET['edit_id'];
    $updateresult = mysqli_query($con, $updatearticle);

    if($updateresult) {
        ?>
        <script type="text/javascript">
            alert('Save Successfully');
            window.location.href="home.php";
            </script>
        <?php
    }
    else {
        ?>
        <script type="text/javascript">
            alert('Error');
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
    <form method="POST">
        <input type="text" name="title" value="<?php echo $resultsfetch['title'];?>"></input>
        <input type="text" name="descriptions" value="<?php echo $resultsfetch['descriptions'];?>"></input>
        <button type="submit" name="update-btn"><strong>Save</strong></button>
    </form>
</body>
</html>