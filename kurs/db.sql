-- Создание базы данных
CREATE DATABASE IF NOT EXISTS kurs;

-- Использование базы данных
USE kurs; 

-- Таблица пользователей и их роли
CREATE TABLE IF NOT EXISTS users (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

-- Таблица изделий
CREATE TABLE IF NOT EXISTS products (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
product VARCHAR(255) NOT NULL,
description VARCHAR(255) NOT NULL,
price VARCHAR(255) NOT NULL
);
