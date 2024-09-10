**组合模式（Composite Pattern）**
是一种结构型设计模式，允许你将对象组合成树形结构来表示“部分-整体”的层次结构。组合模式使得客户端对单个对象和组合对象的使用具有一致性,也就是说，无论处理单个对象还是处理组合对象，客户端代码都可以统一处理。

简单点理解就是可以抽象为树形结构内容就可以使用组合模式。例如：文件系统，公司组织架构等

## 需求

假设我们有一个文件系统，其中有文件和文件夹，文件夹可以包含文件或其他文件夹。通过组合模式，我们可以对文件和文件夹进行统一的操作，比如计算文件大小或打印文件夹结构。

### 实例

```php
// 组件接口：文件系统元素
interface FileSystemComponent {
    public function display();
    public function add(FileSystemComponent $component);
    public function remove(FileSystemComponent $component);
}

// 叶子节点：图片文件类
class ImageFile implements FileSystemComponent {
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function add(FileSystemComponent $component)
    {
        throw new \Exception('图片文件没有此方法');
    }

    public function remove(FileSystemComponent $component)
    {
        throw new \Exception('图片文件没有此方法');
    }

    public function display() {
        echo "Image File: " . $this->name . PHP_EOL;
    }
}

// 叶子节点：文本文件类
class TextFile implements FileSystemComponent {
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
    }

    public function add(FileSystemComponent $component)
    {
        throw new \Exception('文本文件没有此方法');
    }

    public function remove(FileSystemComponent $component)
    {
        throw new \Exception('文本文件没有此方法');
    }

    public function display() {
        echo "Text File: " . $this->name .PHP_EOL;
    }
}

// 组合节点：文件夹类
class Directory implements FileSystemComponent {
    private $name;
    private $children = [];

    public function __construct($name) {
        $this->name = $name;
    }

    // 添加文件或文件夹
    public function add(FileSystemComponent $component) {
        $this->children[] = $component;
    }

    // 移除文件或文件夹
    public function remove(FileSystemComponent $component) {
        $key = array_search($component, $this->children, true);
        if ($key !== false) {
            unset($this->children[$key]);
        }
    }

    // 显示文件夹结构
    public function display() {
        echo "Directory: " . $this->name . PHP_EOL;
        foreach ($this->children as $child) {
            $child->display();
        }
    }
}

```

### 测试

```php
$file1 = new \Composite\ImageFile("图片1.png");
$file2 = new \Composite\ImageFile("图片2.jpg");
$file3 = new \Composite\TextFile("文件1.txt");

$folder1 = new \Composite\Directory("folder1");
$folder2 = new \Composite\Directory("folder2");

$folder1->add($file1);      // folder1 包含 file1
$folder1->add($file2);      // folder1 包含 file2
$folder2->add($file3);      // folder2 包含 file3

$rootDirectory = new \Composite\Directory("root");
$rootDirectory->add($folder1);  // root 目录包含 folder1
$rootDirectory->add($folder2);  // root 目录包含 folder2

$rootDirectory->display();      // 输出整个文件系统结构
```

### 总结

优点：是可以简化客户端的代码，客户端代码对组合对象和叶节点对象的使用具有一致性。
缺点：组合模式可能会导致类的数量增加，因为需要创建一个新的类来表示组合对象和叶节点对象。如果树形结构过于庞大，遍历和管理可能会导致性能问题。

### 其他

组合模式分为安全组合模式和透明组合模式

透明组合模式：所有类（包括叶子节点和组合节点）都实现了相同的接口，因此客户端不需要知道对象是叶子节点还是组合节点。所有操作（如 add()、remove()）都会在叶子节点和组合节点上统一暴露。
优点：客户端代码可以统一处理叶子对象和组合对象，调用方法时不需要知道是叶子还是组合对象。
缺点：对于叶子节点来说，暴露诸如 add() 和 remove() 这类操作是不合逻辑的，因为叶子节点不应该有子节点。这会带来运行时的错误或无效操作。

安全组合模式：叶子节点和组合节点没有实现完全相同的接口。只有组合节点提供 add() 和 remove() 等管理子节点的方法，叶子节点只实现必要的操作方法。这样做可以避免在叶子节点上暴露不必要的方法，确保更严格的类型安全。
优点：叶子节点和组合节点的实现完全不同，叶子节点没有 add() 和 remove() 等方法， Leaf 类只实现必要的操作方法。
缺点：客户端代码在处理叶子节点和组合节点时，需要区别对待。如果要对组合对象进行管理，需要通过类型判断或其他方式处理。