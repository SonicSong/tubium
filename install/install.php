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
        <div>
            <form action="install_script.php" method="post">
                <p>Database hostname: </p>
                <input type="text" placeholder="Database hostname" name="db_host">
                <p>Database login: </p>
                <input type="text" placeholder="Database login" name="db_login">
                <p>Database password: </p>
                <input type="password" placeholder="Database password" name="db_pass">
                <p>Choose database name you want to set: </p>
                <input type="text" placeholder="Database name" name="db_name">
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
