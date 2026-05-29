<?php

require_once 'db.php';

class ShopProduct
{
    private float|int $discount = 0;
    private int $id = 0;

    public const AVAILABLE = 0;
    public const OUT_OF_STOCK = 1;

    public function __construct(
        private string $title,
        private string $producerMainName,
        private string $producerFirstName,
        protected float|int $price
    ) {
    }

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
    public static function getInstance(int $id, \PDO $pdo): ShopProduct|null
    {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
        $result = $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (empty($row)) {
            return null;
        }

        if ($row['type'] == "book") {
            $product = new BookProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                price:(float) $row['price'],
                numPages:(int) $row['numpages']
            );
        } elseif ($row['type'] == "cd") {
            $product = new CdProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                price:(float) $row['price'],
                playLangth: (int) $row['playlength']
            );
        } else {
            $firstname = (is_null($row['firstname'])) ? "" : $row['firstname'];
            $product = new ShopProduct(
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

class CdProduct extends ShopProduct
{
    public $playLangth;

    public function __construct(
        string $title = "Test product",
        string $producerMainName = "Nachname",
        string $producerFirstName = "Vorname",
        int|float $playLangth = 0,
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
        $str = "<pre>" . $shopProduct->getTitle() . ": " . $shopProduct->getProducer() . " (" . $shopProduct->getPrice() . ")\n" . "</pre>";
        print $str;
    }
}

// тело программы

if (isset($db)) {

    $stmt = $db->query('SELECT id FROM products');

    $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo count($ids) . " products in database<br>";

    print "<hr>";

    foreach ($ids as $id) {
        echo "<br>ID: $id - ";
        $shopProduct = ShopProduct::getInstance($id, $db);
        if (!is_null($shopProduct)) {
            echo $shopProduct->getSummaryLine() . "<br>";
        }
    }

    print "<br><hr>";

    print "AVAILABLE: " . ShopProduct::AVAILABLE . "<br>";

    print "OUT_OF_STOCK: " . ShopProduct::OUT_OF_STOCK . "<br>";

    print "<hr>";

    echo "<pre>";
    foreach ($ids as $id) {
        $shopProduct = ShopProduct::getInstance($id, $db);
        if (!is_null($shopProduct)) {
            var_dump($shopProduct);
        }
    }
    echo "</pre>";

}
