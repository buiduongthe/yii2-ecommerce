<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
<h1>B1. Install Xampp</h1>
<h1>B2. Install Composer</h1>
<h1>B3. Install Git</h1>
<h1>B4. Install Yii2</h1>
<p>Truy cập vào thư mục htdocs của Xampp để thực hiện câu lệnh bên dưới</p>
<p>Nếu dự án đã được khởi tạo thì chỉ cần gõ lệnh: composer update</p>

```
composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application
```

```
composer update
```

<p>Vào thư mục yii-application, mở chế độ dòng lệnh gõ init và enter, sau đó chọn 0 hoặc 1 và nhấn Yes</p>

<h1>B5. Config Database</h1>
Truy cập vào thư mục common/config/ mở tập tin main-local.php thực hiện cấu hình tham số cho dbname, username, password

```
<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=banhang',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
```


<h1>B6. Custom VirtualHost</h1>

```
<VirtualHost *:80>
    DocumentRoot "E:/xampp/htdocs/yii-application/frontend/web"
    ServerName banhang.com
    ErrorLog "logs/banhang.com-error.log"
    CustomLog "logs/banhang.com-access.log" common
</VirtualHost>
<VirtualHost *:80>
    DocumentRoot "E:/xampp/htdocs/yii-application/backend/web"
    ServerName admin.banhang.com
    ErrorLog "logs/admin.banhang.com-error.log"
    CustomLog "logs/admin.banhang.com-access.log" common
</VirtualHost>
```
<h1>B6. Config Hosts</h1>
<p>
Windows: Vào trong thư mục C:\Windows\Systems32\drivers\etc
Thêm dòng sau đây vào cuối tập tin "hosts", lưu ý cấp quyền ghi vào tập tin "hosts"
</p>

<p>
Linux: Vào trong thư mục /etc/hosts
Thêm dòng sau đây vào cuối tập tin "hosts", lưu ý cấp quyền ghi vào tập tin "hosts"
</p>

```
127.0.0.1 banhang.com
127.0.0.1 admin.banhang.com
```

<h1>B7. Friendly Url</h1>
<p>Tạo tập tin .htaccess với nội dung sau:</p>

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . index.php
```
<p>Chép tập tin .htaccess vào 2 thư mục frontend/web và backend/web </p>
Truy cập vào backend/config hoặc frontend/config, tùy chỉnh tập tin main.php

Tìm đoạn mã sau
```
/*
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
    ],
],
/*
```
Sửa thành (bỏ thẻ /* */)

```
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
    ],
],

```

<h1>B8.Testing</h1>
<p>Mở trình duyệt web và thực hiện truy cập website <a href="http://banhang.com">http://banhang.com</a></p>