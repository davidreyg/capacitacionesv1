-- Volcando datos para la tabla capacitaciones.items: ~1 rows (aproximadamente)
INSERT INTO `items` (`id`, `nombre`) VALUES
	(1, 'Tipo de accion de capacitación'),
	(2, 'Código de prioridad'),
	(3, 'Beneficio de la accion de la capacitación'),
	(4, 'Funciones de la accion de la capacitación'),
	(5, 'Objetivo de la capacitación'),
	(6, 'Acciones para aplicar lo aprendido');
-- Volcando datos para la tabla capacitaciones.respuestas: ~5 rows (aproximadamente)
INSERT INTO `respuestas` (`id`, `nombre`) VALUES
	(1, 'Curso'),
	(2, 'Taller'),
	(3, 'Dimoplado'),
	(4, 'Pasantia'),
	(5, 'Seminarios'),

	(6, 'Rendimiento sujeto a Observación'),
	(7, 'Nuevas Funciones'),
	(8, 'Cierre de Brechas'),
	(9, 'Brechas Identificadas en los Dxs.'),
	(10, 'Requerimiento de Entes Rectores'),
	(11, 'Rendimiento Distinguido'),
	(12, 'Necesidades Identificadas'),
	(13, 'Necesidades Identificadas E'),
	(14, 'Necesidades Identificadas por Servir'),

	(15, 'Beneficio Bajo'),
	(16, 'Beneficio Medio'),
	(17, 'Beneficio Alto'),

	(18, 'Funciones de soporte o complemento'),
	(19, 'Funciones directivas'),
	(20, 'Funciones sustantivas o de administración interna'),

	(21, 'Objetivo de Aprendizaje (sólo conocimiento)'),
	(22, 'Objetivo de Aprendizaje (conocimiento y habilidades)'),
	(23, 'Objetivo de desempeño'),

	(24, 'Cuestionario'),
	(25, 'Escala de Observación'),
	(26, 'Muestra de Trabajo'),
	(27, 'Entrevista Focus Group');
-- Volcando datos para la tabla capacitaciones.item_respuesta: ~5 rows (aproximadamente)
INSERT INTO `item_respuesta` (`item_id`, `respuesta_id`, `valor`) VALUES
	(1, 1, '1'),
	(1, 2, '2'),
	(1, 3, '3'),
	(1, 4, '4'),
	(1, 5, '5'),
	(2, 6, 'A'),
	(2, 7, 'B'),
	(2, 8, 'C'),
	(2, 9, 'C1'),
	(2, 10, 'C2'),
	(2, 11, 'C3'),
	(2, 12, 'D'),
	(2, 13, 'E'),
	(2, 14, 'F'),
	(3, 15, '1'),
	(3, 16, '2'),
	(3, 17, '3'),
	(4, 18, '1'),
	(4, 19, '2'),
	(4, 20, '3'),
	(5, 21, '1'),
	(5, 22, '2'),
	(5, 23, '3'),
	(6, 24, '1'),
	(6, 25, '2'),
	(6, 26, '3'),
	(6, 27, '4');