##安装说明
阳春站图书管理系统（练手使用）
###安装应用
网站使用的是laravel5.0，所以服务器应该提前安装composer。

安装好composer后，执行
```shell
composer install
```
命令。
###配置信息

- 复制.env.example文件命名为.env文件
- 在.env文件中生成token

```shell
php artisan key:generate
```
- 配置数据库信息：先在本地数据库中，创建一个库。然后在.env文件中，配置本地数据库信息
- 生成数据库表

```shell
php artisan migrate
```
- 填充数据库

```shell
php artisan db:seed
```