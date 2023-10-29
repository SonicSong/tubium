<?php
if (isset($_SERVER['REQUEST_METHOD'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db_hostname = $_REQUEST['db_host'] ?? '';
        $db_login = $_REQUEST['db_login'] ?? '';
        $db_password = $_REQUEST['db_pass'] ?? '';
        $db_name = $_REQUEST['db_name'] ?? '';

        $data = [
            'hostname' => $db_hostname,
            'login' => $db_login,
            'password' => $db_password,
            'name' => $db_name,
        ];

        file_put_contents('../config.php', '<?php $config = ' . var_export($data, true) . ';');

        $new_db = createNewDb($db_hostname, $db_login, $db_password, $db_name);
        if($new_db !== false){
            header('Location:fin.php');
            exit;
        }
    }else{
        echo "Installation script error.";
    }
}

function createNewDb($db_hostname, $db_login, $db_password, $db_name){
    $db = mysqli_connect($db_hostname, $db_login, $db_password);
    if(!$db){
        die("Cannot connect do database. Make sure you inputted correct data").mysqli_connect_error();
    }

    $createDbQuery = 'CREATE DATABASE IF NOT EXISTS '.$db_name.';';
    try {
        mysqli_query($db, $createDbQuery);;
    } catch (mysqli_sql_exception $error){
        die($error);
    }

    $switchToDb = 'USE '.$db_name.';';
    try{
        mysqli_query($db, $switchToDb);
    } catch (mysqli_sql_exception $error){
        die($error);
    }

    $createTbQuery = 'CREATE TABLE IF NOT EXISTS history ( id INT AUTO_INCREMENT, video_name TEXT, video_link TEXT, PRIMARY KEY (id) );';
    try{
        mysqli_query($db, $createTbQuery);
    }catch (mysqli_sql_exception $error){
        die($error);
    }
}

//FINITO!