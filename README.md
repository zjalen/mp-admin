<h1 align="center"> Mp-Admin </h1>

<p align="center"> A wechat media platform control system for Laravel. 一个 Laravel 平台的微信公众平台 UI 管理组件.</p>

**alpha 测试阶段，不建议生产环境使用**

## 主要目的

后台接管微信后台，启用服务器之后，不能可视化使用自定义菜单、自动回复等功能。本组件可实现可视化管理功能，记录用户消息日志，自动回复等。

## 安装

仅支持 laravel 中使用，基于 easywechat 组件

```shell
$ composer require zjalen/mp-admin -vvv
```

## 使用

发布配置与资源文件

```shell script
$ php artisan vendor:publish --provider="Jalen\MpAdmin\MpAdminServiceProvider"
```

生成数据表，生成路由和回调管理控制器

```shell script
$ php artisan mp-admin:install                                                
```

**注意要把 `/notify` 路由添加到 `csrf token` 的例外中。** 在 `app\Http\Middleware\VerifyCsrfToken` 的 `$except` 中加入例外路由，这是微信通知的路由。

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/notify'
    ];
}
```

## 开始使用

你可以使用下面命令快速启动测试

```shell script
php artisan serve
```

之后访问路由 `http://localhost:8000/mp-admin` 即可看到 UI 界面。

- 如需正式使用，需设置微信服务器相关配置，默认微信通知路由为 `http://域名/notify`。

- 使用自定义菜单需在微信公众号后台添加 ip 白名单。

- 注意要把 `/notify` 路由添加到 `csrf token` 的例外中


## License

MIT