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


