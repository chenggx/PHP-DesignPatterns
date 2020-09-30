<?php


namespace Creational\Prototype\ShallowClone;


class Attachment
{
    private $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function download()
    {
        echo '下载附件，文件名为'.$this->name.PHP_EOL;
    }
}
