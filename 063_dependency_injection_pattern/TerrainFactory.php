<?php

require_once "./InjectConstructor.php";

class Plains
{
}

class Forest
{
}

class Sea
{
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
    #[InjectConstructor(Sea::class, Plains::class, Forest::class)]
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
