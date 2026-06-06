<?php

require_once("./ShopProduct.php");


$product = CdProduct::getProduct();

if (get_class($product) === 'CdProduct') {
    echo "----------------------------<br/>\n";
    print "\$product является объектом класса CdProduct<br>\n";
    echo "----------------------------<br/>\n";
}


if ($product instanceof CdProduct) {
    echo "----------------------------<br/>\n";
    print "\$product является экземпляром класса CdProduct<br>\n";
    echo "----------------------------<br/>\n";
}
