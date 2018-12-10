<?php  session_start(); ?>

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
        $logErrorMessages = array ("logError" => "", "passError" => ""); //Array with error messages 
        $login = $pass = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Check if fields are not empty
            if ($_POST["login"] == "") {
                $logErrorMessages["logError"] = "* Login field cannot be empty";
            }
            else {
                $login = checkUserInput($_POST["login"]);
            }

            if ($_POST["pass"] == "") {
                $logErrorMessages["passError"] = "* Password field cannot be empty";
            }
            else {
                $pass = checkUserInput($_POST["pass"]);
            }

            isAllFieldsAreFilled();
        }   



        //Check if all fields are entered and there's no errors and call function writing everything to database if it's the case 
        function isAllFieldsAreFilled() {
            //iterate through error array to see if there's any errors 
            foreach ($GLOBALS["logErrorMessages"] as $error) {
                if ($error != "") {
                    return;
                }
            }

            //if reached this point it means that there's no any errors and we can check if login and password are correct
            authenticate();
        }

        function authenticate() {
            //get database connection handler 
            $dbConnection = connectToDB();
            mysqli_select_db($dbConnection, "bookmarks");

            $query = "SELECT userID FROM login WHERE log =" . "\"". $GLOBALS["login"] . "\"";
            //Check if there's such login in the database
            $result = mysqli_query($dbConnection, $query);

            if (mysqli_num_rows($result) > 0) {
                //if we are here such a login exists in the database, so now we can check password
                $queryPassword = "SELECT pass FROM login WHERE log =" . "\"". $GLOBALS["login"] . "\"";
                $passwordResult = mysqli_query($dbConnection, $queryPassword);
                $row = mysqli_fetch_assoc($passwordResult);
                if (password_verify($GLOBALS["pass"], $row["pass"])) {
                   
                    $_SESSION["authenticated"] = true;
                    $_SESSION["login"] = $GLOBALS["login"];
                    $_SESSION["userID"] = mysqli_fetch_assoc($result)["userID"];
                    header("Location: http://127.0.0.1/tma2/part1/loged.php");
                    exit();
                }
                else {
                    $GLOBALS["logErrorMessages"]["passError"] = "* Password incorrect. Try again";
                    $GLOBALS["pass"] = "";
                }
            }
            else {
                $GLOBALS["logErrorMessages"]["logError"] = "* Login doesn't exist";
            }
            mysqli_close($dbConnection);
        }

        //Function connecting to database and returning database handler
        function connectToDB() {
            $dbConnection = mysqli_connect("localhost", "testUser", "GHNKCh3hgmpdE3Ka"); //Connect to db

            if (!$dbConnection) {
                die ("Couldn't connect to database. Try later or check your credentials");
            }
            else {
                return $dbConnection;
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
            <a href="register.php">Register</a>
        </div>
    </nav>
        
    <main>
        <div class="loginContainer"> 
            <h1>Login</h1>   
            <form action="login.php" method="Post" autocomplete="off" >
                <input type="password" style="display:none">
                <label>Login</label><input type="text" class="formFields" name="login" value="<?php echo $login ?>"/>
                <span class="error"><?php echo $logErrorMessages["logError"]; ?></span><br>
                <label>Password</label><input type="password" class="formFields" name="pass" value=""  />
                <span class="error"><?php echo $logErrorMessages["passError"]; ?></span>
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