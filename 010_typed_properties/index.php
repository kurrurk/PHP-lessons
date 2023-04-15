<?php

class Point
{
    public int $x = 0;
    public int $y = 0;

}

$point = new Point();
$point->x = "a"; // TypeError: Cannot assign string to property Point::$x of type int, а с 0 все нормально работает.

print $point->x;
