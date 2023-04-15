<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Семейство классов ShopProduct</title>
</head>
<body>
    <div class="main-content">
        <hr>
            <h3 class="object"><strong>Object</strong> ShopProduct :</h3>
            <p class="title" ><?= $product1->getTitle() ?></p>
            <p><strong>Автор: </strong><?= $product1->getProducer() ?></p>
            <pre><?= $product1->getSummaryLine() ?></pre>
            <h3 class="object"><strong>Function</strong> ShopProductWriter::write() :</h3>
            <?php $writer->write($product1); ?>
        <hr>
            <h3 class="object"><strong>Object</strong> CdProduct :</h3>
            <p class="title" ><?= $product2->getTitle() ?></p>
            <p><strong>Автор: </strong><?= $product2->getProducer() ?></p>
            <pre><?= $product2->getSummaryLine() ?></pre>
            <h3 class="object"><strong>Function</strong> ShopProductWriter::write() :</h3>
            <?php $writer->write($product2); ?>
        <hr>
            <h3 class="object"><strong>Object</strong> CdProduct :</h3>
            <p class="title" ><?= $product3->getTitle() ?></p>
            <p><strong>Автор: </strong><?= $product3->getProducer() ?></p>
            <pre><?= $product3->getSummaryLine() ?></pre>
            <h3 class="object"><strong>Function</strong> ShopProductWriter::write() :</h3>
            <?php $writer->write($product3); ?>
        <hr>
    </div>
    <hr>
    <pre><?php
            var_dump($product1);
            var_dump($product2);
            var_dump($product3);
    ?></pre>

</body>
</html>
