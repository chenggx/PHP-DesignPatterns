简单工厂模式虽然简单，但存在一个很严重的问题。**当系统中需要引入新产品时，由于静态工厂方法通过所传入参数的不同来创建不同的产品，这必定要修改工厂类的源代码，将违背“开闭原则”，如何实现增加新产品而不影响已有代码？**工厂方法模式应运而生，本文将介绍第二种工厂模式——工厂方法模式。



## 需求

某软件公司需要开发一个日志记录器，该记录器可以通过多种途径保存系统的运行日志，如通过文件记录或数据库记录，用户可以通过修改配置文件灵活地更换日志记录方式。

公司开发人员通过对该需求进行分析，发现该日志记录器有两个设计要点：

1. 需要封装日志记录器的初始化过程，这些初始化工作较为复杂，例如需要初始化其他相关的类，还有可能需要读取配置文件（例如连接数据库或创建文件），导致代码较长，如果将它们都写在构造函数中，会导致构造函数庞大，不利于代码的修改和维护；
2. 用户可能需要更换日志记录方式，在客户端代码中需要提供一种灵活的方式来选择日志记录器，尽量在不修改源代码的基础上更换或者增加日志记录方式。

**如果我们使用简单工厂模式的话，当需要增加一个新的记录日志的方式就需要更改工厂类的源码，违反了“开闭原则”。而且工厂类中会有大量的 if...else...代码，导致测试和维护难度增大。**

> 解决上面的办法就是使用工厂方式模式。

在工厂方法模式中，我们**不再提供一个统一的工厂类来创建所有的产品对象，而是针对不同的产品提供不同的工厂，系统提供一个与产品等级结构对应的工厂等级结构**

## 工厂方法模式

### 定义

定义一个用于创建对象的接口，让子类决定将哪一个类实例化。工厂方法模式让一个类的实例化延迟到其子类。工厂方法模式又简称为工厂模式(Factory Pattern)，又可称作虚拟构造器模式(Virtual Constructor Pattern)或多态工厂模式(Polymorphic Factory Pattern)。工厂方法模式是一种类创建型模式。

### 主要角色

- 抽象产品（Product）：它是定义产品的接口，是工厂方法模式所创建对象的超类型，也就是产品对象的公共父类

- 具体产品（ConcreteProduct）：它实现了抽象产品接口，某种类型的具体产品由专门的具体工厂创建，具体工厂和具体产品之间一一对应。
- 抽象工厂（Factory）：在抽象工厂类中，声明了工厂方法(Factory Method)，用于返回一个产品。抽象工厂是工厂方法模式的核心，所有创建对象的工厂类都必须实现该接口。
- 具体工厂（ConcreteFactory）：它是抽象工厂类的子类，实现了抽象工厂中定义的工厂方法，并可由客户端调用，返回一个具体产品类的实例。

**与简单工厂模式相比，工厂方法模式最重要的区别是引入了抽象工厂角色，抽象工厂可以是接口，也可以是抽象类或者具体类**

### 实例

```php
//日志记录器接口：抽象产品
interface Logger
{
    public function writeLog();
}
 
//数据库日志记录器：具体产品
class DatabaseLogger implements Logger
{
    public function writeLog()
    {
        echo '数据库记录日志' . PHP_EOL;
    }
}
 
//文件日志记录器：具体产品
class FileLogger implements Logger
{
    public function writeLog()
    {
        echo '文件记录日志' . PHP_EOL;
    }
}
 
//日志记录器工厂接口：抽象工厂
interface LoggerFactory
{
    public function createLogger();
}
 
//数据库日志记录器工厂类：具体工厂
class DatabaseLoggerFactory implements LoggerFactory
{
    public function createLogger()
    {
        // 模拟初始化数据库链接
        echo '初始化数据库链接' . PHP_EOL;

        return new DatabaseLogger();
    }
}
 
//文件日志记录器工厂类：具体工厂
class FileLoggerFactory implements LoggerFactory
{
    public function createLogger()
    {
        return new FileLogger();
    }
}
```

### 测试

```php
use Creational\FactoryMethod\DatabaseLoggerFactory;

require 'vendor/autoload.php';

$factory = new DatabaseLoggerFactory();

$logger = $factory->createLogger();

$logger->writeLog();
```



![结果](http://static.xiangdangnian.net.cn/20200925171424.png)



为了让系统具有更好的灵活性和扩展性，我们可以通过 php 的反射机制，可以在不修改任何客户端代码的基础上更换或增加新的日志记录方式。

```php
//配置文件可以放在单独的文件中
$config = [
    'LoggerFactory' => DatabaseLoggerFactory::class
];

$class = new ReflectionClass($config['LoggerFactory']);

$factory = $class->newInstance();

$logger = $factory->createLogger();

$logger->writeLog();
```



增加新的日志记录方式，只需要执行如下几个步骤：

1. 新的日志记录器需要继承抽象日志记录器Logger。
2. 对应增加一个新的具体日志记录器工厂，继承抽象日志记录器工厂LoggerFactory，并实现其中的工厂方法createLogger()，设置好初始化参数和环境变量，返回具体日志记录器对象；
3. 修改配置，将新增的具体日志记录器工厂类的类名字符串替换原有工厂类类名字符串；
4. 运行客户端测试类即可使用新的日志记录方式。

### 总结

#### 优点

1. 在工厂方法模式中，工厂方法用来创建客户所需要的产品，同时还向客户隐藏了哪种具体产品类将被实例化这一细节，用户只需要关心所需产品对应的工厂，无须关心创建细节，甚至无须知道具体产品类的类名。
2. 基于工厂角色和产品角色的多态性设计是工厂方法模式的关键。它能够让工厂可以自主确定创建何种产品对象，而如何创建这个对象的细节则完全封装在具体工厂内部。工厂方法模式之所以又被称为多态工厂模式，就正是因为所有的具体工厂类都具有同一抽象父类。
3. 使用工厂方法模式的另一个优点是在系统中加入新产品时，无须修改抽象工厂和抽象产品提供的接口，无须修改客户端，也无须修改其他的具体工厂和具体产品，而只要添加一个具体工厂和具体产品就可以了，这样，系统的可扩展性也就变得非常好，完全符合“开闭原则”。

#### 缺点

1. 在添加新产品时，需要编写新的具体产品类，而且还要提供与之对应的具体工厂类，系统中类的个数将成对增加，在一定程度上增加了系统的复杂度。
2. 由于考虑到系统的可扩展性，需要引入抽象层，在客户端代码中均使用抽象层进行定义，增加了系统的抽象性和理解难度。