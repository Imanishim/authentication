<?php 
session_start();
include("php/config.php");

// Redirect to sign-in page if user is not logged in
if(!isset($_SESSION['valid'])){
    header("location: sign_in.php");
    exit(); // Added exit to prevent further execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="log.css">
    <title>Home</title>
</head>
<body>

<div class="nav">
    <div class="logo">
        <p><a href="hom.php">logo</a></p>
    </div>
  
    <div class="right-links">
        <?php
        // Fetch user data
        $id = $_SESSION['id'];
        $query = mysqli_query($con, "SELECT * FROM user WHERE id=$id");

        while($result = mysqli_fetch_assoc($query)){
            $res_uname = $result['username'];
            $res_email = $result['email'];
            $res_age = $result['age'];
            $res_id = $result['id'];
        }
        // Corrected syntax error in the anchor tag
        echo "<a href='edit.php?id=$res_id'>Change Profile</a>";
        ?>
        <!-- Moved Logout button outside of PHP block -->
        <a href="php/logout.php"><button class="btn">LogOut</button></a>
    </div>
</div>

<main>
    <div class="main-box top">
        <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_uname; ?></b>, welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_email; ?></b>.</p>
            </div>
        </div>
        <div class="button">
            <div class="box">
                <p>And you are <b><?php echo $res_age; ?></b>.</p>
            </div>
        </div>
        
    </div>
</main> 

</body>
</html>

