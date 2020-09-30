<?php


namespace Creational\Builder;


class HeroBuilder extends ActorBuilder
{
    public function buildType()
    {
        $this->actor->setType('英雄');
    }

    public function buildSex()
    {
        $this->actor->setSex('男');
    }

    public function buildFace()
    {
        $this->actor->setFace('英俊');
    }

    public function buildCostume()
    {
        $this->actor->setCostume('盔甲');
    }

    public function buildHairstyle()
    {
        $this->actor->setHairstyle('飘逸');
    }
}
