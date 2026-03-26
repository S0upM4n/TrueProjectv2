create database if not exists projeto;
use projeto;
create table usuarios(
nome varchar(255),
senha varchar(255),
id int(255),
email varchar(255),
titulo varchar(255)
);


create table salas(
id varchar(255),
nome varchar(255),
criador varchar(255),
data date 
);
