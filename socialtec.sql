CREATE DATABASE socialtec;

USE socialtec;


CREATE TABLE users
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	lastName VARCHAR(50) NOT NULL,
	username VARCHAR(50) NOT NULL,
	email VARCHAR(60) NOT NULL,
	pass VARCHAR(60) NOT NULL,
	token VARCHAR(20) NULL,
	active INT NOT NULL
);

CREATE TABLE user_profile(
	birthday DATE NOT NULL,
	gender CHAR(1) NOT NULL,
	country VARCHAR(30) NOT NULL,
	profile_img TEXT NULL,
	header_img TEXT NULL,
	description TEXT NULL,
	phone INT UNSIGNED NULL,
	sentimental_status TINYINT NULL,
	user_id INT NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)  
);

CREATE TABLE albums(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	title TEXT null,
	description TEXT NULL,
	created_date DATE,
	user_id INT NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
)

CREATE TABLE images(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	src TEXT NOT NULL,
	description text NULL,
	user_id INT NOT NULL,
	album_id INT NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (album_id) REFERENCES albums(id)
);

CREATE TABLE posts(
	id INT PRIMARY KEY AUTO_INCREMENT,
	description TEXT NULL,
	reactions INT NOT NULL,
	post_type INT NOT NULL,
	date_post DATETIME NOT NULL,
	user_id INT NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE post_images(
	post_id INT NOT NULL,
	image_id INT NOT NULL,
	FOREIGN KEY (post_id) REFERENCES posts(id),
	FOREIGN KEY (image_id) REFERENCES images(id)
);

CREATE TABLE likes(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	post_id INT NOT NULL,
	user_id INT NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
);


CREATE TABLE comments(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	description TEXT NOT NULL,
	created DATETIME NOT NULL,
	post_type INT NOT NULL,
	user_id int NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE friends(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	sender_id INT NOT NULL,
	receptor_id INT NOT NULL,
	is_accepted BOOLEAN DEFAULT 0,
	reception_date DATETIME NOT NULL,
	FOREIGN KEY (sender_id) REFERENCES users(id),
	FOREIGN KEY (receptor_id) REFERENCES users(id)
);

CREATE TABLE conversations(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	sender_id INT NOT NULL,
	receptor_id INT NOT NULL,
	FOREIGN KEY (sender_id) REFERENCES users(id),
	FOREIGN KEY (receptor_id) REFERENCES users(id)
);

CREATE TABLE messages(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	message TEXT NOT NULL,
	user_id INT NOT NULL,
	conversation_id INT NOT NULL,
	message_date DATETIME NOT NULL,
	is_readed BOOLEAN DEFAULT 0,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (conversation_id) REFERENCES conversations(id)
);

CREATE TABLE notifications(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	notification_type INT NOT NULL,
	post_type INT NOT NULL,
	sender_id INT NOT NULL,
	receptor_id INT NOT NULL,
	notification_date DATETIME NOT NULL,
	is_readed BOOLEAN DEFAULT 0,
	FOREIGN KEY (sender_id) REFERENCES users(id),
	FOREIGN KEY (receptor_id) REFERENCES users(id)
);