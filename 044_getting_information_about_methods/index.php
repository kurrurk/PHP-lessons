<?php

require_once("./ShopProduct.php");

echo "----------------------------<br/>\n<pre>";
print_r(get_class_methods('mypackage\BookProduct')); // в файле ShopProduct.php задано пространство имен mypackage
echo "</pre>----------------------------<br/>\n";

$product = mypackage\CDProduct::getProduct();
$method = "getTitle";

if (in_array($method, get_class_methods($product))) {
    echo $product->$method() . "<br/>\n";
}
echo "----------------------------<br/>\n";

if (is_callable([$product, $method])) {
    echo $product->$method() . "<br/>\n"; // Вызов метода
}

echo "----------------------------<br/>\n";

if (is_callable([$product, $method], true, $callableName)) {
    echo $callableName . "<br/>\n"; // строковое представление переданного метода $method
}

echo "----------------------------<br/>\n";

if (method_exists($product, $method)) {
    echo $product->$method() . "<br/>\n"; // Вызов метода
}

echo "----------------------------<br/>\n";
