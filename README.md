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

- 地址 xxx.com/admin
- 账号和密码 admin / admin

### 命令行

```text
php artisan test:test
```
