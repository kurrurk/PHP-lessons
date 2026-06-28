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

class BloggsTtdEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Данные о задаче в формате BloggsCal<br/>\n";
    }
}

class BloggsContactEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Данные о контакте в формате BloggsCal<br/>\n";
    }
}


class MegaApptEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Данные о встрече в формате MegaCal<br/>\n";
    }
}

class MegaTtdEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Данные о задаче в формате MegaCal<br/>\n";
    }
}

class MegaContactEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Данные о контакте в формате MegaCal<br/>\n";
    }
}
