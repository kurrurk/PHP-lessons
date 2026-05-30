<?php

require_once "traits.php";

interface IdentityObject
{
    public function generateId(): string;
}

class ShopProduct implements IdentityObject
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
    use TaxTools
    {
        TaxTools::calculateTax insteadof PriceUtilities;
    }

    public function doSomething(): void
    {
        // Implementation of the abstract method
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

print "<hr>";

echo "<pre>";
getReflection(ShopProduct::class);
getReflection(UtilityService::class);
echo "</pre>";
