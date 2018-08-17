create database cartdb;

grant all on cartdb.* to dbuser@localhost identified by 'shin0622';

use cartdb;

create table products (
  product-id int not null auto_increment primary key,
  product-ttl varchar(100),
  product-exp varchar(255),
  product-price int,
  product-imgpath varchar(100),
  product-indate datetime
);

create table users (
  user-id int not null auto_increment primary key,
  user-password varchar(255) unique,
);

create table cat (
  cat-id int not null auto_increment primary key,
  cat-name varchar(255) unique
);

create table productcat (
  cat-id int not null,
  product-id int not null
);

create table review (
  review-id int not null auto_increment primary key,
  user-id int not null,
  review-star int not null,
  review-exp varchar(255),
  review-indate datetime
);

create table productreview {
  review-id int not null,
  product-id int not null
}

create table store {
  store-id int not null auto_increment primary key,
  store-password varchar(255) unique,
  store-name varchar(100) not null,
  store-exp varchar(255),
}

create table productstore {
  store-id int not null,
  product-id int not null
}

desc users;
