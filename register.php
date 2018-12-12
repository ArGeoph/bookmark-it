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
        
        //Check if user pressed submit button
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

                //Check if the same email was used already 
                if (emailIsUsed($email)) {
                    $errorMessages["email"] = " Email is already used. Enter different email";
                    $_POST["email"] = "";
                }
            }

            if(empty($_POST["login"])) {
                $errorMessages["login"] = " * Login is required";
            }
            else {
                $login = checkUserInput($_POST["login"]);

                if (strlen($login) < 6) {
                    $errorMessages["login"] = " *Login must be longer than 6";
                }

                //Check if the same login was used already 
                if (loginIsUsed($login)) {
                    $errorMessages["login"] = " Login is already used. Choose different one";
                    $_POST["login"] = "";
                }
            }

            if(empty($_POST["password1"])) {
                $errorMessages["password1"] = " * Password is required";
            }
            else {
                $password1 = checkUserInput($_POST["password1"]);

                if (strlen($password1) < 7) {
                    $errorMessages["password1"] = " *password1 must be longer than 7";
                }
            }

            if(empty($_POST["password2"])) {
                $errorMessages["password2"] = " * Password is required";
            }
            else {
                $password2 = checkUserInput($_POST["password2"]);

                if (strlen($password2) < 7) {
                    $errorMessages["password2"] = " *password1 must be longer than 7";
                }
            }

            if($_POST["password1"] != $_POST["password2"]) {
                $errorMessages["password1"] =  $errorMessages["password2"] =  " * Passwords do not match";
                $_POST["password2"] = "";
            }

            isAllFieldsAreFilled(); //Check if all fields are correctly filled and create user in this case
        }

        //Function checking user input to prevent attacks on the website
        function checkUserInput($userInput) {
            $userInput = trim($userInput);
            $userInput = stripcslashes($userInput);
            $userInput = htmlspecialchars($userInput);

            return $userInput;
        }

        //***======================================================================= ***/
        //*** Working with database ***/

        //Function checking if email has been already used and it's in database
        function emailIsUsed($email) {
            $dbConnection = connectToDB();
            mysqli_select_db($dbConnection, "bookmarks");

            $sqlQuery = "SELECT userID FROM login WHERE email = \"" . $email . "\"" ;
            $result = mysqli_query($dbConnection, $sqlQuery);

            if (mysqli_num_rows($result) > 0) {
                return true;
            }
            else {
                return false;
            }

            mysqli_close($dbConnection);
        }

        //Function checking if login has been already used and it's in database
        function loginIsUsed($login) {
            $dbConnection = connectToDB();
            mysqli_select_db($dbConnection, "bookmarks");

            $sqlQuery = "SELECT userID FROM login WHERE log = \"" . $login . "\"";
            $result = mysqli_query($dbConnection, $sqlQuery);

            if (mysqli_num_rows($result) > 0) {
                return true;
            }
            else {
                return false;
            }

            mysqli_close($dbConnection);
        }

        //Check if all fields are entered and there's no errors and call function writing everything to database if it's the case 
        function isAllFieldsAreFilled() {
            //iterate through error array to see if there's any errors 
            foreach ($GLOBALS["errorMessages"] as $error) {
                if ($error != "") {
                    return;
                }
            }

            //if reached this point it means that there's no any errors
            createUser();
        }

        //Create user and write everything to database 
        function createUser() {
            $dbConnection = connectToDB();
            mysqli_select_db($dbConnection, "bookmarks");

            $query = "INSERT INTO login (email, log, pass) VALUES (" . "\"" .  $GLOBALS["email"] . "\"" .  "," . "\"" . $GLOBALS["login"] . "\"" . "," 
            . "\"" . password_hash($GLOBALS["password1"], PASSWORD_BCRYPT) . "\")";

            $result = mysqli_query($dbConnection, $query);

            if ($result) {
                echo "User created";
                header ("Location:  http://127.0.0.1/tma2/part1/success.php");
                exit();
            }
            else {
                echo "Error adding user, try later";
            }
        }
        
        //Function connecting to database and returning database handler
        function connectToDB() {
            $dbConnection = mysqli_connect("localhost", "testUser", "GHNKCh3hgmpdE3Ka"); //Connect to db

            if (!$dbConnection) {
                die ("Couldn't connect to database. Try later or check your credentials");
            }
            else {
                echo ("Database connection successful");
            }
            return $dbConnection;
        }        
    //===========================================================================================================================//
    ?>

    <!-- Nav menu -->
    <nav>
        <p class="logo">Bookmark IT!</p>
        <div class="navButtons">
            <a href="index.php" >Main</a>
            <a href="login.php">Login</a>
        </div>
    </nav>
        
    <main>
        <div class="registerContainer"> 
            <h1>Register</h1>   
            <form action="register.php" method="Post" class="registerForm" autocomplete="off" >
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
        <h3>Kirill Golubev &copy;<?php echo date("Y") ?></h3>
    </footer>
</body>
</html>