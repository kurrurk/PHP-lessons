<?php

class ShopProduct
{
    public function __construct(
        public string $title = "Test product",
        public string $producerMainName = "Nachname",
        public string $producerFirstName = "Vorname",
        public float $price = 0
    ) {
    }

    public function getProducer()
    {
        return "{$this->producerFirstName} " . "{$this->producerMainName}";
    }

    public function getSummaryLine()
    {
        $base = "{$this->title} ( {$this->producerMainName},";
        $base .= "{$this->producerFirstName} )";
        return $base;
    }
}

class CdProduct extends ShopProduct
{
    public $playLangth;

    public function __construct(
        string $title = "Test product",
        string $producerMainName = "Nachname",
        string $producerFirstName = "Vorname",
        float $playLangth = 0,
        float $price = 0
    ) {
        parent::__construct(
            $title,
            $producerMainName,
            $producerFirstName,
            $price
        );

        $this->playLangth = $playLangth;
    }

    public function getPlayLangth()
    {
        return $this->playLangth;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": Время звучания - {$this->playLangth}";
        return $base;
    }
}


class BookProduct extends ShopProduct
{
    public $numPages;

    public function __construct(
        string $title = "Test product",
        string $producerMainName = "Nachname",
        string $producerFirstName = "Vorname",
        int $numPages = 0,
        float $price = 0
    ) {
        parent::__construct(
            $title,
            $producerMainName,
            $producerFirstName,
            $price
        );

        $this->numPages = $numPages;
    }

    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": {$this->numPages} стр.";
        return $base;
    }
}


class ShopProductWriter
{
    public function write(ShopProduct $shopProduct)
    {
        $str = "<pre>" . $shopProduct->title . ": " . $shopProduct->getProducer() . " (" . $shopProduct->price . "€)\n" . "</pre>";
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

print $product1->title . "<br>";

print "<hr>";

print "<b>Function</b> getProducer() : <br>";

print "<pre>Автор: " . $product1->getProducer() . "</pre><br>";

print "<hr>";

print "<p><b>Object</b> CdProduct : </p>";

$product2 = new CdProduct(
    "Классическая музыка. Лучшее",
    "Антонио",
    "Вивальди",
    60.33,
    10.99,
);

print "Исполнитель: {$product2->getProducer()}\n";

print "<p><em>{$product2->getSummaryLine()}</em></p>";

print "<b>Object</b> BookProduct : <br>";

$product3 = new BookProduct(
    "Cобачье сердце",
    "Михаил",
    "Булгаков",
    600,
    5.99
);

print "<p><em>{$product3->getSummaryLine()}</em></p>";

print "<hr><br>";

print "<b>Function</b> ShopProductWriter::write() : <br>";

$writer->write($product2);

print "<hr>";

echo "<pre>";
var_dump($product1);
var_dump($product2);
var_dump($product3);
echo "</pre>";
