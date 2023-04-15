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
    public function __construct( string $title, string $MainName,
                                 string $FirstName, int | float $price,
                                 private int $playLength)
    {
        parent::__construct($title,$MainName,$FirstName,$price);
    }
    public function getPlayLangth () : int
    {
        return $this->playLength;
    }
    public function getSummaryLine () : string
    {
        return parent::getSummaryLine() . ": Время звучания - $this->playLangth";
    }

}


class BookProduct extends ShopProduct {
    public function __construct( string $title, string $mainName,
                                 string $firstName, int | float $price,
                                 private int $numPages)
    {
        parent::__construct($title,$mainName,$firstName,$price);
    }

    public function getNumberOfPages () : int
    {
        return $this->numPages;
    }

    public function getSummaryLine () : string
    {
        return parent::getSummaryLine() . ": $this->numPages стр.";
    }

}


class ShopProductWriter
{
    public function write(ShopProduct $shopProduct) : void
    {
        $str = "<pre>" . $shopProduct->getTitle() . ": " . $shopProduct->getProducer() . " (" . $shopProduct->getPrice() . ")\n" . "</pre>";
        print $str;
    }
}

$product1 = new ShopProduct(
    "Cобачье сердце",
    "Михаил",
    "Булгаков",
    5.99,
);

$product2 = new CdProduct(
    "Классическая музыка. Лучшее",
    "Антонио",
    "Вивальди",
    60.33,
    10.99,
);

$product3 = new BookProduct(
    "Cобачье сердце",
    "Михаил",
    "Булгаков",
    5.99,
    600
);

$writer = new ShopProductWriter();


require "index.view.php";