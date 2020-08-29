CREATE TABLE Administrator (
	idAdministrator int(11) NOT NULL AUTO_INCREMENT,
	email varchar(45) NOT NULL,
	password varchar(45) NOT NULL,
	PRIMARY KEY (idAdministrator)
);

INSERT INTO Administrator(idAdministrator,email, password) VALUES 
	('1', 'admin@udistrital.edu.co', md5('123')); 


CREATE TABLE Cliente (
	idCliente int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	correo varchar(45) DEFAULT NULL,
	PRIMARY KEY (idCliente)
);

CREATE TABLE TarjetaCredito (
	idTarjetaCredito int(11) NOT NULL AUTO_INCREMENT,
	cvc varchar(45) NOT NULL,
	fechaVencimiento date NOT NULL,
	cliente_idCliente int(11) NOT NULL,
	PRIMARY KEY (idTarjetaCredito)
);

ALTER TABLE TarjetaCredito
 	ADD FOREIGN KEY (cliente_idCliente) REFERENCES Cliente (idCliente); 

