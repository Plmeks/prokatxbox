ALTER TABLE orderList
DROP FOREIGN KEY fk_orderListOrder;

ALTER TABLE orderList
DROP FOREIGN KEY fk_orderListProduct;

ALTER TABLE product
DROP FOREIGN KEY fk_prodCat;

ALTER TABLE catalogue
DROP FOREIGN KEY fk_catlProd;

ALTER TABLE catalogue
DROP FOREIGN KEY fk_catlSubcat;

ALTER TABLE popularProducts
DROP FOREIGN KEY fk_popularProd;

ALTER TABLE subcategory
DROP FOREIGN KEY fk_subcatCat;

ALTER TABLE orders
DROP FOREIGN KEY fk_ordersUser;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS subcategory;
DROP TABLE IF EXISTS catalogue;
DROP TABLE IF EXISTS popularProducts;
DROP TABLE IF EXISTS orderList;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS clients;

CREATE TABLE users (
  id INT AUTO_INCREMENT,
  login VARCHAR(60) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(120) NOT NULL,
  passwordKey VARCHAR(120) NOT NULL,
  role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY(id),
  UNIQUE(id)
);

CREATE TABLE category (
  id INT AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL,
  shortName VARCHAR(60) NOT NULL,
  description TEXT,
  PRIMARY KEY(id),
  UNIQUE(id)
);

CREATE TABLE subcategory (
  id INT AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL,
  shortName VARCHAR(60) NOT NULL,
  description TEXT,
  idCategory int NOT NULL,
  PRIMARY KEY(id),
  UNIQUE(id),
  INDEX(idCategory),
  CONSTRAINT fk_subcatCat  FOREIGN KEY (idCategory)
  REFERENCES category (id)
);

CREATE TABLE product (
  id INT AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL,
  shortName VARCHAR(60) NOT NULL,
  description TEXT NOT NULL,
  shortDescription TEXT NOT NULL,
  price INT NOT NULL,
  image TEXT NOT NULL,
  idCategory INT NOT NULL,
  PRIMARY KEY(id),
  UNIQUE(id),
  INDEX(idCategory),
  CONSTRAINT fk_prodCat FOREIGN KEY (idCategory)
  REFERENCES category (id)
);

CREATE TABLE catalogue (
  id INT AUTO_INCREMENT,
  idProduct INT NOT NULL,
  idSubcategory int NOT NULL,
  PRIMARY KEY(id),
  UNIQUE(id),
  INDEX(idProduct),
  INDEX(idSubcategory),
  CONSTRAINT fk_catlProd FOREIGN KEY (idProduct)
  REFERENCES product (id),
  CONSTRAINT fk_catlSubcat  FOREIGN KEY (idSubcategory)
  REFERENCES subcategory (id)
);

CREATE TABLE popularProducts (
  id INT AUTO_INCREMENT,
  idProduct INT NOT NULL,
  image VARCHAR(60),
  PRIMARY KEY(id),
  UNIQUE(id),
  INDEX(idProduct),
  CONSTRAINT fk_popularProd FOREIGN KEY (idProduct)
  REFERENCES product (id)
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT,
  phone VARCHAR(60) NOT NULL,
  fio VARCHAR(120) NOT NULL,
  address VARCHAR(120),
  fromDate DATE NOT NULL,
  toDate DATE NOT NULL,
  delivery ENUM('courier', 'pickup') NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY(id),
  UNIQUE(id),
  INDEX(idUser),
  CONSTRAINT fk_ordersUser FOREIGN KEY (idUser)
  REFERENCES users (id)
);

CREATE TABLE orderList(
  id INT AUTO_INCREMENT,
  idOrder INT NOT NULL,
  idProduct int NOT NULL,
  PRIMARY KEY(id),
  UNIQUE(id),
  INDEX(idOrder),
  INDEX(idProduct),
  CONSTRAINT fk_orderListOrder FOREIGN KEY (idOrder)
  REFERENCES orders (id),
  CONSTRAINT fk_orderListProduct FOREIGN KEY (idProduct)
  REFERENCES product (id)
);

CREATE TABLE clients (
  id INT AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL,
  shortName VARCHAR(60) NOT NULL,
  description TEXT,
  PRIMARY KEY(id),
  UNIQUE(id)
);

CREATE TABLE IF NOT EXISTS competition (
  id INT AUTO_INCREMENT,
  link Text NOT NULL,
  PRIMARY KEY(id),
  UNIQUE(id)
);
