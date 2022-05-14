# 使用

## 如果你在使用YngPHP则需要按照下面的教程来使用

### 安装

使用起步中的命令安装完成后框架会自动将配置文件`cache.php`移动到根包的`config`目录下，如果创建失败，可以手动创建。

### 注册服务提供者

> 如果你在使用YngPHP,需要注册服务提供者

你可能需要绑定接口对应的类的到`app.php` 的配置文件中（非必须），例如

```php
'aliases' => [
    \Psr\SimpleCache\CacheInterface::class => \Yng\Framework\Cache::class,
],
```

### 使用门面，依赖注入或者助手函数（助手函数需要注册服务提供者才能使用）

```php
\Yng\Framework\Facades\Cache::get($key); //门面

cache() //助手函数

//依赖注入
pubilc function index(\Yng\Framework\Cache $cache){
    $cache->get('stat');
}
```

## 如果你没有使用YngPHP，可以按照下面的方式使用

如果你使用文件缓存，安装好后你可能需要修改配置中的缓存存放路径，参考代码

```php
<?php

use Yng\Cache\Cache;
use Yng\Cache\CacheManager;

require './vendor/autoload.php';
//配置文件
$config = include './vendor/max/cache/src/cache.php';

$cacheManager = new CacheManager($config);
//如果需要切换存储，只需要将参数传递给get方法
$cache = $cacheManager->get();
//设置缓存
$cache->set('stat', 12, 10);
//读取缓存
var_dump($cache->get('stat'));

```

# 配置文件

文件内容如下：

```php
<?php

return [
    'default'  => 'file',
    'handlers' => [
        //文件缓存
        'file'      => [
            'handler' => \Yng\Cache\Handlers\File::class,
            'options' => [
                'path' => env('cache_path') . 'app',
            ],
        ],
        // redis缓存
        'redis'     => [
            'handler' => \Yng\Cache\Handlers\Redis::class,
            'options' => [
                //所有Redis的host[不区分主从]
                'host'   => [
                    '127.0.0.1',
                    '127.0.0.1',
                    '127.0.0.1',
                    '127.0.0.1',
                    '127.0.0.1',
                    '127.0.0.1',
                    '127.0.0.1',
                ],
                //端口 string / array
                'port'   => 6379,
                //密码 string / array
                'auth'   => '',
                //主Redis ID [host中主机对应数组的键]
                'master' => [0, 1, 4, 5],
                //从Redis ID [host中主机对应数组的键]
                'slave'  => [2, 3, 6]
            ],
        ],
        //memcached缓存
        'memcached' => [
            'handler' => \Yng\Cache\Handlers\Memcached::class,
            'options' => [
                'host' => '127.0.0.1', //主机
                'port' => 11211        //端口
            ],
        ]
    ],
];

```

目前redis存储使用了max/redis包，所以实际连接的redis由redis.php配置文件中的配置决定

> 官网：https://www.1kmb.com
