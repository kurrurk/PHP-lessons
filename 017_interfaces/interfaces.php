<?php

interface Chargeble
{
    public function getPrice(): int | float;
}

interface Bookable
{
    public function getTime(): int;

}
