<?php

require_once "abstract_classes.php";

echo '---------- start: require_once "db.php";  -------------' . "<br>";
require_once "db.php";
if (isset($db)) {

    $stmt = $db->query('SELECT id FROM products');

    $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo count($ids) . " products in database<br>";
}
echo '---------- end: require_once "db.php";  -------------' . "<br>";

// может быть реализовано любое количество интерфейсов, а слово extends может быть только одно, и расположено оно всегда перед implements
class Consultancy extends TimedServices implements Bookable, Chargeble
{
    public function __construct(
        private int $time,
        private int | float $price
    ) {
    }
    public function getTime(): int
    {
        return $this->time;
    }

    public function getPrice(): int | float
    {
        return $this->price;
    }
}

class Shipping implements Chargeble
{
    public function __construct(
        private int | float $price
    ) {
    }

    public function getPrice(): int | float
    {
        return $this->price;
    }
}

class ShopProduct implements Chargeble
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
    public function getPrice(): float|int
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
    public static function getInstance(int $id, \PDO $pdo): ShopProduct
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
                price: (float) $row['price'],
                numPages: (int) $row['numpages']
            );
        } elseif ($row['type'] == "cd") {
            $product = new CdProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                price: (float) $row['price'],
                playLength: (int) $row['playlength']
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
    public function __construct(
        string $title,
        string $MainName,
        string $FirstName,
        int | float $price,
        private int | float $playLength
    ) {
        parent::__construct($title, $MainName, $FirstName, $price);
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": Время звучания - {$this->playLength}";
        return $base;
    }

}


class BookProduct extends ShopProduct
{
    public function __construct(
        string $title,
        string $mainName,
        string $firstName,
        int | float $price,
        private int $numPages
    ) {
        parent::__construct($title, $mainName, $firstName, $price);
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

function getReflection(string $classname): ReflectionClass
{
    $reflection = new ReflectionClass($classname);

    echo 'Class: ' . $reflection->getName() . PHP_EOL;
    if ($reflection->getParentClass()) {
        echo 'Parent: ' . $reflection->getParentClass()?->getName() . PHP_EOL;
    }

    echo PHP_EOL . 'Interfaces:' . PHP_EOL;

    foreach ($reflection->getInterfaceNames() as $interface) {
        echo ' - ' . $interface . PHP_EOL;
    }

    echo '<br/><hr><br/>';
    return new ReflectionClass($classname);
}

// тело программы

print "<hr>";

echo "<pre>";
getReflection(Consultancy::class);
getReflection(Shipping::class);
echo "</pre>";
