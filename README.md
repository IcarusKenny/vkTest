**Тестирование задания:**
1) Склонировать репозиторий
2) Отредактировать файл /etc/hosts, добавив в него строчку
```
127.0.0.1       vktest.local
```

3) Сбилдить и поднять контейнеры
```
docker-compose build
docker-compose up -d
```
4) Установить пакеты с помощью композера следующими командами:
```
docker exec -ti vktest.local bash
composer install
exit
```
5) Создать базу и таблицу:
```
docker exec -ti db mysql --user=root --password=mypassword
CREATE DATABASE vktestdb;
use vktestdb;
CREATE TABLE users
(
    id    int primary key     not null auto_increment,
    email varchar(255) unique not null,
    hash  varchar(255)        not null
);
```
7) Апи-методы:
   1. POST: http://vktest.local:8888/public/register, принимает параметры email и password
   2. POST: http://vktest.local:8888/public/authorize, принимает параметры email и password
   3. GET: http://vktest.local:8888/public/feed?access_token=ТОКЕН, в параметр access_token нужно подставить access_token из предыдущего метода
