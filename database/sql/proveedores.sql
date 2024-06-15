-- Iniciar la transacción
START TRANSACTION;

-- Insertar datos falsos en la tabla proveedors
INSERT INTO `proveedors` (`numero_documento`, `razon_social`, `telefono`, `correo`, `fecha_alta`, `fecha_baja`, `is_active`, `observacion`, `tipo_documento_id`) VALUES
(12345678, 'Servicios y Soluciones Integrales S.A.', 987654321, 'contactoA@empresa.com', '2023-01-01', NULL, 1, 'Proveedor de servicios empresariales.', 3),
(23456789, 'Comercializadora de Productos ABC S.A.C.', 876543210, 'contactoB@empresa.com', '2023-02-01', NULL, 1, 'Distribuidor mayorista de productos varios.', 3),
(34567890, 'Innovaciones Tecnológicas XYZ EIRL', 765432109, 'contactoC@empresa.com', '2023-03-01', NULL, 1, 'Desarrollo y venta de software.', 3),
(45678901, 'Importadora y Exportadora Global S.A.', 654321098, 'contactoD@empresa.com', '2023-04-01', NULL, 1, 'Comercio internacional de bienes.', 3),
(56789012, 'Consultores Financieros y Asesores S.A.C.', 543210987, 'contactoE@empresa.com', '2023-05-01', NULL, 1, 'Asesoría financiera y contable.', 3),
(67890123, 'Constructora y Servicios Generales LMN EIRL', 432109876, 'contactoF@empresa.com', '2023-06-01', NULL, 1, 'Proyectos de construcción y servicios.', 3),
(78901234, 'Distribuidora de Alimentos Orgánicos S.A.', 321098765, 'contactoG@empresa.com', '2023-07-01', NULL, 1, 'Venta y distribución de alimentos orgánicos.', 3),
(89012345, 'Tecnología y Consultoría Empresarial TCE S.A.C.', 210987654, 'contactoH@empresa.com', '2023-08-01', NULL, 1, 'Consultoría en tecnología de la información.', 3),
(90123456, 'Fabricantes de Equipos Industriales FIE EIRL', 109876543, 'contactoI@empresa.com', '2023-09-01', NULL, 1, 'Fabricación y mantenimiento de equipos industriales.', 3),
(101234567, 'Servicios de Transporte y Logística STRAN S.A.', 198765432, 'contactoJ@empresa.com', '2023-10-01', NULL, 1, 'Servicios de transporte y logística.', 3);

-- Confirmar la transacción
COMMIT;
