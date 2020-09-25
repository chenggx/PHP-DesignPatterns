## 需求

   某软件公司欲基于php语言开发一套图表库，该图表库可以为应用系统提供各种不同外观的图表，例如柱状图、饼状图、折线图等。公司图表库设计人员希望为应用系统开发人员提供一套灵活易用的图表库，而且可以较为方便地对图表库进行扩展，以便能够在将来增加一些新类型的图表。

## 第一版

公司图表库设计人员提出了一个初始设计方案，将所有图表的实现代码封装在一个Chart类中，其框架代码如下所示：

```php
class Chart
{
  private $type;
  
  public function Chart($type)
  {
    $this->type = $type;
    if($this->type == 'histogram'){
      //初始化柱状图
    }
    if($this->type == 'pie'){
      //初始化饼状图
    }
    if($this->type == 'line'){
      //初始化折线图
    }
  }
  
  public function display()
  {
    if($this->type == 'histogram'){
      //显示柱状图
    }
    if($this->type == 'pie'){
      //显示化饼状图
    }
    if($this->type == 'line'){
      //显示化折线图
    }
  }
}

```

不难看出，Chart类是一个“巨大的”类，在该类的设计中存在如下几个问题

1. 在Chart类中包含很多“if…else…”代码块，整个类的代码相当冗长，代码越长，阅读难度、维护难度和测试难度也越大；而且大量条件语句的存在还将影响系统的性能，程序在执行过程中需要做大量的条件判断。

2. Chart类的职责过重，它负责初始化和显示所有的图表对象，将各种图表对象的初始化代码和显示代码集中在一个类中实现，违反了“单一职责原则”，不利于类的重用和维护；而且将大量的对象初始化代码都写在构造函数中将导致构造函数非常庞大，对象在创建时需要进行条件判断，降低了对象创建的效率。

3. 当需要增加新类型的图表时，必须修改Chart类的源代码，违反了“开闭原则”。

4. 客户端只能通过new关键字来直接创建Chart对象，Chart类与客户端类耦合度较高，对象的创建和使用无法分离。

5. 客户端在创建Chart对象之前可能还需要进行大量初始化设置，例如设置柱状图的颜色、高度等，如果在Chart类的构造函数中没有提供一个默认设置，那就只能由客户端来完成初始设置，这些代码在每次创建Chart对象时都会出现，导致代码的重复。

## 简单工厂模式

### 简介

简单工厂模式并不属于GoF 23个经典设计模式，但通常将它作为学习其他工厂模式的基础，它的设计思想很简单，其基本流程如下：

>  首先将需要创建的各种不同对象（例如各种不同的Chart对象）的相关代码封装到不同的类中，这些类称为**具体产品类**，而将它们公共的代码进行抽象和提取后封装在一个**抽象产品类**中，每一个具体产品类都是抽象产品类的子类；然后提供一个**工厂类**用于创建各种产品，在工厂类中提供一个创建产品的工厂方法，该方法可以根据所传入的参数不同创建不同的具体产品对象；客户端只需调用工厂类的工厂方法并传入相应的参数即可得到一个产品对象。

### 简单工厂模式定义

 简单工厂模式(Simple Factory Pattern)：定义一个工厂类，它可以根据参数的不同返回不同类的实例，被创建的实例通常都具有共同的父类。因为在简单工厂模式中用于创建实例的方法是静态(static)方法，因此简单工厂模式又被称为静态工厂方法(Static Factory Method)模式，它属于类创建型模式。



### 特点

当你需要什么，只需要传入一个正确的参数，就可以获取你所需要的对象，而无须知道其创建细节。



### 实例

项目目录结构如下所示

```shell
|____
|____TestSimpleFactory.php
|____composer.json
|____Creational
| |____SimpleFactory
| | |____PieChart.php
| | |____ChartFactory.php
| | |____Chart.php
| | |____HistogramChart.php
| | |____LineChart.php
```

**Chart 接口充当抽象产品类，ChartFactory 充当工厂类，其子类 HistogramChart、PieChart 和LineChart 充当具体产品类。完整代码如下所示**

Chart 接口

```php
<?php

namespace Creational\SimpleFactory;

interface Chart
{
    public function display();
}
```



ChartFactory 类

```php
<?php
namespace Creational\SimpleFactory;

class ChartFactory 
{
    //静态工厂方法
    public static function getChart($type)
    {
        if($type === 'histogram'){
            $chart = new HistogramChart();
          }
          if($type === 'pie'){
            $chart = new PieChart();
          }
          if($type === 'line'){
            $chart = new LineChart();
          }

          return $chart;
    }
}

```



HistogramChart 类

```php
<?php

namespace Creational\SimpleFactory;

class HistogramChart implements Chart
{
    public function __construct()
    {
        echo '初始化柱状图' . PHP_EOL;
    }

    public function display()
    {
        echo '显示化柱状图' . PHP_EOL;
    }
}

```



LineChart 类

```php
<?php

namespace Creational\SimpleFactory;

class LineChart implements Chart
{
    public function __construct()
    {
        echo '初始化折线图' . PHP_EOL;
    }

    public function display()
    {
        echo '显示化折线图' . PHP_EOL;
    }
}
```



PieChart 类

```php
<?php

namespace Creational\SimpleFactory;

class PieChart implements Chart
{
    public function __construct()
    {
        echo '初始化饼状图' . PHP_EOL;
    }

    public function display()
    {
        echo '显示化饼状图' . PHP_EOL;
    }
}
```

#### 测试

我们只需要在客户端里更改对应的参数就可以生成相应的图标类了。

TestSimpleFacotry

```php
<?php

use Creational\SimpleFactory\ChartFactory;

require 'vendor/autoload.php';

$chart = ChartFactory::getChart('line');
$chart->display();
```

![结果](http://static.xiangdangnian.net.cn/20200925113744.png)



### 总结

优点

1. 工厂类中统一管理所有逻辑，决定什么时候创建什么类，客户端免去直接创建对象的职责，仅仅消费产品，实现了对象创建和使用的分离。
2. 客户端无须知道所创建的具体产品类的类名，只需要知道具体产品类所对应的参数即可，对于一些复杂的类名，通过简单工厂模式可以在一定程度减少使用者的记忆量。
3. 还可以通过引入配置文件的方式，可以在不修改任何客户端代码的情况下更换和增加新的具体产品类，在一定程度上提高了系统的灵活性。

缺点：

1. 由于工厂类集中了所有产品的创建逻辑，职责过重，一旦不能正常工作，整个系统都要受到影响。
2. 使用简单工厂模式势必会增加系统中类的个数（引入了新的工厂类），增加了系统的复杂度和理解难度。
3. 系统扩展困难，一旦添加新产品就不得不修改工厂逻辑，在产品类型较多时，有可能造成工厂逻辑过于复杂，不利于系统的扩展和维护。
4.  简单工厂模式由于使用了静态工厂方法，造成工厂角色无法形成基于继承的等级结构。