## 需求
你需要创建一个类，让应用所发出的调用与第三方类所要求的接口相匹配，而无需重写应用的通知接口并支持每一个第三方服务（如钉钉、 微信、 短信或其他任何服务）；

## 概述

> 适配器模式（Adapter Pattern）是一种结构型设计模式，为两个不兼容的接口之间架设桥梁，使不兼容的对象能够相互合作。

## 分类
### 类适配
这一实现使用了继承机制： 适配器同时继承两个对象的接口。 请注意， 这种方式仅能在支持多重继承的编程语言中实现。

### 对象适配
实现时使用了构成原则： 适配器实现了其中一个对象的接口， 并对另一个对象进行封装。 所有流行的编程语言都可以实现适配器。

## 主要角色

客户端
> 业务逻辑的类

客户端接口
> 即其他类与客户端代码合作时必须遵循的协议。

服务
> 第三方或遗留系统中的具体功能。没办法直接调用

适配器
> 是一个可以同时与客户端和服务交互的类,
> 它在实现客户端接口的同时封装了服务对象。 适配器接受客户端通过适配器接口发起的调用， 并将其转换为适用于被封装服务对象的调用。

## 实例代码



### 实例代码


## 总结
适配器模式允许你创建一个中间层类， 其可作为代码与遗留类、 第三方类或提供怪异接口的类之间的转换器。