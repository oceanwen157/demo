## 说明

项目分为管理后台站点（backend目录）和前台展示站点（frontend目录），两个站点共用一个数据库.  
PHP 版本为 7.3或7.4，需composer、mysql和redis。  
**注意：**  
因为管理后台要上传图片到前台站，部署时两个站必须在同一目录下，即保持当前backend和frontend不动。


### 一、管理后台站

- 代码目录为 backend
- 框架为 laravel 8

#### 1.0 安装依赖

执行命令

```text
cd backend
composer install
```

#### 1.1 配置文件

- 复制backend目录下的`.env.example`为`.env`
- 修改`.env`里面相关的配置

#### 1.2 nginx配置

设置站点的访问目录为`backend/public`

```text
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

#### 1.3 后台入口

- 地址 xxx.com/myadmin
- 初始账号和密码 admin / admin

#### 1.4 执行采集命令
可以定时每24小时执行
```text
cd backend
php artisan crawler:run
```

#### 1.5 执行翻译命令
可以定时每1小时执行
```text
cd backend

#翻译基础信息，包括帮助中心、合作伙伴
php artisan translate:base

#翻译分类信息
php artisan translate:cate

#翻译明星信息
php artisan translate:star

#翻译视频信息
php artisan translate:video
```

### 二、前台展示站

- 代码目录为 frontend
- 框架为 thinkphp 6

#### 2.0 安装依赖

执行命令

```text
cd backend
composer install
```

#### 2.1 配置文件

- 复制frontend目录下的`.env.sample`为`.env`
- 修改`.env`里面相关的配置

#### 2.2 nginx配置

设置站点的访问目录为`frontend/public`

```text
location / { 
 if (!-e $request_filename){ 
  rewrite  ^(.*)$  /index.php?s=$1  last;   break; 
 } 
}
```
