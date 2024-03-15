# Teste de conhecimentos PHP + Banco de dados
Eu tive que recriar o banco de dados, pois nao tinha jeito de carregar o sqllite por causa de uma dll que nao abria 

-- Database: crud_users

-- DROP DATABASE IF EXISTS crud_users;

CREATE DATABASE crud_users
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'English_United States.1252'
    LC_CTYPE = 'English_United States.1252'
    LOCALE_PROVIDER = 'libc'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;
	
	

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS colors (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS user_colors (
    color_id INTEGER,
    user_id INTEGER,
    FOREIGN KEY (color_id) REFERENCES colors(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    PRIMARY KEY (color_id, user_id)
);

SELECT * FROM user_colors

SELECT * FROM user

SELECT * FROM public.users
ORDER BY id ASC 
