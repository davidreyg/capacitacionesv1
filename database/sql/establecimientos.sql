-- INSERTAMOS LOS PADRES PRIMERO

INSERT INTO establecimientos (nombre, codigo, direccion, categoria, ris, distrito_id, correo, telefono, tipo, parent_id) VALUES
('RIS BCO-CHO-SCO', 12, '', NULL, 'RIS BCO-CHO-SCO', '140108', 'risbcochosco@dirislimasur.gob.pe', NULL, 'RIS', 1),
('RIS LURIN Y BALNEARIOS', 123, '', NULL, 'RIS LURIN Y BALNEARIOS', '140113', 'rislurinybalnearios@dirislimasur.gob', NULL, 'RIS', 1),
('RIS PACHACAMAC', 1234, '', NULL, 'RIS PACHACAMAC', '140116', 'rispachacamac@dirislimasur.gob.pe', NULL, 'RIS', 1),
('RIS SJM', 12354, '', NULL, 'RIS SJM', '140136', 'rissjm@dirislimasur.gob.pe', NULL, 'RIS', 1),
('RIS VES', 123456, '', NULL, 'RIS VES', '140141', 'risves@dirislimasur.gob.pe', NULL, 'RIS', 1),
('RIS VMT', 1234567, '', NULL, 'RIS VMT', '140132', 'risvmt@dirislimasur.gob.pe', NULL, 'RIS', 1);


INSERT INTO establecimientos (nombre, codigo, CATEGORIA, RIS, distrito_id, DIRECCION, CORREO, tipo, parent_id) VALUES
    ('C.S. ALICIA LASTRES DE LA TORRE', '00005988', 'I-3', 'BCO-CHO-SCO', '140125', 'CALLE MARTÍNEZ DE PINILLOS N° 124 - A', 'csalicialastreslatorre@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.S. GAUDENCIO BERNASCONI', '00005989', 'I-3', 'BCO-CHO-SCO', '140125', 'AV. ALMIRANTE GRAU N° 198', 'csgaudenciobernasconi@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.S.M.C. BARRANCO', '00027615', 'I-3', 'BCO-CHO-SCO', '140125', 'AV. SURCO N° 431', 'csmcbarranco@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.M.I. VIRGEN DEL CARMEN', '00005991', 'I-4', 'BCO-CHO-SCO', '140108', 'CALLE LEOPOLDO ARIAS N° 200', 'cmivirgendelcarmen@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.M.I. BUENOS AIRES DE VILLA', '00005998', 'I-4', 'BCO-CHO-SCO', '140108', 'AV. BUENOS AIRES DE VILLA S/N.', 'cmibuenosairesdevilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.S. DELICIAS DE VILLA', '00005999', 'I-3', 'BCO-CHO-SCO', '140108', 'JR. NEVADO CARHUAZO S/N - II ZONA - DELICIAS DE VILLA', 'csdeliciasdevilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.S. SAN GENARO DE VILLA', '00006000', 'I-4', 'BCO-CHO-SCO', '140108', 'CALLE 8 S/N - AA.HH. SAN GENARO DE VILLA', 'cmisangenarodevilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.S. GUSTAVO LANATTA LUJÁN', '00005990', 'I-3', 'BCO-CHO-SCO', '140108', 'AV. DEFENSORES DEL MORRO N° 556', 'csgustavolanatta@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.S. TUPAC AMARU DE VILLA', '00006003', 'I-3', 'BCO-CHO-SCO', '140108', 'AV. TÚPAC AMARU MZ. E - LT.1', 'cstupacamaru@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.S.M.C. NANCY REYES BAHAMONDE', '00024374', 'I-3', 'BCO-CHO-SCO', '140108', 'CALLE SAN RODOLFO N° 441 - VILLA MARINA', 'csmcnancyreyes@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.E. SAN PEDRO DE LOS CHORRILLOS', '00006162', 'I-4', 'BCO-CHO-SCO', '140108', 'CALLE FERROCARRIL S/N', 'cesanpedrodeloschorrillos@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('C.S.M.C. SAN SEBASTIAN', '00026221', 'I-3', 'BCO-CHO-SCO', '140108', 'AV. INDEPENDENCIA S/N CRUCE CON JOSÉ OLAYA - URB. SANTA ISABEL DE VILLA', 'csmcsansebastian@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('P.S. SANTA ISABEL DE VILLA', '00006002', 'I-2', 'BCO-CHO-SCO', '140108', 'AV. INDEPENDENCIA S/N - AA.HH. SANTA ISABEL DE VILLA', 'pssantaisabeldevilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
    ('P.S. SAN JUAN DE LA LIBERTAD', '00006004', 'I-2', 'BCO-CHO-SCO', '140108', 'AV. 11 S/N - AA.HH. SAN JUAN DE LA LIBERTAD', 'pssanjuandelalibertad@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. DEFENSORES DE LIMA', '00006010', 'I-2', 'BCO-CHO-SCO', '140108', 'AA.HH. DEFENSORES DE LIMA S/N', 'psdefensoresdelima@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. MATEO PUMACAHUA', '00006005', 'I-2', 'BCO-CHO-SCO', '140108', 'AV. MATEO PUMACAHUA S/N - MZ. T - LOTE 37 - SECTOR 01', 'psmateopumacahua@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. VILLA VENTURO', '00006007', 'I-2', 'BCO-CHO-SCO', '140108', 'CALLE JAUJA S/N - AA.HH. VILLA VENTURO', 'psvillaventuro@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. NUEVA CALEDONIA', '00006008', 'I-2', 'BCO-CHO-SCO', '140108', 'AV. HUANCAVELICA - MZ. E - LT. 1 - AA.HH. NUEVA CALEDONIA', 'psnuevacaledonia@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. SANTA TERESA DE CHORRILLOS', '00006006', 'I-2', 'BCO-CHO-SCO', '140108', 'PROLONGACIÓN AV. EL SOL S/N - AA.HH. SANTA TERESA DE CHORRILLOS', 'pssantateresadechorrillos@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. LOS INCAS', '00006009', 'I-2', 'BCO-CHO-SCO', '140108', 'CALLE ISLAS GUYANAS - MZ. I-6 - LOTE 30 - URB. LOS CEDROS DE VILLA', 'pslosincas@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. ARMATAMBO', '00005992', 'I-2', 'BCO-CHO-SCO', '140108', 'AV. JULIO CALERO MZ. 16 - LOTE 3 – AA.HH. CRUZ DE ARMATAMBO', 'psarmatambo@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. VISTA ALEGRE DE VILLA', '00006001', 'I-2', 'BCO-CHO-SCO', '140108', 'CALLE JOSÉ CARLOS MARIATEGUI S/N', 'psvistaalegredevilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('C.S.M.C. CRL. SAN. WILELMO PEDRO ZORRILLA HUAMÁN', '00029266', 'I-3', 'BCO-CHO-SCO', '140108', 'JR. GRAL. BUENDIA N° 503 - VILLA MILITAR OESTE', '', 'ESTABLECIMIENTO', '2'),

	('C.S. SANTIAGO DE SURCO', '00005993', 'I-3', 'BCO-CHO-SCO', '140130', 'JR. DANIEL CORNEJO N° 182', 'cssantiagodesurco@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. VIÑEDOS DE SURCO', '00005996', 'I-2', 'BCO-CHO-SCO', '140130', 'MZ. F - LOTE 12 – AA.HH. VIÑEDOS DE SURCO', 'psvinedosdesurco@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. SAN ROQUE', '00005995', 'I-2', 'BCO-CHO-SCO', '140130', 'JR. ESTEBAN CÁMERE N° 378 - URB. SAN ROQUE', 'pssanroque@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. LAS DUNAS', '00006952', 'I-2', 'BCO-CHO-SCO', '140130', 'CALLE LOS HERRERILLOS S/N – MZ. F - LT. 1 - LAS DUNAS', 'pslasdunas@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. LAS FLORES', '00005997', 'I-2', 'BCO-CHO-SCO', '140130', 'CALLE FERREÑAFE N° 220 - URB. LAS FLORES - MONTERRICO', 'pslasflores@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),
	('P.S. SAN CARLOS', '00005994', 'I-1', 'BCO-CHO-SCO', '140130', 'JR. MARISCAL SANTA CRUZ S/N – AA.HH. SAN CARLOS', 'pssancarlos@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '2'),

	('C.M.I. LURÍN', '00006079', 'I-4', 'RIS LURIN Y BALNERARIOS', '140113', 'JR. GRAU Nº 370', 'cmilurin@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('C.S. CLAS NUEVO LURÍN - KM 40', '00006081', 'I-3', 'RIS LURIN Y BALNERARIOS', '140113', 'AV. 28 JULIO MZ 18 - LT 20 - NUEVO LURIN – KM. 40 -ANTIGUA PANAMERICANA SUR', 'clasnuevolurin@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('C.S. CLAS JULIO C. TELLO', '00006080', 'I-3', 'RIS LURIN Y BALNERARIOS', '140113', 'AV. LAS ACASIAS MZ. B – LT. 12 - SECTOR 1 - JULIO C. TELLO', 'clasjulioctello@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('C.S. CLAS VILLA ALEJANDRO', '00006082', 'I-3', 'RIS LURIN Y BALNERARIOS', '140113', 'MZ. L - LOTE 31 – AA.HH. VILLA ALEJANDRO', 'clasvillaalejandro@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('P.S. BUENA VISTA', '00006083', 'I-2', 'RIS LURIN Y BALNERARIOS', '140113', 'PROLONG. ALFONSO UGARTE - URB. BUENA VISTA BAJA S/N', 'psbuenavista@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('P.S. MARTHA MILAGROS BAJA', '00016852', 'I-2', 'RIS LURIN Y BALNERARIOS', '140113', 'AV. LOS CIPRECES MZ. B - LOTE 01 - MARTHA MILAGROS BAJA', 'psmarthamilagrosbaja@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('C.S. BENJAMIN DOIG', '00006085', 'I-3', 'RIS LURIN Y BALNERARIOS', '140118', 'AA.HH. BENJAMIN DOIG LOSSIO – MZ. 21 – LT. 13', 'csbenjamindoig@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('C.S. PUCUSANA', '00006084', 'I-3', 'RIS LURIN Y BALNERARIOS', '140118', 'AV. LIMA Nº 559', 'cmipucusana@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('P.S. PUNTA HERMOSA', '00006086', 'I-2', 'RIS LURIN Y BALNERARIOS', '140120', 'JR. PIMENTEL Nº 248 – MZ. G – LT. 9', 'pspuntahermosa@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('C.S. PUNTA NEGRA', '00006087', 'I-3', 'RIS LURIN Y BALNERARIOS', '140121', 'AV. GUAYANAY NORTE - ZONA CENTRAL MZ. H-1 – LT. 6', 'cspuntanegra@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('C.S. SAN BARTOLO', '00006088', 'I-3', 'RIS LURIN Y BALNERARIOS', '140123', 'AV. SAN BARTOLO MZ. A - LT 1 Y AV. EL GOLF S/N', 'cmisanbartolo@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('P.S. VILLA MERCEDES', '00006089', 'I-2', 'RIS LURIN Y BALNERARIOS', '140128', 'AV. MANCO CAPAC – MZ. H – LT. 01', 'psvillamercedes@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('P.S. CLAS VILLA LIBERTAD', '00006093', 'I-2', 'RIS LURIN Y BALNERARIOS', '140113', 'JR. HUÁNUCO S/N -CENTRO POBLADO RURAL CASICA - VILLA LIBERTAD', 'clasvillalibertad@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '4'),
	('C.S.M.C. BALNEARIOS DEL SUR', '00031200', 'I-3', 'RIS LURIN Y BALNERARIOS', '140120', 'CALLE BARTOLOME HERRERA N° 100-102 MZ A LOTE 10- AGRUPACION DE FAMILIAS SANTA CRUZ  ', '', 'ESTABLECIMIENTO', '4'),

	('C.S. PACHACAMAC', '00006090', 'I-3', 'PACHACAMAC', '140116', 'AV. COLONIAL S/N Y ESQ. CASTILLA', 'cspachacamac@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('C.S. PORTADA DE MANCHAY', '00006092', 'I-3', 'PACHACAMAC', '140116', 'CALLE 7 ESQ. CALLE 4 - MZ F - LT 11 – AA.HH. PORTADA DE MANCHAY', 'cmiportadademanchay@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('C.S. CLAS JUAN PABLO II', '00015075', 'I-3', 'PACHACAMAC', '140116', 'MZ. K8 - LOTE 5B - SECTOR LOS JARDINES - HUERTOS DE MANCHAY', 'clasjuanpablo2@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('C.S.M.C. SANTA ROSA DE MANCHAY', '00025772', 'I-3', 'PACHACAMAC', '140116', 'PORTADA DE MANCHAY III - MZ B LOTE 1', 'csmcsantarosademanchay@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('C.S.M.C. LA MEDALLA MILAGROSA', '00025771', 'I-3', 'PACHACAMAC', '140116', 'PSJE. COLLANAC SECTOR 24 DE JUNIO – HUERTOS DE MANCHAY', 'csmcmedallamilagrosa@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. MANCHAY ALTO', '00006091', 'I-2', 'PACHACAMAC', '140116', 'AV. LAS CASUARINAS – MZ. E – LT. 18 - CENTRO POBLADO RURAL MANCHAY ALTO', 'csmanchayalto@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. TAMBO INGA', '00006098', 'I-1', 'PACHACAMAC', '140116', 'AV. VÍCTOR MALÁSQUEZ - CENTRO POBLADO RURAL TAMBO INGA', 'pstamboinga@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. PICAPIEDRA', '00006097', 'I-2', 'PACHACAMAC', '140116', 'AV. REAL – MZ. J – LT. 8 - CENTRO POBLADO RURAL PICAPIEDRA', 'pspicapiedra@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. GUAYABO', '00006096', 'I-2', 'PACHACAMAC', '140116', 'AV. SAN JUAN – MZ. H – LT. 2 - CENTRO POBLADO RURAL GUAYABO', 'psguayabo@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. QUEBRADA VERDE', '00006095', 'I-2', 'PACHACAMAC', '140116', 'AV. ROQUE SAENZ PEÑA - MZ. I - LOTE 13', 'psquebradaverde@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S.PAMPA GRANDE', '00006094', 'I-2', 'PACHACAMAC', '140116', 'AV. 7 DE JUNIO – MZ. B S/N - PAMPA GRANDE', 'pspampagrande@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. CARDAL', '00006099', 'I-2', 'PACHACAMAC', '140116', 'CENTRO POBLADO RURAL CARDAL', 'pscardal@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. HUERTOS DE MANCHAY', '00006102', 'I-2', 'PACHACAMAC', '140116', 'MZ. T - LOTE S/N - SECTOR RINCONADA ALTA', 'pshuertosdemanchay@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. PARQUES DE MANCHAY', '00006103', 'I-2', 'PACHACAMAC', '140116', 'CARRETERA CIENEGUILLA KM. 21 – MZ. 1 – LT. 12-13 – AA.HH. PAUL POBLET LIND', 'psparquesdemanchay@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
	('P.S. COLLANAC', '00006101', 'I-2', 'PACHACAMAC', '140116', 'AV. VÍCTOR MALÁSQUEZ KM. 5.5 - SECTOR 24 DE JUNIO - COLLANAC', 'pscollanac@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '3'),
    
	('C.M.I. MANUEL BARRETO', '00006104', 'I-4', 'SJM', '140136', 'JR. MANUEL BARRETO S/N - ZONA K - CIUDAD DE DIOS', 'cmimanuelbarreto@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('C.M.I. OLLANTAY', '00006107', 'I-4', 'SJM', '140136', 'AV. PROLONGACIÓN GABRIEL TORRES S/N - PAMPLONA ALTA', 'cmiollantay@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('C.S. LEONOR SAAVEDRA', '00006105', 'I-3', 'SJM', '140136', 'AV. TORRES PAZ - CDRA. 1 - ESQ. CDRA. 4 AV. LOS HÉROES', 'csleonorsaavedra@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('C.S. TREBOL AZUL', '00006122', 'I-3', 'SJM', '140136', 'AV. MIGUEL GRAU MZ. L - LOTE 15 - ALT. CDRA. 9 AV. PROLONG. CANEVARO -AA.HH. TRÉBOL AZUL', 'cstrebolazul@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('C.S. JESUS PODEROSO', '00006109', 'I-3', 'SJM', '140136', 'P.J. JESÚS PODEROSO S/N – MZ. T - LOTE C-PAMPLONA BAJA', 'csjesuspoderoso@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('C.S. VILLA SAN LUIS', '00006106', 'I-3', 'SJM', '140136', 'AV. SOLIDARIDAD Y JOSÉ C. MARIÁTEGUI MZ. H-7 - LOTE S/N- SECTOR VILLA SAN LUIS -PAMPLONA ALTA', 'csvillasanluis@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('C.S. SAN JUAN DE MIRAFLORES', '00006115', 'I-3', 'SJM', '140136', 'PSJE. SAN JUAN S/N -ZONA A', 'cssanjuandemiraflores@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. SAN FRANCISCO DE LA CRUZ', '00006110', 'I-2', 'SJM', '140136', 'PROLONGACIÓN CANEVARO S/N - SAN FRANCISCO DE LA CRUZ - PAMPLONA ALTA', 'pssanfcodelacruz@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. VIRGEN DEL BUEN PASO', '00006108', 'I-2', 'SJM', '140136', 'AV. CENTENARIO PARADERO 14 - SECTOR VIRGEN DEL BUEN PASO - PAMPLONA ALTA', 'psvirgendelbuenpaso@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. MARIANNE PREUSS DE STARK', '00013486', 'I-2', 'SJM', '140136', 'MZ. 78 - LT. 5 - AAHH. LOS LAURELES - PAMPLONA ALTA', 'psmpreussdestark@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. LA RINCONADA', '00006112', 'I-2', 'SJM', '140136', 'MZ. T2 - LOTE 15 – AA.HH. LA RINCONADA - PAMPLONA ALTA', 'pslarinconada@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. JOSÉ MARIA ARGUEDAS', '00006872', 'I-2', 'SJM', '140136', 'PJ. A – MZ. F - LOTE 01 - SECTOR JOSÉ MARÍA ARGUEDAS - PAMPLONA ALTA', 'psjosemariaarguedas@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. LEONCIO PRADO', '00006163', 'I-2', 'SJM', '140136', 'SAN MARTÍN MZ I-10 - LOTE 6 - SECTOR LEONCIO PRADO - PAMPLONA ALTA', '', 'ESTABLECIMIENTO', '5'),
	('P.S. 5 DE MAYO', '00007645', 'I-2', 'SJM', '140136', 'JR. LIBERTAD MZ. A6 - LOTE 28 - SECTOR 5 DE MAYO - PAMPLONA ALTA', 'ps05demayo@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. DESIDERIO MOSCOSO CASTILLO', '00023635', 'I-2', 'SJM', '140136', 'AA.HH. VIRGEN DE GUADALUPE MZ. E - LOTE 1 – NUEVA RINCONADA – URBANIZACION PAMPLONA ALTA', 'psdesideriomoscoso@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. 6 DE JULIO', '00006114', 'I-2', 'SJM', '140136', 'ASOCIACIÓN MAGISTERIAL – MZ. I - LOTE S/N - PAMPLONA BAJA', 'ps06dejulio@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. EL BRILLANTE', '00006113', 'I-2', 'SJM', '140136', 'PROLONGACIÓN AV. SAN JUAN CON AV. DEFENSORES DE LIMA S/N PAMPLONA ALTA', 'pselbrillante@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('C.S.M.C. 12 DE NOVIEMBRE', '00006111', 'I-3', 'SJM', '140136', 'AV. LAS AMÉRICAS - SECTOR 12 DE NOVIEMBRE', 'csmc12noviembre@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. PARAISO', '00006120', 'I-2', 'SJM', '140136', 'CALLE L - LT. 6 Y 7 MZ. H – AA.HH. PARAÍSO', 'pselparaiso@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. HEROES DEL PACIFICO', '00006123', 'I-2', 'SJM', '140136', 'JR. 1° DE ENERO S/N MZ. Q – AA.HH. PACÍFICO I', 'psheroesdelpacifico@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. RICARDO PALMA', '00006119', 'I-2', 'SJM', '140136', 'MZ. F - LOTE 1 - ASOCIACION DE VIVIENDA TRADICIONES RICARDO PALMA', 'psricardopalma@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. SANTA URSULA', '00006121', 'I-2', 'SJM', '140136', 'CALLE SANTA TERESA MZ. G - LOTE 17 S/N -COOPERATIVA SANTA ÚRSULA', 'pssantaursula@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. LADERAS DE VILLA', '00007434', 'I-2', 'SJM', '140136', 'PROLONGACIÓN AV. MIGUEL IGLESIAS S/N -MZ. V ', 'psladerasdevilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. VALLE SHARON', '00006116', 'I-2', 'SJM', '140136', 'ESQ. DE LOS ALELÍS Y CIPRECES S/N - VALLE SHARON', 'psvallesharon@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. VILLA SOLIDARIDAD', '00006118', 'I-2', 'SJM', '140136', 'CALLE 9 MZ. F-A - LOTE 3 – AA.HH. VILLA SOLIDARIDAD', 'psvillasolidaridad@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),
	('P.S. PAMPAS DE SAN JUAN', '00006117', 'I-2', 'SJM', '140136', 'AV. PEDRO SILVA CDRA. 10 S/N - ZONA C', 'pspampasdesanjuan@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '5'),

	('C.M.I. SAN JOSÉ', '00006132', 'I-4', 'VES', '140141', 'AV. LOS ÁNGELES S/N - SECTOR 1 - GRUPO 15', 'cmisanjose@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('C.M.I. CÉSAR LÓPEZ SILVA', '00006124', 'I-4', 'VES', '140141', 'SECTOR IV – MZ. B1 – LT. S/N - 1RA. ETAPA URB.PACHACAMAC', 'cmicesarlopezsilva@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('C.M.I. JUAN PABLO II', '00006133', 'I-4', 'VES', '140141', 'AV. MARIANO PASTOR SEVILLA S/N - SECTOR 6 - GRUPO 6', 'cmijuanpablo2@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('C.S. SAN MARTÍN DE PORRES', '00006125', 'I-3', 'VES', '140141', 'CALLE LOS BOMBEROS S/N SECTOR 2 - GRUPO 15', 'cssanmartindeporres@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('C.S.M.C. EL SOL DE VILLA', '00027622', 'I-3', 'VES', '140141', 'SECTOR 2 - GRUPO 6-LOTE 1 AL 4', 'csmcsoldevilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('C.S.M.C. VILLA EL SALVADOR', '00026282', 'I-3', 'VES', '140141', 'SECTOR 6, GRUPO 5, MANZANA I, LOTE 19 ', 'csmcvillaelsalvador@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('C.S.M.C. VIRGEN DE LA MERCED', '00029636', 'I-3', 'VES', '140141', 'AA.HH. EDILBERTO RAMOS GRUPO 1 - MZ. M PRIMA - SECTOR 10 ', '', 'ESTABLECIMIENTO', '6'),
	('P.S. SEÑOR DE LOS MILAGROS', '00006134', 'I-2', 'VES', '140141', 'SECTOR. 1 - GRUPO - 25 - MZ. D1 - LOTE 2', 'pssenordelosmilagros@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. LLANAVILLA', '00006135', 'I-2', 'VES', '140141', 'MZ F - LTE 05 - SECTOR 8', 'psllanavilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. BRISAS DE PACHACAMAC', '00006129', 'I-2', 'VES', '140141', 'AV. REICHE S/N – MZ. K - AA.HH. BRISAS DE PACHACAMAC', 'psbrisasdepachacamac@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. EDILBERTO RAMOS', '00006128', 'I-2', 'VES', '140141', 'AV. TAHUANTINSUYO S/N - MZ. U - SECTOR 10 - AA.HH. EDILBERTO RAMOS', 'psedilbertoramos@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. HÉROES DEL CENEPA', '00007278', 'I-3', 'VES', '140141', 'JR. HÉROES DEL CENEPA – MZ. C – LT. 20', 'psheroesdelcenepa@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. PRINCIPE DE ASTURIAS', '00006126', 'I-2', 'VES', '140141', 'AA.HH. PRINCIPE DE ASTURIAS S/N – LT. 17 - IV ETAPA DE PACHACAMAC', 'psprincipedeasturias@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. VIRGEN DE ASUNCION', '00006130', 'I-2', 'VES', '140141', 'SECTOR 3 - GRUPO 3 - MZ. P-1 - LOTE 4 B', 'psvirgendelaasuncion@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. CRISTO SALVADOR', '00006137', 'I-2', 'VES', '140141', 'SECTOR. 9 - GRUPO 2 - PARQUE CENTRAL', 'pscristosalvador@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. PACHACAMAC', '00006127', 'I-2', 'VES', '140141', 'AV. 200 MILLAS - BARRIO 2 - SECTOR 1- IV ETAPA - PACHACAMAC', 'pspachacamac@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. SAGRADA FAMILIA', '00006131', 'I-2', 'VES', '140141', 'SECTOR 2 - GRUPO 18 - PARQUE CENTRAL', 'pssagradafamilia@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. OASIS DE VILLA', '00006139', 'I-2', 'VES', '140141', 'SECTOR 10 - GRUPO 2 – MZ. P - LT 15 - AA.HH. OASIS DE VILLA', 'psoasisdevilla@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. FERNANDO LUYO SIERRA', '00006136', 'I-2', 'VES', '140141', 'SECTOR 7 - GRUPO 1 S/N - PARQUE CENTRAL', 'psfernandoluyosierra@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. SARITA COLONIA', '00006138', 'I-2', 'VES', '140141', 'SECTOR 2 - GRUPO 24 - PARQUE CENTRAL', 'pssaritacolonia@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),
	('P.S. SASBI', '00007716', 'I-2', 'VES', '140141', 'SECTOR 6 - GRUPO 01 - LT 3 - PARQUE CENTRAL', 'pssasbi@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '6'),

	('C.M.I. DANIEL ALCIDES CARRION', '00006153', 'I-4', 'VMT', '140132', 'AV. PACHACUTEC N° 3470 - URB. MARIANO MELGAR', 'cmidanielalcidescarrion@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('C.M.I. TABLADA DE LURIN', '00006164', 'I-4', 'VMT', '140132', 'AV. REPUBLICA S/N ESQUINA CON BILLINGHURST – 2° SECTOR', 'cmitabladadelurin@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('C.M.I. VILLA MARIA DEL TRIUNFO', '00006151', 'I-4', 'VMT', '140132', 'AV. PEDRO VALLE S/N', 'cmivillamariadeltriunfo@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('C.M.I. JOSE CARLOS MARIATEGUI', '00006152', 'I-4', 'VMT', '140132', 'AV. SIMON BOLIVAR CON JR. MARIANO NECOCHEA S/N - URB. SAN GABRIEL', 'cmijosecarlosmariategui@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('C.M.I. JOSE GALVEZ', '00006141', 'I-4', 'VMT', '140132', 'AV. AGRICULTURA S/N CRUCE CON AV. ARICA', 'cmijosegalvez@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('C.S. NUEVA ESPERANZA', '00006140', 'I-3', 'VMT', '140132', 'AV. 26 DE NOVIEMBRE N° 835 - NUEVA ESPERANZA', 'csnuevaesperanza@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('C.S.M.C. SAN GABRIEL ALTO', '00006155', 'I-3', 'VMT', '140132', 'CALLE LEONCIO PRADO N° 322 - URB. SAN GABRIEL ALTO', 'csmcsangabrielalto@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('C.A.A.M. TAYTA WASI', '00015544', 'I-3', 'VMT', '140132', 'AV. PRIMAVERA CRUCE CON CALLE SUCRE S/N - URB. SAN GABRIEL ALTO', 'camtaytawasi@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. TORRES DE MELGAR', '00006161', 'I-2', 'VMT', '140132', 'MZ. J - LOTE S/N - AA.HH. TORRES DE MELGAR', 'pstorresdemelgar@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. MICAELA BASTIDAS', '00006160', 'I-2', 'VMT', '140132', 'JR. JOSÉ OLAYA S/N', 'psmicaelabastidas@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. SANTA ROSA DE LAS CONCHITAS', '00006150', 'I-2', 'VMT', '140132', 'MZ. L - LOTE 18 – AA.HH. SANTA ROSA DE LAS CONCHITAS', 'pssantarosalasconchitas@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. DAVID GUERRERO DUARTE', '00006149', 'I-2', 'VMT', '140132', 'AV. LOS INCAS ESQ. JR. TÚPAC YUPANQUI – 2DO SECTOR', 'psdavidguerrero@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. SANTA ROSA DE BELEN', '00006154', 'I-2', 'VMT', '140132', 'AV. BOLIVAR CON AV. JOSÉ OLAYA – AA.HH. SANTA ROSA BAJA', 'pssantarosadebelen@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. 12 DE JUNIO', '00016630', 'I-2', 'VMT', '140132', 'CALLE AMANCAES S/N - INTERSECCIÓN CON PASAJE LAS FLORES - MZ. J - LT. 4 - AA.HH. 12 DE JUNIO', 'ps12dejunio@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. JUAN CARLOS SOBERON', '00017440', 'I-2', 'VMT', '140132', 'PROLONGACIÓN AV. JOSÉ CARLOS MARIATEGUI MZ. 6 - LOTE 18 - AA.HH. VIRGEN DE LA CANDELARIA', 'psjuancarlossoberon@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. PARAISO ALTO', '00009565', 'I-2', 'VMT', '140132', 'PROYECTO INTEGRAL PARAISO ALTO - MZ. F2 - LOTE 1 - SECTOR PARAÍSO ALTO', 'psparaisoalto@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. VALLE ALTO', '00006159', 'I-2', 'VMT', '140132', 'AV. JOSÉ OLAYA CON AV. ALFONSO UGARTE S/N - VALLECITO ALTO', 'psvallealto@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. VALLE BAJO', '00006156', 'I-2', 'VMT', '140132', 'CALLE INDEPENDENCIA LTE. 4 - MZ. O-10 - SECTOR SAN GABRIEL BAJO', 'psvallebajo@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. BUENOS AIRES', '00006157', 'I-2', 'VMT', '140132', 'BUENOS AIRES S/N -MZ. M-SAN GABRIEL BAJO', 'psbuenosaires@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. VILLA LIMATAMBO', '00006158', 'I-2', 'VMT', '140132', 'MZ. J1 - LOTE 2 - AA.HH. VILLA LIMATAMBO', 'psvillalimatambo@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. NUEVO PROGRESO', '00006145', 'I-2', 'VMT', '140132', 'MZ. F - LT. 1 - PROLONG. PACHACUTEC – AA.HH. NUEVO PROGRESO GRUPO 1', 'psnuevoprogreso@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. MODULO I', '00006146', 'I-2', 'VMT', '140132', 'PROLONGACIÓN LUCANAS S/N - PARADERO 12', 'psmoduloi@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. CIUDAD DE GOSEN', '00012847', 'I-2', 'VMT', '140132', 'DIVINO MAESTRO MZ. D - LOTE 11', 'psciudaddegosen@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. VIRGEN DE LOURDES', '00006142', 'I-2', 'VMT', '140132', 'AV. CONDEBAMBA S/N', 'psvirgendelourdes@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. CESAR VALLEJO', '00006144', 'I-2', 'VMT', '140132', 'CRUCE TRILCE Y COMERCIO', 'pscesarvallejo@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('P.S. NUEVA ESPERANZA ALTA', '00006143', 'I-2', 'VMT', '140132', 'AV. RAMIRO MERINO Y TACNA S/N - MZ. 9B - LOTE 1B - NUEVA ESPERANZA ALTA', 'psnuevaesperanzaalta@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7'),
	('C.S.M.C. MONSEÑOR JOSE RAMON GURRUCHAGA', '00027621', 'I-3', 'VMT', '140132', 'AV. SANTA ROSA N° 900 – TABLADA DE LURIN', 'csmcmjrguruchaga@dirislimasur.gob.pe', 'ESTABLECIMIENTO', '7');