
-- Inserciones en la tabla tipo_contacto
INSERT INTO tipo_contactos (id, nombre) VALUES
(1, 'Golpeada Contra (chocar contra algo)'),
(2, 'Golpeado por (Impactado por objeto en movimiento)'),
(3, 'Caída a un nivel más bajo'),
(4, 'Caída en el mismo nivel (Resbalar y caer, tropezar)'),
(5, 'Atrapado (Puntos de Pellizco y Mordida)'),
(6, 'Cogido (Enganchado, Colgado)'),
(7, 'Atrapado entre o debajo (Chancado, Amputado)'),
(8, 'Contacto con (Electricidad, Calor, Frío, Radiación, Caústicos, Tóxicos, Ruido)'),
(9, 'Sobretensión; Sobre-esfuerzo; Sobrecarga');

-- Inserciones en la tabla CausasInmediatas
INSERT INTO causa_inmediatas (id, nombre) VALUES
(1, 'Operar equipo sin autorización (Ver CB 2,3,4,5,7,8,12,13,15)'),
(2, 'Omisión de advertir (Ver CB 1,2,3,4,5,6,7,8,9,12,13,15)'),
(3, 'Omisión de asegurar (Ver CB 2,3,4,5,6,7,8,9,12,13,15)'),
(4, 'Operar a velocidad indebida (Ver CB 2,3,4,5,6,7,8,9,11,12,13,15)'),
(5, 'Desactivar dispositivos de seguridad (Ver CB 2,3,4,5,6,7,8,9,12,13,15)'),
(6, 'Usar equipo defectuoso (Ver CB 2,3,4,5,6,7,8,9,10,11,12,13,14,15)'),
(7, 'No usar el EPP correctamente (Ver CB 2,3,4,5,7,8,10,12,13,15)'),
(8, 'Carga incorrecta (Ver CB 1,2,3,4,5,6,7,8,9,11,12,13,15)'),
(9, 'Colocación incorrecta (Ver CB 1,2,3,4,5,6,7,8,9,12,13,15)'),
(10, 'Levantar incorrectamente (Ver CB 1,2,3,4,5,6,7,8,9,12,13,15)'),
(11, 'Posición indebida (Ver CB 1,2,3,4,5,6,7,8,9,12,13,15)'),
(12, 'Dar servicio a equipo en funcionamiento (Ver CB 2,3,4,5,6,7,8,9,12,13,15)'),
(13, 'Jugueteo (Ver CB 2,3,4,5,7,8,13,15)'),
(14, 'Bajo la influencia del alcohol y/u otras drogas (Ver CB 2,3,4,5,7,8,13,15)'),
(15, 'Uso indebido del equipo (Ver CB 1,2,3,4,5,6,7,8,9,10,12,13,15)'),
(16, 'Guardas o Barreras Inadecuadas (Ver CB 5,7,8,9,10,11,12,13,15)'),
(17, 'Equipo de protección incorrecto o Inadecuado (Ver CB 5,7,8,9,10,12,13)'),
(18, 'Herramientas, Equipo o Materiales defectuosos (Ver CB 8,9,10,11,12,13,14,15)'),
(19, 'Congestión o Acción Restringida (Ver CB 8,9,13)'),
(20, 'Sistema de Advertencia Inadecuado (Ver CB 8,9,10,11,12,13)'),
(21, 'Peligros de Incendio y Explosión (Ver CB 5,6,7,8,9,10,11,12,13,15)'),
(22, 'Orden y Limpieza deficientes/Desorden (Ver CB 5,6,7,8,9,10,11,12,13,15)'),
(23, 'Exposición al Ruido (Ver CB 5,6,7,8,9,10,11,12,13,14)'),
(24, 'Exposición a la Radiación (Ver CB 5,6,7,8,9,10,11,12,13,14)'),
(25, 'Temperaturas Extremas (Ver CB 1,2,3,8,9,11,12)'),
(26, 'Iluminación Deficiente o Excesiva (Ver CB 8,9,10,11,12,13)'),
(27, 'Ventilación Inadecuada (Ver CB 8,9,10,11,12,13)'),
(28, 'Condiciones Ambientales Peligrosas (Ver CB 8,9,10,11,12,13)');

-- Inserciones en la tabla causa_basicas con jerarquía
INSERT INTO causa_basicas (id, nombre, parent_id) VALUES 
-- FACTORES PERSONALES
(1, 'Capacidad Física / Fisiológica Inadecuada', NULL),
(2, 'Estatura, Peso, tamaño, fuerza, alcance, etc. Inadecuados', 1),
(3, 'Rango limitado de movimiento corporal', 1),
(4, 'Capacidad limitada para mantener posiciones del cuerpo', 1),
(5, 'Alergias o sensibilidad a sustancias', 1),
(6, 'Sensibilidad a extremos sensoriales', 1),
(7, 'Defecto de visión', 1),
(8, 'Defecto de audición', 1),
(9, 'Otros defectos sensoriales (tacto, gusto, olfato. equilibrio)', 1),
(10, 'Incapacidad respiratoria', 1),
(11, 'Otras capacidades físicas permanentes', 1),
(12, 'Incapacidades temporales', 1),
(13, 'Capacidad Mental/Psicológica Inadecuada', NULL),
(14, 'Miedos y Fobias', 13),
(15, 'Perturbación Emocional', 13),
(16, 'Enfermedad Mental', 13),
(17, 'Nivel de Inteligencia', 13),
(18, 'Incapacidad para Comprender', 13),
(19, 'Mal discernimiento', 13),
(20, 'Mala coordinación', 13),
(21, 'Tiempo lento de reacción', 13),
(22, 'Baja aptitud mecánica', 13),
(23, 'Baja aptitud para el aprendizaje', 13),
(24, 'Fallas de memoria', 13),
(25, 'Tensión Física o Fisiológica', NULL),
(26, 'Lesión o Enfermedad', 25),
(27, 'Fatiga debida a carga o duración del trabajo', 25),
(28, 'Fatiga debida a falta de descanso', 25),
(29, 'Fatiga debida a sobrecarga sensorial', 25),
(30, 'Exposición a peligros para la salud', 25),
(31, 'Exposición a temperaturas extremas', 25),
(32, 'Deficiencia de oxígeno', 25),
(33, 'Variación de la presión atmosférica', 25),
(34, 'Movimiento restringido', 25),
(35, 'Insuficiencia de azúcar en la sangre', 25),
(36, 'Drogas', 25),
(37, 'Tensión Mental o Psicológica', NULL),
(38, 'Sobrecarga emocional', 37),
(39, 'Fatiga debida a la velocidad o carga de trabajo mental', 37),
(40, 'Exigencias extremas de discernimiento / decisión', 37),
(41, 'Rutina, monotonía, exigencia de vigilancia aburrida', 37),
(42, 'Exigencias extremas de concentración / percepción', 37),
(43, 'Actividades sin “sentido” o “degradantes”', 37),
(44, 'Instrucciones/ exigencias confusas', 37),
(45, 'Exigencias /instrucciones contradictorias', 37),
(46, 'Preocupación por problemas', 37),
(47, 'Frustración', 37),
(48, 'Falta de Conocimientos', NULL),
(49, 'Falta de experiencia', 48),
(50, 'Orientación inadecuada', 48),
(51, 'Entrenamiento inicial inadecuado', 48),
(52, 'Entrenamiento de actualización inadecuado', 48),
(53, 'Instrucciones malentendidas', 48),
(54, 'Falta de Habilidad', NULL),
(55, 'Instrucción inicial inadecuada', 54),
(56, 'Procedimiento inadecuado', 54),
(57, 'Desempeño infrecuente', 54),
(58, 'Falta de Orientación', 54),
(59, 'Instrucciones de revisión inadecuada', 54),
(60, 'Motivación Incorrecta', NULL),
(61, 'El desempeño incorrecto es premiado', 60),
(62, 'El desempeño correcto es castigado', 60),
(63, 'Falta de incentivos', 60),
(64, 'Frustración excesiva', 60),
(65, 'Agresión indebida', 60),
(66, 'Intento incorrecto de ahorrar tiempo o esfuerzo', 60),
(67, 'Intento incorrecto de evitar incomodidad', 60),
(68, 'Intento incorrecto de llamar la atención', 60),
(69, 'Disciplina inadecuada', 60),
(70, 'Presión indebida de los compañeros', 60),
(71, 'Ejemplo indebido de la supervisión', 60),
(72, 'Retroalimentación inadecuada del desempeño', 60),
(73, 'Refuerzo inadecuado de la conducta correcta', 60),
(74, 'Incentivos de producción incorrectos', 60),
-- FACTORES LABORALES
(75, 'Liderazgo y/o Supervisión Inadecuados', NULL),
(76, 'Relaciones jerárquicas confusas o contradictorias', 75),
(77, 'Asignación confusa o contradictoria de responsabilidades', 75),
(78, 'Delegación indebida o insuficiente', 75),
(79, 'Dar política, procedimiento, prácticas o pautas inadecuadas', 75),
(80, 'Dar objetivos, metas o estándares contradictorios', 75),
(81, 'Planificación o programación inadecuada del trabajo', 75),
(82, 'Instrucciones, orientación y/o entrenamiento inadecuados', 75),
(83, 'Proporcionar documentos de referencia, directivas y publicaciones de orientación inadecuadas', 75),
(84, 'Identificación y evaluación inadecuadas de exposición a pérdidas', 75),
(85, 'Falta de conocimiento del trabajo de supervisión /gerencial', 75),
(86, 'Calificaciones individuales incompatibles con los requisitos del trabajo o tarea', 75),
(87, 'Medición y evaluación inadecuada del desempeño', 75),
(88, 'Retroalimentación inadecuada o incorrecta del desempeño', 75),
(89, 'Ingeniería Inadecuada', NULL),
(90, 'Evaluación inadecuada de exposición a pérdidas', 89),
(91, 'Consideración inadecuada de factores humanos/ergonomía', 89),
(92, 'Estándares, especificaciones y /o criterios de diseño inadecuados', 89),
(93, 'Control inadecuado de la construcción', 89),
(94, 'Evaluación inadecuada de la preparación operativa', 89),
(95, 'Controles Inadecuados o incorrectos', 89),
(96, 'Monitoreo Inadecuado de la operación Inicial', 89),
(97, 'Evaluación Inadecuada de los cambios', 89),
(98, 'Compras Inadecuadas', NULL),
(99, 'Especificaciones inadecuadas en las requisiciones', 98),
(100, 'Investigación inadecuada de materiales o equipos', 98),
(101, 'Especificaciones inadecuadas a los vendedores', 98),
(102, 'Modo o ruta de embarque inadecuada', 98),
(103, 'Inspección o aceptación de recibos inadecuados', 98),
(104, 'Comunicación inadecuada de datos de salud y seguridad', 98),
(105, 'Manipulación incorrecta de materiales', 98),
(106, 'Almacenamiento incorrecto de materiales', 98),
(107, 'Transporte incorrecto de materiales', 98),
(108, 'Identificación inadecuada de artículos peligrosos', 98),
(109, 'Salvamento y /o eliminación de desechos incorrecta', 98),
(110, 'Selección inadecuada de contratistas', 98),
(111, 'Mantenimiento Inadecuado', NULL),
(112, 'Preventivo Inadecuado', 111),
(113, 'Evaluación de Necesidades', 112),
(114, 'Lubricación y Servicio', 112),
(115, 'Ajuste/ Montaje', 112),
(116, 'Limpieza o recubrimiento de superficie', 112),
(117, 'Reparación Inadecuada', 111),
(118, 'Comunicaciones de necesidades', 117),
(119, 'Programación del trabajo', 117),
(120, 'Examen de las unidades', 117),
(121, 'Sustitución de piezas', 117),
(122, 'Herramientas y Equipo Inadecuados', NULL),
(123, 'Evaluación inadecuada de necesidades y riesgos', 122),
(124, 'Consideración inadecuada de factores humanos/ ergonomía', 122),
(125, 'Estándares o especificaciones inadecuadas', 122),
(126, 'Disponibilidad inadecuada', 122),
(127, 'Ajuste/ reparación / mantenimiento inadecuados', 122),
(128, 'Recuperación y rehabilitación inadecuadas', 122),
(129, 'Remoción y reemplazo inadecuado de artículos inapropiados', 122),
(130, 'Estándares de Trabajo Inadecuados', NULL),
(131, 'Desarrollo inadecuado de estándares para:', 130),
(132, 'Inventario y evaluación de exposiciones y necesidades', 131),
(133, 'Coordinación con el diseño en proceso', 131),
(134, 'Participación del personal', 131),
(135, 'Procedimientos prácticas /reglas', 131),
(136, 'Comunicación inadecuada de estándares para:', 130),
(137, 'Publicación', 136),
(138, 'Distribución', 136),
(139, 'Traducción a Idiomas Apropiados', 136),
(140, 'Entrenamiento', 136),
(141, 'Refuerzo con Señales, Códigos de Color y Ayudas del Trabajo', 136),
(142, 'Mantenimiento inadecuado de Estándares para:', 130),
(143, 'Seguimiento del Flujo del Trabajo', 142),
(144, 'Actualización', 142),
(145, 'Monitoreo inadecuado del cumplimiento', 130),
(146, 'Desgaste Excesivo', NULL),
(147, 'Planificación inadecuada del uso', 146),
(148, 'Ampliación indebida de la vía útil', 146),
(149, 'Inspección y /o monitoreo inadecuados', 146),
(150, 'Carga o velocidad de uso incorrectas', 146),
(151, 'Mantenimiento inadecuado', 146),
(152, 'Uso por personal no calificado o no entrenado', 146),
(153, 'Uso para el propósito equivocado', 146),
(154, 'Abuso o Mal Uso', NULL),
(155, 'Conducta impropia que es condonada:', 154),
(156, 'Intencional', 155),
(157, 'No Intencional', 155),
(158, 'Conducta impropia que no es condonada', 154),
(159, 'Intencional', 158),
(160, 'No Intencional', 158);

-- Inserciones en la tabla nac con jerarquía
INSERT INTO nacs (id, nombre, parent_id, level) VALUES 
-- Nivel 1
(1, 'Liderazgo y Administración', NULL, '1'),
(2, 'Política General', 1, '1.1'),
(3, 'Coordinador del Programa', 1, '1.2'),
(4, 'Participación de Gerencia Superior y Media', 1, '1.3'),
(5, 'Estándares de Desempeño Gerencial', 1, '1.4'),
(6, 'Participación de Gerencia', 1, '1.5'),
(7, 'Presentación en Reuniones de Gerencia', 1, '1.6'),
(8, 'Manual de Referencia de Gerencia', 1, '1.7'),
(9, 'Realización de Auditorías de Gerencia', 1, '1.8'),
(10, 'Responsabilidad Individual de Seguridad y Salud/Control de Pérdidas en Descripciones de Puestos', 1, '1.9'),
(11, 'Establecimiento de Objetivos Anuales de Seguridad y Salud/Control de Pérdidas', 1, '1.10'),
(12, 'Comités Conjuntos de Seguridad y Salud y/o Delegados de Seguridad y Salud', 1, '1.11'),
(13, 'Negativa a trabajar debido al Procedimiento de Peligros de Seguridad y Salud', 1, '1.12'),
(14, 'Biblioteca de Referencia', 1, '1.13'),

-- Nivel 2
(15, 'Entrenamiento de Gerencia', NULL, '2'),
(16, 'Programa de Orientación/ Inducción de Gerencia', 15, '2.1'),
(17, 'Entrenamiento Formal Inicial del Personal de Gerencia Superior', 15, '2.2'),
(18, 'Revisión Formal y Entrenamiento Actualizado del Personal de Gerencia Superior', 15, '2.3'),
(19, 'Entrenamiento Inicial Formal para Personal de Gerencia Media y Supervisores', 15, '2.4'),
(20, 'Revisión Formal y Entrenamiento Actualizado del Personal de Gerencia Media y Supervisores', 15, '2.5'),
(21, 'Entrenamiento Formal del Coordinador del Programa', 15, '2.6'),

-- Nivel 3
(22, 'Inspecciones Planificadas', NULL, '3'),
(23, 'Inspecciones Generales Planificadas', 22, '3.1'),
(24, 'Procedimientos de Seguimiento', 22, '3.2'),
(25, 'Análisis de Informe de Inspección', 22, '3.3'),
(26, 'Programa de Inspección de Piezas/Rubros Críticos', 22, '3.4'),
(27, 'Programa de Mantenimiento Preventivo', 22, '3.5'),
(28, 'Inspección Previa al uso de Equipo Móvil y de Manipulación de Materiales', 22, '3.6'),
(29, 'Sistema de Informe de Condiciones Alternas', 22, '3.7'),
(30, 'Mantenimiento del Informe de Inspección General Planificada', 22, '3.8'),
(31, 'Monitoreo Regular del Programa', 22, '3.9'),

-- Nivel 4
(32, 'Análisis y Procedimientos de Tareas', NULL, '4'),
(33, 'Directiva de Gerencia sobre la Importancia', 32, '4.1'),
(34, 'Inventario de Tareas Críticas', 32, '4.2'),
(35, 'Objetivos de Análisis de Tareas y Procedimientos de Tareas', 32, '4.3'),
(36, 'Análisis y Procedimientos de Tareas Efectuados para Tareas Críticas y Actualizados Periódicamente', 32, '4.4'),
(37, 'Peligros de Seguridad y Salud en los Análisis y Procedimientos de Tareas Críticas', 32, '4.5'),
(38, 'Monitoreo Regular del Programa', 32, '4.6'),

-- Nivel 5
(39, 'Investigación de Accidente / Incidente', NULL, '5'),
(40, 'Procedimiento de investigación de Accidente/Incidente', 39, '5.1'),
(41, 'Alcance e Investigaciones establecidos', 39, '5.2'),
(42, 'Seguimiento y Medidas de Corrección', 39, '5.3'),
(43, 'Utilización de Anuncio de Accidente Mayor', 39, '5.4'),
(44, 'Uso de Información de Alto Potencial de Incidente', 39, '5.5'),
(45, 'Participación de la Gerencia de Operaciones', 39, '5.6'),
(46, 'Informe e Investigación de Incidentes', 39, '5.7'),
(47, 'Mantenimiento de Informes de Accidente/Incidente', 39, '5.8'),
(48, 'Monitoreo Periódico del Programa', 39, '5.9'),

-- Nivel 6
(49, 'Observación de Tareas', NULL, '6'),
(50, 'Directiva de Gerencia sobre su Importancia', 49, '6.1'),
(51, 'Programa Completo de Observación de Tareas', 49, '6.2'),
(52, 'Nivel de Observación Completa de Tareas', 49, '6.3'),
(53, 'Programa de Observación de Tareas Parciales', 49, '6.4'),
(54, 'Análisis de Informe de Observación de Tareas', 49, '6.5'),
(55, 'Monitoreo Periódico del Programa', 49, '6.6'),

-- Nivel 7
(56, 'Preparación para Emergencias', NULL, '7'),
(57, 'Coordinador Designado', 56, '7.1'),
(58, 'Plan de Emergencia por Escrito', 56, '7.2'),
(59, 'Entrenamiento de Primeros Auxilios para Supervisor', 56, '7.3'),
(60, 'Entrenamiento de Primeros Auxilios para el Personal (10%)', 56, '7.4'),
(61, 'Iluminación y Energía de Emergencia Adecuadas', 56, '7.5'),
(62, 'Controles Principales con Código de Color y Rotulados', 56, '7.6'),
(63, 'Equipo de Protección y de Rescate', 56, '7.7'),
(64, 'Entrenamiento y Ejercicios del Equipo de Emergencia', 56, '7.8'),
(65, 'Asistentes de Primeros Auxilios Calificados', 56, '7.9'),
(66, 'Ayuda Exterior y Auxilio Mutuo Organizados', 56, '7.10'),
(67, 'Protección de Registros Vitales', 56, '7.11'),
(68, 'Planificación para Etapa Posterior al Evento', 56, '7.12'),
(69, 'Se provee Comunicación de Emergencia', 56, '7.13'),
(70, 'Comunicaciones de Seguridad Pública Planificadas', 56, '7.14'),

-- Nivel 8
(71, 'Reglamentos de la Compañía', NULL, '8'),
(72, 'Reglamento General de Seguridad y Salud', 71, '8.1'),
(73, 'Reglamento de Trabajo Especializado', 71, '8.2'),
(74, 'Sistemas de Permiso de Trabajo y Procedimientos Especiales', 71, '8.3'),
(75, 'Programa de Educación y Revisión del Reglamento', 71, '8.4'),
(76, 'Esfuerzo de Cumplimiento del Reglamento', 71, '8.5'),
(77, 'Uso de Símbolos Educativos y Código de Colores', 71, '8.6'),
(78, 'Monitoreo Periódico del Programa', 71, '8.7'),

-- Nivel 9
(79, 'Análisis de Accidente / Incidente', NULL, '9'),
(80, 'Cálculo y Uso de Estadísticas de Desempeño', 79, '9.1'),
(81, 'Análisis de Lesiones y Enfermedades Ocupacionales', 79, '9.2'),
(82, 'Identificación y Análisis de Daños a la Propiedad y Equipo', 79, '9.3'),
(83, 'Equipos de Proyecto para Solución de Problemas', 79, '9.4'),
(84, 'Análisis de Incidentes (Cuasi accidentes)', 79, '9.5'),

-- Nivel 10
(85, 'Entrenamiento del Personal', NULL, '10'),
(86, 'Análisis de Necesidades de Entrenamiento', 85, '10.1'),
(87, 'Programa de Entrenamiento del Personal', 85, '10.2'),
(88, 'Evaluación del Programa de Entrenamiento', 85, '10.3'),

-- Nivel 11
(89, 'Equipo de Protección Personal', NULL, '11'),
(90, 'Estándares para Equipo de Protección Personal', 89, '11.1'),
(91, 'Registros de Equipo de Protección Personal', 89, '11.2'),
(92, 'Cumplimiento de Estándares', 89, '11.3'),
(93, 'Monitoreo Periódico del Programa', 89, '11.4'),

-- Nivel 12
(94, 'Control de la Salud', NULL, '12'),
(95, 'Identificación de Peligros para la Salud', 94, '12.1'),
(96, 'Control de Peligros de la Salud', 94, '12.2'),
(97, 'Información / Entrenamiento / Educación', 94, '12.3'),
(98, 'Monitoreo de Higiene Industrial', 94, '12.4'),
(99, 'Programa de Mantenimiento de la Salud', 94, '12.5'),
(100, 'Asistencia Médica Profesional', 94, '12.6'),
(101, 'Comunicaciones de Salud a los Trabajadores', 94, '12.7'),
(102, 'Mantenimiento de Registros', 94, '12.8'),

-- Nivel 13
(103, 'Sistema de Evaluación del Programa', NULL, '13'),
(104, 'Auditoría Completa del Cumplimiento de Estándares del Programa', 103, '13.1'),
(105, 'Auditoría Completa del Cumplimiento de Estándares de Condiciones Físicas', 103, '13.2'),
(106, 'Auditoría Completa del Cumplimiento de Estándares de Prevención y Control de Incendios', 103, '13.3'),
(107, 'Auditoría Completa del Cumplimiento de Estándares de Salud Ocupacional', 103, '13.4'),
(108, 'Registro de Sistemas de Evaluación de Programa', 103, '13.5'),

-- Nivel 14
(109, 'Controles de Ingeniería', NULL, '14'),
(110, 'Consideraciones de Seguridad y Salud de Ingeniería de Diseño en la Concepción y el Diseño', 109, '14.1'),
(111, 'Consideraciones de Seguridad y Salud de Ingeniería de Proceso en la Concepción y el Diseño', 109, '14.2'),
(112, 'Monitoreo Periódico del Programa', 109, '14.3'),

-- Nivel 15
(113, 'Comunicaciones al Personal', NULL, '15'),
(114, 'Entrenamiento en Técnicas de Comunicación al Personal', 113, '15.1'),
(115, 'Orientación / Inducción de Trabajo para Personal Nuevo/Transferido', 113, '15.2'),
(116, 'Entrenamiento y Uso Adecuado de Instrucción de Tarea', 113, '15.3'),

-- Nivel 16
(117, 'Reuniones Grupales', NULL, '16'),
(118, 'Realización de Reuniones Grupales', 117, '16.1'),
(119, 'Registro del Asunto, Ayudas Visuales, Asistencia y Problemas Tratados', 117, '16.2'),
(120, 'Participación de la Gerencia Superior y Media', 117, '16.3'),
(121, 'Monitoreo Periódico del Programa', 117, '16.4'),

-- Nivel 17
(122, 'Promoción General', NULL, '17'),
(123, 'Programa de Periódico Mural de Seguridad', 122, '17.1'),
(124, 'Uso de Estadísticas y Hechos del Programa', 122, '17.2'),
(125, 'Promoción de Temas Críticos', 122, '17.3'),
(126, 'Uso de Premios o Reconocimiento', 122, '17.4'),
(127, 'Publicaciones de Información el Programa', 122, '17.5'),
(128, 'Promoción del Desempeño en Grupo', 122, '17.6'),
(129, 'Promoción del Orden y la Limpieza', 122, '17.7'),
(130, 'Registros de Actividades de Promoción del Programa', 122, '17.8'),

-- Nivel 18
(131, 'Contratación y Colocación de Personal', NULL, '18'),
(132, 'Análisis de la Capacidad Física', 131, '18.1'),
(133, 'Examen Médico Pre-Ocupacional', 131, '18.2'),
(134, 'Programa de Orientación / Inducción General', 131, '18.3'),
(135, 'Verificación de Calificaciones Previa a la Contratación y Colocación', 131, '18.4'),

-- Nivel 19
(136, 'Controles de Compra', NULL, '19'),
(137, 'Compras Incluyen la Seguridad y Salud en las Especificaciones y Logística', 136, '19.1'),
(138, 'Selección y Control de Contratistas', 136, '19.2'),

-- Nivel 20
(139, 'Seguridad Fuera del Trabajo', NULL, '20'),
(140, 'Establecimiento de Sistema de Informes y Análisis de Estadísticas', 139, '20.1'),
(141, 'Comunicación de Información de Seguridad Fuera del Trabajo', 139, '20.2');


-- Inserciones en la tabla intermedia tipo_contacto_causa_inmediata
INSERT INTO tipo_contacto_causa_inmediata (tipo_contacto_id, causa_inmediata_id) VALUES
(1, 1), (1, 2), (1, 4), (1, 5), (1, 12), (1, 14), (1, 15), (1, 16), (1, 17), (1, 18), (1, 19), (1, 26),
(2, 1), (2, 2), (2, 4), (2, 5), (2, 6), (2, 9), (2, 10), (2, 12), (2, 13), (2, 14), (2, 15), (2, 16), (2, 20), (2, 26),
(3, 3), (3, 5), (3, 6), (3, 7), (3, 11), (3, 12), (3, 13), (3, 14), (3, 15), (3, 16), (3, 17), (3, 22),
(4, 4), (4, 9), (4, 13), (4, 14), (4, 15), (4, 16), (4, 19), (4, 22), (4, 26),
(5, 5), (5, 6), (5, 11), (5, 13), (5, 14), (5, 15), (5, 16), (5, 18),
(6, 5), (6, 6), (6, 11), (6, 12), (6, 13), (6, 14), (6, 15), (6, 16), (6, 18),
(7, 1), (7, 2), (7, 5), (7, 6), (7, 9), (7, 11), (7, 12), (7, 13), (7, 14), (7, 15), (7, 16), (7, 22), (7, 28),
(8, 5), (8, 6), (8, 7), (8, 11), (8, 12), (8, 13), (8, 14), (8, 15), (8, 16), (8, 17), (8, 18), (8, 20), (8, 21), (8, 23), (8, 24), (8, 25), (8, 27), (8, 28),
(9, 8), (9, 9), (9, 10), (9, 11), (9, 13), (9, 14), (9, 15);

-- Inserciones en la tabla intermedia causa_inmediata_causa_basica
INSERT INTO causa_inmediata_causa_basica (causa_inmediata_id, causa_basica_id) VALUES
(1, 13), (1, 37), (1, 48), (1, 60), (1, 75), (1, 122), (1, 130), (1, 154),
(2, 1), (2, 13), (2, 25), (2, 37), (2, 48), (2, 54), (2, 60), (2, 75), (2, 89), (2, 122), (2, 130), (2, 154),
(3, 13), (3, 25), (3, 37), (3, 48), (3, 54), (3, 60), (3, 75), (3, 89), (3, 122), (3, 130), (3, 154),
(4, 13), (4, 25), (4, 37), (4, 48), (4, 54), (4, 60), (4, 75), (4, 89), (4, 111), (4, 122), (4, 130), (4, 154),
(5, 13), (5, 25), (5, 37), (5, 48), (5, 54), (5, 60), (5, 75), (5, 89), (5, 122), (5, 130), (5, 154),
(6, 13), (6, 25), (6, 37), (6, 48), (6, 54), (6, 60), (6, 75), (6, 89), (6, 98), (6, 111), (6, 122), (6, 130), (6, 146), (6, 154),
(7, 13), (7, 25), (7, 37), (7, 48), (7, 60), (7, 75), (7, 98), (7, 122), (7, 130), (7, 154),
(8, 1), (8, 13), (8, 25), (8, 37), (8, 48), (8, 60), (8, 75), (8, 89), (8, 122), (8, 130), (8, 154),
-- Colocación incorrecta
(9, 1), (9, 13), (9, 25), (9, 37), (9, 48), (9, 54), (9, 60), (9, 75), (9, 89), (9, 122), (9, 130), (9, 154),
-- Levantar incorrectamente
(10, 1), (10, 13), (10, 25), (10, 37), (10, 48), (10, 54), (10, 60), (10, 75), (10, 89), (10, 122), (10, 130), (10, 154),
-- Posición indebida
(11, 1), (11, 13), (11, 25), (11, 37), (11, 48), (11, 54), (11, 60), (11, 75), (11, 89), (11, 122), (11, 130), (11, 154),
-- Dar servicio a equipo en funcionamiento
(12, 13), (12, 25), (12, 37), (12, 48), (12, 54), (12, 60), (12, 75), (12, 89), (12, 122), (12, 130), (12, 154),
-- Jugueteo
(13, 13), (13, 25), (13, 37), (13, 48), (13, 60), (13, 75), (13, 130), (13, 154),
-- Bajo la influencia del alcohol y/u otras drogas
(14, 14), (14, 25), (14, 37), (14, 48), (14, 60), (14, 75), (14, 130), (14, 154),
-- Uso indebido del Equipo
(15, 1), (15, 13), (15, 25), (15, 37), (15, 48), (15, 54), (15, 60), (15, 75), (15, 89), (15, 98), (15, 122), (15, 130), (15, 154),
-- Guardas o Barreras Inadecuadas
(16, 48), (16, 60), (16, 75), (16, 89), (16, 98), (16, 111), (16, 122), (16, 130), (16, 154),
-- Equipo de protección incorrecto o Inadecuado
(17, 48), (17, 60), (17, 75), (17, 89), (17, 98), (17, 122), (17, 130),
-- Herramientas, Equipo o Materiales defectuosos
(18, 75), (18, 89), (18, 98), (18, 111), (18, 122), (18, 130), (18, 146), (18, 154),
-- Congestión o Acción Restringida
(19, 75), (19, 89), (19, 130),
-- Sistema de Advertencia Inadecuado
(20, 75), (20, 89), (20, 98), (20, 111), (20, 122), (20, 130),
-- Peligros de Incendio y Explosión
(21, 48), (21, 54), (21, 60), (21, 75), (21, 89), (21, 98), (21, 111), (21, 122), (21, 130), (21, 154),
-- Orden y Limpieza deficientes/Desorden
(22, 48), (22, 54), (22, 60), (22, 75), (22, 89), (22, 98), (22, 111), (22, 122), (22, 130), (22, 154),
-- Exposición al Ruido
(23, 48), (23, 54), (23, 60), (23, 75), (23, 89), (23, 98), (23, 111), (23, 122), (23, 130), (23, 146),
-- Exposición a la Radiación
(24, 48), (24, 54), (24, 60), (24, 75), (24, 89), (24, 98), (24, 111), (24, 122), (24, 130), (24, 146),
-- Temperaturas Extremas
(25, 1), (25, 13), (25, 25), (25, 75), (25, 89), (25, 111), (25, 122),
-- Iluminación Deficiente o Excesiva
(26, 75), (26, 89), (26, 98), (26, 111), (26, 122), (26, 130),
-- Ventilación Inadecuada
(27, 75), (27, 89), (27, 98), (27, 111), (27, 122), (27, 130),
-- Condiciones Ambientales Peligrosas
(28, 75), (28, 89), (28, 98), (28, 111), (28, 122), (28, 130);

-- Inserciones en la tabla intermedia causa_basica_nac
INSERT INTO causa_basica_nac (causa_basica_id, nac_id) VALUES
-- Capacidad Física / Fisiológica Inadecuada
(1, 49), (1, 79), (1, 94), (1, 113), (1, 131),

-- Capacidad Mental/Psicológica Inadecuada
(13, 49), (13, 79), (13, 85), (13, 113), (13, 131),

-- Tensión Física o Fisiológica
(25, 32), (25, 49), (25, 79), (25, 89), (25, 94),(25, 103), (25, 113), (25, 131), (25, 139),

-- Tensión Mental o Psicológica
(37, 1), (37, 32), (37, 39), (37, 49), (37, 85), (37, 89),
(37, 94), (37, 113), (37, 117), (37, 131), (37, 139),

-- Falta de Conocimientos
(48, 15), (48, 32), (48, 39), (48, 49), (48, 56), (48, 71),
(48, 79), (48, 85), (48, 89), (48, 94), (48, 103), (48, 109),
(48, 113), (48, 117), (48, 131), (48, 139),

-- Falta de Habilidad
(54, 15), (54, 32), (54, 39), (54, 49), (54, 56), (54, 79),
(54, 85), (54, 103), (54, 113), (54, 131),

-- Motivación Incorrecta
(60, 1), (60, 15), (60, 32), (60, 39), (60, 49), (60, 71),
(60, 85), (60, 89), (60, 103), (60, 113), (60, 117), (60, 131),

-- Liderazgo y/o Supervisión Inadecuados
(75, 1), (75, 15), (75, 22), (75, 32), (75, 39), (75, 49),
(75, 71), (75, 79), (75, 85), (75, 89), (75, 94), (75, 103),
(75, 109), (75, 113), (75, 117), (75, 122), (75, 131),

-- Compras Inadecuadas
(98, 1), (98, 22), (98, 32), (98, 49), (98, 79), (98, 94),
(98, 103), (98, 109), (98, 113), (98, 136),

-- Mantenimiento Inadecuado
(111, 1), (111, 22), (111, 32), (111, 49), (111, 79), (111, 85),
(111, 103), (111, 109), (111, 113), (111, 136),

-- Herramientas y Equipo Inadecuados
(122, 1), (122, 22), (122, 32), (122, 49), (122, 56), (122, 79),
(122, 94), (122, 103), (122, 109), (122, 113), (122, 136),

-- Estándares de Trabajo Inadecuados
(130, 1), (130, 15), (130, 22), (130, 32), (130, 39), (130, 49),
(130, 56), (130, 71), (130, 79), (130, 85), (130, 89), (130, 103),
(130, 109), (130, 113), (130, 117), (130, 136),

-- Desgaste Excesivo
(146, 22), (146, 32), (146, 49), (146, 79), (146, 85), (146, 103),
(146, 109), (146, 113),

-- Abuso o Mal Uso
(154, 1), (154, 22), (154, 32), (154, 49), (154, 71), (154, 79),
(154, 85), (154, 89), (154, 103), (154, 109), (154, 113), (154, 117),
(154, 136);
