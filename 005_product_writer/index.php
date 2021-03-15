<?php
    class ShopProduct {
        public $title = "Test product";
        public $producerMainName = "Nachname";
        public $producerFirstName = "Vorname";
        public $price = 0;

        public function __construct(
            string $title = "Test product",
            string $producerMainName = "Nachname",
            string $producerFirstName = "Vorname",
            float $price = 0
        ) {
            $this->title = $title;
            $this->producerMainName = $producerMainName;
            $this->producerFirstName = $producerFirstName;
            $this->price = $price;
        }

        public function getProducer () {
           return "{$this->producerFirstName} " . "{$this->producerMainName}";
        }
    }

    class ShopProductWriter
    {
        public function write(ShopProduct $shopProduct)
        {
            $str = "<pre>" . $shopProduct->title . ": " . $shopProduct->getProducer() . " (" . $shopProduct->price . ")\n" . "</pre>";
            print $str;
        }
    }

    $product1 = new ShopProduct(
        "Cобачье сердце",
        "Михаил",
        "Булгаков",
        5.99,
    );
    $writer = new ShopProductWriter();
    $product2 = new ShopProduct();

    
    $product2->title = "Ревизор";

    print $product1->title . "<br>";
    print $product2->title . "<br>";

    print "<hr>";

    print "<b>Function</b> getProducer() : <br>";

    print "<pre>Автор: " . $product1->getProducer() ."</pre><br>";    

    print "<b>Function</b> ShopProductWriter::write() : <br>";

    $writer->write($product1);

    print "<hr><br>";

    echo "<pre>";
    var_dump($product1);
    var_dump($product2);
    echo "</pre>";