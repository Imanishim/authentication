<?php
include("php/config.php");

$message = '';

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    // Verify unique email
    $verify_query = mysqli_query($con, "SELECT email FROM user WHERE email='$email'");
    
    if(mysqli_num_rows($verify_query) != 0) {
        $message = "This email is already in use. Please try another one.";
    } else {
        mysqli_query($con, "INSERT INTO user (username, email, age, password) VALUES ('$username', '$email', '$age', '$password')") or die("Error Occurred");

        $message = "Registration successful!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="log.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php if(empty($message)) { ?>
            <header>Sign Up</header>
            <form action="" method="POST">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required><br><br>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required><br><br>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required><br><br>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required><br><br>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register"><br><br>
                </div>
                <div class="link">
                    Already a member? <a href="sign_in.php">Sign In</a>
                </div>
            </form>
            <?php } else { ?>
            <div class="message">
                <p><?php echo $message; ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

