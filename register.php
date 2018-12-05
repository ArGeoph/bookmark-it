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
    <?php 
        $errorMessages = array("firstName" => "", "lastName" => "", "email" => "", "login" => "", "password1" => "", "password2" => "");
        $firstName = $lastName = $email = $login = $password1 = $password2 = "";
        
        //Check if user pressed sumbit button
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["firstName"])) {
                $errorMessages["firstName"] = " *First name is required";
            }
            else {
                $firstName = checkUserInput($_POST["firstName"]);

                if (!preg_match("/^[a-zA-Z ]*$/", $firstName )) {
                    $errorMessages["firstName"] = " *First name can contain only letters";
                    $firstName = "";
                }
            }

            if(empty($_POST["lastName"])) {
                $errorMessages["lastName"] = " * Last name is required";
            }
            else {
                $lastName = checkUserInput($_POST["lastName"]);

                if (!preg_match("/^[a-zA-Z]*$/", $lastName)) {
                    $errorMessages["lastName"] = " *Last name can only contain only letters";
                }
            }

            if(empty($_POST["email"])) {
                $errorMessages["email"] = " * Email is required";
            }
            else {
                $email = checkUserInput($_POST["email"]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errorMessages["email"] = " *Email format isn't correct";
                }

                //Check if the same login is registered already 
                // if (!checkEmail($email)) {
                //     $errorMessages["email"] = " Email is already used. Enter different email";
                //     $_POST["email"] = "";
                // }
            }

            if(empty($_POST["login"])) {
                $errorMessages["login"] = " * Login is required";
            }
            else {
                $login = checkUserInput($_POST["login"]);

                if (strlen($login) < 6) {
                    $errorMessages["login"] = " *Login must be longer that 6";
                }

                //Check if the same login is registered already 
                // if (!checkLogin($login)) {
                //     $errorMessages["login"] = " Login is already used. Choose different login";
                //     $_POST["login"] = "";
                // }
            }

            if(empty($_POST["password1"])) {
                $errorMessages["password1"] = " * Password is required";
            }
            else {
                $password1 = checkUserInput($_POST["password1"]);

                if (strlen($password1) < 7) {
                    $errorMessages["password1"] = " *password1 must be longer that 7s";
                }
            }

            if(empty($_POST["password2"])) {
                $errorMessages["password2"] = " * Password is required";
            }
            else {
                $password2 = checkUserInput($_POST["password2"]);

                if (strlen($password2) < 7) {
                    $errorMessages["password2"] = " *password1 must be longer that 7s";
                }
            }

            if($_POST["password1"] != $_POST["password2"]) {
                $errorMessages["password1"] =  $errorMessages["password2"] =  " * Passwords do not match";
                $_POST["password2"] = "";
            }

        }

        //Function checking user input to prevent attacks on the website
        function checkUserInput($userInput) {
            $userInput = trim($userInput);
            $userInput = stripcslashes($userInput);
            $userInput = htmlspecialchars($userInput);

            return $userInput;
        }
    ?>
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
            <form action="register.php" method="Post" autocomplete="off" >
                <input type="password" style="display:none">
                <label>First name</label><input type="text" class="formFields" name="firstName" value="<?php echo $firstName; ?>" placeholder="John" />
                    <span class="error"><?php echo $errorMessages["firstName"] ?></span><br>
                <label>Last name</label><input type="text" class="formFields" name="lastName" value="<?php echo $lastName; ?>" placeholder="Doe"  />
                <span class="error"><?php echo $errorMessages["lastName"] ?></span><br>
                <label>Email</label><input type="email" class="formFields" name="email" value="<?php echo $email; ?>" placeholder="example@example.ca"  />
                <span class="error"><?php echo $errorMessages["email"] ?></span><br>
                 <input type="password" style="display:none">
                <label>Login</label><input type="text" class="formFields" name="login" value="<?php echo $login ?>" autocomplete="new-password" />
                <span class="error"><?php echo $errorMessages["login"] ?></span><br>
                <input type="password" style="display:none">
                <label>Password</label><input type="password" class="formFields" name="password1" value="<?php echo $password1; ?>" />
                <span class="error"><?php echo $errorMessages["password1"] ?></span><br>
                <label>Repeat password</label><input type="password" class="formFields"  name="password2" value="<?php echo $password2; ?>"  />
                <span class="error"><?php echo $errorMessages["password2"] ?></span><br>
                <div class="buttonsContainer">
                    <input type="submit" class="formButton" value="Register"/>
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