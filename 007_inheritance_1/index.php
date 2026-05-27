<?php
class ShopProduct
{
    public function __construct(
        public string $title = "Test product",
        public string $producerMainName = "Nachname",
        public string $producerFirstName = "Vorname",
        public float $playLangth = 0,
        public int $numPages = 0,
        public float $price = 0
    ) {}

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

    public function getPlayLangth()
    {
        return $this->playLangth;
    }

    public function getSummaryLine()
    {
        $base = "{$this->title} ( {$this->producerMainName},";
        $base .= "{$this->producerFirstName} )";
        $base .= ": Время звучания - {$this->playLangth}";
        return $base;
    }
}


class BookProduct extends ShopProduct
{

    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine()
    {
        $base = "{$this->title} ( {$this->producerMainName},";
        $base .= "{$this->producerFirstName} )";
        $base .= ": {$this->numPages} стр.";
        return $base;
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


print "<p><b>Object</b> CdProduct : </p>";

$product2 = new CdProduct(
    "Классическая музыка. Лучшее",
    "Антонио",
    "Вивальди",
    60.33,
    0,
    10.99,
);

print "Исполнитель: {$product2->getProducer()}\n";

print "<p><em>{$product2->getSummaryLine()}</em></p>";

print "<b>Object</b> BookProduct : <br>";

$product1 = new BookProduct(
    "Cобачье сердце",
    "Михаил",
    "Булгаков",
    0,
    600,
    5.99
);

print "<p><em>{$product1->getSummaryLine()}</em></p>";

print "<hr><br>";

echo "<pre>";
var_dump($product1);
var_dump($product2);
echo "</pre>";
