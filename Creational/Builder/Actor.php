<?php


namespace Creational\Builder;


class Actor
{
    private $type;
    private $sex;
    private $face;
    private $costume;
    private $hairstyle;

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    public function setFace($face)
    {
        $this->face = $face;
    }

    public function setCostume($costume)
    {
        $this->costume = $costume;
    }

    public function setHairstyle($hairstyle)
    {
        $this->hairstyle = $hairstyle;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function getFace()
    {
        return $this->face;
    }

    public function getCostume()
    {
        return $this->costume;
    }

    public function getHairstyle()
    {
        return $this->hairstyle;
    }
}
