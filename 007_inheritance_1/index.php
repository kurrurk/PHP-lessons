<?php
    class ShopProduct {
        public $title = "Test product";
        public $producerMainName = "Nachname";
        public $producerFirstName = "Vorname";
        public $price = 0;
        public $playLangth = 0;
        public $numPages = 0;

        public function __construct(
            string $title = "Test product",
            string $producerMainName = "Nachname",
            string $producerFirstName = "Vorname",
            int $playLangth = 0,
            int $numPages = 0,
            float $price = 0
        ) {
            $this->title = $title;
            $this->producerMainName = $producerMainName;
            $this->producerFirstName = $producerFirstName;
            $this->price = $price;
            $this->playLangth = $playLangth;
            $this->numPages = $numPages;
        }

        public function getProducer () {
           return "{$this->producerFirstName} " . "{$this->producerMainName}";
        }

        public function getSummaryLine () {
            $base = "{$this->title} ( {$this->producerMainName},";
            $base .= "{$this->producerFirstName} )";
            return $base;
        }
    }

    class CdProduct extends ShopProduct { 

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
        0,
        10.99,        
    );

    print "Исполнитель: <pre>{$product2->getProducer()}</pre>\n";

    print "<pre>{$product2->getSummaryLine()}</pre>\n";

    print "<b>Object</b> BookProduct : <br>";

    $product3 = new BookProduct(
        "Cобачье сердце",
        "Михаил",
        "Булгаков",
        0,
        600,
        5.99
    );

    print "<pre>{$product3->getSummaryLine()}</pre>\n";

    print "<hr><br>";

    echo "<pre>";
    var_dump($product1);
    var_dump($product2);
    echo "</pre>";