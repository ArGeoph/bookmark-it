<?php  session_start(); 
    //Check if user is not authenticated
    if (!$_SESSION["authenticated"]) {
        //Redirect user to the page that not existent in case they are not authenticated
        header ("Location http://127.0.0.1/tma2/part1/sagsadgqewhdgsadfdsa.php"); 
    }
    //=============================================================================//
    //***PHP Code ***/

        //Get user bookmarks from database
        function getBookmarks() {
            $dbConnection = connectToDB();
            mysqli_select_db($dbConnection, "bookmarks");
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

    //=============================================================================//
    //***PHP Code Ends***/   
?>

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
            <a href="logout.php">Logout</a>
        </div>
    </nav>
        
    <main>
        <div class="bookmarksContainer"> 
            <h1>Welcome <?php echo $_SESSION["login"]; ?>!</h1>  
            



            <h3>You have the following bookmarks:</h3>
            <ol>
                <!-- <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <!-- <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>

                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li> -->
            </ol> -->
            <button class="addButton">Add new bookmark</button>
        </div>
    </main>

    <footer>
        <h3>Kirill Golubev &copy;<?php echo date('Y') ?></h3>
    </footer>
</body>
</html>