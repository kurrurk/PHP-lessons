<?php
class ShopProduct
{

    public function __construct(
        public string $title = "Default product",
        public string $producerMainName = "Nachname",
        public string $producerFirstName = "Vorname",
        public float $price = 0
    ) {}

    public function getProducer()
    {
        return "{$this->producerFirstName} " . "{$this->producerMainName}";
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
     * @param ShopProduct $shopProduct Объект книги, содержащий название,
     *                                 автора и цену.
     *
     * @return void
     */
    public function write(ShopProduct $shopProduct)
    {
        $str = "<pre>" . $shopProduct->title . ": " . $shopProduct->getProducer() . " (" . $shopProduct->price . ")\n" . "</pre>";
        print $str;
    }
}
