CREATE DATABASE utnjobs;

-- USE utnjobs

-- creacion de tablas

CREATE TABLE companies(
	id_company int PRIMARY KEY auto_increment,
	cuit BIGINT unique,
	name varchar(20) UNIQUE,
	company_role varchar(100),
	description varchar(1000),
	link varchar(100),
	active BOOL
);

CREATE TABLE users(
	id_user mediumint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	username varchar(30),
	password varchar(30),
	user_type enum('admin','student')	
);

CREATE TABLE job_offers(
	id_job_offer MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	publication_date DATETIME,
	remote BOOL,
	description varchar(1000),
	title varchar(1000),
	career varchar(30) NOT null,
	job_position varchar(30) NOT null,
	active bool,
	id_company INT NOT null,
	CONSTRAINT fk_company_job_offer FOREIGN KEY (id_company) REFERENCES companies (id_company)	
);


ALTER TABLE job_offers ADD COLUMN title varchar(1000);

CREATE TABLE students(
	id_student mediumint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	career varchar(30),
	firstName varchar(30),
	lastName varchar(30),
	dni varchar(50),
	fileNumber varchar(50),
	gender varchar(30),
	birthDate date,
	mail varchar(50),
	phoneNumber varchar(50),
	active boolean,
	id_user MEDIUMINT UNSIGNED,
	CONSTRAINT fk_user_student FOREIGN KEY (id_user) REFERENCES users (id_user)	
);

CREATE TABLE applications(
	id_application MEDIUMINT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
	application_datetime datetime,
	id_user MEDIUMINT UNSIGNED ,
	id_job_offer MEDIUMINT UNSIGNED,
	CONSTRAINT fk_user_application FOREIGN KEY (id_user) REFERENCES users(id_user),
	CONSTRAINT fk_job_offer_application FOREIGN KEY (id_job_offer) REFERENCES job_offers (id_job_offer)
);

-- insercion de datos


INSERT INTO utnjobs.users (username,password,user_type)
	VALUES ('admin','123','admin'),('ddouthwaite0@goo.gl','123','student');

