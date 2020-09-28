> 工厂方法模式通过引入工厂等级结构，解决了简单工厂模式中工厂类职责太重的问题，但由于工厂方法模式中的每个工厂只生产一类产品，可能会导致系统中存在大量的工厂类，势必会增加系统的开销。此时，我们可以考虑**将一些相关的产品组成一个“产品族”，由同一个工厂来统一生产**，这就是我们本文将要学习的抽象工厂模式的基本思想。

## 需求

某公司需要开发一套界面皮肤系统，每种皮肤将提供相应的组件(按钮、文本框、分割线等)。其结构如下图所示：

![](http://static.xiangdangnian.net.cn/20200927144445.png)

### 第一版：

使用工厂方法模式进行设计。

![基于工厂方法模式的结构图](http://static.xiangdangnian.net.cn/20200928083444.png)

如上图所示是基于工厂方法模式进行设计的，当需要增加新的组件时，虽然不要修改现有代码，但是需要增加大量类，针对每一个新增具体组件都需要增加一个具体工厂，类的个数成对增加，这无疑会导致系统越来越庞大，增加系统的维护成本和运行开销。



>  在工厂方法模式中，每一个具体的工厂负责生产一种具体的产品，工厂方法具有唯一性。但是有时候我们希望一个工厂可以生产多个产品对象，例如：一个电器工厂，可以生产电视机、电冰箱等多种电器。

### 前置概念

#### 产品等级结构

**产品等级结构即产品的继承结构**

如一个抽象类是电视机，其子类有海尔电视机、海信电视机、TCL电视机，则抽象电视机与具体品牌的电视机之间构成了一个产品等级结构，抽象电视机是父类，而具体品牌的电视机是其子类。

#### 产品族

**产品族是指由同一个工厂生产的、位于不同产品等级结构中的一组产品**

如海尔电器工厂生产的海尔电视机、海尔电冰箱，海尔电视机位于电视机产品等级结构中，海尔电冰箱位于电冰箱产品等级结构中，海尔电视机、海尔电冰箱构成了一个产品族。

***当系统需要工厂生产的具体产品不是一个简单的对象，而是多个位于不同产品等级结构、属于不同类型的具体产品时就可以使用抽象工厂模式了。*它和工厂方法模式最大的区别在于：工厂方法模式针对的是一个产品等级结构，而抽象工厂模式面对的是多个产品等级结构，一个工厂等级结构可以负责多个不同产品等级结构中的产品对象的创建。**

### 抽象工厂模式概述

> 在抽象工厂模式中，每一个具体工厂都提供了多个工厂方法用于产生多种不同类型的产品，这些产品构成了一个产品族

#### 主要角色

##### 抽象工厂（AbstractFacotry）

它声明了一组用于创建一族产品的方法，每个方法对应一种产品。

在抽象工厂中声明了多个工厂方法，用于创建不同类型的产品，抽象工厂可以是接口，也可以是抽象类或者具体类

##### 具体工厂（ConcreteFactory）

它实现了抽象工厂中声明的创建产品的方法，生成一组具体的产品，这些产品构成了一个产品族。

##### 抽象产品（AbstractProduct）

它为每种产品声明了接口，在该接口中声明了产品的所有具体的业务方法。

##### 具体产品（ConcreteProduct）

它定义具体工厂生产的具体产品对象，实现抽象产品接口中声明的业务方法。

### 实例代码

```php
//按钮接口：抽象产品
interface ButtonInterface
{
    public function display();
}

//Mac 风格按钮  具体产品
class MacButton implements ButtonInterface
{
    public function display()
    {
        echo 'mac 风格按钮'.PHP_EOL;
    }
}

//windows 风格按钮  具体产品
class WindowsButton implements ButtonInterface
{
    public function display()
    {
        echo 'windows 风格按钮'.PHP_EOL;
    }
}

//文本框接口：抽象产品
interface TextInterface
{
    public function display();
}

//Mac 风格文本框  具体产品
class MacText implements TextInterface
{
    public function display()
    {
        echo 'mac 风格文本框'.PHP_EOL;
    }
}

//windows 风格文本框  具体产品
class WindowsText implements TextInterface
{
    public function display()
    {
        echo 'windows 风格文本框'.PHP_EOL;
    }
}

//界面皮肤工厂接口：抽象工厂
interface AbstractFactory
{
    public function createButton();

    public function createText();
}

//mac 风格皮肤 具体工厂
class MacFactory implements AbstractFactory
{
    public function createButton()
    {
        return new MacButton();
    }

    public function createText()
    {
        return new MacText();
    }
}

//windows 风格皮肤 具体工厂
class WindowsFactory implements AbstractFactory
{
    public function createButton()
    {
        return new WindowsButton();
    }

    public function createText()
    {
        return new WindowsText();
    }
}
```



#### 测试

```php
$skin = new \Creational\AbstractFactory\MacFactory();  
//改变相应的工厂类就可以实现风格的切换
//$skin = new \Creational\AbstractFactory\WindowsFactory();

$button = $skin->createButton();
$text = $skin->createText();

$button->display();
$text->display();
```

#### 结果

![](http://static.xiangdangnian.net.cn/20200928100340.png)



### 总结

#### 开闭原则的倾斜性

假如我们现在需要增加一个单选按钮组件，这时我们会发现原有系统居然不能够在符合“开闭原则”的前提下增加新的组件。原因是抽象工厂SkinFactory中根本没有提供创建单选按钮的方法，如果需要增加单选按钮，首先需要修改抽象工厂接口SkinFactory，在其中新增声明创建单选按钮的方法，然后逐个修改具体工厂类，增加相应方法以实现在不同的皮肤中创建单选按钮，此外还需要修改客户端，否则单选按钮无法应用于现有系统。

*该怎么办呢？答案是抽象工厂模式无法解决该问题，这也是抽象工厂模式最大的缺点。* **在抽象工厂模式中，增加新的产品族很方便，但是增加新的产品结构等级就会很麻烦，这种性质被称为开闭原作的倾斜性**



对于涉及到多个产品族与多个产品等级结构的系统，其功能增强包括两方面：增加产品族、增加新的产品等级解构。正因为抽象工厂模式存在“开闭原则”的倾斜性，它以一种倾斜的方式来满足“开闭原则”，为增加新产品族提供方便，但不能为增加新产品结构提供这样的方便，因此要求设计人员在设计之初就能够全面考虑，不会在设计完成之后向系统中增加新的产品等级结构，也不会删除已有的产品等级结构，否则将会导致系统出现较大的修改，为后续维护工作带来诸多麻烦。



#### 优点

1. 抽象工厂模式隔离了具体类的生成，使得客户并不需要知道什么被创建。由于这种隔离，更换一个具体工厂就变得相对容易，所有的具体工厂都实现了抽象工厂中定义的那些公共接口，因此只需改变具体工厂的实例，就可以在某种程度上改变整个软件系统的行为。
2. 当一个产品族中的多个对象被设计成一起工作时，它能够保证客户端始终只使用同一个产品族中的对象。
3. 增加新的产品族很方便，无须修改已有系统，符合“开闭原则”。

#### 缺点

1. 增加新的产品等级结构麻烦，需要对原有系统进行较大的修改，甚至需要修改抽象层代码，这显然会带来较大的不便，违背了“开闭原则”。
