<?php

abstract class ShopProductWriter
{
    protected array $products = [];

    public function addProduct(ShopProduct $shopProduct): void
    {
        $this->products[] = $shopProduct;
    }

    abstract public function write(): void;
}

// class ErroredWriter extends ShopProductWriter
// {
// }

class XmlProductWriter extends ShopProductWriter
{
    public function write(): void
    {
        $writer = new XMLWriter();
        $writer->openUri('products.xml');
        $writer->setIndent(true);
        $writer->startDocument("1.0", "UTF-8");
        $writer->startElement("products");
        foreach ($this->products as $shopProduct) {
            $writer->startElement("product");
            $writer->writeElement("title", $shopProduct->getTitle());
            $writer->startElement("summary");
            $writer->text($shopProduct->getSummaryLine());
            $writer->endElement();
            $writer->endElement();
        }
        $writer->endElement();
        $writer->endDocument();
        $writer->flush();
        print "XML файл products.xml успешно создан.\n";
    }
}

class TextProductWriter extends ShopProductWriter
{
    public function write(): void
    {
        $str = "Товары:\n";
        foreach ($this->products as $shopProduct) {
            $str .= $shopProduct->getSummaryLine() . "\n";
        }
        print $str;
    }
}
