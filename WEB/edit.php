<?php 
session_start();

include("php/config.php");

// Redirect to sign-in page if the user is not authenticated
if(!isset($_SESSION['valid'])){
  header("location: sign in.php"); 
  exit(); // Terminate script execution after redirection
}

// Process form submission
if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $id = $_SESSION['id'];

    // Update user profile
    $edit_query = mysqli_query($con, "UPDATE user SET username='$username', email='$email', age='$age' WHERE id=$id");

    if($edit_query){
        // Display success message
        echo "<div class='message'>
              <p>Profile updated</p>
              </div><br>";
        echo "<a href='hom.php'><button class='btn'>Go home</button></a>";
        exit(); // Terminate script execution after displaying success message
    } else {
        die("Error occurred: " . mysqli_error($con)); // Display error message if query fails
    }
}

// Retrieve user data for pre-populating the form
$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM user WHERE id=$id");

if($query && mysqli_num_rows($query) > 0){
    $result = mysqli_fetch_assoc($query);
    $res_uname = htmlspecialchars($result['username']);
    $res_email = htmlspecialchars($result['email']);
    $res_age = htmlspecialchars($result['age']);
} else {
    die("Error occurred: User data not found"); // Display error message if user data retrieval fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="log.css">
    <title>Change Profile</title>
</head>
<body>

<div class="nav">
    <div class="logo">
        <p><a href="hom.php">logo</a></p>
    </div>
  
    <div class="right-links">
        <a href="#">Change Profile</a>
        <a href="php/logaut.php"><button class="btn">Log Out</button></a>
    </div>
</div>
  
<div class="container">
    <div class="box form-box">
        <header>Change Profile</header>
        <form action="" method="POST">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $res_uname; ?>" autocomplete="off" required><br><br>
            </div> 
            <div class="field input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $res_email; ?>" autocomplete="off" required><br><br>
            </div>
            <div class="field input">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" value="<?php echo $res_age; ?>" autocomplete="off" required><br><br>
            </div>
            <div class="field">
                <input type="submit" class="btn" name="submit" value="Submit"><br><br>
            </div>
        </form>
    </div>
    <?php ?>
</div>

</body>
</html>
