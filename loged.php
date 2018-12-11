<?php  
    //=============================================================================//
    //***PHP Code ***/
    session_start(); 
    //Check if user is not authenticated
    if (!$_SESSION["authenticated"]) {
        //Redirect user to login page in case they are not authenticated
        header ("Location: http://127.0.0.1/tma2/part1/login.php"); 
    }

    //Get user bookmarks from database
    function getBookmarks() {
        $dbConnection = connectToDB();
        mysqli_select_db($dbConnection, "bookmarks");

        //get all bookmarks for the this particular user
        $requestBookmarks = "SELECT * FROM bookmarks WHERE userID = \""  .$_SESSION["userID"] . "\"";
        $requestResult = mysqli_query($dbConnection, $requestBookmarks);
        mysqli_close($dbConnection);

        return $requestResult;
    }

    //Function connecting to database and returning database handler
    function connectToDB() {
        $dbConnection = mysqli_connect("localhost", "testUser", "GHNKCh3hgmpdE3Ka"); //Connect to db

        if (!$dbConnection) {
            die ("Couldn't connect to database. Try later or check your credentials");
        }
        else {
        }
        return $dbConnection;
    }  


    //Check if any form button was pressed
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["newUrlName"]) && isset($_POST["newUrl"])) {
            insertNewBookmarkToDatabase();            
        }
        
        //Check if remove button was pressed
        if (isset($_POST["removeBookmark"])) {
            removeBookmarkFromDatabase($_POST["removeBookmark"]);
        }

        //Check if user button to update bookmark
        if (isset($_POST["updateBookmark"])) {
            $bookmarkID = $_POST["updateBookmark"];
            echo $_POST["linkName$bookmarkID"];
            // updateBookmarkInDatabase($_POST["updateBookmark"]);
            
        }

        $_POST = array();   
        unset($_REQUEST);
    }

    //Insert new bookmarks to database 
    function insertNewBookmarkToDatabase() {
        $dbConnection = connectToDB();
        mysqli_select_db($dbConnection, "bookmarks");

        $insertQuery = "INSERT INTO bookmarks (userID, url, name) VALUES(" 
            . $_SESSION["userID"] . ", \"" . $_POST["newUrl"] . "\", \"" . $_POST["newUrlName"] . "\")";
            // echo $insertQuery;
        $insertResult = mysqli_query($dbConnection, $insertQuery);
        mysqli_close($dbConnection);
    }

    //Edit bookmark
    function updateBookmarkInDatabase($bookmarkID) {
        $dbConnection = connectToDB();
        mysqli_select_db($dbConnection, "bookmarks");

        $updateQuery = "UPDATE bookmarks SET url=\"" . $_POST["linkName$bookmarkID"] . 
            "/, name=\"" . $_POST["linkUrl$bookmarkID"] . "\" WHERE bookmarkID=$bookmarkID" ;
        mysqli_query($dbConnection, $updateQuery);
        mysqli_close($dbConnection);
        echo ("DB closed");
    }

    //Remove bookmark with specified id from database 
    function removeBookmarkFromDatabase($bookmarkID) {
        $dbConnection = connectToDB();
        mysqli_select_db($dbConnection, "bookmarks");

        $removeQuery = "DELETE FROM bookmarks WHERE bookmarkID = $bookmarkID";
        $result = mysqli_query($dbConnection, $removeQuery);
        mysqli_close($dbConnection);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

            <?php  
            //=============================================================================//
            //***PHP Code ***/

            $bookmarks = getBookmarks(); //Get user bookmarks from database

            if (mysqli_num_rows(($bookmarks)) > 0) {
                echo "<h3>Your bookmarks:</h3><ul><form id=\"bookmarkForm\" name=\"theForm\" action=\"loged.php\" method=\"POST\">";
                while ($row = mysqli_fetch_assoc($bookmarks)) {
                    echo ("<li><input type=\"text\" name=\"linkName" . $row["bookmarkID"] . "\" class=\"bookmarkFiels\" value=\"" . $row["name"] . "\"  disabled  formaction=\"loged.php\" />");
                    echo ("<input type=\"text\" name=\"linkUrl" . $row["bookmarkID"] . "\" class=\"bookmarkFiels urlField\" value=\"" . $row["url"] . "\"  disabled  formaction=\"loged.php\" />");
                    echo ("<a class=\"bookmarkButton\" href=\"" . $row["url"] . "\" target=\"_blank\">Open &#8594;</a>");
                    echo ("<button class=\"bookmarkButton\" type=\"submit\" value=\"" . $row["bookmarkID"] . "\"" . $row["bookmarkID"] . " name=\"removeBookmark\" formaction=\"loged.php\">Remove</button>");
                    echo ("<button class=\"bookmarkButton editButton\" type=\"submit\" name='updateBookmark' value=\"" . $row["bookmarkID"] . "\" formaction=\"loged.php\">Edit</button>");
                    echo ("<button class=\"bookmarkButton cancelButton\" value=\"" . $row["bookmarkID"] . "\" formaction=\"#\">Cancel</button>");
                }
                echo "</form></ul>";

            }
            else {
                
                echo "<h3>You don't have any bookmarks, but you can add some</h3>";
                echo "<form id=\"bookmarkForm\" action=\"loged.php\" method=\"POST\">";
                echo "</form></ul>";
            }
            //=============================================================================//
            //***PHP Code Ends ***/
            ?>
            <button class="bookmarkButton addNewBookmark" id="addBookmark">Add new bookmark</button>
        </div>
    </main>

    <footer>
        <h3>Kirill Golubev &copy;<?php echo date('Y') ?></h3>
    </footer>
</body>
</html>