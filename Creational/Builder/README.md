没有人买车会只买一个轮胎或者方向盘，大家买的都是一辆包含轮胎、方向盘和发动机等多个部件的完整汽车。如何将这些部件组装成一辆完整的汽车并返回给用户，这是建造者模式需要解决的问题。建造者模式又称为生成器模式，它是一种较为复杂、使用频率也相对较低的创建型模式。建造者模式为客户端返回的不是一个简单的产品，而是一个由多个部件组成的复杂产品。



## 需求

游戏公司需要开发一款 RPG 游戏，玩家在游戏中扮演一个特定角色。开发人员发现游戏角色是一个复杂对象，它包含性别、脸型等多个组成部分，不同的游戏角色其组成部分有所差异。无论是何种造型的游戏角色，它的创建步骤都大同小异，都需要逐步创建其组成部分，再将各组成部分装配成一个完整的游戏角色。如何一步步创建一个包含多个组成部分的复杂对象，建造者模式为解决此类问题而诞生。



## 定义

将一个复杂对象的构建与它的表示分离，使得同样的构建过程可以创建不同的表示。建造者模式是一种对象创建型模式。

## 主要角色

### 抽象建造者(Builder)

它为创建一个产品Product对象的各个部件指定抽象接口，在该接口中一般声明两类方法，一类方法是buildPartX()，它们用于创建复杂对象的各个部件；另一类方法是getResult()，它们用于返回复杂对象。Builder既可以是抽象类，也可以是接口。

### 具体建造者(ConcreteBuilder)

它实现了Builder接口，实现各个部件的具体构造和装配方法，定义并明确它所创建的复杂对象，也可以提供一个方法返回创建好的复杂产品对象。

### 产品角色(Product)

它是被构建的复杂对象，包含多个组成部件，具体建造者创建该产品的内部表示并定义它的装配过程。

### 指挥者(Director)

指挥者又称为导演类，它负责安排复杂对象的建造次序，指挥者与抽象建造者之间存在关联关系，可以在其 construct() 构造方法中调用建造者对象的部件构造与装配方法，完成复杂对象的建造。客户端一般只需要与指挥者进行交互，在客户端确定具体建造者的类型，并实例化具体建造者对象（也可以通过配置文件和反射机制），然后通过指挥者类的构造函数或者 Setter 方法将该对象传入指挥者类中。



## 实例代码

```php
// Actor 角色类（复杂产品）
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
// 角色建造器（抽象建造者）
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

//英雄角色建造器（具体建造者）
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
//天使角色建造器（具体建造器）
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

//游戏角色创建控制器（指挥者）
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
```

### 测试

```php
$controller = new \Creational\Builder\ActorController();

$actor = $controller->build(new \Creational\Builder\AngelBuilder());

echo $actor->getSex().PHP_EOL;
echo $actor->getType().PHP_EOL;
echo $actor->getHairstyle().PHP_EOL;
echo $actor->getFace().PHP_EOL;
echo $actor->getCostume().PHP_EOL;
```

### 结果

```php
> php Creational/Builder/Test.php
女
天使
披肩长发
漂亮
白裙
```

在建造者模式中，客户端只需实例化指挥者类，指挥者类针对抽象建造者编程，客户端根据需要传入具体的建造者类型，指挥者将指导具体建造者一步一步构造一个完整的产品（逐步调用具体建造者的 build 方法），相同的过程可以创建完全不同的产品。在游戏角色实例中，如果需要更换角色，只需要修改配置文件或者更换具体角色建造者类即可。如果需要增加新角色，可以增加一个新的具体角色建造者类作为抽象角色建造者的子类，再修改配置文件即可，原有代码无须修改，完全符合“开闭原则”。

## 总结

#### 有点

- 在建造者模式中，客户端不必知道产品内部组成的细节，将产品本身与产品的创建过程解耦，使得相同的创建过程可以创建不同的产品对象。

- 每一个具体建造者都相对独立，而与其他的具体建造者无关，因此可以很方便地替换具体建造者或增加新的具体建造者，用户使用不同的具体建造者即可得到不同的产品对象。由于指挥者类针对抽象建造者编程，增加新的具体建造者无须修改原有类库的代码，系统扩展方便，符合“开闭原则”。
- 可以更加精细地控制产品的创建过程。将复杂产品的创建步骤分解在不同的方法中，使得创建过程更加清晰，也更方便使用程序来控制创建过程。

#### 缺点

- 建造者模式所创建的产品一般具有较多的共同点，其组成部分相似，如果产品之间的差异性很大，例如很多组成部分都不相同，不适合使用建造者模式，因此其使用范围受到一定的限制。
- 如果产品的内部变化复杂，可能会导致需要定义很多具体建造者类来实现这种变化，导致系统变得很庞大，增加系统的理解难度和运行成本。

#### 适用场景

- 需要生成的产品对象有复杂的内部结构，这些产品对象通常包含多个成员属性。
- 需要生成的产品对象的属性相互依赖，需要指定其生成顺序。
- 对象的创建过程独立于创建该对象的类。在建造者模式中通过引入了指挥者类，将创建过程封装在指挥者类中，而不在建造者类和客户类中。
- 隔离复杂对象的创建和使用，并使得相同的创建过程可以创建不同的产品。
