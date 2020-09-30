<?php


namespace Creational\Builder;


class ActorController
{
    public function build(ActorBuilder $actor)
    {
        $actor->buildType();
        $actor->buildCostume();
        $actor->buildFace();
        $actor->buildHairstyle();
        $actor->buildSex();

        return $actor->getActor();
    }
}
