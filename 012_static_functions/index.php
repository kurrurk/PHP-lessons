<?php

    echo '---------- start: require_once "db.php";  -------------' . "<br>";
    require_once "db.php";
    echo '---------- end: require_once "db.php";  -------------' . "<br>";

    class ShopProduct {
        protected $title;
        protected $producerMainName;
        protected $producerFirstName;
        protected $price;
        protected $id = 0;
        protected $discount = 0;

        /**
         * @return int
         */
        public function getDiscount(): int
        {
            return $this->discount;
        }

        /**
         * @param int $discount
         */
        public function setDiscount(int $discount): void
        {
            $this->discount = $discount;
        }

        /**
         * @return string
         */
        public function getTitle(): string
        {
            return $this->title;
        }

        /**
         * @param string $title
         */
        public function setTitle(string $title): void
        {
            $this->title = $title;
        }

        /**
         * @return string
         */
        public function getProducerMainName(): string
        {
            return $this->producerMainName;
        }

        /**
         * @param string $producerMainName
         */
        public function setProducerMainName(string $producerMainName): void
        {
            $this->producerMainName = $producerMainName;
        }

        /**
         * @return string
         */
        public function getProducerFirstName(): string
        {
            return $this->producerFirstName;
        }

        /**
         * @param string $producerFirstName
         */
        public function setProducerFirstName(string $producerFirstName): void
        {
            $this->producerFirstName = $producerFirstName;
        }

        /**
         * @return float|int
         */
        public function getPrice()
        {
            return $this->price;
        }

        /**
         * @param float|int $price
         */
        public function setPrice($price): void
        {
            $this->price = $price;
        }

        public function setID(int $id)
        {
            $this->id = $id;
        }

        public function getID(int $id)
        {
            return $this->id;
        }

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

        public function getSummaryLine () {
            $base = "{$this->title} ( {$this->producerMainName},";
            $base .= "{$this->producerFirstName} )";
            return $base;
        }
        public static function getInstance( int $id, \PDO $pdo): ShopProduct {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
            $result = $stmt->execute([$id]);
            $row = $stmt->fetch();

            if (empty($row)) {
                return null;
            }

            if ($row['type'] == "книга") {
                $product = new BookProduct(
                    $row['title'],
                    $row['firstname'],
                    $row['mainname'],
            (float) $row['price'],
              (int) $row['numpages']
                );
            } elseif ($row['type'] == "диск") {
                $product = new BookProduct(
                    $row['title'],
                    $row['firstname'],
                    $row['mainname'],
                    (float) $row['price'],
                    (int) $row['playlength']
                );
            } else {
                $firstname = (is_null($row['firstname'])) ? "" : $row['firstname'];
                $product = new BookProduct(
                    $row['title'],
                    $firstname,
                    $row['mainname'],
                    (float) $row['price']
                );
            }
            $product->setID((int) $row['id']);
            $product->setDiscount((int) $row['discount']);
            return $product;
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
            $str = "<pre>" . $shopProduct->getTitle() . ": " . $shopProduct->getProducer() . " (" . $shopProduct->getPrice() . ")\n" . "</pre>";
            print $str;
        }
    }

    // тело программы

    $product1 = new ShopProduct(
        "Cобачье сердце",
        "Михаил",
        "Булгаков",
        5.99,
    );
    $writer = new ShopProductWriter();
    
    print $product1->getTitle() . "<br>";

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
    var_dump(ShopProduct::getInstance(4, $pdo));
    var_dump($product1);
    var_dump($product2);
    var_dump($product3);
    echo "</pre>";