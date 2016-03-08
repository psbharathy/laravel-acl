# README #

Laravel ACL package
This document whatever steps are necessary to get acl application up and running.

### Software Requirement ###


* Server Script : PHP 5.5 and also it will support PHP 7
* Framework : Laravel 5.1
* Database : Mysql 5.6
* webserver : apache2 / Nginx

### What is this repository for? ###


* Laravel ACL based application
* V1.0.0

### How do I get set up? ###

*  Apache Config:

```
#!Apache2

<VirtualHost *:80>
        ServerName laravel-acl.app
        ServerAdmin dev@laravel-acl.app
        DocumentRoot  /var/www/html/laravel-acl/public
        DirectoryIndex index.html index.php
        <Directory /var/www/html/laravel-acl>
        AllowOverride All
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/laravel-acl/acl_error.log
        CustomLog ${APACHE_LOG_DIR}/laravel-acl/acl_access.log combined
</VirtualHost>

```
If you are using Nginx web server try the below
```
#!Nginx

server {
    listen 80;
    listen 443 ssl;
    server_name laravel-acl.app;
    root "/var/www/html/laravel-acl/public";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log off;
    error_log  /var/log/nginx/acl.app-error.log error;

    sendfile off;

    client_max_body_size 100m;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
        fastcgi_connect_timeout 300;
        fastcgi_send_timeout 300;
        fastcgi_read_timeout 300;
    }

    location ~ /\.ht {
        deny all;
    }

}

```


##  Step 1:  ##

```
#!GIT HUB

$# git clone https://github.com/psbharathy/laravel-acl.git
```

## Step 2: ##
Goto applciation root directory and Run the following command

```
#!Composer

$# composer Install
```
## Step 3: ##

Environment Configuration

Change .env file for environment based configuration like Database , Email and Debug setings

## Step 4: ##

Run the migration file to update all database migrations

```
#!Migration

$# php artaisan migrate
```

### Contribution guidelines ###

* All the test cases are written in tests folder
* PSR2  Code Standard followed in this Application