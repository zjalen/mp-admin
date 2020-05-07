<h1 align="center"> mp-admin </h1>

<p align="center"> A wechat media platform control system for Laravel. 一个 Laravel 平台的微信公众平台 UI 管理组件.</p>

**alpha 测试阶段，不建议生产环境使用**

## 主要目的

后台接管微信后台，启用服务器之后，不能可视化使用菜单、自动回复等功能。本组件可实现可视化管理功能，记录用户消息日志，自动回复等。

## 安装

仅支持 laravel 中使用，基于 easywechat 组件

```shell
$ composer require jalen/mp-admin -vvv
```

## 使用

发布配置与资源文件

```shell script
$ php artisan vendor:publish --provider="Jalen\MpAdmin\MpAdminServiceProvider"
Copied Directory [/Users/jialinzhang/Develop/mp-admin/config] To [/config]
Copied Directory [/Users/jialinzhang/Develop/mp-admin/database/migrations] To [/database/migrations]
Copied Directory [/Users/jialinzhang/Develop/mp-admin/resources/assets] To [/public/vendor]
Copied Directory [/Users/jialinzhang/Develop/mp-admin/resources/views] To [/resources/views]
Publishing complete.
```

生成路由和回调管理控制器

```shell script
$ php artisan mp-admin:install                                                
Nothing to migrate.
MpAdmin directory was created: /app/MpAdmin
MpAdminController file was created: /app/MpAdmin/Controllers/MpAdminController.php
Routes file was created: /routes/mp_routes.php
```

## 开始使用

你可以使用下面命令快速启动

```shell script
php artisan serve
```

之后访问路由 `http://localhost:8000/mp-admin` 即可看到 UI 界面。

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/jalen/mp-admin/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/jalen/mp-admin/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT