<?php

namespace popp\ch05\batch09;

#[info] // аннотация/атрибут
class Person
{
    private string $name;
    private int $companyid;
    private string $department;

    #[moreinfo] // аннотация/атрибут
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    #[ApiInfo("Идентификатор компании из 3 цифр", "Дескриптор отдела из 5 символов")]
    public function setInfo(int $companyid, string $department): void
    {
        $this->companyid = $companyid;
        $this->department = $department;
    }
}

use Attribute;

#[Attribute]
class ApiInfo
{
    public function __construct(public string $compinfo, public string $depinfo)
    {
    }
}

$rpers = new \ReflectionClass(Person::class);
$attrs = $rpers->getAttributes();

$rmeth = $rpers->getMethod("setName");
$mattrs = $rmeth->getAttributes();

$rmeth = $rpers->getMethod("setInfo");
$mattrs2 = $rmeth->getAttributes();
$mattrs3 = $rmeth->getAttributes(ApiInfo::class);

/**
 * данное выражение ослабляет фильтр, чтобы он соответствовал не только классу,
 * но и раширяющим или реализующим его классам или интрефейсам
 */
$mattrs3 = $rmeth->getAttributes(ApiInfo::class, \ReflectionAttribute::IS_INSTANCEOF); // данное выражение ослабляет фильтр чтобы он соответствовал не только классу но и раширяющим или реализующим его классам или интрефейсам

echo "<pre>";
foreach ($attrs as $attr) {
    echo "----------------------------<br/>\n";
    print $attr->getName() . "<br>\n";
    echo "----------------------------<br/>\n";
}

foreach ($mattrs as $attr) {
    echo "----------------------------<br/>\n";
    print $attr->getName() . "<br>\n";
    echo "----------------------------<br/>\n";
}

foreach ($mattrs2 as $attr) {
    echo "----------------------------<br/>\n";
    print $attr->getName() . "<br>\n";
    foreach ($attr->getArguments() as $arg) {
        print " - $arg<br>\n";
    }
    echo "----------------------------<br/>\n";
}

foreach ($mattrs3 as $attr) {
    echo "----------------------------<br/>\n";
    print $attr->getName() . "<br>\n";
    $attrobj = $attr->newInstance();
    print " - " . $attrobj->compinfo . " <br>\n";
    print " - " . $attrobj->depinfo . " <br>\n";
    echo "----------------------------<br/>\n";
}
echo "</pre>";
