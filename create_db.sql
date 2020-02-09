# drop database if exists jackards_db;

create database if not exists jackards_db
default character set utf8mb4
default collate utf8mb4_general_ci;

use jackards_db;

create table if not exists `user` (
    id int not null unique auto_increment,
    name varchar(64) not null,
    username varchar(32) not null unique,
    e_mail varchar(64) not null unique,
    phone varchar(16) not null unique,
    `password` varchar(64) not null,
    primary key(id)
)
auto_increment = 0
default charset utf8mb4
engine = InnoDB;

create table if not exists card_name (
    id char(64) not null unique,
    image_path varchar(256) not null,
    primary key(id)
)
default charset utf8mb4
engine = InnoDB;

create table if not exists card (
    id int not null unique auto_increment,
    name char(64) not null,
    price decimal(6, 2) not null,
    owner int not null,
    primary key(id),
    foreign key(name) references card_name(id),
    foreign key(owner) references `user`(id)
)
auto_increment = 0
default charset utf8mb4
engine = InnoDB;
