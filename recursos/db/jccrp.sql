/************************* TABLAS **************************/

/* tablas del inventario */

CREATE TABLE inv_categoria(
	id_categoria serial PRIMARY KEY,
	nombre varchar(50) NOT NULL,
	eliminado boolean DEFAULT false
);


CREATE TABLE inv_elemento(
	id_elemento serial PRIMARY KEY,
	id_categoria integer,
		CONSTRAINT elemnt_cat
		FOREIGN KEY (id_categoria)
		REFERENCES inv_categoria(id_categoria)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	nombre varchar(50) NOT NULL,
	cantidad integer NOT NULL DEFAULT 0,
	precio double precision NOT NULL DEFAULT 0,
	descripcion varchar(200),
	eliminado boolean DEFAULT false
);

CREATE TABLE movimiento(
	id_movimiento serial PRIMARY KEY,
	id_categoria integer,
	id_elemento integer,
	nombre varchar(50),
	accion varchar(30) NOT NULL,
	precio_old double precision,
	precio_new double precision,
	existencia_old integer,
	existencia_new integer,
	descripcion text,
	fecha date,
	hora time
);

/* galeria */

CREATE TABLE galeria(
	id_galeria serial PRIMARY KEY,
	urlfoto text NOT NULL DEFAULT 'user.jpg'
);


/* tablas de personal */

CREATE TABLE empleado(
	id_empleado serial PRIMARY KEY,
	id_galeria integer DEFAULT 1 NOT NULL,
		CONSTRAINT foto_empleado
		FOREIGN KEY (id_galeria)
		REFERENCES galeria(id_galeria)
		ON DELETE RESTRICT
		ON UPDATE CASCADE, 
	nombre 		varchar(40) NOT NULL,
	apellido	varchar(40) NOT NULL,
	cedula 		varchar(15) NOT NULL,
	telefono	varchar(11) NOT NULL,
	email 		varchar(30),
	cargo 		varchar(20) DEFAULT 'VENDEDOR' NOT NULL,
	eliminado boolean DEFAULT false
);

CREATE TABLE usuarios(
	id_usuarios serial PRIMARY KEY,
	id_empleado integer,
		CONSTRAINT user_empleado
		FOREIGN KEY (id_empleado)
		REFERENCES empleado(id_empleado)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	usuario varchar(20) NOT NULL,
	pass text NOT NULL,
	eliminado boolean DEFAULT false,
	nivel integer DEFAULT 1 NOT NULL
);

CREATE TABLE vehiculos(
	id_vehiculo serial PRIMARY KEY,
	matricula varchar(10) NOT NULL,
	marca varchar(20),
	modelo varchar(20),
	eliminado boolean DEFAULT false
);


/* Tablas de rutas */

CREATE TABLE zona(
	id_zona serial PRIMARY KEY,
	nombre varchar(50) NOT NULL
);


CREATE TABLE cliente(
	id_cliente serial PRIMARY KEY,
	id_zona integer,
		CONSTRAINT zona_cliente
		FOREIGN KEY (id_zona)
		REFERENCES zona(id_zona)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	nom_fiscal	varchar(35) NOT NULL,
	rif 		varchar(10) NOT NULL,
	telefono	varchar(11) NOT NULL,
	direccion	varchar(250) NOT NULL,
	eliminado 	boolean DEFAULT false
);


CREATE TABLE ruta(
	id_ruta serial PRIMARY KEY,
	id_vendedor1 integer,
		CONSTRAINT vendedor1_ruta
		FOREIGN KEY (id_vendedor1)
		REFERENCES empleado(id_empleado)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	id_vendedor2 integer,
		CONSTRAINT vendedor2_ruta
		FOREIGN KEY (id_vendedor2)
		REFERENCES empleado(id_empleado)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	id_vehiculo integer,
		CONSTRAINT vehiculo_ruta
		FOREIGN KEY (id_vehiculo)
		REFERENCES vehiculos(id_vehiculo)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	eliminado 	boolean DEFAULT false
);


CREATE TABLE dia_trabajo(
	id_diatrabajo serial PRIMARY KEY,
	id_ruta integer,
		CONSTRAINT cargamento_ruta
		FOREIGN KEY (id_ruta)
		REFERENCES ruta(id_ruta)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	id_zona integer,
	escolta text DEFAULT 'NO POSEE' NOT NULL,
	fecha date NOT NULL,
	estado varchar(20) NOT NULL DEFAULT 'espera'
);

CREATE TABLE cargamento(
	id_cargamento serial PRIMARY KEY,
	id_diatrabajo integer,
		CONSTRAINT cargamento_diatrabajo
		FOREIGN KEY (id_diatrabajo)
		REFERENCES dia_trabajo(id_diatrabajo)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	id_elemento integer,
		CONSTRAINT cargamento_elemento
		FOREIGN KEY (id_elemento)
		REFERENCES inv_elemento(id_elemento)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	cantidad_prod integer
);

CREATE TABLE cargo_historico(
	id_cargo serial PRIMARY KEY,
	id_cargamento int,
	id_diatrabajo int,
	id_elemento int,
	cantidad_prod int
);

/* tablas de facturacion */

CREATE TABLE factura(
	id_factura serial PRIMARY KEY,
	id_diatrabajo integer,
		CONSTRAINT factura_diatrabajo
		FOREIGN KEY (id_diatrabajo)
		REFERENCES dia_trabajo(id_diatrabajo)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	fact_serial varchar(40) NOT NULL,
	id_cliente integer,
		CONSTRAINT factura_cliente
		FOREIGN KEY (id_cliente)
		REFERENCES cliente(id_cliente)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	total_factura double precision DEFAULT 0,
	fecha date DEFAULT now()
);

CREATE TABLE compra(
	id_compra serial PRIMARY KEY,
	id_factura integer,
		CONSTRAINT factura_compra
		FOREIGN KEY (id_factura)
		REFERENCES factura(id_factura)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	id_elemento integer,
	cantidad_prod integer
);

/* auditor */


CREATE TABLE auditor(
	id_auditoria serial PRIMARY KEY,
	empleado int,
	user_sis text,
	accion text,
	modulo text,
	descripcion text,
	fecha date,
	hora time
);



/************************* TRIGGERS Y AUDITORIA **************************/

/******************** CAMBIAR ZONA HORARIA DE LA BASE DE DATOS A VENEZUELA ********************/
/*ALTER DATABASE jccrp SET timezone TO -04;*/

/******** TRIGGER ACTUALIZAR ESTADO USUARIO ********/
CREATE OR REPLACE FUNCTION habilitar_user_empleado() RETURNS TRIGGER AS
$$
BEGIN
	UPDATE usuarios SET eliminado = NEW.eliminado WHERE usuarios.id_empleado = OLD.id_empleado;
	RETURN new;
END
$$
LANGUAGE plpgsql;

CREATE TRIGGER actualiza_user AFTER UPDATE ON empleado
for each row execute procedure habilitar_user_empleado();
/************************************************/


/************* TRIGGER NUEVA CATEGORIA ***************/

CREATE OR REPLACE FUNCTION mov_new_categoria() RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO movimiento(id_categoria,nombre,accion,descripcion,fecha,hora)
	VALUES (NEW.id_categoria,NEW.nombre,'Nuevo','Se ha creado una nueva categoria',CURRENT_DATE,CURRENT_TIME);
	return new;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER mov_new_categoria_ai AFTER INSERT ON inv_categoria
for each row execute procedure mov_new_categoria();

/************* TRIGGER MODIFICAR CATEGORIA ***************/

CREATE OR REPLACE FUNCTION mov_mod_categoria() RETURNS TRIGGER AS
$$
BEGIN
	IF(OLD.eliminado = NEW.eliminado)THEN
		INSERT INTO movimiento(id_categoria,nombre,accion,descripcion,fecha,hora)
		VALUES (OLD.id_categoria,NEW.nombre,'Modificar',concat('Se ha modificado de:',OLD.nombre,' a:',NEW.nombre),CURRENT_DATE,CURRENT_TIME);
	END IF;
	IF(OLD.eliminado != NEW.eliminado AND NEW.eliminado = true)THEN
		INSERT INTO movimiento(id_categoria,nombre,accion,descripcion,fecha,hora)
		VALUES (OLD.id_categoria,NEW.nombre,'Eliminar','Se ha deshabilitado la categoria',CURRENT_DATE,CURRENT_TIME);
	END IF;
	IF(OLD.eliminado != NEW.eliminado AND NEW.eliminado = false)THEN
		INSERT INTO movimiento(id_categoria,nombre,accion,descripcion,fecha,hora)
		VALUES (OLD.id_categoria,NEW.nombre,'Habilitar','Se ha habilitado la categoria',CURRENT_DATE,CURRENT_TIME);
	END IF;
	return new;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER mov_mod_categoria_au AFTER UPDATE ON inv_categoria
for each row execute procedure mov_mod_categoria();




/***************** TRIGGER NUEVO ELEMENTO ************************/

CREATE OR REPLACE FUNCTION mov_nuevo_elemento() RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO movimiento(id_elemento,nombre,accion,precio_old,precio_new,existencia_old,existencia_new,descripcion,fecha,hora) 
	VALUES (NEW.id_elemento,NEW.nombre,'Nuevo',0,NEW.precio,0,NEW.cantidad,'Se ha creado nuevo elemento',CURRENT_DATE,CURRENT_TIME);
	return new;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER mov_elemt_ai AFTER INSERT ON inv_elemento
for each row execute procedure mov_nuevo_elemento();

/**************** TRIGGER MODIFICAR ELEMENTO **********************/

CREATE OR REPLACE FUNCTION mov_mod_elemento() RETURNS TRIGGER AS
$$
BEGIN
	/** INGRESO DE MERCANCIA **/
	IF(OLD.cantidad<NEW.cantidad)THEN
		INSERT INTO movimiento(id_elemento,nombre,accion,precio_old,existencia_old,existencia_new,descripcion,fecha,hora) 
		VALUES (OLD.id_elemento,OLD.nombre,'Ingreso Mercancia',OLD.precio,OLD.cantidad,NEW.cantidad,concat('Balance mercancia: ',NEW.cantidad-OLD.cantidad),CURRENT_DATE,CURRENT_TIME);
	END IF;

	/** SALIDA DE MERCANCIA **/
	IF (OLD.cantidad>NEW.cantidad)THEN
		INSERT INTO movimiento(id_elemento,nombre,accion,precio_old,existencia_old,existencia_new,descripcion,fecha,hora) 
		VALUES (OLD.id_elemento,OLD.nombre,'Salida Mercancia',OLD.precio,OLD.cantidad,NEW.cantidad,concat('Balance mercancia: ',NEW.cantidad-OLD.cantidad),CURRENT_DATE,CURRENT_TIME);
	END IF;

	/** CAMBIO DE PRECIO **/
	IF(OLD.precio!=NEW.precio)THEN
		INSERT INTO movimiento(id_elemento,nombre,accion,precio_old,precio_new,existencia_old,descripcion,fecha,hora) 
		VALUES (OLD.id_elemento,OLD.nombre,'Cambio Precio',OLD.precio,NEW.precio,OLD.cantidad,concat('Balance de precio: ',NEW.precio-OLD.precio),CURRENT_DATE,CURRENT_TIME);
	END IF;

	/** DESHABILITAR ELEMENTO **/
	IF(OLD.eliminado != NEW.eliminado AND NEW.eliminado = true)THEN
		INSERT INTO movimiento(id_elemento,nombre,accion,precio_old,existencia_old,descripcion,fecha,hora) 
		VALUES (OLD.id_elemento,OLD.nombre,'Eliminar',OLD.precio,OLD.cantidad,'Elemento Habilitado',CURRENT_DATE,CURRENT_TIME);
	END IF;

	/** HABILITAR ELEMENTO **/
	IF(OLD.eliminado != NEW.eliminado AND NEW.eliminado = false)THEN
		INSERT INTO movimiento(id_elemento,nombre,accion,precio_old,existencia_old,descripcion,fecha,hora) 
		VALUES (OLD.id_elemento,OLD.nombre,'Habilitar',OLD.precio,OLD.cantidad,'Elemento Habilitado',CURRENT_DATE,CURRENT_TIME);
	END IF;
	return new;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER mov_elemt_bu BEFORE UPDATE ON inv_elemento
for each row execute procedure mov_mod_elemento();


/*************** TRIGGER NUEVO HISTORICO CARGAMENTO *********/

CREATE OR REPLACE FUNCTION new_histo_cargo() RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO cargo_historico(id_cargamento,id_diatrabajo,id_elemento,cantidad_prod)
	VALUES (NEW.id_cargamento,NEW.id_diatrabajo,NEW.id_elemento,NEW.cantidad_prod);
	return new;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER new_histo_cargo_ai AFTER INSERT ON cargamento
for each row execute procedure new_histo_cargo();

/*************** TRIGGER DELETE HISTORICO CARGAMENTO *********/

CREATE OR REPLACE FUNCTION del_histo_cargo() RETURNS TRIGGER AS
$$
BEGIN
	DELETE FROM cargo_historico WHERE id_cargamento = OLD.id_cargamento;
	return new;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER del_histo_cargo_ad AFTER DELETE ON cargamento
for each row execute procedure del_histo_cargo();