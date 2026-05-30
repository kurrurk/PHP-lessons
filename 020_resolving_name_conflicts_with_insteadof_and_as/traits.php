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
