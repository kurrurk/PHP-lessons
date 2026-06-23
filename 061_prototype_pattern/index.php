<?php

class Plains
{
}

class Forest
{
}

class Sea
{
    public function __construct(private int $navigability)
    {
    }
}

class EarthPlains extends Plains
{
}

class EarthForest extends Forest
{
}

class EarthSea extends Sea
{
}

class MarsPlains extends Plains
{
}

class MarsForest extends Forest
{
}

class MarsSea extends Sea
{
}

class TerrainFactory
{
    public function __construct(
        private Sea $sea,
        private Plains $plains,
        private Forest $forest
    ) {
    }
    public function getSea(): Sea
    {
        return clone $this->sea;
    }

    public function getPlains(): Plains
    {
        return clone $this->plains;
    }

    public function getForest(): Forest
    {
        return clone $this->forest;
    }

}

// не нужно забывать, что, если в продуктах имеются ссылки на другие объекты,
//следует реализовать метод __clone(), чтобы создать полную(или гибкую) копию продукта
class Contained
{
}

class Container
{
    public Contained $contained;
    public function __construct()
    {
        $this->contained = new Contained();
    }
    public function __clone()
    {
        // Обеспечить, чтобы клонированный объект
        // содержал клон объекта, хранящегося в
        // свойстве self::$containrd,
        // а не ссылку на него
        $this->contained = clone $this->contained;
    }
}

$factory = new TerrainFactory(
    new EarthSea(-1),
    new MarsPlains(),
    new EarthForest()
);

echo "<pre>";
echo "----------------------------<br/>\n";
var_dump($factory->getSea());
var_dump($factory->getPlains());
var_dump($factory->getForest());
echo "----------------------------<br/>\n";
echo "</pre>";
