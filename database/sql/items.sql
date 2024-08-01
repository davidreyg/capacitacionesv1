-- Insertar grupos de items
INSERT INTO grupo_items (id, nombre) VALUES
    (1, 'Grupo 1'),
    (2, 'Grupo 2'),
    (3, 'Grupo 3'),
    (4, 'Grupo 4');
-- Insertar items
INSERT INTO items (id, nombre,grupo_item_id) VALUES
    (1, 'Tipo de accion de capacitación',1),
    (2, 'Código de prioridad',2),
    (3, 'Beneficio de la accion de la capacitación',3),
    (4, 'Funciones de la accion de la capacitación',3),
    (5, 'Objetivo de la capacitación',3),
    (6, 'Acciones para aplicar lo aprendido',4);

-- Insertar respuestas con valores y item asociado
INSERT INTO respuestas (id, nombre, item_id, valor) VALUES
    (1, 'Curso', 1, '1'),
    (2, 'Taller', 1, '2'),
    (3, 'Dimoplado', 1, '3'),
    (4, 'Pasantia', 1, '4'),
    (5, 'Seminarios', 1, '5'),
    (6, 'Rendimiento sujeto a Observación', 2, 'A'),
    (7, 'Nuevas Funciones', 2, 'B'),
    (8, 'Cierre de Brechas', 2, 'C'),
    (9, 'Brechas Identificadas en los Dxs.', 2, 'C1'),
    (10, 'Requerimiento de Entes Rectores', 2, 'C2'),
    (11, 'Rendimiento Distinguido', 2, 'C3'),
    (12, 'Necesidades Identificadas', 2, 'D'),
    (13, 'Necesidades Identificadas E', 2, 'E'),
    (14, 'Necesidades Identificadas por Servir', 2, 'F'),
    (15, 'Beneficio Bajo', 3, '1'),
    (16, 'Beneficio Medio', 3, '2'),
    (17, 'Beneficio Alto', 3, '3'),
    (18, 'Funciones de soporte o complemento', 4, '1'),
    (19, 'Funciones directivas', 4, '2'),
    (20, 'Funciones sustantivas o de administración interna', 4, '3'),
    (21, 'Objetivo de Aprendizaje (sólo conocimiento)', 5, '1'),
    (22, 'Objetivo de Aprendizaje (conocimiento y habilidades)', 5, '2'),
    (23, 'Objetivo de desempeño', 5, '3'),
    (24, 'Cuestionario', 6, '1'),
    (25, 'Escala de Observación', 6, '2'),
    (26, 'Muestra de Trabajo', 6, '3'),
    (27, 'Entrevista Focus Group', 6, '4');
