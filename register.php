<?php include('server.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    <div>
        <h2>Register</h2>
    </div>

    <form action="register.php" method="post">
        <?php include('errors.php');?>
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username;?>">
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email;?>">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div>
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div>
            <button type="submit" name="reg_user">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>
</html>