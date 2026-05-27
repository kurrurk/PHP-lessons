<?php

class ShopProduct
{
    public function __construct(
        public string $title = 'Default product',
        public string $producerMainName = 'Nachname',
        public string $producerFirstName = 'Vorname',
        public float $price = 0
    ) {}

    public function getProducer()
    {
        return "{$this->producerFirstName} {$this->producerMainName}";
    }
}

class ShopProductWriter
{
    /**
     * Выводит информацию о книге в HTML-формате.
     *
     * Формирует строку с названием произведения, именем автора
     * и стоимостью книги, после чего выводит её на экран внутри
     * тега <pre> для сохранения форматирования текста.
     *
     * @param ShopProduct $shopProduct объект книги, содержащий название,
     *                                 автора и цену
     */
    public function write(ShopProduct $shopProduct)
    {
        $str = '<pre>' . $shopProduct->title . ': ' . $shopProduct->getProducer() . ' (' . $shopProduct->price . ")\n" . '</pre>';
        echo $str;
    }
}

$product1 = new ShopProduct(
    'Cобачье сердце',
    'Михаил',
    'Булгаков',
    5.99,
);
$writer = new ShopProductWriter();
$product_default = new ShopProduct();

echo $product1->title . '<br>';

echo '<hr>';

echo '<b>Function</b> ShopProduct::getProducer() : <br>';

echo '<pre>Автор: ' . $product1->getProducer() . '</pre><br>';

echo '<b>Function</b> ShopProductWriter::write() : <br>';

$writer->write($product1);

echo '<hr><br>';

echo '<pre>';
var_dump($product1);
var_dump($product_default);
echo '</pre>';
