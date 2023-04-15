<?php
$mysqli =  new mysqli("localhost", "root", "","test");

if (mysqli_connect_errno()){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    print("Соединение установлено успешно<br>");
    $book[1] = [
        "id" => 1,
        "type" => "книга",
        "firstname" => "Михаил",
        "mainname" => "Булгаков",
        "title"	=> "Cобачье сердце",
        "price"	=> 5.99,
        "numpages" => 600,
        "discount" => 5,
    ];

    $CD[1] = [
        "id" => 2,
        "type" => "диск",
        "firstname" => "Антонио",
        "mainname" => "Вивальди",
        "title"	=> "Классическая музыка. Лучшее",
        "price"	=> 10.99,
        "playlength" => 60.33,
        "discount" => 3,
    ];

    $book[2] = [
        "id" => 3,
        "type" => "книга",
        "firstname" => "Николай",
        "mainname" => "Гоголь",
        "title"	=> "Мертвые души",
        "price"	=> 4.99,
        "numpages" => 273,
        "discount" => 5,
    ];

    $CD[2] = [
        "id" => 4,
        "type" => "диск",
        "firstname" => "Эдвард",
        "mainname" => "Григ",
        "title"	=> "The Very Best ",
        "price"	=> 12.99,
        "playlength" => 85.10,
        "discount" => 10,
    ];

    $result = '';
    $id = 0;

    for ( $i = 1; $i < 3; $i++ ) {



        $sql_b = 'INSERT INTO test SET id = ' . $mysqli->insert_id;
        $sql_b .= ', type = "' . $book[$i]["type"] . '"';
        $sql_b .= ', firstname = "' . $book[$i]["firstname"] . '"';
        $sql_b .= ', mainname = "' . $book[$i]["mainname"] . '"';

        $sql_b .= ', title = "' . $book[$i]["title"] . '"';
        $sql_b .= ', price = ' . $book[$i]["price"];
        $sql_b .= ', numpages = ' . $book[$i]["numpages"];
        $sql_b .= ', discount = ' . $book[$i]["discount"];

        $mysqli->query($sql_b);
        $mysqli->close();
        $mysqli =  new mysqli("localhost", "root", "","test");

        $sql_cd = 'INSERT INTO test SET id = ' . $mysqli->insert_id;
        $sql_cd .= ', type = "' . $CD[$i]["type"] . '"';
        $sql_cd .= ', firstname = "' . $CD[$i]["firstname"] . '"';
        $sql_cd .= ', mainname = "' . $CD[$i]["mainname"] . '"';

        $sql_cd .= ', title = "' . $CD[$i]["title"] . '"';
        $sql_cd .= ', price = ' . $CD[$i]["price"];
        $sql_cd .= ', playlength = ' . $CD[$i]["playlength"];
        $sql_cd .= ', discount = ' . $CD[$i]["discount"];

        $mysqli->query($sql_cd);
        $mysqli->close();
        $mysqli =  new mysqli("localhost", "root", "","test");
    }
    $mysqli->close();
}
?>