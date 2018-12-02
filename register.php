<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bookmark iT! Your personal bookmars storage</title>
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
        <div class="registerContainer"> 
            <h1>Register</h1>   
            <form action="registerUser.php" method="Post" autocomplete="off">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">    
                <label>First name</label><input type="text" class="formFields" name="firstName" placeholder="John" required /><br>
                <label>Last name</label><input type="text" class="formFields" name="lastName" placeholder="Doe" required /><br>
                <label>Email</label><input type="email" class="formFields" name="lastName" placeholder="example@example.ca" required autocomplete="off"/><br>
                <label>Login</label><input type="text" class="formFields" name="login" value="" autocomplete="off" required/><br>
                <label>Password</label><input type="password" class="formFields" name="password1" value="" autocomplete="off" required /><br>
                <label>Repeat password</label><input type="password" class="formFields" name="password2" required /><br>
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