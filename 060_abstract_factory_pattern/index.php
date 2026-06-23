<?php

abstract class CommsManager
{
    abstract public function getHeaderText(): string;
    abstract public function getApptEncoder(): ApptEncoder;
    abstract public function getTtdEncoder(): TtdEncoder;
    abstract public function getContactEncoder(): ContactEncoder;
    abstract public function getFooterText(): string;

}

class BloggsApptEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Данные о встрече в формате BloggsCal<br/>\n";
    }
}

class BloggsTtdEncoder extends TtdEncoder
{
    public function encode(): string
    {
        return "Данные о задаче в формате BloggsCal<br/>\n";
    }
}

class BloggsContactEncoder extends ContactEncoder
{
    public function encode(): string
    {
        return "Данные о контакте в формате BloggsCal<br/>\n";
    }
}

class BloggsCommsManager extends CommsManager
{
    #[Override]
    public function getHeaderText(): string
    {
        return "BloggsCal header<br/>\n<em style='color:green'>";
    }
    public function getApptEncoder(): ApptEncoder
    {
        return new BloggsApptEncoder();
    }
    public function getApptEncoder(): TtdEncoder
    {
        return new BloggsTtdEncoder();
    }
    public function getApptEncoder(): ContactEncoder
    {
        return new BloggsContactEncoder();
    }
    public function getFooterText(): string
    {
        return "</em>BloggsCal footer<br/>\n";
    }
}
