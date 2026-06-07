<?php

require_once("./ShopProduct.php");

echo "----------------------------<br/>\n<pre>";
print_r(get_class_vars('mypackage\ShopProduct')); // в файле ShopProduct.php задано пространство имен mypackage
echo "</pre>----------------------------<br/>\n";
