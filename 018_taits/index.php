<?php

trait PriceUtilities
{
    private int $taxrate = 20;

    /**
     * @return int
     */
    public function calculateTax(float $price): float
    {
        return ($this->taxrate / 100) * $price;
    }
    // Other utility methods related to price calculations can be added here
}

trait IdentityTrait
{
    public function generateId(): string
    {
        return uniqid();
    }
}

class ShopProduct
{
    use PriceUtilities;
    use IdentityTrait;
}

abstract class Service
{
    abstract public function doSomething(): void;
}

class UtilityService extends Service
{
    use PriceUtilities;

    public function doSomething(): void
    {
        // Implementation of the abstract method
    }
}

$shopProduct = new ShopProduct();
$utilityService = new UtilityService();

// тело программы

print '<strong>$shopProduct</strong>->calculateTax(100): ' . $shopProduct->calculateTax(100) . "<br>";
print '<strong>$utilityService</strong>->calculateTax(100): ' . $utilityService->calculateTax(100) . "<br>";

print "<hr>";

print '<strong>$shopProduct</strong>->generateId(): ' . $shopProduct->generateId() . "<br>";

print "<hr><br>";

echo "<pre>";
var_dump($shopProduct);
var_dump($utilityService);
echo "</pre>";
