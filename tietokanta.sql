drop database if exists shoppinglist;
create database shoppinglist;
use shoppinglist;

create table item (
    id int primary key auto_increment,
    description varchar(255) not null,
    amount smallint unsigned not null
);


INSERT into item(description,amount) values('Test item',1);
INSERT into item(description,amount) values('Another test item',1);