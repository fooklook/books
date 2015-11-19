##安装说明
###安装应用
网站使用的是laravel5.0，所以服务器应该提前安装composer。

安装好composer后，执行
```shell
composer install
```
命令。
###配置信息

- 复制.env.example文件命名为.env文件
- 执行
```shell
php artisan key:generate
```
，将自动在.env文件中生成token

- 先在本地数据库中，创建一个库。然后在.env文件中，配置本地数据库信息
- 执行
```shell
php artisan migrate
```
生成数据库表
- 执行
```shell
php artisan db:seed
```
填充数据库