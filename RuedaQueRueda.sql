-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-06-2022 a las 12:22:17
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `RuedaQueRueda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id`, `usuario_id`, `descripcion`, `subtitulo`, `titulo`, `foto`, `tipo`, `puntuacion`) VALUES
(21, 1, 'Alpine da la sorpresa, y nos muestra sus dos modelos de pintura para los coches de 2022, donde el principal patrocinador, BWT, tiene una gran importancia. Las dos primeras carreras correran con la delivery con el color rosa como color principal', 'Alpine presenta sus dos deliverys para los coches de 2022', 'Presentacion coches F1 2022', 'articulo1653998501.jpg', 'f1', 0),
(22, 1, 'El coche presentado por ferrari al que han llamado F1-75, ha sorprendido a todos viendo esos pontones con una forma tan agresiva, apunta a ser de los mejores diseños de coches de F1 en este año 2022', 'Ferrari presenta su coche para 2022', 'Presentacion coches F1 2022', 'articulo1653999189.webp', 'f1', 0),
(23, 1, 'Mercedes busca la revancha contra RedBull en este 2022, después de perder el campeonato del año pasado en el ultimo GP. Para ello, han presentado hoy su nuevo diseño del coche para este 2022', 'Mercedes sorprende con la vuelta al color gris', 'Presentacion coches F1 2022', 'articulo1653999395.jpg', 'f1', 0),
(24, 1, 'Antes del comienzo de los grandes premios, el primero en Bharein, los pilotos y equipos tienen la oportunidad de probar el coche en pista, donde buscarán obtener el mejor coche posible para esta temporada', 'Comienza la pretemporada del campeonato', 'Campeonato de F1 2022', 'articulo1654000058.webp', 'f1', 0),
(25, 1, 'Ha sido un inicio de temporada bastante igualado, pole para Leclerc y le sigue de cerca Verstappen, parece ser que los que dominaran este año van a ser Ferrari y RedBull,', 'Leclerc consigue la pole', 'Clasificacion GP Bharein', 'articulo1654000447.png', 'f1', 0),
(26, 1, 'Ha sido una carrera nefasta para RedBull, donde sus dos pilotos abandonaron, ambos por problemas de fiabilidad, en Ferrari, Leclerc consigue la victoria y Carlos Sainz un segundo puesto. Alonso terminó 9º.', 'Catastrofe en RedBull, Ferrari festeja', 'GP Bharein 2022', 'articulo1654000694.jpg', 'f1', 0),
(27, 1, 'Despues de abandonar en la primera carrera en Bharein, Verstappen consigue la victoria en Arabia Saudi, seguido en segundo lugar por Leclerc y un tercer puesto de Carlos Sainz', 'Verstappen toma la revancha, Carlos Sainz vuelve a conseguir podio', 'GP Arabia Saudi 2022', 'articulo1654001203.jpg', 'f1', 0),
(28, 1, 'Verstappen vuelve a abandonar por una falla mecánica, Leclerc consigue la victoria y se consolida por mucho como el lider del campeonato, Alonso iba para conseguir la pole en la clasificacion, pero un fallo en el coche le hizo abortar la vuelta', 'S. Perez rescata un 2º para RedBull, Alpine ilusiona', 'GP Australia 2022', 'articulo1654001579.webp', 'f1', 0),
(30, 1, 'Mal GP para los españoles, ambos abandonaron, RedBull celebra el doblete, 1º Max, y 2º Checo, Leclerc cometio un error y termino 6º. Bottas consigue una gran cantidad de puntos para Alfa Romeo, quedando 5º.', 'Duro golpe a Ferrari, Bottas sorprende con un 5º', 'GP Imola 2022', 'articulo1654002410.jpg', 'f1', 0),
(31, 1, 'En este nuevo circuito de Miami, Verstappen se impuso a los 2 Ferraris, quedando primero, Lelcerc segundo y Carlos tercero. Rusell, quedó 5º, sigue con su racha.', 'Verstappen sobre los dos Ferrari', 'GP Miami 2022', 'articulo1654002651.jpg', 'f1', 0),
(32, 1, 'En lo que ha sido un GP espectacular, donde la estrategia era variable gracias a las altas temperaturas y degradacion, Verstappen consigue otra victoria consecutiva', 'Carrerón de Alonso, abandona Leclerc', 'GP España 2022', 'articulo1654002851.jpg', 'f1', 0),
(33, 1, 'En un gran premio con lluvia, la estrategia lo era todo, ahi es donde fallo Ferrari con Leclerc, relegandolo inevitablemente al 4º puesto. Carlos se impuso sobre las ordenes de Ferrari, lo que le hizo conseguir un segundo puesto', 'Victoria historica de Perez, Leclerc cabreado con Ferrari', 'GP Monaco 2022', 'articulo1654003078.jpg', 'f1', 0),
(34, 1, 'Después de su victoria en el GP de Mónaco, donde consiguió la 4º victoria consecutiva para RedBull, demostrando que si está al nivel, Checo renueva con RedBull dos años más', 'Checo Perez, contrato hasta 2024', 'RedBull renueva a uno de sus pilotos', 'articulo1654003289.jpg', 'f1', -2),
(35, 1, 'Sorprendente la remontada de RedBull y Verstappen sobre Ferrari y Leclerc, que conseguian una gran distancia en los primeros Grandes Premios. Rusell por encima de Hamilton, continua su racha quedando 5º o mejor en todas las carreras', 'Asi queda el campeonato despues de Mónaco', 'Clasificacion F1 2022', 'articulo1654004125.png', 'f1', 2),
(36, 1, 'El BMW M2 recibirá su segunda generación en 2022 dotado del motor de 3.0 litros y 6 cilindros que ya equipan modelos como el M3 y el M4. Llegarán dos versiones y mantendrá su sistema de propulsión en todo caso.', 'Nuevo adelanto para generar expectación', 'BMW M2 2023', 'articulo1654007222.jpg', 'noticia', 0),
(37, 1, 'En Volkswagen creen que tan sólo necesitan tres años más para superar las ventas de coches eléctricos de Tesla.\r\nEl gigante alemán está embarcado en una ofensiva sin precedentes para no perder el tren del vehículo eléctrico.', 'Diess cree que entonces las ventas de VW superarán a las de la marca de Elon Musk', 'Volkswagen cree que dejará atrás a Tesla en 2025', 'articulo1654007638.jpg', 'noticia', 0),
(38, 1, 'La particularidad de este Vision Gran Turismo es que cuenta con el motor de la icónica moto Suzuki Hayabusa.\r\n\r\nLa propuesta de Suzuki va más allá y combina el motor de gasolina con dos propulsores eléctricos para dotarse de tracción a las cuatro ruedas.', 'Una Hayabusa con cuatro ruedas', 'Suzuki Vision Gran Turismo', 'articulo1654007858.jpg', 'noticia', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `califica`
--

CREATE TABLE `califica` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `califica`
--

INSERT INTO `califica` (`id`, `usuario_id`, `articulo_id`, `puntuacion`) VALUES
(9, 5, 35, 1),
(10, 5, 34, -1),
(11, 5, 38, 1),
(12, 6, 35, 1),
(13, 6, 34, -1),
(14, 6, 38, -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220509200856', '2022-05-09 22:09:26', 210),
('DoctrineMigrations\\Version20220509203937', '2022-05-09 22:39:55', 101),
('DoctrineMigrations\\Version20220509204149', '2022-05-09 22:41:57', 51),
('DoctrineMigrations\\Version20220510083711', '2022-05-10 10:37:22', 153),
('DoctrineMigrations\\Version20220510204845', '2022-05-10 22:48:56', 62),
('DoctrineMigrations\\Version20220511154959', '2022-05-11 17:50:18', 64),
('DoctrineMigrations\\Version20220513101711', '2022-05-13 12:17:22', 114),
('DoctrineMigrations\\Version20220513102407', '2022-05-13 12:24:12', 20),
('DoctrineMigrations\\Version20220513104932', '2022-05-13 12:49:38', 23),
('DoctrineMigrations\\Version20220518101200', '2022-05-18 12:12:12', 142);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interactua`
--

CREATE TABLE `interactua` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `publicacion_id` int(11) NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `interactua`
--

INSERT INTO `interactua` (`id`, `usuario_id`, `publicacion_id`, `tipo`, `texto`) VALUES
(25, 1, 35, 'like', NULL),
(26, 1, 35, 'comentario', 'Muy buen logo! Pero me gusta mas en naranja.'),
(27, 1, 34, 'comentario', 'Muy chulo!'),
(28, 5, 39, 'like', NULL),
(29, 6, 39, 'like', NULL),
(30, 6, 39, 'comentario', 'Guau! Como mola!'),
(31, 1, 37, 'like', NULL),
(32, 1, 37, 'comentario', 'Muy Bonito!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `cv` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cilindrada` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `km` int(11) NOT NULL,
  `cambio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plazas` int(11) NOT NULL,
  `puertas` int(11) NOT NULL,
  `combustible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`id`, `usuario_id`, `modelo`, `precio`, `cv`, `descripcion`, `cilindrada`, `color`, `km`, `cambio`, `plazas`, `puertas`, `combustible`, `foto`) VALUES
(5, 1, 'Citroën Xsara Picasso', 4999, 90, 'Modelo del año 2005. Casi nuevo. Lo vendo por que ahora voy en bici', 19000, 'Gris', 170000, 'manual', 5, 5, 'diesel', 'oferta1654009935.jpg'),
(6, 1, 'Citroën ZX', 1199, 68, 'Reliquia del año 1997. Esta pequeña bestia tiene 68 CV pero parecen 200', 1900, 'Granate', 210000, 'manual', 5, 5, 'diesel', 'oferta1654010468.jpg'),
(7, 1, 'Opel Corsa', 2999, 120, 'Opel corsa biplaza. Esta un poco tocado de chapa y pintura pero de mecanica como nuevo.', 2500, 'blanco', 150000, 'manual', 2, 3, 'diesel', 'oferta1654010655.jpg'),
(8, 5, 'Citroën Berlingo', 6999, 90, 'Furgoneta Berlingo seminueva. Filtros y ruedas recién cambiados. Está sucia por dentro por que la usaba para transportar paja pero si la limpias tu te descuento 100€', 1700, 'Blanco', 80000, 'manual', 5, 5, 'diesel', 'oferta1654072392.jpg'),
(9, 5, 'Land Rover Santana', 12999, 75, 'Reliquia de LandRover conservada como nueva! La he usado muy poco y solo ha tenido un dueño, yo! La he mimado muy bien', 2500, 'Beige', 45000, 'manual', 7, 5, 'gasolina', 'oferta1654072502.jpg'),
(10, 6, 'BMW i3', 21000, 140, 'Coche electrico, con muchos botones para que te entretengas mientras conduces', 2000, 'azul', 70000, 'automatico', 5, 5, 'electrico', 'oferta1654073026.jpg'),
(11, 6, 'Lamborghini Urus', 250000, 350, 'SUV de altimisima gama para que lleves a tus hijos al colegio privado.', 3000, 'Negro', 120000, 'manual', 5, 5, 'gasolina', 'oferta1654073111.jpg'),
(12, 6, 'Seat Leon', 5500, 160, 'Vendo mi coche por que mi esposa dice que es muy feo y que canta a la vista... Está un poco sucio por dentro pero nada exagerado.', 2300, 'amarillo', 220000, 'manual', 5, 5, 'gasolina', 'oferta1654073359.jpg'),
(13, 5, 'Ferrari F40', 2000000, 750, 'Pocas unidades en todo el mundo. Venta libre sin modificaciones aprovecha!', 4000, 'rojo', 35000, 'manual', 2, 3, 'gasolina', 'oferta1654073546.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `usuario_id`, `puntuacion`) VALUES
(13, 1, 6658),
(14, 5, 621),
(15, 5, 3043),
(16, 6, 3352),
(17, 6, 1334),
(18, 1, 868),
(19, 1, 1485);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `usuario_id`, `foto`, `descripcion`) VALUES
(34, 1, 'publicacion1654009497.png', 'Comenzando a administrar la pagina! Este sera nuestro logo nº1'),
(35, 1, 'publicacion1654009535.png', 'Comenzando a administrar la pagina! Este sera nuestro logo nº2'),
(36, 5, 'publicacion1654072178.jpg', 'Hoy me crucé el desierto del Sahara con mi furgoneta. Es muy grande!'),
(37, 6, 'publicacion1654072696.webp', 'De ruta con mi 4x4 por la montaña!\r\nSe veian unas vistas muy bonitas.'),
(38, 6, 'publicacion1654072742.jpg', 'A ver si adivinais que coche es :p. Pista: no es  Lamborghini ni Ferrari'),
(39, 5, 'publicacion1654073710.jpg', 'Hoy he quedado con un amigo que decía que tenia una sorpresa para mi, y mirad con lo que ha venido a recogerme! Es un coche muy viejo y descapotable, no corre mucho pero mola mogollón!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `roles`, `password`, `nick`, `telefono`) VALUES
(1, 'super@admin.com', '[\"ROLE_SUPER_ADMIN\"]', '$2y$13$BPCnkVZPl9CahxtQ90IqXu1B.vZluVxtQ5aQrZ08XICwS8MyDEROu', 'SuperAdmin', 888888),
(5, 'usuario1@gmail.com', '[]', '$2y$13$shS2ARFuKf62yFKHDBXdd.vCKJemLo.B4ULPcf6hh6F1mSexL3bje', 'usuario1', 67676767),
(6, 'usuario2@gmail.com', '[]', '$2y$13$xTABiHOKV1VNxlkjAvx3CuyUwKnxG0niz6CQDdcPjMjK2kP7ih.t6', 'usuario2', 555555555);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_69E94E91DB38439E` (`usuario_id`);

--
-- Indices de la tabla `califica`
--
ALTER TABLE `califica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D0BDD4A7DB38439E` (`usuario_id`),
  ADD KEY `IDX_D0BDD4A72DBC2FC9` (`articulo_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `interactua`
--
ALTER TABLE `interactua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5B6357F9DB38439E` (`usuario_id`),
  ADD KEY `IDX_5B6357F99ACBB5E7` (`publicacion_id`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7479C8F2DB38439E` (`usuario_id`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A9C1580CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62F2085FDB38439E` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `califica`
--
ALTER TABLE `califica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `interactua`
--
ALTER TABLE `interactua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `FK_69E94E91DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `califica`
--
ALTER TABLE `califica`
  ADD CONSTRAINT `FK_D0BDD4A72DBC2FC9` FOREIGN KEY (`articulo_id`) REFERENCES `articulo` (`id`),
  ADD CONSTRAINT `FK_D0BDD4A7DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `interactua`
--
ALTER TABLE `interactua`
  ADD CONSTRAINT `FK_5B6357F99ACBB5E7` FOREIGN KEY (`publicacion_id`) REFERENCES `publicacion` (`id`),
  ADD CONSTRAINT `FK_5B6357F9DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `FK_7479C8F2DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `FK_A9C1580CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `FK_62F2085FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
