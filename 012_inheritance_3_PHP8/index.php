<?php
class ShopProduct {
    private int | float $discount = 0;
    public function __construct(
        private string $title,
        private string $producerMainName,
        private string $producerFirstName,
        protected int | float $price)
    {
    }
    public function getProducerFirstName () : string
    {
        return $this->producerFirstName;
    }
    public function getProducerMainName () : string
    {
        return $this->producerMainName;
    }
    public function setDiscount ( int | float $num ) : void
    {
        $this->discount = $num;
    }
    public function getDiscount () : int | float
    {
        return $this->discount;
    }
    public function getTitle () : string
    {
        return $this->title;
    }
    public function getPrice () : int | float
    {
        return ($this->price - $this->discount);
    }
    public function getProducer () : string
    {
        return "$this->producerFirstName $this->producerMainName";
    }
    public function getSummaryLine () : string
    {
        return "$this->title ( $this->producerMainName $this->producerFirstName )";
    }
}

class CdProduct extends ShopProduct {

    public $playLangth;

    public function __construct(
        string $title = "Test product",
        string $producerMainName = "Nachname",
        string $producerFirstName = "Vorname",
        int $playLangth = 0,
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

    public function getPlayLangth () {
        return $this->playLangth;
    }

    public function getSummaryLine () {
        $base = "{$this->title} ( {$this->producerMainName},";
        $base .= "{$this->producerFirstName} )";
        $base .= ": Время звучания - {$this->playLangth}";
        return $base;
    }

}


class BookProduct extends ShopProduct {

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

    public function getNumberOfPages () {
        return $this->numPages;
    }

    public function getSummaryLine () {
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

print "<pre>Автор: " . $product1->getProducer() ."</pre><br>";

print "<b>Function</b> ShopProductWriter::write() : <br>";

$writer->write($product1);

print "<hr>";

print "<b>Object</b> CdProduct : <br><br>";

$product2 = new CdProduct(
    "Классическая музыка. Лучшее",
    "Антонио",
    "Вивальди",
    60.33,
    10.99,
);

print "Исполнитель: <pre>{$product2->getProducer()}</pre>\n";

print "<pre>{$product2->getSummaryLine()}</pre>\n";

print "<b>Object</b> BookProduct : <br>";

$product3 = new BookProduct(
    "Cобачье сердце",
    "Михаил",
    "Булгаков",
    600,
    5.99
);

print "<pre>{$product3->getSummaryLine()}</pre>\n";

print "<hr><br>";

echo "<pre>";
var_dump($product1);
var_dump($product2);
var_dump($product3);
echo "</pre>";