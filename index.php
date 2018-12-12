<?php  
    //=============================================================================//
    //***PHP Code ***/
    //Get 10 most popular bookmarks from database
    $tenMostPopularBookmars;

    function getBookmarks() {
        $dbConnection = connectToDB();
        mysqli_select_db($dbConnection, "bookmarks");

        //get all bookmarks for the this particular user
        $requestBookmarks = "SELECT name, url, COUNT(url) AS number_of_entries FROM bookmarks GROUP BY url ORDER BY number_of_entries DESC LIMIT 10";
        $GLOBALS["tenMostPopularBookmars"] = mysqli_query($dbConnection, $requestBookmarks);
        mysqli_close($dbConnection);
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

    getBookmarks();
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
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </nav>
        
    <main>
        <h1>Welcome to <span>Bookmark It!</span><br> Add, edit and access your bookmarks from anythere and from any device</h1>
        <div class="mostPopular"> 
            <?php 
                if (isset($GLOBALS["tenMostPopularBookmars"]) && mysqli_num_rows($GLOBALS["tenMostPopularBookmars"]) > 0) {
                    echo "<h3>Most popular bookmarks our users added so far</h3>";
                    echo "<ul><form id=\"bookmarkForm\" >";
                    echo "<li><p class='mainPage'><label>Website name</label><label>Web address</label></p></li>";
                    while($row = mysqli_fetch_assoc($GLOBALS["tenMostPopularBookmars"])) {
                        echo ("<li><input type=\"text\" class=\"bookmarkFiels mainPage \" value=\"" . $row["name"] . "\"  disabled  />");    
                        echo ("<input type=\"text\" class=\"bookmarkFiels urlField mainPage\" value=\"" . $row["url"] . "\"  disabled  />");
                        echo ("<a class=\"bookmarkButton\" href=\"" . $row["url"] . "\" target=\"_blank\">Open &#8594;</a>");
                    }  
                    echo "</form></ul>";                
                }
                else {
                    echo "<h3>There has been no any bookmarks adeed so far</h3>";
                }
            ?>

        </div>
    </main>

    <footer>
        <h3>Kirill Golubev &copy;<?php echo date('Y') ?></h3>
    </footer>
</body>
</html>