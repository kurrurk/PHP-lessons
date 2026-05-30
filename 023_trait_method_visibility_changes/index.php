<?php

trait PriceUtilities
{
    /**
     * @return int
     */
    public function calculateTax(float $price): float
    {
        return ($this->getTaxRate() / 100) * $price;
    }

    abstract public function getTaxRate(): float;
    // Other utility methods related to price calculations can be added here
}

abstract class Service
{
    abstract public function doSomething(): void;
}

class UtilityService extends Service
{
    use PriceUtilities
    {
        PriceUtilities::calculateTax as private;
    }

    private float $taxrate = 0;

    public function __construct(private float $price)
    {
    }

    public function getTaxRate(): float
    {
        $this->taxrate = rand(10, 20);
        return $this->taxrate;
    }

    public function getFinalPrice(): string
    {
        return $this->price + $this->calculateTax($this->price) . ', taxrate:' . $this->taxrate;
    }

    #[Override]
    public function doSomething(): void
    {
        throw new \Exception('Not implemented');
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

$utilityService = new UtilityService(rand(100, 600));

// тело программы

print '<strong>$utilityService</strong>->getFinalPrice(100): ' . $utilityService->getFinalPrice() . "<br>";

print "<hr>";

echo "<pre>";
var_dump($utilityService);
echo "</pre>";

print "<hr>";

echo "<pre>";
getReflection(UtilityService::class);
echo "</pre>";
