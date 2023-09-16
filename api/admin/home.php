<?php
session_start();

// Check if the user is logged in, redirect to login page if not
if (!isset($_SESSION['username'])) {
    ?>
    <script type="text/javascript">
        alert('You Need To Login First =)');
        window.location.href="index.php";
        </script>
       
    <?php
    
    exit;
}

require_once '../dbconfig.php';

if(isset($_GET['delete_id'])) {
    $deletearticles = "DELETE FROM articles_posted WHERE post_id=".$_GET['delete_id'];
    mysqli_query($con, $deletearticles);
    ?>
    <script type="text/javascript">
        window.location.href="home.php";
        </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script type="text/javascript">
    function delete_id(posted_id){
        if(confirm('Are you sure?')){
            window.location.href="home.php?delete_id="+posted_id;
        }
    }
    function edit_id(posted_id) {
        if(confirm('Are you sure?')){
            window.location.href="edit.php?edit_id="+posted_id;
        }
    }
    </script>
<body>
    <a href="logout.php">Logout</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Descriptions</th>
            <th>Date Posted</th>
        </tr>
        <?php
        $listarticles = "SELECT * FROM articles_posted";
        $listresults = mysqli_query($con, $listarticles);

        if(mysqli_num_rows($listresults)>0) {
            while($row = mysqli_fetch_row($listresults)){
                ?>
                <tr>
                    <td><img src="<?php echo $row[4]; ?>" alt="Article Image" style="max-width: 100px;"></td>
                    <td><?php echo $row[1];?></td>
                    <td><?php echo $row[2];?></td>
                    <td><?php echo $row[3];?></td>
                    <td><a href="javascript:delete_id('<?php echo $row[0];?>')">DELETE</a></td>
                    <td><a href="javascript:edit_id('<?php echo $row[0];?>')">EDIT</a></td>
                </tr>
                <?php
            }
        }
        
        ?>
    </table>
</body>
</html>