CREATE SEQUENCE dispositivo_dsp_sequencia_seq;

CREATE TABLE TB_DISPOSITIVO (
    CD_DISPOSITIVO INTEGER NOT NULL DEFAULT nextval('dispositivo_dsp_sequencia_seq'),
    NOME VARCHAR(50) NOT NULL,
    STATUS CHAR(1) NOT NULL,
    CONSTRAINT pk_grupo PRIMARY KEY (CD_DISPOSITIVO)
);

CREATE SEQUENCE perguntas_sequencia_seq;

CREATE TABLE TB_PERGUNTA(
				CD_PERGUNTA INTEGER NOT NULL DEFAULT nextval('perguntas_sequencia_seq'),
				DESC_PERGUNTA VARCHAR (150) NOT NULL,
				STATUS CHAR(1) NOT NULL,
				CONSTRAINT pk_pergunta PRIMARY KEY (CD_PERGUNTA)
);

ALTER TABLE TB_PERGUNTA
ALTER COLUMN status TYPE INTEGER USING status::integer;

CREATE SEQUENCE setor_sequencia_seq;

CREATE TABLE TB_SETOR(
				CD_SETOR INTEGER NOT NULL DEFAULT nextval('setor_sequencia_seq'),
				DESC_SETOR VARCHAR (150) NOT NULL,
				STATUS CHAR(1) NOT NULL,
				CONSTRAINT pk_setor PRIMARY KEY (CD_SETOR)
);

CREATE SEQUENCE pergunta_sequencia_seq;

CREATE TABLE TB_AVALIACAO(
				CD_AVALIACAO INTEGER NOT NULL DEFAULT nextval('pergunta_sequencia_seq'),
				CD_SETOR INTEGER NOT NULL,
				CD_PERGUNTA INTEGER NOT NULL,
				CD_DISPOSITIVO INTEGER NOT NULL,
				RESPOSTA VARCHAR(10) NOT NULL,
				FEEDBACK VARCHAR(150),
				DATA_RES TIMESTAMP NOT NULL,
				CONSTRAINT pk_avaliacao PRIMARY KEY (CD_AVALIACAO),		
				CONSTRAINT FK_SETOR FOREIGN KEY (CD_SETOR) REFERENCES TB_SETOR (CD_SETOR),
				CONSTRAINT FK_PERGUNTA FOREIGN KEY (CD_PERGUNTA) REFERENCES TB_PERGUNTA (CD_PERGUNTA),
				CONSTRAINT FK_DISPOSITIVO FOREIGN KEY (CD_DISPOSITIVO) REFERENCES TB_DISPOSITIVO (CD_DISPOSITIVO)
);

CREATE SEQUENCE usuario_sequencia_seq;

CREATE TABLE TB_USUARIO(
				CD_USUARIO INTEGER NOT NULL DEFAULT nextval('usuario_sequencia_seq'),
				USUARIO VARCHAR (50) NOT NULL,
				SENHA VARCHAR (255) NOT NULL,
				STATUS CHAR(1) NOT NULL,
				CONSTRAINT pk_usuario PRIMARY KEY (CD_USUARIO)
);

ALTER TABLE TB_DISPOSITIVO
ADD COLUMN cd_setor INTEGER,
ADD CONSTRAINT fk_dispositivo_setor FOREIGN KEY (cd_setor) REFERENCES TB_SETOR (cd_setor);

insert into tb_dispositivo (nome,status) values ('tablet',1,1);

insert into tb_setor (desc_setor,status) values ('entrada',1);

insert into tb_usuario (usuario,senha,status) values ('gustavo','1',1);

insert into tb_pergunta (desc_pergunta,status) values ('Desecreva seu atendimento',1);

insert into tb_pergunta (desc_pergunta,status) values ('Ecreva uma sujestão de melhoria',1);



