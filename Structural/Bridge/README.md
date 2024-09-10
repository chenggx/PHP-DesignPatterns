可将一个大类或一系列紧密相关的类拆分为抽象和实现两个独立的层次结构， 从而能在开发时分别使用。

## 需求

假设有一个文件系统，支持不同类型的文件（如文本文件、图片文件），同时可以使用不同的存储方式（如本地存储、云存储）。通过桥接模式，可以解耦文件类型和存储方式，使得两者独立扩展。

### 实例

```php
// 实现部分接口：定义不同的存储方式
interface Storage {
    public function store($file);
}

// 具体实现类：本地存储方式
class LocalStorage implements Storage {
    public function store($file) {
        echo "存储 $file 到本地";
    }
}

// 具体实现类：云存储方式
class CloudStorage implements Storage {
    public function store($file) {
        echo "存储 $file 到云端";
    }
}

// 抽象部分：文件类
abstract class File {
    protected $storage;

    public function __construct(Storage $storage) {
        $this->storage = $storage;
    }

    abstract public function save();
}

// 扩展抽象类：文本文件
class TextFile extends File {
    public function save() {
        $this->storage->store('TextFile');
    }
}

// 扩展抽象类：图片文件
class ImageFile extends File {
    public function save() {
        $this->storage->store('ImageFile');
    }
}

```

### 测试

```php
// 使用桥接模式
$textFileOnLocal = new TextFile(new LocalStorage());
$imageFileOnCloud = new ImageFile(new CloudStorage());

$textFileOnLocal->save();   // 输出: 存储 TextFile 到本地".
$imageFileOnCloud->save();  // 输出: 存储 ImageFile 到云端.
```

### 总结
符合开闭原则、单一职责原则, Bridge模式通过分离抽象和实现，可以使得抽象和实现可以独立变化，但是由于引入了更多的类，会使得系统更加复杂。

