insert into niveles (nombre) values ('Administrador') , ('Asesor');
insert into carreras (nombre) values 
	('Informatica'), 
	('Telecomunicaciones'), 
	('Electronica'), 
	('Mecanica Automotriz');

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `cedula`, `telefono`, `celular`, `direccion`, `email`, `email_verified_at`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Alennys', 'Palma', 12345, 1234, 4321, 'Direccion ejemplo', 'alennyspalma@gmail.com', NULL, '1', NULL, NULL),
(2, 'Alberto', 'Montoya', 4193, 4193, 4193, '4193', 'email4193@gmail.com', NULL, '1', '2020-01-22 06:54:29', '2020-01-22 06:54:29'),
(3, 'Alfonso', 'Avila', 7574, 7574, 7574, '7574', 'email7574@gmail.com', NULL, '1', '2020-01-22 06:54:30', '2020-01-22 06:54:30'),
(4, 'Andrea', 'Suarez', 6133, 6133, 6133, '6133', 'email6133@gmail.com', NULL, '1', '2020-01-22 06:54:31', '2020-01-22 06:54:31'),
(5, 'Adriana', 'Machado', 5615, 5615, 5615, '5615', 'email5615@gmail.com', NULL, '1', '2020-01-22 06:54:32', '2020-01-22 06:54:32'),
(6, 'Brian', 'Monasterios', 4996, 4996, 4996, '4996', 'email4996@gmail.com', NULL, '1', '2020-01-22 06:54:33', '2020-01-22 06:54:33'),
(7, 'Bethoveen', 'Santiago', 4805, 4805, 4805, '4805', 'email4805@gmail.com', NULL, '1', '2020-01-22 06:54:35', '2020-01-22 06:54:35'),
(8, 'Barbara', 'Berroteran', 3848, 3848, 3848, '3848', 'email3848@gmail.com', NULL, '1', '2020-01-22 06:54:39', '2020-01-22 06:54:39'),
(9, 'Bellonce', 'Belandria', 791, 791, 791, '791', 'email791@gmail.com', NULL, '1', '2020-01-22 06:54:42', '2020-01-22 06:54:42'),
(10, 'Carlos', 'Rodriguez', 4940, 4940, 4940, '4940', 'email4940@gmail.com', NULL, '1', '2020-01-22 06:54:46', '2020-01-22 06:54:46'),
(11, 'Camilo', 'Orozco', 290, 290, 290, '290', 'email290@gmail.com', NULL, '1', '2020-01-22 06:54:49', '2020-01-22 06:54:49'),
(12, 'Carolina', 'Hidalgo', 6003, 6003, 6003, '6003', 'email6003@gmail.com', NULL, '1', '2020-01-22 06:54:59', '2020-01-22 06:54:59'),
(13, 'Carmen', 'Perez', 2963, 2963, 2963, '2963', 'email2963@gmail.com', NULL, '1', '2020-01-22 06:55:09', '2020-01-22 06:55:09'),
(14, 'Daniel', 'Mogollon', 6098, 6098, 6098, '6098', 'email6098@gmail.com', NULL, '1', '2020-01-22 06:55:19', '2020-01-22 06:55:19'),
(15, 'Dubraska', 'Leon', 9226, 9226, 9226, '9226', 'email9226@gmail.com', NULL, '1', '2020-01-22 06:55:28', '2020-01-22 06:55:28');

INSERT INTO `users` (`id`, `id_nivel`, `username`, `password`, `id_persona`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'ale', '$2y$12$iaTS.B.jpp5HlTidno1bzemOkP.iR1pHy5r6wxn7Px9HHbvMg/pkm', 1, NULL, NULL, NULL),
(2, 1, 'username4805', '$2y$10$F.FzB7TN9KEj4LxYDtbmJuoOyDdcV8m.IYqKTimddfXEnZkBH1yDq', 7, NULL, '2020-01-22 06:54:36', '2020-01-22 06:54:36'),
(3, 1, 'username3848', '$2y$10$0atM4mSbTI20cEdzLP23Bu0s1SCNz7KHCSTL40TKrINP3jzShwEfW', 8, NULL, '2020-01-22 06:54:39', '2020-01-22 06:54:39'),
(4, 1, 'username791', '$2y$10$3vhST4dcxiqUKg81TXrjLeyf6jqSRj5iK/aS6RKd2AgR2fLVb0892', 9, NULL, '2020-01-22 06:54:42', '2020-01-22 06:54:42'),
(5, 1, 'username4940', '$2y$10$/h6wQPLJugBmoqo8qkQ/yeMtyyKiHZRmN.pHAGKQnt71YWTGHlp9e', 10, NULL, '2020-01-22 06:54:46', '2020-01-22 06:54:46'),
(6, 1, 'username290', '$2y$10$7I81YM9mBIs7MZ6F3HTsG.DKjhrSeVgqVTYlxXfQdYoOCHUp13AnC', 11, NULL, '2020-01-22 06:54:49', '2020-01-22 06:54:49'),
(7, 2, 'username6003', '$2y$10$lFjEdfmezRGU4qgl2VWvAupN5gGyK54vVpTTJWM70OmSf3pMo/ya2', 12, NULL, '2020-01-22 06:55:00', '2020-01-22 06:55:00'),
(8, 2, 'username2963', '$2y$10$7qAjrx82bXRD6lVITsd9geI4VnLpQl0obNiZ/DvUNgeTKZk2oaC8e', 13, NULL, '2020-01-22 06:55:09', '2020-01-22 06:55:09'),
(9, 2, 'username6098', '$2y$10$7ypTmTnbFeGIH1VjXx4CIOnopcJ39FLWcmqVRNdkETrP9gs1YgpMa', 14, NULL, '2020-01-22 06:55:19', '2020-01-22 06:55:19'),
(10, 2, 'username9226', '$2y$10$C.u8mavSK8Ozh.6MMjxtn.VNJYfGwoam72Ir9r8oaNGAVb2FqBYsG', 15, NULL, '2020-01-22 06:55:28', '2020-01-22 06:55:28');

INSERT INTO `clientes` (`id`, `id_persona`, `carnet`, `created_at`, `updated_at`) VALUES
(1, 2, 'cu4193', '2020-01-22 06:54:29', '2020-01-22 06:54:29'),
(2, 3, 'cu7574', '2020-01-22 06:54:30', '2020-01-22 06:54:30'),
(3, 4, 'cu6133', '2020-01-22 06:54:31', '2020-01-22 06:54:31'),
(4, 5, 'cu5615', '2020-01-22 06:54:32', '2020-01-22 06:54:32'),
(5, 6, 'cu4996', '2020-01-22 06:54:33', '2020-01-22 06:54:33');

INSERT INTO `asesores` (`id`, `id_usuario`, `id_carrera`, `sexo`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '1', '2020-01-22 06:55:00', '2020-01-22 06:55:00'),
(2, 8, 2, '1', '2020-01-22 06:55:09', '2020-01-22 06:55:09'),
(3, 9, 3, '2', '2020-01-22 06:55:19', '2020-01-22 06:55:19'),
(4, 10, 4, '2', '2020-01-22 06:55:29', '2020-01-22 06:55:29');

INSERT INTO `universidades` (nombre) VALUES
('Universidad Mayor de San Fco. Xavier (USFX) - (Chuquisaca)'),
('Universidad Autónoma Tomás Frías (AUTF) - (Potosi)'),
('Universidad Mayor de San Simón (UMSS) - (Cochabamba)'),
('Universidad Mayor de San Andrés (UMSA) - (La paz)'),
('Universidad Salesiana de Bolivia (USALESIANA) - (Bolivia)'),
('Universidad Técnica de ORURO (UTO) - (Oruro)'),
('Universidad Autónoma Gabriel René Moreno (UAGRM) - (Santa Cruz)'),
('Universidad Autónoma Juan Misael Saracho (UAJMS) - (Tarija)'),
('Universidad A. del Beni José Ballivián (UABJB) - (Beni)'),
('Universidad Andina Simón Bolívar (UASB) - (Chuquisaca)'),
('Escuela Militar de Ingeniería (EMI) - (Cochabamba, La Paz)'),
('Escuela Pública de El Alto (UPEA) - (El Alto)'),
('Universidad Nacional del Siglo XX (UNSXX) - (Potosi)'),
('Universidad Nacional del Oriente (UNO) - (Santa Cruz)'),
('Universidad Nacional Ecológica Santa Cruz (UECOLOGICA) - (Santa Cruz)'),
('Otros - (Chuquisaca)');

INSERT INTO `etapas` (nombre) VALUES
('Docente'),
('Tutor'),
('Tribunal');

INSERT INTO `facultades` (nombre) VALUES
('Ciencias Sociales y Humanísticas'),
('Ciencias de la Salud'),
('Ciencias Económicas y financieras'),
('Ciencias Tecnológicas y Agrarias');

INSERT INTO `modalidades` (nombre) VALUES
('Proyecto de grado'),
('Tesis de grado'),
('Trabajo de grado'),
('Trabajo dirigido'),
('Internado'),
('Pasantía'),
('Monografía'),
('Tesina'),
('Ensayo'),
('Artículo');

INSERT INTO `medios` (nombre) VALUES
('Recomendación'),
('Redes Sociales'),
('Periódico'),
('Clientes Antiguos'),
('Television');

INSERT INTO `cursos` (nombre) VALUES
('Semestralizado'),
('Anualizado');

INSERT INTO `niveles_academicos` (nombre) VALUES
('Bachiller'),
('Técnico Medio'),
('Técnico Superior'),
('Licenciatura'),
('Ingeniería'),
('Diplomado'),
('Especialidad'),
('Doctorado'),
('Maestría');


INSERT INTO `profesiones` (nombre) VALUES
('Abogado'),
('Programador'),
('Analista de Redes'),
('Analista de Sistemas'),
('Traumatólogo'),
('Cirujano'),
('Asistente Contable');

INSERT INTO `cotizaciones` (id_profesion,created_at, updated_at, id_curso, id_nivel_academico, numero_cotizacion, id_cliente, id_universidad, id_modalidad, id_medio, tema, avance, observaciones, precio_total, validez) VALUES
(1,'2020-01-01','2020-02-01',1,1,1,1, 1, 5, 1,'tema 6', 6, 'Observacion 6', 16, 10),
(2,'2020-01-01','2020-02-01',2,6,2,2, 2, 6, 2,'tema 7', 7, 'Observacion 7', 17, 10),
(3,'2020-01-01','2020-02-01',1,7,3,3, 3, 7, 3,'tema 8', 8, 'Observacion 8', 18, 10),
(4,'2020-01-01','2020-02-01',2,8,4,4, 4, 8, 4,'tema 9', 1, 'Observacion 9', 19, 10),
(5,'2020-01-01','2020-02-01',1,5,5,5, 5, 1, 5,'tema 10',2, 'Observacion 0', 10, 10),
(6,'2020-01-01','2020-02-01',2,6,6,1, 6, 2, 1,'tema 6', 3, 'Observacion 6', 16, 10),
(7,'2020-01-01','2020-02-01',1,7,7,2, 7, 3, 3,'tema 7', 4, 'Observacion 7', 17, 10),
(1,'2020-01-01','2020-02-01',2,8,8,3, 8, 4, 4,'tema 8', 5, 'Observacion 8', 18, 10),
(2,'2020-01-01','2020-02-01',1,1,8,4, 1, 5, 5,'tema 9', 6, 'Observacion 9', 19, 10),
(3,'2020-01-01','2020-02-01',2,9,10,5,2, 6, 1,'tema 10',7, 'Observacion 0', 10, 10);

INSERT INTO `cotizaciones_generales` (id_cotizacion, id_facultad, id_carrera) VALUES
(1,1,1),
(5,2,2),
(6,3,3),
(7,4,4),
(8,1,1),
(9,2,2);

INSERT INTO `cotizaciones_posgrado` (id_cotizacion) VALUES
(2),
(3),
(4),
(10);
INSERT INTO `tipos_contrato` (nombre) VALUES
('Estudiantes Universitarios'),
('Egresados'),
('Diplomados y Maestrias');

INSERT INTO `contratos` (`id`, `numero_contrato`, `id_asesor`, `id_cliente`, `id_tipo_contrato`, `monto`, `daf`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 100, 2,'2020-01-01','2020-02-01'),
(2, 2, 2, 2, 2, 50, 3, '2020-01-01','2020-02-01'),
(3, 3, 3, 3, 3, 150, 4, '2020-01-01','2020-02-01');

INSERT INTO `fichas_academicas` (id_cliente,id_asesor,id_contrato,id_cotizacion,fecha_inicio,plazo,fecha_fin,id_etapa,created_at,updated_at,estado) VALUES
(1,1,1,1,'2020-02-16',51,'2020-05-16',1,NULL,NULL,0),
(2,2,2,2,'2020-02-16',60,'2020-06-16',2, NULL,NULL,0),
(3,3,3,3,'2020-02-16',70,'2020-07-16',3, NULL,NULL,0);

INSERT INTO `tipos_ingreso` (nombre) VALUES
('Pagos de cliente'),
('Otros Ingresos');

INSERT INTO `tipos_pago` (nombre) VALUES
('Depósito'),
('Efectivo');

INSERT INTO `tipos_egreso` (nombre) VALUES
('Servicios básicos'),
('Pagos de consultores'),
('Devoluciones'),
('Gastos'),
('Planillas de sueldos'),
('Otros');

INSERT INTO `ingresos` (id_tipo_ingreso,concepto, id_tipo_pago, numero_recibo, monto) VALUES
(1,'concepto de ingreso',1,1,200),
(2,'concepto de ingreso',1,2,400),
(2,'concepto de ingreso',1,3,400),
(2,'concepto de ingreso',1,4,400),
(2,'concepto de ingreso',1,5,400),
(2,'concepto de ingreso',1,6,400),
(2,'concepto de ingreso',1,7,400),
(2,'concepto de ingreso',1,8,400),
(2,'concepto de ingreso',1,9,400),
(2,'concepto de ingreso',1,10,400),
(2,'concepto de ingreso',1,11,400),
(2,'concepto de ingreso',1,12,400),
(2,'concepto de ingreso',1,13,400),
(2,'concepto de ingreso',1,14,400),
(2,'concepto de ingreso',1,15,300);

INSERT INTO `egresos` (id_tipo_pago,id_tipo_egreso, concepto, numero_recibo, monto) VALUES
(1,1,'concepto de egreso',16,500),
(1,2,'concepto de egreso',17,400),
(1,2,'concepto de egreso',18,400),
(1,2,'concepto de egreso',19,400),
(1,2,'concepto de egreso',20,400),
(1,2,'concepto de egreso',21,400),
(1,2,'concepto de egreso',22,400),
(1,2,'concepto de egreso',24,400),
(1,2,'concepto de egreso',25,400),
(1,2,'concepto de egreso',26,400),
(1,2,'concepto de egreso',27,400),
(1,2,'concepto de egreso',28,400),
(1,2,'concepto de egreso',29,400),
(1,2,'concepto de egreso',30,400);

INSERT INTO `fichas_economicas` (id_cotizacion, id_contrato,created_at,updated_at) VALUES
(1,1,'2020-02-01','2020-03-01'),
(2,2,'2020-02-01','2020-03-01'),
(3,3,'2020-02-01','2020-03-01');

INSERT INTO `pagos_asesor` (id_modalidad,id_usuario,id_asesor,id_egreso, id_ficha_economica,created_at,updated_at) VALUES
(1,1,1,1,1,'2020-02-01','2020-03-01'),
(2,1,2,2,2,'2020-02-01','2020-03-01'),
(2,1,2,3,2,'2020-02-01','2020-03-01'),
(2,1,2,4,2,'2020-02-01','2020-03-01'),
(2,1,2,5,2,'2020-02-01','2020-03-01'),
(2,1,2,6,2,'2020-02-01','2020-03-01'),
(2,1,2,7,2,'2020-02-01','2020-03-01'),
(2,1,2,8,2,'2020-02-01','2020-03-01'),
(2,1,2,9,2,'2020-02-01','2020-03-01'),
(2,1,2,10,2,'2020-02-01','2020-03-01'),
(2,1,2,11,2,'2020-02-01','2020-03-01'),
(2,1,2,12,2,'2020-02-01','2020-03-01'),
(2,1,2,13,2,'2020-02-01','2020-03-01'),
(2,1,2,14,2,'2020-02-01','2020-03-01');

INSERT INTO `pagos_cliente` (id_usuario,id_modalidad,id_ingreso, id_ficha_economica,created_at,updated_at) VALUES
(1,1,1,1,'2020-02-01','2020-03-01'),
(1,2,2,2,'2020-02-01','2020-03-01'),
(1,2,3,2,'2020-02-01','2020-03-01'),
(1,2,4,2,'2020-02-01','2020-03-01'),
(1,2,5,2,'2020-02-01','2020-03-01'),
(1,2,6,2,'2020-02-01','2020-03-01'),
(1,2,7,2,'2020-02-01','2020-03-01'),
(1,2,8,2,'2020-02-01','2020-03-01'),
(1,2,9,2,'2020-02-01','2020-03-01'),
(1,2,10,2,'2020-02-01','2020-03-01'),
(1,2,11,2,'2020-02-01','2020-03-01'),
(1,2,12,2,'2020-02-01','2020-03-01'),
(1,2,13,2,'2020-02-01','2020-03-01'),
(1,2,14,2,'2020-02-01','2020-03-01');

INSERT INTO `caja_chica` (monto, created_at, updated_at) VALUES
(4000.18,'2020-03-13','2020-03-13');

INSERT INTO `movimientos` (id_usuario,tipo,concepto,monto,created_at,updated_at) values 
(1,1,'concepto ingreso',1000,'2020-03-13','2020-03-13'),
(1,1,'concepto ingreso',1000,'2020-03-13','2020-03-13'),
(1,1,'concepto ingreso',1000,'2020-03-13','2020-03-13'),
(1,1,'concepto ingreso',1000,'2020-03-13','2020-03-13'),
(1,2,'concepto egreso',1000,'2020-03-13','2020-03-13'),
(1,1,'concepto ingreso',1000.18,'2020-03-13','2020-03-13');
