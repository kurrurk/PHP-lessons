<?php
    class ShopProduct {
        public $title = "Test product";
        public $producerMainName = "Nachname";
        public $producerFirstName = "Vorname";
        public $price = 0;

        public function __construct(
            $title = "Test product",
            $producerMainName = "Nachname",
            $producerFirstName = "Vorname",
            $price = 0
        ) {
            $this->title = $title;
            $this->producerMainName = $producerMainName;
            $this->producerFirstName = $producerFirstName;
            $this->price = $price;
        }

        public function getProducer () {
            print "<b>Function</b> getProducer(): <pre>";
            print "Автор: {$this->producerFirstName} " . 
            "{$this->producerMainName}\n";
            print "</pre>";
        }
    }

    $product1 = new ShopProduct(
        "Cобачье сердце",
        "Михаил",
        "Булгаков",
        5.99,
    );
    $product2 = new ShopProduct();

    
    $product2->title = "Ревизор";

    print $product1->title . "<br>";
    print $product2->title . "<br>";

    print "<hr>";

    $product1->getProducer();    

    print "<hr><br>";

    echo "<pre>";
    var_dump($product1);
    var_dump($product2);
    echo "</pre>";