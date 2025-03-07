## About App

### php版本

- php 7.3
- php 7.4

### 配置文件

- 复制`.env.example`为`.env`
- 修改`.env`里面相关的配置

### nginx配置

```text
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

### 管理后台

- 地址 xxx.com/myadmin
- 账号和密码 admin / admin

### 命令行

```text
抓取所有分类+明星
php artisan crawler:run cates &

抓取分类下的视频
php artisan crawler:run video --subject=category &

抓取明星下的视频
php artisan crawler:run  --subject=pornstar &

图片异步队列
php artisan queue:work --queue=default --daemon &
```
