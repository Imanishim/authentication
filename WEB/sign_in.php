<?php
session_start();

include("php/config.php");

$error_message = "";

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Escape user input to prevent SQL injection
    $email = mysqli_real_escape_string($con, $_POST['email']); 
    $password = mysqli_real_escape_string($con, $_POST['password']); 

    // Query the database for the user
    $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        // Check if user exists
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            // Set session variables
            $_SESSION['valid'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['age'] = $row['age'];
            $_SESSION['id'] = $row['id'];
            
            // Redirect to home page
            header("Location: home.php");
            exit();
        } else {
            // If user doesn't exist, display error message
            $error_message = "Wrong username or password";
        }
    } else {
        // If query fails, display error message
        $error_message = "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="log.css">
  <title>Login Form</title>
</head>
<body>
  <div class="container">
    <div class="box form-box">
      <header>Login</header>
      <form action="" method="POST">
        <div class="field input">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" autocomplete="off" required><br><br>
        </div>
        <div class="field input">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" autocomplete="off" required><br><br>
        </div>
        <div class="field">
          <input type="submit" name="submit" value="Login"><br><br>
        </div>
        <div class="message">
          <?php if(!empty($error_message)) { echo "<p>$error_message</p>"; } ?>
        </div>
        <div class="link">
          Don't have an account? <a href="register.php">Sign up Now</a>
          <a href=>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
