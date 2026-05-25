<?php
class ShopProduct
{
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

    public function getProducer()
    {
        print "<b>Function</b> ShopProduct::getProducer(): <pre>";
        print "Автор: {$this->producerFirstName} " .
            "{$this->producerMainName}\n";
        print "</pre>";
    }
}

class ShopProduct_PHP8
{
    public function __construct(
        public $title = "Test product",
        public $producerMainName = "Nachname",
        public $producerFirstName = "Vorname",
        public $price = 0
    ) {}

    public function getProducer()
    {
        print "<b>Function</b> ShopProduct_PHP8::getProducer(): <pre>";
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
$product2 = new ShopProduct_PHP8(
    "Ревизор",
    "Николай",
    "Гоголь",
    4.99,
);
$product_default = new ShopProduct_PHP8();
$product_title_and_price = new ShopProduct_PHP8(
    price: 9.99,
    title: "Мастер и Маргарита",
);


print $product1->title . "<br>";
print $product2->title . "<br>";

print "<hr>";

$product1->getProducer();

print "<hr>";

$product2->getProducer();

print "<hr><br>";

echo "<pre>";
var_dump($product1);
var_dump($product2);
var_dump($product_default);
var_dump($product_title_and_price);
echo "</pre>";
