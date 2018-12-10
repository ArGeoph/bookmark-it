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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
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

            <?php  
            //=============================================================================//
            //***PHP Code ***/

            $bookmarks = getBookmarks(); //Get user bookmarks from database
            $bookmarkCounter = 0;

            if (mysqli_num_rows(($bookmarks)) > 0) {
                echo "<h3>You have the following bookmarks:</h3><ul><form id=\"bookmarkForm\" action=\"/loged.php\" method=\"POST\">";
                while ($row = mysqli_fetch_assoc($bookmarks)) {
                    echo ("<li><input natype=\"text\" name=\"linkName$bookmarkCounter\" class=\"bookmarkFiels\" value=\"" . $row["name"] . "\" disabled />");
                    echo ("<input natype=\"text\" name=\"linkUrl$bookmarkCounter\" class=\"bookmarkFiels urlField\" value=\"" . $row["url"] . "\" disabled /><wbr>");
                    echo ("<wbr><a class=\"bookmarkButton\" href=\"" . $row["url"] . "\" target=\"_blank\">Open &#8594;</a><wbr>");
                    echo ("<button class=\"bookmarkButton\" type=\"submit\" name=\"editBookmark$bookmarkCounter\" formaction=\"loged.php\">Remove</button>");
                    echo ("<button class=\"bookmarkButton\" name=\"editBookmark$bookmarkCounter\" formaction=\"#\">Edit</button><wbr>");

                    $bookmarkCounter++;
                }
                echo "</form></ul>";
                $bookmarkCounter = 0;
            }
            else {
                echo "<h3>You don't have any bookmarks, but you can add some</h3>";
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