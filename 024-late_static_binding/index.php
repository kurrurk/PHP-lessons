<?php

abstract class DomainObject
{
    private string $group;
    public function __construct()
    {
        $this->group = static::getGroup();
    }
    public static function create(): DomainObject
    {
        return new static();
    }
    public static function getGroup()
    {
        return "default";
    }
}

class User extends DomainObject
{
}

class Document extends DomainObject
{
    #[Override]
    public static function getGroup()
    {
        return "dacument";
    }
}

class SpreadSheet extends Document
{
}


// тело программы


print "<hr>";

print '<strong>User</strong>::create() retuned: <em>';
print_r(User::create());
print "</em><br>";

print '<strong>Document</strong>::create() retuned: <em>';
print_r(Document::create());
print "</em><br>";

print '<strong>SpreadSheet</strong>::create() retuned: <em>';
print_r(SpreadSheet::create());
print "</em><br>";

print "<hr>";
