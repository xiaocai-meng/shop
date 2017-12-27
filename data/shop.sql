create database if not exists `shop`;
use `shop`;

--管理员表
drop table if exists `shop_admin`;
create table `shop_admin`(
`id` tinyint unsigned auto_increment primary key,
`username` varchar(30) not null unique,
`password` char(32) not null ,
`email` varchar(60) not null
);

--分类表
drop table if exists `shop_cate`;
create table `shop_cate`(
`id` smallint unsigned auto_increment primary key,
`cName` varchar(30) unique
);

--商品表
drop table if exists `shop_pro`;
create table `shop_pro`(
`id` int unsigned auto_increment primary key,
`pName` varchar(255) not null unique,
`cId` int unsigned not null,
`pSn` varchar(50) not null,
`pNum` int unsigned default 1,
`mPrice` decimal(10,2) not null,
`iPrice` decimal(10,2) not null,
`pDesc` mediumtext,
`pImg` varchar(255) not null,
`pubTime` int unsigned not null,
`isShow` tinyint(1) default 1,
`isHot` tinyint(1) default 0

);

--会员表
drop table if exists `shop_user`;
create table `shop_user`(
`id` int unsigned auto_increment primary key,
`username` varchar(30) not null unique,
`password` varchar(32) not null,
`sex` enum('男','女','保密') not null default '保密',
`email` varchar(60) not null,
`face` varchar(50)  not null,
`regTime` int unsigned not null,
`activeFlag` tinyint(1) not null default 0
)DEFAULT charset='utf8';

--相册表
drop table if exists `shop_album`;
create table `shop_album`(
`id` int unsigned auto_increment primary key,
`pid` int unsigned not null,
`albumPath` varchar(50) not null
);

