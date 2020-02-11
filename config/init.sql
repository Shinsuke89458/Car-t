create database cartdb;

grant all on cartdb.* to dbuser@localhost identified by '********';

use cartdb;

drop table if exists products;
create table products (
  product_id int not null auto_increment primary key,
  product_ttl varchar(100),
  product_exp varchar(255),
  product_price int,
  product_imgpath varchar(100),
  product_state enum('show', 'draft') default 'draft',
  product_indate datetime,
);

drop table if exists users;
create table users (
  user_id int not null auto_increment primary key,
  user_password varchar(255) unique
);

drop table if exists cat;
create table cat (
  cat_id int not null auto_increment primary key,
  cat_name_en varchar(255) unique,
  cat_name_ja varchar(255) unique
);

insert into cat(cat_name_en, cat_name_ja) values
('ncar', '新車'),
('ucar', '中古車'),
('tirewheel', 'タイヤ＆ホイール'),
('caracce', 'カーアクセサリー'),
('carparts', 'カーパーツ');

drop table if exists productcat;
create table productcat (
  cat_id int not null,
  product_id int not null
);

drop table if exists tag;
create table tag (
  tag_id int not null auto_increment primary key,
  tag_name varchar(255) unique
);

drop table if exists producttag;
create table producttag (
  tag_id int not null,
  product_id int not null
);

drop table if exists review;
create table review (
  review_id int not null auto_increment primary key,
  user_id int not null,
  review_star int not null,
  review_exp varchar(255),
  review_indate datetime
);

drop table if exists productreview;
create table productreview (
  review_id int not null,
  product_id int not null
);

drop table if exists store;
create table store (
  store_id int not null auto_increment primary key,
  store_password varchar(255) unique,
  store_name varchar(100) not null,
  store_exp varchar(255)
);

drop table if exists productstore;
create table productstore (
  store_id int not null,
  product_id int not null
);

desc users;
