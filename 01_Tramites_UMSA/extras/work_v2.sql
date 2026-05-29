-- Base de datos: `workflow`
-- (Reemplaza las tablas de tu base de datos workflow)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

-- --------------------------------------------------------
-- 1. Nueva estructura para `flujoproceso` (Corregida según pizarra)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `flujoproceso`;
CREATE TABLE `flujoproceso` (
  `flojo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `procesosiguiente` varchar(10) DEFAULT NULL,
  `topo` varchar(3) DEFAULT NULL,
  `rol` varchar(30) DEFAULT NULL,
  `pantalla` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `flujoproceso` (`flojo`, `proceso`, `procesosiguiente`, `topo`, `rol`, `pantalla`) VALUES
('F1', 'P1', 'P2', 'I', 'alumno', 'inicio'),
('F1', 'P2', 'P3', 'P', 'alumno', 'documentos'),
('F1', 'P3', 'P4', 'P', 'kardex', 'envio'),
('F1', 'P4', '', 'Q', 'kardex', 'constatar'),
('F1', 'P5', 'P6', 'P', 'tecnico', 'aceptar'),
('F1', 'P6', 'P1', 'P', 'tecnico', 'notificar'),
('F1', 'P7', '', 'I', 'tecnico', 'rechazar');

-- --------------------------------------------------------
-- 2. NUEVA TABLA: `flujocondicion` (Para el rombo de decisión)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `flujocondicion`;
CREATE TABLE `flujocondicion` (
  `flojo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `opcion` varchar(10) DEFAULT NULL,
  `procesosiguiente` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Aquí programamos la lógica de P4:
-- Si es 'Si' va a P5. Si es 'No' vuelve a P2.
INSERT INTO `flujocondicion` (`flojo`, `proceso`, `opcion`, `procesosiguiente`) VALUES
('F1', 'P4', 'Si', 'P5'),
('F1', 'P4', 'No', 'P2');

-- --------------------------------------------------------
-- 3. Estructura de tabla `seguimiento` (Sin el F2 falso)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `seguimiento`;
CREATE TABLE `seguimiento` (
  `nrotramite` int(11) DEFAULT NULL,
  `flojo` varchar(30) DEFAULT NULL,
  `proceso` varchar(30) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `fechaini` datetime DEFAULT NULL,
  `fechafin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `seguimiento` (`nrotramite`, `flojo`, `proceso`, `usuario`, `fechaini`, `fechafin`) VALUES
(1000, 'F1', 'P1', 'm1', '2026-05-04 14:00:00', '2026-05-04 14:10:00'),
(1000, 'F1', 'P2', 'm1', '2026-05-04 14:10:01', '2026-05-04 14:10:01'),
(1000, 'F1', 'P3', 'm2', '2026-05-04 18:00:02', NULL),
(1001, 'F1', 'P3', 'm1', '2026-05-21 15:03:46', NULL);

COMMIT;
