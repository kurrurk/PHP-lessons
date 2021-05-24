<?php
    $driver = "mysql";
    $host = "localhost";
    $db_name = "test";
    $db_user = "root";
    $db_pass = "";
    $charset = "utf8";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    try {
        $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset",$db_user,$db_pass,$options);
    }catch (PDOException $e){
        die('не могу подключиться к базе данных!');
    }

    $result = $pdo->query('SELECT * FROM test');

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $str = "<pre>" . $row['id'] . ". -> " . $row['title'] . " (" . $row['type'] . ") " . ": " . $row['firstname'] . " " . $row['mainname'] . " (" . $row['price'] . ")\n" . "</pre>";
        print $str;
    }

    print("Соединение установлено успешно!<br>");