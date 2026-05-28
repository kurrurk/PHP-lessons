<?php

require_once 'db.php';

class ShopProduct
{
    private float|int $discount = 0;
    private int $id = 0;

    public function __construct(
        private string $title,
        private string $producerMainName,
        private string $producerFirstName,
        protected float|int $price
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public static function getInstance(int $id, PDO $db): ShopProduct|null
    {
        $stmt = $db->prepare('select * from products where id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (empty($row)) {
            return null;
        }

        if ($row['type'] === 'book') {
            $product = new BookProduct(
                $row['title'],
                $row['mainname'],
                $row['firstname'],
                $row['price'],
                $row['numpages']
            );
        } elseif ($row['type'] === 'cd') {
            $product = new CdProduct(
                $row['title'],
                $row['mainname'],
                $row['firstname'],
                $row['price'],
                $row['playlength']
            );
        } else {
            $product = new ShopProduct(
                $row['title'],
                $row['mainname'],
                $row['firstname'],
                $row['price']
            );
        }
        $product->setId($row['id']);
        $product->setDiscount($row['discount']);
        return $product;
    }

    public function getProducerFirstName(): string
    {
        return $this->producerFirstName;
    }

    public function getProducerMainName(): string
    {
        return $this->producerMainName;
    }

    public function setDiscount(float|int $num): void
    {
        $this->discount = $num;
    }

    public function getDiscount(): float|int
    {
        return $this->discount;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float|int
    {
        return $this->price - $this->discount;
    }

    public function getProducer(): string
    {
        return "{$this->producerFirstName} {$this->producerMainName}";
    }

    public function getSummaryLine(): string
    {
        return "{$this->title} ( {$this->producerMainName} {$this->producerFirstName} )";
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
    public function getPlayLangth(): int
    {
        return $this->playLength;
    }
    public function getSummaryLine(): string
    {
        return parent::getSummaryLine() . ": Время звучания - $this->playLangth";
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

    public function getNumberOfPages(): int
    {
        return $this->numPages;
    }

    public function getSummaryLine(): string
    {
        return parent::getSummaryLine() . ": $this->numPages стр.";
    }

}

echo '<hr>';

echo '<pre>';
for ($i = 1; $i < count($products) + 1; $i++) {
    var_dump(ShopProduct::getInstance($i, $db));
}
echo '</pre>';
