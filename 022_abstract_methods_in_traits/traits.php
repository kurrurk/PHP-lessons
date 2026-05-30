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

trait TaxTools
{
    public function calculateTax(float $price): float
    {
        return 222;
    }
}

trait IdentityTrait
{
    public function generateId(): string
    {
        return uniqid();
    }
}
