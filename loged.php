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
            <a href="index.php">Logout</a>
        </div>
    </nav>
        
    <main>
        <div class="container"> 
            <h1>Welcome Kirill!</h1>   
            <h3>You have the following bookmarks:</h3>
            <ol>
                <li>Google <a href="https://www.google.com" target="_blank">Open bookmark</a><button class="removeButton">Remove bookmark</button></li>
            </ol>
            <button class="addButton">Add new bookmark</button>
        </div>
    </main>

    <footer>
        <h3>Kirill Golubev &copy;<?php echo date('Y') ?></h3>
    </footer>
</body>
</html>