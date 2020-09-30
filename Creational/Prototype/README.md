## 需求

某软件公司有一套 OA 系统，由于某些岗位每周工作存在重复性，工作周报内容都大同小异，只有一些小地方存在差异，但是现行系统每周默认创建的周报都是空白报表，用户只能通过重新输入或不断复制粘贴来填写重复的周报内容，极大降低了工作效率，浪费宝贵的时间。如何快速创建相同或者相似的工作周报，成为公司OA 开发人员面临的一个新问题。开发人员通过对问题进行仔细分析，决定按照如下思路对工作周报模块进行重新设计和实现：

- 除了允许用户创建新周报外，还允许用户将创建好的周报保存为模板；
- 用户在再次创建周报时，可以创建全新的周报，还可以选择合适的模板复制生成一份相同的周报，然后对新生成的周报根据实际情况进行修改，产生新的周报。

## 概述

> 使用原型实例指定创建对象的种类，并且通过拷贝这些原型创建新的对象。原型模式是一种对象创建型模式。

## 工作原理

将一个原型对象传给那个要发动创建的对象，这个要发动创建的对象通过请求原型对象拷贝自己来实现创建过程。

## 主要角色

### 抽象原型类

它是声明克隆方法的接口，是所有具体原型类的公共父类，可以是抽象类也可以是接口，甚至还可以是具体实现类。

### 具体原型类

实现在抽象原型类中声明的克隆方法，在克隆方法中返回自己的一个克隆对象。

### 客户类

让一个原型对象克隆自身从而创建一个新的对象，在客户类中只需要直接实例化或通过工厂方法等方式创建一个原型对象，再通过调用该对象的克隆方法即可得到多个相同的对象。由于客户类针对抽象原型类Prototype编程，因此用户可以根据需要选择具体原型类，系统具有较好的可扩展性，增加或更换具体原型类都很方便。



## 实例代码

```php
//抽象原型类
Abstract class AbstractPrototype
{
    abstract public function copy();
}

//具体原型类
class WeeklyLog extends AbstractPrototype
{
    private $date;

    private $name;

    private $content;

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

    public function copy()
    {
        return clone $this;
    }
}
```



### 测试代码

```php
$ob1 = new \Creational\Prototype\WeeklyLog();

$ob1->setName('小明');
$ob1->setDate('第一周');
$ob1->setContent('xxxxxx');


echo '****周报****'.PHP_EOL;
echo $ob1->getDate().PHP_EOL;
echo $ob1->getName().PHP_EOL;
echo $ob1->getContent().PHP_EOL;
echo '--------------------------------'.PHP_EOL;


$ob2 = $ob1->copy();
$ob2->setDate('第二周');
echo '****周报****'.PHP_EOL;
echo $ob2->getDate().PHP_EOL;
echo $ob2->getName().PHP_EOL;
echo $ob2->getContent().PHP_EOL;
echo '--------------------------------'.PHP_EOL;
```

### 结果

![](http://static.xiangdangnian.net.cn/20200929173850.png)

## 浅克隆、深克隆

通过引入原型模式，软件公司 OA 系统支持工作周报的快速克隆，极大提高了工作周报的编写效率，受到员工的一致好评。但有员工又发现一个问题，有些工作周报带有附件，例如经理助理“小龙女”的周报通常附有本周项目进展报告汇总表、本周客户反馈信息汇总表等，如果使用上述原型模式来复制周报，周报虽然可以复制，但是周报的附件并不能复制，这是由于什么原因导致的呢？如何才能实现周报和附件的同时复制呢？



在回答这些问题之前，先介绍一下两种不同的克隆方法，浅克隆(ShallowClone)和深克隆(DeepClone)。

- 深拷贝：赋值时值完全复制，完全的copy，对其中一个作出改变，不会影响另一个

- 浅拷贝：赋值时，引用赋值，相当于取了一个别名。对其中一个修改，会影响另一个

**PHP中，使用 = 赋值时，普通值是深拷贝，但对对象来说，是浅拷贝。也就是说，对象的赋值是引用赋值**。

```php
<?php
//普通对象赋值，深拷贝，完全值复制
$m = 1;
$n = $m;
$n = 2;
echo $m;//值复制，对新对象的改变不会对m作出改变，输出 1.深拷贝
echo PHP_EOL;

/*==================*/

//对象赋值，浅拷贝，引用赋值
class Test{
    public $a=1;
}

$m = new Test();
$n = $m;//引用赋值
$m->a = 2;//修改m，n也随之改变
echo $n->a;//输出2，浅拷贝
echo PHP_EOL;
```



在上面的需求中，我们可以使用深拷贝来获取全新的对象。

```php
//抽象原型类
Abstract class AbstractPrototype
{
    abstract public function copy();
}

//具体原型类
class WeeklyLog extends AbstractPrototype
{
    private $date;

    private $name;

    private $content;

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

    public function copy()
    {
        return serialize($this);
    }
}
```

测试

```php
$ob1 = new \Creational\Prototype\WeeklyLog();
$attachment = new \Creational\Prototype\Attachment();

$ob1->setAttachment($attachment);

$ob2 = unserialize($ob1->copy());

if ($ob1 === $ob2) {
    echo '周报是相同的'.PHP_EOL;
} else {
    echo '周报是不同的'.PHP_EOL;
}

if ($ob1->getAttachment() === $ob2->getAttachment()) {
    echo '附件是相同的'.PHP_EOL;
} else {
    echo '附件是不同的'.PHP_EOL;
}
```

结果

```php
> php TestPrototype.php
周报是不同的
附件是不同的
```

由于使用了深克隆技术，附件对象也得以复制，因此用“===”比较原型对象的附件和克隆对象的附件时输出结果均为false。深克隆技术实现了原型对象和克隆对象的完全独立，对任意克隆对象的修改都不会给其他对象产生影响，是一种更为理想的克隆实现方式。

## 原型管理器

> 原型管理器(Prototype Manager)是将多个原型对象存储在一个集合中供客户端使用，它是一个专门负责克隆对象的工厂，其中定义了一个集合用于存储原型对象，如果需要某个原型对象的一个克隆，可以通过复制集合中对应的原型对象来获得。在原型管理器中针对抽象原型类进行编程，以便扩展。

### 需求

软件公司在日常办公中有许多公文需要创建、递交和审批，例如《可行性分析报告》、《立项建议书》、《软件需求规格说明书》、《项目进展报告》等，为了提高工作效率，在OA系统中为各类公文均创建了模板，用户可以通过这些模板快速创建新的公文，这些公文模板需要统一进行管理，系统根据用户请求的不同生成不同的新公文。



### 实例代码

```php
//抽象公文接口，也可定义为抽象类，提供clone()方法的实现，将业务方法声明为抽象方法
interface OfficialDocument
{
    public function copy();

    public function display();

}
//可行性分析报告类
class FAR implements OfficialDocument
{
    public function copy()
    {
        return clone $this;
    }

    public function display()
    {
        echo '《可行性分析报告》'.PHP_EOL;
    }
}

//软件需求规格说明书类
class SRS implements OfficialDocument
{
    public function copy()
    {
        return clone $this;
    }

    public function display()
    {
        echo '《软件需求规格说明书》'.PHP_EOL;
    }
}

//原型管理器
class PrototypeManager
{
    public static $document = [];

    public static function addPrototype($name, OfficialDocument $value)
    {
        self::$document[$name] = $value;
    }

    public static function getPrototype($name)
    {
        return self::$document[$name]->copy();
    }

}
```

### 测试

```php
PrototypeManager::addPrototype('far', new FAR());
$doc1 = PrototypeManager::getPrototype('far');
$doc1->display();

$doc2 = PrototypeManager::getPrototype('far');
$doc2->display();

var_dump($doc1 === $doc2);


PrototypeManager::addPrototype('srs', new SRS());
$doc3 = PrototypeManager::getPrototype('srs');
$doc3->display();

$doc4 = PrototypeManager::getPrototype('srs');
$doc4->display();

var_dump($doc3 === $doc4);
```

### 结果输出

```php
> php Creational/Prototype/PrototypeManager/Test.php
《可行性分析报告》
《可行性分析报告》
bool(false)
《软件需求规格说明书》
《软件需求规格说明书》
bool(false)
```

在 PrototypeManager 中定义了一个 $document 静态数组变量，使用“键值对”来存储原型对象，客户端可以通过 Key（如“far”或“srs”）来获取对应原型对象的克隆对象。PrototypeManager 类提供了类似工厂方法的 getPrototype() 方法用于返回一个克隆对象。使用 addPrototype 方法设置原型。通过结果我们可以看到最终生成了全新的对象。



## 总结

 原型模式作为一种快速创建大量相同或相似对象的方式，在软件开发中应用较为广泛，很多软件提供的复制(Ctrl + C)和粘贴(Ctrl + V)操作就是原型模式的典型应用。
