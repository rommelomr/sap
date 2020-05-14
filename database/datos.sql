insert into niveles (nombre) values ('Administrador') , ('Asesor');

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

INSERT INTO `universidades` (nombre) VALUES
('Universidad Mayor de San Francisco Xavier'),
('Universidad Mayor de San Andrés'),
('Universidad Pública de El Alto'),
('Universidad Mayor de San Simón'),
('Universidad Autónoma Gabriel Rene Moreno'),
('Universidad Técnica de Oruro'),
('Universidad Tomás Frías'),
('Universidad Juan Misael Saracho'),
('Universidad Autónoma de Beni José Ballivián'),
('Universidad Nacional de Siglo XX'),
('Universidad Amazónica de Pando'),
('Escuela Militar de Ingeniería'),
('Universidad Católica Boliviana San Pablo'),
('Universidad Privada del Valle'),
('Universidad de Aquino Bolivia - UDABOL'),
('Universidad Nur'),
('UPAL'),
('Universidad La Salle'),
('Universidad Loyola'),
('Universidad Salesiana de Bolivia'),
('Universidad San Francisco de Asís'),
('UTB'),
('Universidad Unión Bolivariana'),
('Universidad Tecnológica Privada de Santa Cruz'),
('Ucebol - Universidad Cristiana de Bolivia'),
('Unikuljis'),
('Universidad Evangélica Boliviana'),
('Universidad Adventista de Bolivia'),
('UNIOR');

INSERT INTO `etapas` (nombre) VALUES
('Docente'),
('Tutor'),
('Tribunal');

INSERT INTO `facultades` (nombre) VALUES

('FACULTAD DE DERECHO, CIENCIAS SOCIALES Y POLÍTICAS'),
('FACULTAD DE MEDICINA'),
('FACULTAD DE ODONTOLOGÍA'),
('FACULTAD DE CIENCIAS QUÍMICO - FARMACÉUTICAS Y BIOQUÍMICAS'),
('FACULTAD DE CONTADURÍA PUBLICA Y CIENCIAS FINANCIERAS'),
('FACULTAD DE CIENCIAS ECONÓMICAS Y EMPRESARIALES'),
('FACULTAD DE TECNOLOGÍA'),
('FACULTAD DE CIENCIAS AGRARIAS'),
('FACULTAD INTEGRAL DEFENSORES DEL CHACO'),
('FACULTAD DE HUMANIDADES Y CIENCIAS DE LA EDUCACIÓN'),
('FACULTAD TÉCNICA'),
('FACULTAD DE CIENCIAS DE ENFERMERÍA Y OBSTETRICIA'),
('FACULTAD DE CIENCIAS Y TECNOLOGÍAS DE LA SALUD'),
('FACULTAD DE ARQUITECTURA Y CIENCIAS DEL HÁBITAT'),
('FACULTAD DE INGENIERÍA CIVIL'),
('FACULTAD DE MECÁNICA');

insert into carreras (id_facultad, nombre) values 
(1, 'DERECHO'),
(1, 'COMUNICACIÓN'),
(1, 'SOCIOLOGÍA'),
(2, 'MEDICINA'),
(3, 'ODONTOLOGÍA'),
(3, 'PRÓTESIS DENTAL'),
(4, 'BIOQUÍMICA'),
(4, 'QUÍMICA FARMACÉUTICA'),
(4, 'BIOLOGÍA'),
(5, 'CONTADURÍA PUBLICA'),
(5, 'ADMINISTRACIÓN FINANCIERA'),
(6, 'ECONOMÍA'),
(6, 'ADMINISTRACIÓN DE EMPRESAS'),
(6, 'INGENIERÍA COMERCIAL'),
(6, 'GERENCIA Y ADMINISTRACIÓN PUBLICA'),
(7, 'INGENIERÍA QUÍMICA'),
(7, 'INGENIERÍA ALIMENTOS'),
(7, 'INGENIERÍA INDUSTRIAL'),
(7, 'INGENIERÍA AMBIENTAL'),
(7, 'INGENIERÍA PETRÓLEO Y GAS NATURAL'),
(7, 'INGENIERÍA DE SISTEMAS'),
(7, 'INGENIERÍA TELECOMUNICACIONES'),
(7, 'INGENIERÍA DE DISEÑO Y ANIMACIÓN DIGITAL'),
(7, 'INGENIERÍA EN CIENCIAS DE LA COMPUTACIÓN'),
(7, 'INGENIERÍA TECNOLOGÍAS DE LA INFORMACIÓN Y SEGURIDAD'),
(7, 'INFORMÁTICA'),
(8, 'AGRONOMÍA'),
(8, 'INGENIERÍA AGRONÓMICA'),
(8, 'DESARROLLO RURAL'),
(8, 'INGENIERÍA AGROFORESTAL'),
(9, 'INGENIERÍA ZOOTECNIA'),
(9, 'MEDICINA VETERINARIA Y ZOOTECNIA'),
(10, 'IDIOMAS'),
(10, 'TURISMO'),
(10, 'PEDAGOGÍA'),
(10, 'PSICOLOGÍA'),
(10, 'TRABAJO SOCIAL'),
(10, 'GASTRONOMÍA'),
(11, 'CONSTRUCCIÓN CIVIL'),
(11, 'TOPOGRAFÍA'),
(11, 'GEODESIA Y TOPOGRAFÍA'),
(11, 'MECÁNICA AUTOMOTRIZ'),
(11, 'MECÁNICA INDUSTRIAL'),
(11, 'ELECTRICIDAD'),
(11, 'ELECTRÓNICA'),
(12, 'ENFERMERÍA'),
(12, 'ENFERMERÍA OBSTETRIZ'),
(12, 'AUXILIAR DE ENFERMERÍA'),
(13, 'BIO-IMAGENOLOGIA'),
(13, 'KINESIOLOGÍA Y FISIOTERAPIA'),
(13, 'LABORATORIO CLÍNICO'),
(13, 'NUTRICIÓN Y DIETÉTICA'),
(14, 'ARQUITECTURA'),
(14, 'DISEÑO INTERIORES'),
(14, 'ARTE Y DISEÑO GRAFICO'),
(15, 'INGENIERÍA CIVIL'),
(16, 'INGENIERÍA MECÁNICA'),
(16, 'INGENIERÍA ELÉCTRICA'),
(16, 'INGENIERÍA ELECTRÓNICA'),
(16, 'INGENIERÍA MECATRÓNICA'),
(16, 'INGENIERÍA ELECTROMECÁNICA');

INSERT INTO `asesores` (`id`, `id_usuario`, `id_carrera`, `sexo`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '1', '2020-01-22 06:55:00', '2020-01-22 06:55:00'),
(2, 8, 2, '1', '2020-01-22 06:55:09', '2020-01-22 06:55:09'),
(3, 9, 3, '2', '2020-01-22 06:55:19', '2020-01-22 06:55:19'),
(4, 10, 4, '2', '2020-01-22 06:55:29', '2020-01-22 06:55:29');

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
('Clientes antiguos'),
('Amistad'),
('Redes sociales'),
('Televisión'),
('Periódico'),
('Radio'),
('Micros'),
('Banner'),
('Tarjeta personal'),
('Afiche'),
('Volante');

INSERT INTO `tipos_cotizacion` (nombre) VALUES
('Semestralizado'),
('Anualizado');

INSERT INTO `niveles_academicos` (nombre) VALUES
('Bachiller'),
('Técnico Medio'),
('Técnico Superior'),
('Licenciatura'),
('Diplomado'),
('Especialidad'),
('Maestría'),
('Doctorado');


INSERT INTO `profesiones` (nombre) VALUES
('Abogado'),
('Programador'),
('Analista de Redes'),
('Analista de Sistemas'),
('Traumatólogo'),
('Cirujano'),
('Asistente Contable');

INSERT INTO `posgrados` (nombre) VALUES
('Desarrollo web');

INSERT INTO `tipos_contrato` (nombre) VALUES
('Estudiantes Universitarios'),
('Egresados'),
('Diplomados y Maestrias');

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
