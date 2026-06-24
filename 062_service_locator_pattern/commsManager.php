<?php

interface Encoder
{
    public function encode(): string;
}

abstract class CommsManager
{
    public const APPT = 1;
    public const TTD = 2;
    public const CONTACT = 3;

    abstract public function getHeaderText(): string;
    abstract public function make(int $flag_int): Encoder;
    abstract public function getFooterText(): string;

}

class BloggsApptEncoder implements Encoder
{
    public function encode(): string
    {
        return "Данные о встрече в формате BloggsCal<br/>\n";
    }
}

class BloggsTtdEncoder implements Encoder
{
    public function encode(): string
    {
        return "Данные о задаче в формате BloggsCal<br/>\n";
    }
}

class BloggsContactEncoder implements Encoder
{
    public function encode(): string
    {
        return "Данные о контакте в формате BloggsCal<br/>\n";
    }
}


class MegaApptEncoder implements Encoder
{
    public function encode(): string
    {
        return "Данные о встрече в формате MegaCal<br/>\n";
    }
}

class MegaTtdEncoder implements Encoder
{
    public function encode(): string
    {
        return "Данные о задаче в формате MegaCal<br/>\n";
    }
}

class MegaContactEncoder implements Encoder
{
    public function encode(): string
    {
        return "Данные о контакте в формате MegaCal<br/>\n";
    }
}

class BloggsCommsManager extends CommsManager
{
    #[Override]
    public function getHeaderText(): string
    {
        return "BloggsCal header<br/>\n<em style='color:green'>";
    }

    #[Override]
    public function make(int $flag_int = 0): Encoder
    {
        switch ($flag_int) {
            case self::APPT:
                return new BloggsApptEncoder();
            case self::CONTACT:
                return new BloggsContactEncoder();
            case self::TTD:
                return new BloggsTtdEncoder();
            default:
                return new BloggsApptEncoder();
        }
    }
    #[Override]
    public function getFooterText(): string
    {
        return "</em>BloggsCal footer<br/>\n";
    }
}

class MegaCommsManager extends CommsManager
{
    #[Override]
    public function getHeaderText(): string
    {
        return "BloggsCal header<br/>\n<em style='color:green'>";
    }

    #[Override]
    public function make(int $flag_int = 0): Encoder
    {
        switch ($flag_int) {
            case self::APPT:
                return new MegaApptEncoder();
            case self::CONTACT:
                return new MegaContactEncoder();
            case self::TTD:
                return new MegaTtdEncoder();
            default:
                return new MegaApptEncoder();
        }
    }
    #[Override]
    public function getFooterText(): string
    {
        return "</em>BloggsCal footer<br/>\n";
    }
}
