drop database coolshop;
create database coolshop;

use coolshop;
-- drop table category;
create table category (
    category_id int auto_increment primary key,
    category_name varchar(20)
)  engine=innodb;
 -- drop table product;
create table product (
    product_id int auto_increment primary key,
    category_id int(10),
    product_name varchar(50),
    product_description varchar(300),
    product_price decimal(10 , 2 ),
    product_image varchar(100),
    foreign key (category_id)
        references category (category_id)
)  engine=innodb;

-- drop table Customer;
-- describe Customer;
create table Customer (
    CustNum int auto_increment primary key,
    CustomerImg varchar(50),
    FirstName varChar(25),
    LastName varChar(25),
    UserId varChar(25),
    Email varChar(25),
    Address varChar(25),
    City varChar(50),
    PhoneNumber varChar(35)
)  engine=InnoDB;
	-- drop table Administrator;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32),
  `lastname` varchar(32),
  `email` varchar(32),
  `username` varchar(32),
  `password` varchar(32),
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


create table Administrator (
    AdminId int auto_increment primary key,
    UserId varChar(25),
    Password text,
    salt text
)  engine=InnoDB;

-- Customers
INSERT INTO Customer Values(null, 'cainton.png','John', 'Jack', 'johnj2014', 'eatjack@hotmail.com', '111 Manchester Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null, 'cainton.png','James', 'Billy', 'jameb2014','eatjack@hotmail.com',  '454 Manchester Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Job', 'Jerry', 'jobj2014','eatjack@hotmail.com',  '408 Harewood road','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Cainton', 'Milroy', 'caintonm2014', 'eatjack@hotmail.com',  '500 Papanui Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Hayden', 'McLaren', 'haydenm2014','eatjack@hotmail.com',  '40 Cashel Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Glen', 'McNeur', 'glenm2014','eatjack@hotmail.com',  '34 Baberdoes Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'David', 'Mullan', 'davidm2014', 'eatjack@hotmail.com',  '78 Marivale Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Jack', 'Eaton', 'jacke2014', 'eatjack@hotmail.com',  '43 Bealey Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Trevor', 'Trief', 'trevort2014', 'eatjack@hotmail.com',  '79 Montreal Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Mary', 'Braid', 'jmaryb2014', 'eatjack@hotmail.com', '100 Cranford Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Isabel', 'Jones', 'isabelj2014', 'eatjack@hotmail.com',  '432 Shirley Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Lisa', 'Mona', 'lisam2014','eatjack@hotmail.com',  '21 Avonhead Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null, 'cainton.png','Jess', 'Perry', 'jessp2014','eatjack@hotmail.com',  '2 Riccarton Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Anthony', 'Freess', 'anthonyf2014', 'eatjack@hotmail.com', '32 Rangiora Street','Christchurch', '0277267785');

INSERT INTO Customer Values(null,'cainton.png', 'Bill', 'Bani', 'billb2014','eatjack@hotmail.com', '98 Aranui Street','Christchurch', '0277267785');

-- Administrators
INSERT INTO Administrator Values(null,'Admin2014', '4f8ee01c497c8a7d6f44334dc15bd44fe5acea9aed07f67e34a22ec490cfced1', 
 's*vl%/?s8b*b4}b/w%w4');


insert into category values (null,'Electronics');
insert into category values (null,'Clothing');
insert into category values (null,'Music');
insert into category values (null,'Jewellery');
insert into category values (null,'Homewares');
insert into category values (null,'Furniture');

insert into product values(null, 1, "Acer Aspire 11.6 Inch Notebook V5-132","The perfect compact Entry-Level Notebook for checking emails, browsing the internet, updating your facebook profile.",22.00,
"acer_01.jpg");
insert into product values(null, 2, "H&H Boys Spray Jacket","Fabric: Polyester",20.50,
"H_H01.jpg") ;

insert into product values(null, 4, "100 years of the blues","Pack Size: 2CD",50.90,
"bluespac_01.jpg");

insert into product values(null, 2, "Ane Si Dora Sterling Silver Bracelet 16cm","Start your Ane Si Dora journey with this 16cm sterling silver bracelet. Begin collecting gorgeous charms representing life's beautiful memories! Their great design means that you can easily add new charms as you like.",50.30,
"Ane_Si_Dora_01.jpg");

insert into product values(null,6, "Arctic Flannel Sheet Set Black Queen","Warm Polyester Fleece",45.00,

"archtic_flannel.jpg");
insert into product values(null, 2, "Reside Espresso Coffee Table Rectangular","Warm Polyester FleeceDecorate your home in style with the \"Reside Espresso\" range exclusive to The Warehouse. Combining the latest in contemporary styling and cool chocolate / coffee colour \"Reside Espresso\" is the latest in modern home fashion. 
No Shrinkage",60.00,
"espresso_coffee_table_01.jpg");
