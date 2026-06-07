<?php

namespace mypackage;

class ThirdPartyShop
{
    public function addProduct(string $title, float $price)
    {
        echo "Добавлен товар: {$title} - {$price}€<br/>\n";
    }
}

class ShopProduct
{
    private float|int $discount = 0;
    private ThirdPartyShop $thirdpartyShop;

    public function __construct(
        private string $title = 'Test product',
        private string $producerMainName = 'Nachname',
        private string $producerFirstName = 'Vorname',
        protected float|int $price = 0
    ) {
        $this->setDiscount(random_int(0, 100));
        $this->thirdpartyShop = new ThirdPartyShop();
    }

    public function __call(string $method, array $args): mixed
    {
        if (method_exists($this->thirdpartyShop, $method)) {
            return call_user_func_array(
                [
                    $this->thirdpartyShop,
                    $method,
                ],
                $args
            );
        }

        return false;
    }

    public static function getProduct()
    {
        return new static();
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
        return round($this->price - $this->price / 100 * $this->discount, 2);
    }

    public function getProducer(): string
    {
        return "{$this->producerFirstName} {$this->producerMainName}";
    }

    public function getSummaryLine(): string
    {
        $base = "{$this->title} ( {$this->producerMainName},";
        $base .= "{$this->producerFirstName} )";

        return $base;
    }
}

class CdProduct extends ShopProduct
{
    public function __construct(
        string $title = 'Test product',
        string $producerMainName = 'Nachname',
        string $producerFirstName = 'Vorname',
        private float $playLangth = 0,
        float|int $price = 0
    ) {
        parent::__construct(
            $title,
            $producerMainName,
            $producerFirstName,
            $price
        );
    }

    public function getPlayLangth()
    {
        return $this->playLangth;
    }

    public function getSummaryLine(): string
    {
        $base = parent::getSummaryLine();
        $base .= ": Время звучания - {$this->playLangth}";

        return $base;
    }
}

class BookProduct extends ShopProduct
{
    public function __construct(
        string $title = 'Test product',
        string $producerMainName = 'Nachname',
        string $producerFirstName = 'Vorname',
        private int $numPages = 0,
        float $price = 0
    ) {
        parent::__construct(
            $title,
            $producerMainName,
            $producerFirstName,
            $price
        );
    }

    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine(): string
    {
        $base = parent::getSummaryLine();
        $base .= ": {$this->numPages} стр.";

        return $base;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class ShopProductWriter
{
    private $products = [];

    public function addProduct(ShopProduct $shopProduct): void
    {
        $this->products[] = $shopProduct;
    }

    public function write(): void
    {
        $str = '<pre>';
        foreach ($this->products as $shopProduct) {
            $str .= "{$shopProduct->getTitle()} : ";
            $str .= $shopProduct->getProducer();
            $str .= " ({$shopProduct->getPrice()}€)\n";
        }
        $str .= '</pre>';
        echo $str;
    }
}
