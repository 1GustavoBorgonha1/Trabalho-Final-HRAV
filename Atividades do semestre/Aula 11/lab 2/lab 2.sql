CREATE TABLE TBPESSOA (

PESCODIGO SERIAL NOT NULL PRIMARY KEY,

PESNOME VARCHAR(150) NOT NULL,

PESSOBRENOME VARCHAR(150),

PESEMAIL VARCHAR(150),

PESPASSWORD TEXT,

PESCIDADE VARCHAR(100),

PESESTADO VARCHAR(2),

CREATEDAT TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,

UPDATEDAT TIMESTAMP

);