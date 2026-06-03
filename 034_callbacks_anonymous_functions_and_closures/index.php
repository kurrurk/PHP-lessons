<?php

class Product
{
    public function __construct(public string $name, public float $price)
    {
    }
}

class ProcessSale
{
    private array $callbacks;
    public function registerCallback(callable $callback): void
    {
        $this->callbacks[] = $callback;
    }

    public function cleanCallbacks(): void
    {
        $this->callbacks = [];
    }

    public function sale(Product $product): void
    {
        print "{$product->name}: обрабатывается <br>\n";
        foreach ($this->callbacks as $callback) {
            call_user_func($callback, $product);
        }
    }
}
class Mailer
{
    public function doMail(Product $product): void
    {
        print "   Отправляется ({$product->name})<br>\n";
    }
}

class Totalizer
{
    public static function warnAmount(): callable
    {
        return function (Product $product): void {
            if ($product->price > 5) {
                print "Достигнута высокая цена: {$product->price}<br>\n";
            }
        };
    }
}

class Totalizer2
{
    public static function warnAmount(float $amt): callable
    {
        $count = 0;
        return function (Product $product) use ($amt, &$count): void { // перед $count стоит знак '&' что означает что переменная передается по ссылке
            $count += $product->price;
            print " Сумма: {$count}<br>\n";

            if ($count > $amt) {
                print "Достигнута сумма: {$count}<br>\n";
            }
        };
    }
}

class Totalizer3
{
    private float $count = 0;
    private float $amt = 0;
    public function warnAmount(float $amt): callable
    {
        $this->amt = $amt;
        return \Closure::fromCallable([$this, "ProcessPrice"]);
    }
    private function ProcessPrice(Product $product): void
    {
        $this->count += $product->price;
        print " Сумма: {$this->count}<br>\n";

        if ($this->count > $this->amt) {
            print "Достигнута сумма: {$this->count}<br>\n";
        }
    }
}


// $logger = function (Product $product) {
//     echo "   Запись ({$product->name})<br>\n";
// };
// стрелочная функция
$logger = fn (Product $product) => print "   Запись ({$product->name})<br>\n"; //echo не работает. Причина в том, что echo не возвращает значение и не считается выражением.

$processor = new ProcessSale();
$processor->registerCallback($logger);
echo "----------------------------<br/>\n";
$processor->sale(new Product("Туфли", 6));
echo "<br>\n";
$processor->sale(new Product("Кофе", 6));
echo "----------------------------<br/>\n";
$processor->cleanCallbacks();
$processor->registerCallback([new Mailer(), "doMail"]);
$processor->sale(new Product("Туфли", 6));
echo "<br>\n";
$processor->sale(new Product("Кофе", 6));
echo "----------------------------<br/>\n";
$processor->cleanCallbacks();
$processor->registerCallback(Totalizer::warnAmount());
$processor->sale(new Product("Туфли", 6));
echo "<br>\n";
$processor->sale(new Product("Кофе", 6));
echo "----------------------------<br/>\n";
$processor->cleanCallbacks();
$processor->registerCallback(Totalizer2::warnAmount(8));
$processor->sale(new Product("Туфли", 6));
echo "<br>\n";
$processor->sale(new Product("Кофе", 6));
echo "----------------------------<br/>\n";
$processor->cleanCallbacks();
$markup = 3;
$counter = fn (Product $product) => print "($product->name) отмечена цена: " . ($product->price + $markup) . "<br>\n";
$processor->registerCallback($counter);
$processor->sale(new Product("Туфли", 6));
echo "<br>\n";
$processor->sale(new Product("Кофе", 6));
echo "----------------------------<br/>\n";
$processor->cleanCallbacks();
$processor->registerCallback(new Totalizer3()->warnAmount(8));
$processor->sale(new Product("Туфли", 6));
echo "<br>\n";
$processor->sale(new Product("Кофе", 6));
echo "----------------------------<br/>\n";
