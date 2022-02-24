create database aconline;
use aconline;

-- drop database Aconline;

CREATE TABLE ocupacao(
	codigo int primary key auto_increment,
    ocupacao varchar(50)
);

INSERT INTO ocupacao(ocupacao) 
	VALUES	('ADMIN'),
			('Professor'),
            ('Aluno'),
            ('Técnico Administrativo');

CREATE TABLE usuario(
	codigo int primary key auto_increment,
    nome varchar(50),
    email varchar(50),
    matricula int,
    usuario varchar(200),
    senha varchar(50),
    dtNascimento date,
    foto varchar(200),
    ocupacao int,
    foreign key (ocupacao) references ocupacao(codigo)
);

INSERT INTO usuario(nome, usuario, email, matricula, senha, dtNascimento, foto, ocupacao) 
	VALUES	('Bruno Martendal', 'Martendal', 'brunolucasjung@hotmail.com', 2017306180, '@123@abc', '2001-04-19', 'martendal.png', 1),
			('Bruno Alvez', 'Bruno', 'bruno@hotmail.com', 2017306180, '6f9736b03a90458b447b28a55a9f183552c4d38f',  '2001-03-12', 'alvez.png', 1),
			('Professor', 'Professor', 'professor@hotmail.com', 2017306180, '6f9736b03a90458b447b28a55a9f183552c4d38f',  '2001-08-10', 'professor.png', 2),
			('Aluno', 'Aluno', 'aluno@hotmail.com', 2017306180, '6f9736b03a90458b447b28a55a9f183552c4d38f', '2001-01-28', 'aluno.png', 3),
            ('Servidor', 'Servidor', 'servidor@hotmail.com', 2017306180, '6f9736b03a90458b447b28a55a9f183552c4d38f', '2001-01-28', 'servidor.png', 4),
            ('Servidor2', 'Servidor2', 'servidor2@hotmail.com', 2017306180, '6f9736b03a90458b447b28a55a9f183552c4d38f', '2001-01-28', 'servidor.png', 4);
            
CREATE TABLE profissao(
	codigo int auto_increment primary key,
    nome varchar(45)
);

INSERT INTO profissao(nome)
	VALUES	('Cordenador'),
			('Diretor'),
			('Pedagogo(a)'),
			('Psicólogo(a)');
            
CREATE TABLE usuario_has_profissao(
	codigo int auto_increment primary key,
    codigoUsuario int,
    codigoProfissao int,
    foreign key(codigoUsuario) references usuario(codigo),
    foreign key(codigoProfissao) references profissao(codigo)
);

INSERT INTO usuario_has_profissao(codigoUsuario, codigoProfissao)
	VALUES	(5,1),
			(6,2);

CREATE TABLE urgencia(
	codigo int primary key auto_increment,
    urgencia varchar(45)
);

INSERT INTO urgencia(urgencia)
	VALUES	('Baixa'),
			('Média'),
            ('Alta'),
            ('Extrema');
            
CREATE TABLE situacao(
	codigo int primary key auto_increment,
    descricao varchar(45)
);

INSERT INTO situacao(descricao)
	VALUES 	('Em aberto'),
			('Pendente'),
            ('Resolvido');

CREATE TABLE tpOcorrencia(
	codigo int auto_increment primary key,
    descricao varchar(45)
);

INSERT INTO tpOcorrencia(descricao)
	VALUES	('Perigo de reprovação');

CREATE TABLE ocorrencia(
	codigo int primary key auto_increment,
    descricao varchar(500),
    nota int,
    dtOcorrencia date,
    tpOcorrencia int,
    foreign key (tpOcorrencia) references tpOcorrencia(codigo),
    codigoProfessor int,
    foreign key (codigoProfessor) references usuario(codigo),
    codigoAluno int,
    foreign key (codigoAluno) references usuario(codigo),
    urgencia int,
    foreign key (urgencia) references urgencia(codigo),
    situacao int,
    foreign key (situacao) references situacao(codigo)
);

INSERT INTO ocorrencia
	VALUES	(null, 'Faz umas coisas que nem Deus acredita', '4', '2010-11-12', 1, 3, 4, 2, 1);
    
CREATE TABLE resolucao(
	codigo int auto_increment primary key,
    resolucao varchar(248),
    ocorrencia int,
    foreign key (ocorrencia) references ocorrencia(codigo)
);

create table nota(
	codigo int primary key auto_increment,
    nota int,
    codigoAluno int,
    foreign key (codigoAluno) references usuario(codigo),
    codigoProfessor int,
    foreign key (codigoProfessor) references usuario(codigo)
);

insert into nota
	values	(null, 3, 4, 3);
    
create table curso(
	codigo int auto_increment primary key,
    nome varchar(50),
    abreviacao varchar(50)
);

insert into curso(nome, abreviacao)
	values	('Informática', 'INFO'),
			('Agronomia', 'Agronomia'),
			('Agropecuária', 'Agropecuária');

create table turma(
	codigo int primary key auto_increment,
    ano int,
    curso int,
    foreign key (curso) references curso(codigo)
);

insert into turma 
	values	(null, 3, 1);

create table turma_has_aluno(
	codigo int primary key auto_increment,
    codigoTurma int,
    codigoUsuario int unique,
    foreign key (codigoTurma) references turma(codigo),
	foreign key (codigoUsuario) references usuario(codigo)
);

INSERT INTO turma_has_aluno(codigoTurma, codigoUsuario) 
	VALUES	(1,1),
			(1,4);
            
create table turma_has_professor(
	codigo int primary key auto_increment,
    codigoTurma int,
    codigoUsuario int,
    foreign key (codigoTurma) references turma(codigo),
	foreign key (codigoUsuario) references usuario(codigo)
);

INSERT INTO turma_has_professor(codigoTurma, codigoUsuario) 
	VALUES	(1,3);

create table disciplina(
	codigo int auto_increment primary key,
    nome varchar(100)
);

insert into disciplina(nome)
	values	('Matemática'),
			('Português'),
			('História');
            
create table professor_has_disciplina(
	codigo int auto_increment primary key,
	codigoUsuario int,
    codigoDisciplina int,
    foreign key(codigoUsuario) references usuario(codigo),
    foreign key(codigoDisciplina) references disciplina(codigo)
);

insert into professor_has_disciplina(codigoUsuario, codigoDisciplina)
	values	(3, 1),
			(3, 2),
            (3, 3);
            
create table aluno_has_disciplina(
	codigoUsuario int,
    codigoDisciplina int,
    primary key(codigoUsuario, codigoDisciplina),
    foreign key(codigoUsuario) references usuario(codigo),
    foreign key(codigoDisciplina) references disciplina(codigo)
);

insert into aluno_has_disciplina
	values	(4, 1);

create table turma_has_disciplina(
	codigoTurma int,
    codigoDisciplina int,
    primary key(codigoTurma, codigoDisciplina),
    foreign key(codigoTurma) references turma(codigo),
    foreign key(codigoDisciplina) references disciplina(codigo)
);

insert into turma_has_disciplina
	values (1,1);
    
-- BD --
CREATE USER adm@localhost IDENTIFIED BY 'f69d55cf595da72adec603bb68718e8d0aa53541';
CREATE VIEW professor_turma AS 
	SELECT * FROM usuario u WHERE u.codigo IN(
		SELECT * FROM turma_has_professor
	);
CREATE TRIGGER mostrarUsuario(
	AFTER INSERT
    ON usuario
    
);

select * from usuario;
select * from turma_has_professor;

select u.codigo, u.nome, u.email, u.matricula, u.usuario, u.senha, u.dtNascimento, u.foto, u.ocupacao from usuario u, disciplina d, professor_has_disciplina pd, aluno_has_disciplina ad 
where ad.codigoUsuario = 4 and ad.codigoDisciplina = d.codigo and pd.codigoDisciplina = d.codigo and pd.codigoUsuario = u.codigo group by u.codigo order by u.nome