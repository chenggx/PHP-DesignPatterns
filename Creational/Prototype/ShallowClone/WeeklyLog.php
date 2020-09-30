<?php


namespace Creational\Prototype\ShallowClone;


class WeeklyLog extends AbstractPrototype
{
    private $date;

    private $name;

    private $content;

    private $attachment;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setAttachment(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getAttachment()
    {
        return $this->attachment;
    }

    public function copy()
    {
        //深拷贝
        return clone $this;
    }
}
