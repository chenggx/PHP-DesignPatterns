<?php


namespace Creational\Builder;


class AngelBuilder extends ActorBuilder
{
    public function buildType()
    {
        $this->actor->setType('天使');
    }

    public function buildSex()
    {
        $this->actor->setSex('女');
    }

    public function buildFace()
    {
        $this->actor->setFace('漂亮');
    }

    public function buildCostume()
    {
        $this->actor->setCostume('白裙');
    }

    public function buildHairstyle()
    {
        $this->actor->setHairstyle('披肩长发');
    }
}
