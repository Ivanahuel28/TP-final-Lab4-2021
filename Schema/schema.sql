-- DROP DATABASE utnjobs;

-- CREATE DATABASE utnjobs;

USE utnjobs

-- creacion de tablas

CREATE TABLE companies(
	id_company MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	cuit varchar(11) unique,
	name varchar(20) UNIQUE,
	company_role varchar(100),
	description varchar(1000),
	link varchar(100),
	active BOOL NOT NULL 
);

CREATE TABLE users(
	id_user mediumint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	username varchar(30) UNIQUE ,
	password varchar(30) NOT NULL ,
	user_type enum('admin','student') NOT NULL 	
);

CREATE TABLE job_offers(
	id_job_offer MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	id_job_position MEDIUMINT UNSIGNED,
	id_company MEDIUMINT UNSIGNED,
	id_career MEDIUMINT UNSIGNED,
	title varchar(30) NOT NULL,
	description varchar(1000),
	creation_date datetime,
	remote bool,
	active bool NOT NULL ,
	CONSTRAINT u_job_offer UNIQUE (id_job_position,id_company),
	CONSTRAINT fk_company_job_offer FOREIGN KEY(id_company) REFERENCES companies (id_company)	
);

CREATE TABLE applications(
	id_application MEDIUMINT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
	id_user MEDIUMINT UNSIGNED ,
	id_job_offer MEDIUMINT UNSIGNED,
	application_datetime datetime,
	file_path varchar(100),
	CONSTRAINT u_application UNIQUE (id_user,id_job_offer),
	CONSTRAINT fk_user_application FOREIGN KEY (id_user) REFERENCES users(id_user),
	CONSTRAINT fk_job_offer_application FOREIGN KEY (id_job_offer) REFERENCES job_offers (id_job_offer)
);

/*CREATE TABLE students(
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
);*/

-- insercion de datos


INSERT INTO utnjobs.users (username,password,user_type)
	VALUES ('admin','123','admin'),('ddouthwaite0@goo.gl','123','student'),('wlorant1@sbwire.com','123','student');

INSERT INTO utnjobs.companies (cuit,name,company_role,description,link,active)
	VALUES (
	421368463,
	'Avalith',
	'Desarrollo',
	'We are passionate about software development. We have been empowering world-class companies for 10 years, with more than 100 Avalithers working from anywhere.',
	'https://www.avalith.net/',
	1)
;


