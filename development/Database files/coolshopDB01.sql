drop database coolshop;
create database coolshop;

use coolshop;

create table category (
category_id int auto_increment primary key,
category_name varchar(20)
) engine = innodb;
 -- drop table product;
create table product (
product_id int auto_increment primary key,
category_id int(10),
product_name varchar(50),
product_description varchar(300),
product_image varchar(100),
foreign key (category_id) references category (category_id)

) engine = innodb;

create table Customer
(
  CustNum int auto_increment primary key,
  FirstName varChar(25),
  LastName varChar(25),
  UserId varChar(25),
  Password varChar(25),
  Email varChar(25),
  Address varChar(25),
  City varChar(50),
  PhoneNumber varChar(35)
) engine = InnoDB;

create table Administrator
(
  AdminId int auto_increment primary key,
  UserId varChar(25),
  Password varChar(25)
) engine = InnoDB;

-- Customers
INSERT INTO Customer Values(null, 'Jack', 'Eaton', 'jeaton01','jack', 'eatjack@hotmail.com', '111 Manchester Street','Christchurch', '0277267785');

-- Administrators
INSERT INTO Administrator Values(null, 'admin', 'admin');



insert into category values (1,'Electronics');
insert into category values (2,'Clothing');
insert into category values (3,'Music');
insert into category values (4,'Jewellery');
insert into category values (5,'Homewares');
insert into category values (6,'Furniture');

insert into product values(2, 1, "Acer Aspire 11.6 Inch Notebook V5-132","The perfect compact Entry-Level Notebook for checking emails, browsing the internet, updating your facebook profile.",
"images/electronics/acer_01.jpg");
insert into product values(2, 2, "H&H Boys Spray Jacket","Fabric: Polyester",
"images/cloths/H_H01.jpg");

insert into product values(4, 3, "100 years of the blues","Pack Size: 2CD",
"images/music/bluespac_01.jpg");

insert into product values(5, 4, "Ane Si Dora Sterling Silver Bracelet 16cm","Start your Ane Si Dora journey with this 16cm sterling silver bracelet. Begin collecting gorgeous charms representing life's beautiful memories! Their great design means that you can easily add new charms as you like.",
"images/jewellery/Ane_Si_Dora_01 .jpg");

insert into product values(6, 5, "Arctic Flannel Sheet Set Black Queen","Warm Polyester Fleece
No Shrinkage",
"images/homeware/archtic_flannel.jpg");
insert into product values(7, 6, "Reside Espresso Coffee Table Rectangular","Warm Polyester FleeceDecorate your home in style with the \"Reside Espresso\" range exclusive to The Warehouse. Combining the latest in contemporary styling and cool chocolate / coffee colour \"Reside Espresso\" is the latest in modern home fashion. 
No Shrinkage",
"images/furniture/espresso_coffee_table_01.jpg");
