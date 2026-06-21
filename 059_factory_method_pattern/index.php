<?php

abstract class ApptEncoder
{
    abstract public function encode(): string;
}

class BloggsApptEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Данные о встрече в формате BloggsCal<br/>\n";
    }
}

class MegaApptEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Данные о встрече в формате MegaCal<br/>\n";
    }
}

class CommsManager_naive
{
    public const BLOGGS = 1;
    public const MEGA = 2;
    public function __construct(private int $mode)
    {
    }
    public function getApptEncoder(): ApptEncoder
    {
        // return new BloggsApptEncoder(); // - первая реализация класса CommsManager
        switch ($this->mode) {
            case (self::MEGA): return new MegaApptEncoder();

            default: return new BloggsApptEncoder();
        }

    }
    public function getHeaderText(): string
    {
        switch ($this->mode) {
            case (self::MEGA): return "MegaCal header<br/>\n";

            default: return "BloggsCal header<br/>\n";
        }
    }
}

abstract class CommsManager
{
    abstract public function getHeaderText(): string;
    abstract public function getApptEncoder(): ApptEncoder;
    abstract public function getFooterText(): string;
}

class BloggsCommsManager extends CommsManager
{
    #[Override]
    public function getHeaderText(): string
    {
        return "BloggsCal header<br/>\n<em style='color:green'>";
    }
    #[Override]
    public function getApptEncoder(): ApptEncoder
    {
        return new BloggsApptEncoder();
    }
    #[Override]
    public function getFooterText(): string
    {
        return "</em>BloggsCal footer<br/>\n";
    }
}

echo "<pre>";
echo "----------------------------<br/>\n";
$man = new CommsManager_naive(CommsManager_naive::MEGA);
print(get_class($man->getApptEncoder())) . "<br/>\n";
$man = new CommsManager_naive(CommsManager_naive::BLOGGS);
print(get_class($man->getApptEncoder())) . "<br/>\n";
echo "----------------------------<br/>\n";
$mgr = new BloggsCommsManager();
print $mgr->getHeaderText();
print $mgr->getApptEncoder()->encode();
print $mgr->getFooterText();
echo "----------------------------<br/>\n";
echo "</pre>";
