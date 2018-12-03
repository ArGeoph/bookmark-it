<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bookmark iT! Your personal bookmarks storage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <!-- Nav menu -->
    <nav>
        <p class="logo">Bookmark IT!</p>
        <div class="navButtons">
            <a href="index.php" >Main</a>
            <a href="about.php" >About</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </nav>
        
    <main>
        <div class="loginContainer"> 
            <h1>Login</h1>   
            <form action="registerUser.php" method="Post" autocomplete="off" >
                <input type="password" style="display:none">
                <label>Login</label><input type="text" class="formFields" name="login" value="" autocomplete="new-password" required/><br>
                <label>Password</label><input type="password" class="formFields" name="password1" value="" autocomplete="new-password" required /><br>
                <div class="buttonsContainer">
                    <input type="submit" class="formButton" value="Submit"/>
                    <input type="reset" class="formButton"  value="Clear fields" />
                </div>
            </form>      
        </div>
    </main>

    <footer>
        <h3>Kirill Golubev &copy;<?php echo date('Y') ?></h3>
    </footer>
</body>
</html>