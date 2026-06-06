<?php

namespace mypackage;

require_once("./ShopProduct.php");

use util as u;
use util\db\Querier as q;

class Local
{
}
// Чему соответствует:

// Псевдомним пространства имен
// u\Writer

// Псевдоним класса
// q

// Ссылка на класс в локальном контексте
// Local

print u\Writer::class . "<br>\n";
print q::class . "<br>\n";
print Local::class . "<br>\n";

$product = new \BookProduct(
    'Cобачье сердце',
    'Михаил',
    'Булгаков',
    600,
    5.99
);

echo "----------------------------<br/>\n";
print $product::class . "<br>\n";
echo "----------------------------<br/>\n";
