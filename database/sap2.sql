SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `asesores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `id_carrera` bigint(20) UNSIGNED NOT NULL,
  `sexo` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `asesores` (`id`, `id_usuario`, `id_carrera`, `sexo`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '1', '2020-01-22 10:55:00', '2020-01-22 10:55:00'),
(2, 8, 2, '1', '2020-01-22 10:55:09', '2020-01-22 10:55:09'),
(3, 9, 3, '2', '2020-01-22 10:55:19', '2020-01-22 10:55:19'),
(4, 10, 4, '2', '2020-01-22 10:55:29', '2020-01-22 10:55:29');







CREATE TABLE `caja_chica` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `monto` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `carreras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_facultad` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `carreras` (`id`, `id_facultad`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'DERECHO', NULL, NULL),
(2, 1, 'COMUNICACIÓN', NULL, NULL),
(3, 1, 'SOCIOLOGÍA', NULL, NULL),
(4, 2, 'MEDICINA', NULL, NULL),
(5, 3, 'ODONTOLOGÍA', NULL, NULL),
(6, 3, 'PRÓTESIS DENTAL', NULL, NULL),
(7, 4, 'BIOQUÍMICA', NULL, NULL),
(8, 4, 'QUÍMICA FARMACÉUTICA', NULL, NULL),
(9, 4, 'BIOLOGÍA', NULL, NULL),
(10, 5, 'CONTADURÍA PUBLICA', NULL, NULL),
(11, 5, 'ADMINISTRACIÓN FINANCIERA', NULL, NULL),
(12, 6, 'ECONOMÍA', NULL, NULL),
(13, 6, 'ADMINISTRACIÓN DE EMPRESAS', NULL, NULL),
(14, 6, 'INGENIERÍA COMERCIAL', NULL, NULL),
(15, 6, 'GERENCIA Y ADMINISTRACIÓN PUBLICA', NULL, NULL),
(16, 7, 'INGENIERÍA QUÍMICA', NULL, NULL),
(17, 7, 'INGENIERÍA ALIMENTOS', NULL, NULL),
(18, 7, 'INGENIERÍA INDUSTRIAL', NULL, NULL),
(19, 7, 'INGENIERÍA AMBIENTAL', NULL, NULL),
(20, 7, 'INGENIERÍA PETRÓLEO Y GAS NATURAL', NULL, NULL),
(21, 7, 'INGENIERÍA DE SISTEMAS', NULL, NULL),
(22, 7, 'INGENIERÍA TELECOMUNICACIONES', NULL, NULL),
(23, 7, 'INGENIERÍA DE DISEÑO Y ANIMACIÓN DIGITAL', NULL, NULL),
(24, 7, 'INGENIERÍA EN CIENCIAS DE LA COMPUTACIÓN', NULL, NULL),
(25, 7, 'INGENIERÍA TECNOLOGÍAS DE LA INFORMACIÓN Y SEGURIDAD', NULL, NULL),
(26, 7, 'INFORMÁTICA', NULL, NULL),
(27, 8, 'AGRONOMÍA', NULL, NULL),
(28, 8, 'INGENIERÍA AGRONÓMICA', NULL, NULL),
(29, 8, 'DESARROLLO RURAL', NULL, NULL),
(30, 8, 'INGENIERÍA AGROFORESTAL', NULL, NULL),
(31, 9, 'INGENIERÍA ZOOTECNIA', NULL, NULL),
(32, 9, 'MEDICINA VETERINARIA Y ZOOTECNIA', NULL, NULL),
(33, 10, 'IDIOMAS', NULL, NULL),
(34, 10, 'TURISMO', NULL, NULL),
(35, 10, 'PEDAGOGÍA', NULL, NULL),
(36, 10, 'PSICOLOGÍA', NULL, NULL),
(37, 10, 'TRABAJO SOCIAL', NULL, NULL),
(38, 10, 'GASTRONOMÍA', NULL, NULL),
(39, 11, 'CONSTRUCCIÓN CIVIL', NULL, NULL),
(40, 11, 'TOPOGRAFÍA', NULL, NULL),
(41, 11, 'GEODESIA Y TOPOGRAFÍA', NULL, NULL),
(42, 11, 'MECÁNICA AUTOMOTRIZ', NULL, NULL),
(43, 11, 'MECÁNICA INDUSTRIAL', NULL, NULL),
(44, 11, 'ELECTRICIDAD', NULL, NULL),
(45, 11, 'ELECTRÓNICA', NULL, NULL),
(46, 12, 'ENFERMERÍA', NULL, NULL),
(47, 12, 'ENFERMERÍA OBSTETRIZ', NULL, NULL),
(48, 12, 'AUXILIAR DE ENFERMERÍA', NULL, NULL),
(49, 13, 'BIO-IMAGENOLOGIA', NULL, NULL),
(50, 13, 'KINESIOLOGÍA Y FISIOTERAPIA', NULL, NULL),
(51, 13, 'LABORATORIO CLÍNICO', NULL, NULL),
(52, 13, 'NUTRICIÓN Y DIETÉTICA', NULL, NULL),
(53, 14, 'ARQUITECTURA', NULL, NULL),
(54, 14, 'DISEÑO INTERIORES', NULL, NULL),
(55, 14, 'ARTE Y DISEÑO GRAFICO', NULL, NULL),
(56, 15, 'INGENIERÍA CIVIL', NULL, NULL),
(57, 16, 'INGENIERÍA MECÁNICA', NULL, NULL),
(58, 16, 'INGENIERÍA ELÉCTRICA', NULL, NULL),
(59, 16, 'INGENIERÍA ELECTRÓNICA', NULL, NULL),
(60, 16, 'INGENIERÍA MECATRÓNICA', NULL, NULL),
(61, 16, 'INGENIERÍA ELECTROMECÁNICA', NULL, NULL);







CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_persona` bigint(20) UNSIGNED NOT NULL,
  `carnet` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `clientes` (`id`, `id_persona`, `carnet`, `created_at`, `updated_at`) VALUES
(1, 2, 'cu4193', '2020-01-22 10:54:29', '2020-01-22 10:54:29'),
(2, 3, 'cu7574', '2020-01-22 10:54:30', '2020-01-22 10:54:30'),
(3, 4, 'cu6133', '2020-01-22 10:54:31', '2020-01-22 10:54:31'),
(4, 5, 'cu5615', '2020-01-22 10:54:32', '2020-01-22 10:54:32'),
(5, 6, 'cu4996', '2020-01-22 10:54:33', '2020-01-22 10:54:33');







CREATE TABLE `contratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_contrato` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_asesor` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `id_tipo_contrato` bigint(20) UNSIGNED NOT NULL,
  `monto` double(15,2) NOT NULL,
  `daf` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `cotizaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `id_nivel_academico` bigint(20) UNSIGNED DEFAULT NULL,
  `id_tipo_cotizacion` bigint(20) UNSIGNED DEFAULT NULL,
  `curso` tinyint(4) DEFAULT NULL,
  `paralelo` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_medio` bigint(20) UNSIGNED DEFAULT NULL,
  `id_modalidad` bigint(20) UNSIGNED DEFAULT NULL,
  `tema` text COLLATE utf8mb4_unicode_ci,
  `avance` int(11) DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `precio_total` int(11) DEFAULT NULL,
  `validez` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `cotizaciones_basicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cotizacion` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `cotizaciones_generales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cotizacion_universitaria` bigint(20) UNSIGNED DEFAULT NULL,
  `id_facultad` bigint(20) UNSIGNED DEFAULT NULL,
  `id_carrera` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `cotizaciones_posgrado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cotizacion_universitaria` bigint(20) UNSIGNED DEFAULT NULL,
  `id_posgrado` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `cotizaciones_universitarias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cotizacion` bigint(20) UNSIGNED DEFAULT NULL,
  `id_universidad` bigint(20) UNSIGNED DEFAULT NULL,
  `id_profesion` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `egresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tipo_egreso` bigint(20) UNSIGNED NOT NULL,
  `id_tipo_pago` bigint(20) UNSIGNED NOT NULL,
  `concepto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_recibo` bigint(20) NOT NULL,
  `monto` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `etapas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `etapas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Docente', NULL, NULL),
(2, 'Tutor', NULL, NULL),
(3, 'Tribunal', NULL, NULL);







CREATE TABLE `facultades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `facultades` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'FACULTAD DE DERECHO, CIENCIAS SOCIALES Y POLÍTICAS', NULL, NULL),
(2, 'FACULTAD DE MEDICINA', NULL, NULL),
(3, 'FACULTAD DE ODONTOLOGÍA', NULL, NULL),
(4, 'FACULTAD DE CIENCIAS QUÍMICO - FARMACÉUTICAS Y BIOQUÍMICAS', NULL, NULL),
(5, 'FACULTAD DE CONTADURÍA PUBLICA Y CIENCIAS FINANCIERAS', NULL, NULL),
(6, 'FACULTAD DE CIENCIAS ECONÓMICAS Y EMPRESARIALES', NULL, NULL),
(7, 'FACULTAD DE TECNOLOGÍA', NULL, NULL),
(8, 'FACULTAD DE CIENCIAS AGRARIAS', NULL, NULL),
(9, 'FACULTAD INTEGRAL DEFENSORES DEL CHACO', NULL, NULL),
(10, 'FACULTAD DE HUMANIDADES Y CIENCIAS DE LA EDUCACIÓN', NULL, NULL),
(11, 'FACULTAD TÉCNICA', NULL, NULL),
(12, 'FACULTAD DE CIENCIAS DE ENFERMERÍA Y OBSTETRICIA', NULL, NULL),
(13, 'FACULTAD DE CIENCIAS Y TECNOLOGÍAS DE LA SALUD', NULL, NULL),
(14, 'FACULTAD DE ARQUITECTURA Y CIENCIAS DEL HÁBITAT', NULL, NULL),
(15, 'FACULTAD DE INGENIERÍA CIVIL', NULL, NULL),
(16, 'FACULTAD DE MECÁNICA', NULL, NULL);







CREATE TABLE `fichas_academicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `id_asesor` bigint(20) UNSIGNED DEFAULT NULL,
  `id_contrato` bigint(20) UNSIGNED DEFAULT NULL,
  `id_cotizacion` bigint(20) UNSIGNED NOT NULL,
  `plazo` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_etapa` bigint(20) UNSIGNED DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `fichas_economicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cotizacion` bigint(20) UNSIGNED NOT NULL,
  `id_contrato` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `grados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `ingresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tipo_ingreso` bigint(20) UNSIGNED NOT NULL,
  `concepto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo_pago` bigint(20) UNSIGNED NOT NULL,
  `numero_recibo` bigint(20) NOT NULL,
  `monto` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `medios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `medios` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Recomendación', NULL, NULL),
(2, 'Redes Sociales', NULL, NULL),
(3, 'Periódico', NULL, NULL),
(4, 'Clientes Antiguos', NULL, NULL),
(5, 'Television', NULL, NULL);







CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_12_17_131429_create_personas_table', 1),
(3, '2019_12_22_150105_create_niveles_table', 1),
(4, '2020_01_06_115610_create_users_table', 1),
(5, '2020_01_06_115716_create_facultades_table', 1),
(6, '2020_01_06_115717_create_carreras_table', 1),
(7, '2020_01_06_115718_create_asesores_table', 1),
(8, '2020_01_06_115830_create_clientes_table', 1),
(9, '2020_01_06_115847_create_universidades_table', 1),
(10, '2020_01_06_120256_create_grados_table', 1),
(11, '2020_01_06_120329_create_modalidades_table', 1),
(12, '2020_01_06_120346_create_medios_table', 1),
(13, '2020_01_06_120442_create_niveles_academicos_table', 1),
(14, '2020_01_06_120442_create_posgrados_table', 1),
(15, '2020_01_06_120442_create_profesiones_table', 1),
(16, '2020_01_06_120442_create_tipos_cotizacion_table', 1),
(17, '2020_01_06_120443_create_cotizaciones_table', 1),
(18, '2020_01_06_120918_create_tipos_pago_table', 1),
(19, '2020_01_06_121505_create_tipos_egreso_table', 1),
(20, '2020_01_06_122802_create_tipos_ingreso_table', 1),
(21, '2020_01_06_122813_create_ingresos_table', 1),
(22, '2020_01_06_122832_create_egresos_table', 1),
(23, '2020_01_06_122856_create_caja_chica_table', 1),
(24, '2020_01_06_122911_create_movimientos_table', 1),
(25, '2020_01_06_122949_create_etapas_table', 1),
(26, '2020_01_06_123028_create_tipos_contrato_table', 1),
(27, '2020_01_06_123048_create_contratos_table', 1),
(28, '2020_01_06_132952_create_fichas_academicas_table', 1),
(29, '2020_01_06_133019_create_observaciones_ficha_table', 1),
(30, '2020_02_23_003042_create_fichas_economicas_table', 1),
(31, '2020_02_23_003043_create_pagos_asesor_table', 1),
(32, '2020_02_23_003135_create_pagos_cliente_table', 1),
(33, '2020_03_04_174641_create_cotizaciones_universitarias_table', 1),
(34, '2020_03_04_174642_create_cotizaciones_posgrado_table', 1),
(35, '2020_03_04_174718_create_cotizaciones_generales_table', 1),
(36, '2020_04_18_150816_create_cotizaciones_basicas_table', 1);







CREATE TABLE `modalidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `modalidades` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Proyecto de grado', NULL, NULL),
(2, 'Tesis de grado', NULL, NULL),
(3, 'Trabajo de grado', NULL, NULL),
(4, 'Trabajo dirigido', NULL, NULL),
(5, 'Internado', NULL, NULL),
(6, 'Pasantía', NULL, NULL),
(7, 'Monografía', NULL, NULL),
(8, 'Tesina', NULL, NULL),
(9, 'Ensayo', NULL, NULL),
(10, 'Artículo', NULL, NULL);







CREATE TABLE `movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `monto` int(11) NOT NULL,
  `concepto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `niveles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `niveles` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', NULL, NULL),
(2, 'Asesor', NULL, NULL);







CREATE TABLE `niveles_academicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `niveles_academicos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Bachiller', NULL, NULL),
(2, 'Técnico Medio', NULL, NULL),
(3, 'Técnico Superior', NULL, NULL),
(4, 'Licenciatura', NULL, NULL),
(5, 'Diplomado', NULL, NULL),
(6, 'Especialidad', NULL, NULL),
(7, 'Doctorado', NULL, NULL),
(8, 'Maestría', NULL, NULL);







CREATE TABLE `observaciones_ficha` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ficha` bigint(20) UNSIGNED NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `pagos_asesor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `id_asesor` bigint(20) UNSIGNED NOT NULL,
  `id_modalidad` bigint(20) UNSIGNED NOT NULL,
  `id_egreso` bigint(20) UNSIGNED NOT NULL,
  `id_ficha_economica` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `pagos_cliente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ingreso` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `id_modalidad` bigint(20) UNSIGNED NOT NULL,
  `id_ficha_economica` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;







CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `estado` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `personas` (`id`, `nombre`, `apellido`, `cedula`, `telefono`, `celular`, `direccion`, `email`, `email_verified_at`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Alennys', 'Palma', '12345', '1234', '4321', 'Direccion ejemplo', 'alennyspalma@gmail.com', NULL, '1', NULL, NULL),
(2, 'Alberto', 'Montoya', '4193', '4193', '4193', '4193', 'email4193@gmail.com', NULL, '1', '2020-01-22 10:54:29', '2020-01-22 10:54:29'),
(3, 'Alfonso', 'Avila', '7574', '7574', '7574', '7574', 'email7574@gmail.com', NULL, '1', '2020-01-22 10:54:30', '2020-01-22 10:54:30'),
(4, 'Andrea', 'Suarez', '6133', '6133', '6133', '6133', 'email6133@gmail.com', NULL, '1', '2020-01-22 10:54:31', '2020-01-22 10:54:31'),
(5, 'Adriana', 'Machado', '5615', '5615', '5615', '5615', 'email5615@gmail.com', NULL, '1', '2020-01-22 10:54:32', '2020-01-22 10:54:32'),
(6, 'Brian', 'Monasterios', '4996', '4996', '4996', '4996', 'email4996@gmail.com', NULL, '1', '2020-01-22 10:54:33', '2020-01-22 10:54:33'),
(7, 'Bethoveen', 'Santiago', '4805', '4805', '4805', '4805', 'email4805@gmail.com', NULL, '1', '2020-01-22 10:54:35', '2020-01-22 10:54:35'),
(8, 'Barbara', 'Berroteran', '3848', '3848', '3848', '3848', 'email3848@gmail.com', NULL, '1', '2020-01-22 10:54:39', '2020-01-22 10:54:39'),
(9, 'Bellonce', 'Belandria', '791', '791', '791', '791', 'email791@gmail.com', NULL, '1', '2020-01-22 10:54:42', '2020-01-22 10:54:42'),
(10, 'Carlos', 'Rodriguez', '4940', '4940', '4940', '4940', 'email4940@gmail.com', NULL, '1', '2020-01-22 10:54:46', '2020-01-22 10:54:46'),
(11, 'Camilo', 'Orozco', '290', '290', '290', '290', 'email290@gmail.com', NULL, '1', '2020-01-22 10:54:49', '2020-01-22 10:54:49'),
(12, 'Carolina', 'Hidalgo', '6003', '6003', '6003', '6003', 'email6003@gmail.com', NULL, '1', '2020-01-22 10:54:59', '2020-01-22 10:54:59'),
(13, 'Carmen', 'Perez', '2963', '2963', '2963', '2963', 'email2963@gmail.com', NULL, '1', '2020-01-22 10:55:09', '2020-01-22 10:55:09'),
(14, 'Daniel', 'Mogollon', '6098', '6098', '6098', '6098', 'email6098@gmail.com', NULL, '1', '2020-01-22 10:55:19', '2020-01-22 10:55:19'),
(15, 'Dubraska', 'Leon', '9226', '9226', '9226', '9226', 'email9226@gmail.com', NULL, '1', '2020-01-22 10:55:28', '2020-01-22 10:55:28');







CREATE TABLE `posgrados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `posgrados` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Desarrollo web', NULL, NULL);







CREATE TABLE `profesiones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `profesiones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Abogado', NULL, NULL),
(2, 'Programador', NULL, NULL),
(3, 'Analista de Redes', NULL, NULL),
(4, 'Analista de Sistemas', NULL, NULL),
(5, 'Traumatólogo', NULL, NULL),
(6, 'Cirujano', NULL, NULL),
(7, 'Asistente Contable', NULL, NULL);







CREATE TABLE `tipos_contrato` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `tipos_contrato` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Estudiantes Universitarios', NULL, NULL),
(2, 'Egresados', NULL, NULL),
(3, 'Diplomados y Maestrias', NULL, NULL);







CREATE TABLE `tipos_cotizacion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `tipos_cotizacion` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Semestralizado', NULL, NULL),
(2, 'Anualizado', NULL, NULL);







CREATE TABLE `tipos_egreso` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `tipos_egreso` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Servicios básicos', NULL, NULL),
(2, 'Pagos de consultores', NULL, NULL),
(3, 'Devoluciones', NULL, NULL),
(4, 'Gastos', NULL, NULL),
(5, 'Planillas de sueldos', NULL, NULL),
(6, 'Otros', NULL, NULL);







CREATE TABLE `tipos_ingreso` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `tipos_ingreso` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Pagos de cliente', NULL, NULL),
(2, 'Otros Ingresos', NULL, NULL);







CREATE TABLE `tipos_pago` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `tipos_pago` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Depósito', NULL, NULL),
(2, 'Efectivo', NULL, NULL);







CREATE TABLE `universidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `universidades` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Universidad Mayor de San Francisco Xavier', NULL, NULL),
(2, 'Universidad Mayor de San Andrés', NULL, NULL),
(3, 'Universidad Pública de El Alto', NULL, NULL),
(4, 'Universidad Mayor de San Simón', NULL, NULL),
(5, 'Universidad Autónoma Gabriel Rene Moreno', NULL, NULL),
(6, 'Universidad Técnica de Oruro', NULL, NULL),
(7, 'Universidad Tomás Frías', NULL, NULL),
(8, 'Universidad Juan Misael Saracho', NULL, NULL),
(9, 'Universidad Autónoma de Beni José Ballivián', NULL, NULL),
(10, 'Universidad Nacional de Siglo XX', NULL, NULL),
(11, 'Universidad Amazónica de Pando', NULL, NULL),
(12, 'Escuela Militar de Ingeniería', NULL, NULL),
(13, 'Universidad Católica Boliviana San Pablo', NULL, NULL),
(14, 'Universidad Privada del Valle', NULL, NULL),
(15, 'Universidad de Aquino Bolivia - UDABOL', NULL, NULL),
(16, 'Universidad Nur', NULL, NULL),
(17, 'UPAL', NULL, NULL),
(18, 'Universidad La Salle', NULL, NULL),
(19, 'Universidad Loyola', NULL, NULL),
(20, 'Universidad Salesiana de Bolivia', NULL, NULL),
(21, 'Universidad San Francisco de Asís', NULL, NULL),
(22, 'UTB', NULL, NULL),
(23, 'Universidad Unión Bolivariana', NULL, NULL),
(24, 'Universidad Tecnológica Privada de Santa Cruz', NULL, NULL),
(25, 'Ucebol - Universidad Cristiana de Bolivia', NULL, NULL),
(26, 'Unikuljis', NULL, NULL),
(27, 'Universidad Evangélica Boliviana', NULL, NULL),
(28, 'Universidad Adventista de Bolivia', NULL, NULL),
(29, 'UNIOR', NULL, NULL);







CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_persona` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `users` (`id`, `id_nivel`, `username`, `password`, `id_persona`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'ale', '$2y$12$iaTS.B.jpp5HlTidno1bzemOkP.iR1pHy5r6wxn7Px9HHbvMg/pkm', 1, NULL, NULL, NULL),
(2, 1, 'username4805', '$2y$10$F.FzB7TN9KEj4LxYDtbmJuoOyDdcV8m.IYqKTimddfXEnZkBH1yDq', 7, NULL, '2020-01-22 10:54:36', '2020-01-22 10:54:36'),
(3, 1, 'username3848', '$2y$10$0atM4mSbTI20cEdzLP23Bu0s1SCNz7KHCSTL40TKrINP3jzShwEfW', 8, NULL, '2020-01-22 10:54:39', '2020-01-22 10:54:39'),
(4, 1, 'username791', '$2y$10$3vhST4dcxiqUKg81TXrjLeyf6jqSRj5iK/aS6RKd2AgR2fLVb0892', 9, NULL, '2020-01-22 10:54:42', '2020-01-22 10:54:42'),
(5, 1, 'username4940', '$2y$10$/h6wQPLJugBmoqo8qkQ/yeMtyyKiHZRmN.pHAGKQnt71YWTGHlp9e', 10, NULL, '2020-01-22 10:54:46', '2020-01-22 10:54:46'),
(6, 1, 'username290', '$2y$10$7I81YM9mBIs7MZ6F3HTsG.DKjhrSeVgqVTYlxXfQdYoOCHUp13AnC', 11, NULL, '2020-01-22 10:54:49', '2020-01-22 10:54:49'),
(7, 2, 'username6003', '$2y$10$lFjEdfmezRGU4qgl2VWvAupN5gGyK54vVpTTJWM70OmSf3pMo/ya2', 12, NULL, '2020-01-22 10:55:00', '2020-01-22 10:55:00'),
(8, 2, 'username2963', '$2y$10$7qAjrx82bXRD6lVITsd9geI4VnLpQl0obNiZ/DvUNgeTKZk2oaC8e', 13, NULL, '2020-01-22 10:55:09', '2020-01-22 10:55:09'),
(9, 2, 'username6098', '$2y$10$7ypTmTnbFeGIH1VjXx4CIOnopcJ39FLWcmqVRNdkETrP9gs1YgpMa', 14, NULL, '2020-01-22 10:55:19', '2020-01-22 10:55:19'),
(10, 2, 'username9226', '$2y$10$C.u8mavSK8Ozh.6MMjxtn.VNJYfGwoam72Ir9r8oaNGAVb2FqBYsG', 15, NULL, '2020-01-22 10:55:28', '2020-01-22 10:55:28');








ALTER TABLE `asesores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asesores_id_usuario_foreign` (`id_usuario`),
  ADD KEY `asesores_id_carrera_foreign` (`id_carrera`);




ALTER TABLE `caja_chica`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carreras_id_facultad_foreign` (`id_facultad`);




ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_id_persona_foreign` (`id_persona`);




ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contratos_id_asesor_foreign` (`id_asesor`),
  ADD KEY `contratos_id_cliente_foreign` (`id_cliente`),
  ADD KEY `contratos_id_tipo_contrato_foreign` (`id_tipo_contrato`),
  ADD KEY `contratos_daf_foreign` (`daf`);




ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cotizaciones_id_cliente_foreign` (`id_cliente`),
  ADD KEY `cotizaciones_id_nivel_academico_foreign` (`id_nivel_academico`),
  ADD KEY `cotizaciones_id_tipo_cotizacion_foreign` (`id_tipo_cotizacion`),
  ADD KEY `cotizaciones_id_medio_foreign` (`id_medio`),
  ADD KEY `cotizaciones_id_modalidad_foreign` (`id_modalidad`);




ALTER TABLE `cotizaciones_basicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cotizaciones_basicas_id_cotizacion_foreign` (`id_cotizacion`);




ALTER TABLE `cotizaciones_generales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cotizaciones_generales_id_cotizacion_universitaria_foreign` (`id_cotizacion_universitaria`),
  ADD KEY `cotizaciones_generales_id_facultad_foreign` (`id_facultad`),
  ADD KEY `cotizaciones_generales_id_carrera_foreign` (`id_carrera`);




ALTER TABLE `cotizaciones_posgrado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cotizaciones_posgrado_id_cotizacion_universitaria_foreign` (`id_cotizacion_universitaria`),
  ADD KEY `cotizaciones_posgrado_id_posgrado_foreign` (`id_posgrado`);




ALTER TABLE `cotizaciones_universitarias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cotizaciones_universitarias_id_cotizacion_foreign` (`id_cotizacion`),
  ADD KEY `cotizaciones_universitarias_id_universidad_foreign` (`id_universidad`),
  ADD KEY `cotizaciones_universitarias_id_profesion_foreign` (`id_profesion`);




ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `egresos_id_tipo_egreso_foreign` (`id_tipo_egreso`),
  ADD KEY `egresos_id_tipo_pago_foreign` (`id_tipo_pago`);




ALTER TABLE `etapas`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `facultades`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `fichas_academicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fichas_academicas_id_cliente_foreign` (`id_cliente`),
  ADD KEY `fichas_academicas_id_asesor_foreign` (`id_asesor`),
  ADD KEY `fichas_academicas_id_contrato_foreign` (`id_contrato`),
  ADD KEY `fichas_academicas_id_cotizacion_foreign` (`id_cotizacion`),
  ADD KEY `fichas_academicas_id_etapa_foreign` (`id_etapa`);




ALTER TABLE `fichas_economicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fichas_economicas_id_cotizacion_foreign` (`id_cotizacion`),
  ADD KEY `fichas_economicas_id_contrato_foreign` (`id_contrato`);




ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingresos_id_tipo_ingreso_foreign` (`id_tipo_ingreso`),
  ADD KEY `ingresos_id_tipo_pago_foreign` (`id_tipo_pago`);




ALTER TABLE `medios`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimientos_id_usuario_foreign` (`id_usuario`);




ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `niveles_academicos`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `observaciones_ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `observaciones_ficha_id_ficha_foreign` (`id_ficha`);




ALTER TABLE `pagos_asesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_asesor_id_usuario_foreign` (`id_usuario`),
  ADD KEY `pagos_asesor_id_asesor_foreign` (`id_asesor`),
  ADD KEY `pagos_asesor_id_modalidad_foreign` (`id_modalidad`),
  ADD KEY `pagos_asesor_id_egreso_foreign` (`id_egreso`),
  ADD KEY `pagos_asesor_id_ficha_economica_foreign` (`id_ficha_economica`);




ALTER TABLE `pagos_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_cliente_id_ingreso_foreign` (`id_ingreso`),
  ADD KEY `pagos_cliente_id_usuario_foreign` (`id_usuario`),
  ADD KEY `pagos_cliente_id_modalidad_foreign` (`id_modalidad`),
  ADD KEY `pagos_cliente_id_ficha_economica_foreign` (`id_ficha_economica`);




ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);




ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_cedula_unique` (`cedula`),
  ADD UNIQUE KEY `personas_email_unique` (`email`);




ALTER TABLE `posgrados`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `profesiones`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `tipos_contrato`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `tipos_cotizacion`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `tipos_egreso`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `tipos_ingreso`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `tipos_pago`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `universidades`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id_persona_foreign` (`id_persona`);








ALTER TABLE `asesores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;



ALTER TABLE `caja_chica`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `carreras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;



ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;



ALTER TABLE `contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `cotizaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;



ALTER TABLE `cotizaciones_basicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `cotizaciones_generales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `cotizaciones_posgrado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `cotizaciones_universitarias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `egresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `etapas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



ALTER TABLE `facultades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;



ALTER TABLE `fichas_academicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `fichas_economicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `grados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `medios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;



ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;



ALTER TABLE `modalidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;



ALTER TABLE `movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `niveles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;



ALTER TABLE `niveles_academicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;



ALTER TABLE `observaciones_ficha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `pagos_asesor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `pagos_cliente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;



ALTER TABLE `posgrados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;



ALTER TABLE `profesiones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;



ALTER TABLE `tipos_contrato`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



ALTER TABLE `tipos_cotizacion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;



ALTER TABLE `tipos_egreso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;



ALTER TABLE `tipos_ingreso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;



ALTER TABLE `tipos_pago`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;



ALTER TABLE `universidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;



ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;







ALTER TABLE `asesores`
  ADD CONSTRAINT `asesores_id_carrera_foreign` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asesores_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;




ALTER TABLE `carreras`
  ADD CONSTRAINT `carreras_id_facultad_foreign` FOREIGN KEY (`id_facultad`) REFERENCES `facultades` (`id`) ON DELETE CASCADE;




ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE CASCADE;




ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_daf_foreign` FOREIGN KEY (`daf`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contratos_id_asesor_foreign` FOREIGN KEY (`id_asesor`) REFERENCES `asesores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contratos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contratos_id_tipo_contrato_foreign` FOREIGN KEY (`id_tipo_contrato`) REFERENCES `tipos_contrato` (`id`) ON DELETE CASCADE;




ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_id_medio_foreign` FOREIGN KEY (`id_medio`) REFERENCES `medios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_id_modalidad_foreign` FOREIGN KEY (`id_modalidad`) REFERENCES `modalidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_id_nivel_academico_foreign` FOREIGN KEY (`id_nivel_academico`) REFERENCES `niveles_academicos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_id_tipo_cotizacion_foreign` FOREIGN KEY (`id_tipo_cotizacion`) REFERENCES `tipos_cotizacion` (`id`) ON DELETE CASCADE;




ALTER TABLE `cotizaciones_basicas`
  ADD CONSTRAINT `cotizaciones_basicas_id_cotizacion_foreign` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE;




ALTER TABLE `cotizaciones_generales`
  ADD CONSTRAINT `cotizaciones_generales_id_carrera_foreign` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_generales_id_cotizacion_universitaria_foreign` FOREIGN KEY (`id_cotizacion_universitaria`) REFERENCES `cotizaciones_universitarias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_generales_id_facultad_foreign` FOREIGN KEY (`id_facultad`) REFERENCES `facultades` (`id`) ON DELETE CASCADE;




ALTER TABLE `cotizaciones_posgrado`
  ADD CONSTRAINT `cotizaciones_posgrado_id_cotizacion_universitaria_foreign` FOREIGN KEY (`id_cotizacion_universitaria`) REFERENCES `cotizaciones_universitarias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_posgrado_id_posgrado_foreign` FOREIGN KEY (`id_posgrado`) REFERENCES `posgrados` (`id`) ON DELETE CASCADE;




ALTER TABLE `cotizaciones_universitarias`
  ADD CONSTRAINT `cotizaciones_universitarias_id_cotizacion_foreign` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_universitarias_id_profesion_foreign` FOREIGN KEY (`id_profesion`) REFERENCES `profesiones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizaciones_universitarias_id_universidad_foreign` FOREIGN KEY (`id_universidad`) REFERENCES `universidades` (`id`) ON DELETE CASCADE;




ALTER TABLE `egresos`
  ADD CONSTRAINT `egresos_id_tipo_egreso_foreign` FOREIGN KEY (`id_tipo_egreso`) REFERENCES `tipos_egreso` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `egresos_id_tipo_pago_foreign` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipos_pago` (`id`) ON DELETE CASCADE;




ALTER TABLE `fichas_academicas`
  ADD CONSTRAINT `fichas_academicas_id_asesor_foreign` FOREIGN KEY (`id_asesor`) REFERENCES `asesores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fichas_academicas_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fichas_academicas_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fichas_academicas_id_cotizacion_foreign` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fichas_academicas_id_etapa_foreign` FOREIGN KEY (`id_etapa`) REFERENCES `etapas` (`id`) ON DELETE CASCADE;




ALTER TABLE `fichas_economicas`
  ADD CONSTRAINT `fichas_economicas_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fichas_economicas_id_cotizacion_foreign` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE;




ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_id_tipo_ingreso_foreign` FOREIGN KEY (`id_tipo_ingreso`) REFERENCES `tipos_ingreso` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ingresos_id_tipo_pago_foreign` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipos_pago` (`id`) ON DELETE CASCADE;




ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;




ALTER TABLE `observaciones_ficha`
  ADD CONSTRAINT `observaciones_ficha_id_ficha_foreign` FOREIGN KEY (`id_ficha`) REFERENCES `fichas_academicas` (`id`) ON DELETE CASCADE;




ALTER TABLE `pagos_asesor`
  ADD CONSTRAINT `pagos_asesor_id_asesor_foreign` FOREIGN KEY (`id_asesor`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_asesor_id_egreso_foreign` FOREIGN KEY (`id_egreso`) REFERENCES `egresos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_asesor_id_ficha_economica_foreign` FOREIGN KEY (`id_ficha_economica`) REFERENCES `fichas_economicas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_asesor_id_modalidad_foreign` FOREIGN KEY (`id_modalidad`) REFERENCES `modalidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_asesor_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;




ALTER TABLE `pagos_cliente`
  ADD CONSTRAINT `pagos_cliente_id_ficha_economica_foreign` FOREIGN KEY (`id_ficha_economica`) REFERENCES `fichas_economicas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_cliente_id_ingreso_foreign` FOREIGN KEY (`id_ingreso`) REFERENCES `ingresos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_cliente_id_modalidad_foreign` FOREIGN KEY (`id_modalidad`) REFERENCES `modalidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_cliente_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;




ALTER TABLE `users`
  ADD CONSTRAINT `users_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE CASCADE;




