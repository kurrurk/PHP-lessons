<?php
    class ShopProduct {
        public $title = "Test product";
        public $producerMainName = "Nachname";
        public $producerFirstName = "Vorname";
        public $price = 0;
    }

    $product1 = new ShopProduct();
    $product2 = new ShopProduct();

    
    $product2->title = "Ревизор";

    $product1->arbitraryAddition = "Доп параметр!!!";

    print $product1->title . "<br>";
    print $product2->title . "<br>";

    print "---------------------------------". "<br>";

    $product1->title = "собачье сердце";
    $product1->producerFirstName = "Михаил";
    $product1->producerMainName = "Булгаков";
    $product1->price = 5.99;

    print "Автор: {$product1->producerFirstName} " . "{$product1->producerMainName}" . "<br>";

    print "---------------------------------". "<br>";

    echo "<pre>";
    var_dump($product1);
    var_dump($product2);
    echo "</pre>";