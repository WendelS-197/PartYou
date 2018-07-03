drop database if exists PartYou;

create database PartYou;

use PartYou;

create table endereco(

	id int auto_increment primary key,
	cep varchar(9) not null,
	numero varchar(6) not null,
	logradouro varchar(45) not null,
	complemento varchar(45),
	uf varchar(30) not null,
	cidade varchar(45),
	bairro varchar(45) not null
);

create table usuario(

	id int auto_increment primary key,
	nome varchar(45) not null, 
	nome_usuario varchar(20) not null unique,
	senha varchar(100) not null,
	data_nascimento date not null,
	telefone varchar(15) not null,
	email varchar(45) not null unique,
	adm varchar(8) not null,
	descricao varchar(500),
	foto varchar(80),
	capa varchar(80),
	id_endereco int not null,

	foreign key(id_endereco) references endereco(id)
	
);

create table localizacao(

	id int auto_increment primary key,
	cep varchar(8) not null,
	numero varchar(6) not null,
	logradouro varchar(45) not null,
	complemento varchar(45),
	uf varchar(30) not null,
	cidade varchar(45),
	bairro varchar(45) not null
);


create table evento(

	id int auto_increment primary key,
	nome varchar(45) unique not null,
	data_inicio_evento date not null,
	data_final_evento date not null,
	descricao varchar(500) not null,
	informacao varchar(300),
	hora_inicio_evento time not null,
	hora_final_evento time not null,
	categoria1 varchar(45) not null,
	categoria2 varchar(45),
	categoria3 varchar(45),
	fotoevento varchar(80),
	id_usuario int,
	id_localizacao int not null,


	foreign key(id_usuario) references usuario(id) on delete cascade,
	foreign key(id_localizacao) references localizacao(id)
);


create table denuncia(

	id int auto_increment primary key,
	tipo varchar(45) not null,
	nome varchar(45) not null,
	descricao varchar(500) not null,
	id_usuario int,
	
	foreign key(id_usuario) references usuario(id) on delete set null
);


create table comentario(
	id int auto_increment primary key,
	id_usuario int not null,
	id_evento int not null,
	conteudo varchar(500) not null,

	foreign key(id_usuario) references usuario(id) on delete cascade,
	foreign key(id_evento) references evento(id) on delete cascade
);
