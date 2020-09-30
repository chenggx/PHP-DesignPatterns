<?php


namespace Creational\Builder;


abstract class ActorBuilder
{
    protected $actor;

    public function __construct()
    {
        $this->actor = new Actor();
    }

    public function getActor()
    {
        return $this->actor;
    }

    abstract public function buildType();

    abstract public function buildSex();

    abstract public function buildFace();

    abstract public function buildCostume();

    abstract public function buildHairstyle();
}
