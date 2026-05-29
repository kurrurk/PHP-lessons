<?php

$db = new PDO('sqlite:database.sqlite');

$db->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);

$db->exec('
    CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        type TEXT,
        firstname TEXT,
        mainname TEXT,
        title TEXT,
        price FLOAT,
        numpages INT,
        playlength FLOAT,
        discount INT
    )
');


$stmt = $db->prepare('
    INSERT INTO products (
        type,
        firstname,
        mainname,
        title,
        price,
        numpages,
        playlength,
        discount
    )
    VALUES (
        :type,
        :firstname,
        :mainname,
        :title,
        :price,
        :numpages,
        :playlength,
        :discount
    )
');

$products = [
    [
        'type' => 'book',
        'firstname' => 'Джон',
        'mainname' => 'Толкин',
        'title' => 'Властелин колец',
        'price' => 24.99,
        'numpages' => 1178,
        'playlength' => 0,
        'discount' => 10,
    ],

    [
        'type' => 'book',
        'firstname' => 'Фрэнк',
        'mainname' => 'Герберт',
        'title' => 'Дюна',
        'price' => 19.99,
        'numpages' => 688,
        'playlength' => 0,
        'discount' => 5,
    ],

    [
        'type' => 'book',
        'firstname' => 'Анджей',
        'mainname' => 'Сапковский',
        'title' => 'Последнее желание',
        'price' => 17.50,
        'numpages' => 480,
        'playlength' => 0,
        'discount' => 15,
    ],

    [
        'type' => 'cd',
        'firstname' => 'Людвиг',
        'mainname' => 'Бетховен',
        'title' => 'Symphony No. 9',
        'price' => 14.99,
        'numpages' => 0,
        'playlength' => 67.35,
        'discount' => 0,
    ],

    [
        'type' => 'cd',
        'firstname' => 'Вольфганг',
        'mainname' => 'Моцарт',
        'title' => 'Requiem',
        'price' => 16.49,
        'numpages' => 0,
        'playlength' => 55.20,
        'discount' => 5,
    ],

    [
        'type' => 'cd',
        'firstname' => 'Иоганн',
        'mainname' => 'Бах',
        'title' => 'Brandenburg Concertos',
        'price' => 13.99,
        'numpages' => 0,
        'playlength' => 71.10,
        'discount' => 20,
    ],
    [
        'type' => 'software',
        'firstname' => 'Брендан',
        'mainname' => 'Эйх',
        'title' => 'JavaScript: The Good Parts',
        'price' => 39.99,
        'numpages' => 0,
        'playlength' => 0,
        'discount' => 15,
    ],
    [
        'type' => 'game',
        'firstname' => 'CD Projekt',
        'mainname' => 'Red',
        'title' => 'Ведьмак 3: Дикая Охота',
        'price' => 29.99,
        'numpages' => 0,
        'playlength' => 120.0,
        'discount' => 10,
    ],
];

$count = $db
    ->query('SELECT COUNT(*) FROM products')
    ->fetchColumn();

if ($count < count($products)) {

    foreach ($products as $product) {
        $stmt->execute([
            ':type' => $product['type'],
            ':firstname' => $product['firstname'],
            ':mainname' => $product['mainname'],
            ':title' => $product['title'],
            ':price' => $product['price'],
            ':numpages' => $product['numpages'],
            ':playlength' => $product['playlength'],
            ':discount' => $product['discount'],
        ]);
    }

    echo 'Products inserted!';
}
