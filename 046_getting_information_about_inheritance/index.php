<?php

require_once("./ShopProduct.php");

echo "----------------------------<br/>\n<pre>";
print_r(get_parent_class('mypackage\BookProduct')); // в файле ShopProduct.php задано пространство имен mypackage
echo "</pre>----------------------------<br/>\n";

$product = mypackage\BookProduct::getProduct(); //получение объекта

if (is_subclass_of($product, 'mypackage\ShopProduct')) {
    print "BookProduct является подклассом ShopProduct<br/>\n";
}

echo "----------------------------<br/>\n";

if (in_array('mypackage\Product', class_implements($product))) {
    print "BookProduct реализует интерфейс Product<br/>\n";
}

echo "----------------------------<br/>\n";
