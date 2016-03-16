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


```
#!GIT HUB

$# git clone https://github.com/psbharathy/laravel-acl.git
```
Or

```
#!Packagist

$# composer require compassites/laravel-acl
```

## Step 2: ##
Goto applciation root directory and Run the following command

```
#!Composer

$# composer Install / update
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