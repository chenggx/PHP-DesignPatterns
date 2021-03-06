## 动机

举个大家都熟知的例子——Windows 任务管理器，如下图所示，我们可以做一个这样的尝试，在 Windows 的“任务栏”的右键弹出菜单上多次点击“启动任务管理器”，看能否打开多个任务管理器窗口？如果你的桌面出现多个任务管理器，我请你吃饭。（注：电脑中毒或私自修改Windows内核者除外）

通常情况下，无论我们启动任务管理多少次，Windows 系统始终只能弹出一个任务管理器窗口，也就是说在一个 Windows 系统中，任务管理器存在唯一性。为什么要这样设计呢？我们可以从以下两个方面来分析：**其一**，如果能弹出多个窗口，且这些窗口的内容完全一致，全部是重复对象，这势必会浪费系统资源，任务管理器需要获取系统运行时的诸多信息，这些信息的获取需要消耗一定的系统资源，包括CPU资源及内存资源等，浪费是可耻的，而且根本没有必要显示多个内容完全相同的窗口；**其二**，如果弹出的多个窗口内容不一致，问题就更加严重了，这意味着在某一瞬间系统资源使用情况和进程、服务等信息存在多个状态，例如任务管理器窗口A显示“CPU使用率”为10%，窗口B显示“CPU使用率”为15%，到底哪个才是真实的呢？这纯属“调戏”用户，给用户带来误解，更不可取。由此可见，确保 Windows 任务管理器在系统中有且仅有一个非常重要。

![](http://static.xiangdangnian.net.cn/20200928112303.png)

在实际开发中，我们也经常遇到类似的情况，为了节约系统资源，有时需要确保系统中某个类只有唯一一个实例，当这个唯一实例创建成功之后，我们无法再创建一个同类型的其他对象，所有的操作都只能基于这个唯一实例。为了确保对象的唯一性，我们可以通过单例模式来实现，这就是单例模式的动机所在。 常见使用实例：数据库连接器；日志记录器（如果有多种用途使用多例模式）



## 实例代码

```php
class Singleton
{
    /**
     * @var Singleton reference to singleton instance
     */
    private static $instance;
    
    /**
     * 通过延迟加载（用到时才加载）获取实例
     *
     * @return self
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * 构造函数私有，不允许在外部实例化
     *
     */
    private function __construct()
    {
    }

    /**
     * 防止对象实例被克隆
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * 防止被反序列化
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}
```



## 测试

```php
$instance_1 = \Creational\Singleton\Singleton::getInstance();
$instance_2 = \Creational\Singleton\Singleton::getInstance();

var_dump($instance_1,$instance_2);
```



## 结果（为用一个 id 对象）

![结果](http://static.xiangdangnian.net.cn/20200928113018.png)



**单例模式在 JAVA 中会被分为懒汉式单例模式 | 饿汉式单例模式**，由于 php 不支持在定义静态变量的时候实例化单例类的写法，所以在 php 中不支持恶汉式单例。

## 总结

**单例模式作为一种目标明确、结构简单、理解容易的设计模式，在软件开发中使用频率相当高，在很多应用软件和框架中都得以广泛应用。**

### 优点

1. 单例模式提供了对唯一实例的受控访问。因为单例类封装了它的唯一实例，所以它可以严格控制客户怎样以及何时访问它。
2. 由于在系统内存中只存在一个对象，因此可以节约系统资源，对于一些需要频繁创建和销毁的对象单例模式无疑可以提高系统的性能。

### 缺点

1. 由于单例模式中没有抽象层，因此单例类的扩展有很大的困难。
2. 单例类的职责过重，在一定程度上违背了“单一职责原则”。因为单例类既充当了工厂角色，提供了工厂方法，同时又充当了产品角色，包含一些业务方法，将产品的创建和产品的本身的功能融合到一起。



