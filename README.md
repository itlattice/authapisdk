## 简介
* 本项目为格子吧软件授权系统(https://auth.itgz8.com)的PHP开发SDK，可下载本仓库集成，也可以使用composer直接安装：
```shell
composer require iboxs/authapi
```

### 使用方法
```php
require_once '../vendor/autoload.php';   //使用thinkphp、laravel等框架的可忽略这一句
use iboxs\authapi\Client;
$upload = new Client("你的APPID","你的appsecret");  //按应用这两个参数不同
echo $upload->Auth("123456789");   //这里模拟验证授权接口发起并获取结果（其他接口调用方法与之类似）
```