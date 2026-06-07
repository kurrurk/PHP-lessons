<?php

require_once("./ShopProduct.php");

echo "----------------------------<br/>\n<pre>";
print_r(get_class_methods('mypackage\BookProduct')); // в файле ShopProduct.php задано пространство имен mypackage
echo "</pre>----------------------------<br/>\n";

$product = mypackage\CDProduct::getProduct();
call_user_func([$product, 'setDiscount'], 20);
$method = "getDiscount";

if (is_callable([$product, $method])) {
    echo $product->$method() . "<br/>\n"; // Вызов метода
}
echo "----------------------------<br/>\n";

$product->addProduct(
    "PHP 8",
    29.99
);

echo "----------------------------<br/>\n";
