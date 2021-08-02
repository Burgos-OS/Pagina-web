CREATE DATABASE paqueteria;

    use paqueteria;

        CREATE TABLE cliente(
            cliente_id int(10) AUTO_INCREMENT PRIMARY KEY,
            nombre varchar(30) NOT NULL,
            primer_apellido varchar(15),
            segundo_apellido varchar(15),
            telefono varchar(20),
            codigo_postal decimal(6,0), 
            estado varchar(20),
            ciudad varchar(20),
            colonia varchar(20),
            fecha_nacimiento date,
            forma_pago varchar(15),
            date TIMESTAMP
        )ENGINE=innodb;

        CREATE TABLE accounts (
	        id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cliente int(10) NOT NULL,
  	        username varchar(50) NOT NULL,
  	        password varchar(255) NOT NULL,
  	        email varchar(100) NOT NULL,
            date TIMESTAMP,
                FOREIGN KEY (cliente) REFERENCES cliente(cliente_id)
        )ENGINE=innodb;

        CREATE TABLE paquete(
            paquete_id int(10) AUTO_INCREMENT PRIMARY KEY,
            contenido varchar(30),
            peso float NOT NULL,
            descripcion text,
            date TIMESTAMP
        )ENGINE=innodb;

        CREATE TABLE envio(
            envio_id int(10) AUTO_INCREMENT PRIMARY KEY,
            cuenta int(10),
            paquete int(10),
            codigo_postal decimal(6,0),
            estado varchar(20),
            colonia varchar(20),
            calle varchar(20),
            Descripcion text,
            nombre_destinatario varchar(30),
            Primer_apellido varchar(15),
            segundo_apellido varchar(15),
            pago float,
            etapa varchar(15),
            date TIMESTAMP,
                FOREIGN KEY (cuenta) REFERENCES accounts(id),
                FOREIGN KEY (paquete) REFERENCES paquete(paquete_id)
        )ENGINE=innodb;
