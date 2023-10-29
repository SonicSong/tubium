<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tubium</title>
</head>
<body>
    <div>
        <div class="header">
            <h2>Tubium</h2>
            <form method="post" action="src/query.php">
                <input type="text" name="query">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="content">
            <div>
                <p>Playlists</p>
            </div>
            <div class="main">
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                include_once 'src/parser.php';

                mainPage();
                ?>
            </div>
        </div>
    </div>
</body>
</html>