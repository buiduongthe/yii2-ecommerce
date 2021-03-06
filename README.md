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
<b>????y l?? d??? ??n d??ng ????? h???c t???p v?? tham kh???o, kh??ng v?? m???c ????ch th????ng m???i</b>
<p>Tr??n tr???ng c???m ??n c??c t??c gi??? c???a c??c Theme, th?? vi???n ???? ???????c s??? d???ng trong m?? ngu???n n??y</p>
<p>D??? ??n c?? s??? d???ng c??c Themes, Th?? vi???n ... ???????c li???t k?? sau ????y:</p>

<p>- Theme Frontend: <a href="https://themeforest.net/item/nest-multipurpose-ecommerce-html-template/33948410">Nest - Multipurpose eCommerce HTML Template
</a></p> 
<p>- Theme Backend: <a href="https://adminlte.io/themes/v3/">AdminLte 3</a></p>
<p>- ...</p>
<h1>B1. Install Xampp</h1>
<p>Truy c???p v??o trang ch??? Xampp t???i <a target="_blank" href="https://www.apachefriends.org/download.html">Xampp Download</a>
v?? c??i ?????t/c???u h??nh theo h?????ng d???n sau:</p>
<p><img src="https://raw.githubusercontent.com/buiduongthe/yii2-ecommerce/master/document/Xampp1.png" alt="" width="502"><br></p>
<p><img src="https://raw.githubusercontent.com/buiduongthe/yii2-ecommerce/master/document/Xampp2.png" alt="" width="502"><br></p>

<h1>B2. Install Composer</h1>
<p>Truy c???p v??o trang ch??? Composer t???i <a target="_blank" href="https://getcomposer.org/download/">Composer Download</a></p>
<p><img src="https://raw.githubusercontent.com/buiduongthe/yii2-ecommerce/master/document/Composer1.png" alt="" width="502"><br></p>
<h1>B3. Install Git</h1>
<p>Truy c???p trang ch??? Git t???i <a target="_blank" href="https://git-scm.com">Git Download</a> v?? th???c hi???n c??i ?????t theo h?????ng d???n m???c ?????nh</p>
<h1>B4. Install Yii2</h1>
<p>Truy c???p v??o th?? m???c htdocs c???a Xampp ????? th???c hi???n c??u l???nh b??n d?????i</p>
<p>N???u d??? ??n ???? ???????c kh???i t???o th?? ch??? c???n g?? l???nh: composer update</p>

```
composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application
```

<p>M??? ph???n m???m PppStorm v?? th???c hi???n m??? th?? m???c yii-application, m??? ch??? ????? d??ng l???nh Terminal v?? th???c thi m???t trong c??c l???nh sau:</p>

```
composer update
composer install --ignore-platform-reqs
composer update --ignore-platform-reqs
```

G?? l???nh php init, ch???n m??i tr?????ng dev ho???c pro, sau ???? nh???n Yes n???u mu???n ghi ???? c??c t???p tin c???u h??nh

```
php init
```

<h1>B5. Install Notepad ++ </h1>
<p>Truy c???p v??o website <a href="https://notepad-plus-plus.org/downloads/">t???i ????y</a> v?? t???i ph???n m???m Notepadd ++ v?? c??i ?????t m???c ?????nh</p>
<h1>B6. Install PhpStorm</h1>
<p>Truy c???p v??o website <a href="https://www.jetbrains.com/phpstorm/download/">t???i ????y</a> v?? t???i ph???n m???m PhpStorm v?? c??i ?????t m???c ?????nh</p>
<p>M??? ph???n m???m PhpStorm, ????ng k?? b???n quy???n, m??? Project</p>
<p>V??o menu File -> Settings -> Plugins t??m v???i t??? kh??a Yii v?? c??i ?????t c??c ti???n ??ch (Yii2 Support,Yii2 Inspection, Yii::t, Yii2-Url)</p>
<h1>B7. Config Database</h1>
Truy c???p v??o th?? m???c common/config/ m??? t???p tin main-local.php th???c hi???n c???u h??nh tham s??? cho dbname, username, password

```
<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=e-commerce',
            'username' => 'root',
            'password' => '',
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
<p>Import DB db/e-commerce.sql</p>

<h1>B8. Custom VirtualHost</h1>
<p>Truy c???p v??o th?? m???c "E:\xampp\apache\conf\extra" m??? t???p tin "httpd-vhosts.conf" b???ng ph???n m???m Notepadd ++ (Ch???n Yes n???u h???i quy???n Administrator) th??m ??o???n m?? v??o cu???i t???p tin v?? kh???i ?????ng l???i Apache</p>

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

<h1>B9. Config Hosts</h1>
<p>Windows: V??o trong th?? m???c C:\Windows\Systems32\drivers\etc</p>
<p>M??? t???p tin hosts b???ng ph???n m???m Notepadd ++ (Ch???n Yes n???u h???i quy???n Administrator).
Th??m d??ng sau ????y v??o cu???i t???p tin "hosts", l??u ?? c???p quy???n ghi v??o t???p tin "hosts"
</p>

<p>
Linux: V??o trong th?? m???c /etc/hosts
Th??m d??ng sau ????y v??o cu???i t???p tin "hosts", l??u ?? c???p quy???n ghi v??o t???p tin "hosts"
</p>

```
127.0.0.1 banhang.com
127.0.0.1 admin.banhang.com
```

<h1>B10. Friendly Url</h1>
<p>T???o t???p tin .htaccess v???i n???i dung sau:</p>

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . index.php
```

<p>Ch??p t???p tin .htaccess v??o 2 th?? m???c frontend/web v?? backend/web </p>
Truy c???p v??o backend/config ho???c frontend/config, t??y ch???nh t???p tin main.php

T??m ??o???n m?? sau

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

S???a th??nh (b??? th??? /* */)

```
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
    ],
],

```

<h1>B11.Testing</h1>
<p>Frontend: <a target="_blank" href="http://banhang.com">http://banhang.com</a><p>
<p>Backend: <a target="_blank" href="http://admin.banhang.com">http://admin.banhang.com</a></p>

```
username:admin
password:999999

```