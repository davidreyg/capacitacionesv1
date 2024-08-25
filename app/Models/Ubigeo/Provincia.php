<?php

namespace App\Models\Ubigeo;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Provincia extends Model
{
    use Sushi;
    protected $rows = [
        [
            "id" => 100,
            "name" => "Extranjero",
            "departamento_id" => 26
        ],
        [
            "id" => 101,
            "name" => "Chachapoyas",
            "departamento_id" => 1
        ],
        [
            "id" => 102,
            "name" => "Bagua",
            "departamento_id" => 1
        ],
        [
            "id" => 103,
            "name" => "Bongará",
            "departamento_id" => 1
        ],
        [
            "id" => 104,
            "name" => "Condorcanqui",
            "departamento_id" => 1
        ],
        [
            "id" => 105,
            "name" => "Luya",
            "departamento_id" => 1
        ],
        [
            "id" => 106,
            "name" => "Rodríguez de Mendoza",
            "departamento_id" => 1
        ],
        [
            "id" => 107,
            "name" => "Utcubamba",
            "departamento_id" => 1
        ],
        [
            "id" => 201,
            "name" => "Huaraz",
            "departamento_id" => 2
        ],
        [
            "id" => 202,
            "name" => "Aija",
            "departamento_id" => 2
        ],
        [
            "id" => 203,
            "name" => "Antonio Raymondi",
            "departamento_id" => 2
        ],
        [
            "id" => 204,
            "name" => "Asunción",
            "departamento_id" => 2
        ],
        [
            "id" => 205,
            "name" => "Bolognesi",
            "departamento_id" => 2
        ],
        [
            "id" => 206,
            "name" => "Carhuaz",
            "departamento_id" => 2
        ],
        [
            "id" => 207,
            "name" => "Carlos Fermín Fitzcarrald",
            "departamento_id" => 2
        ],
        [
            "id" => 208,
            "name" => "Casma",
            "departamento_id" => 2
        ],
        [
            "id" => 209,
            "name" => "Corongo",
            "departamento_id" => 2
        ],
        [
            "id" => 210,
            "name" => "Huari",
            "departamento_id" => 2
        ],
        [
            "id" => 211,
            "name" => "Huarmey",
            "departamento_id" => 2
        ],
        [
            "id" => 212,
            "name" => "Huaylas",
            "departamento_id" => 2
        ],
        [
            "id" => 213,
            "name" => "Mariscal Luzuriaga",
            "departamento_id" => 2
        ],
        [
            "id" => 214,
            "name" => "Ocros",
            "departamento_id" => 2
        ],
        [
            "id" => 215,
            "name" => "Pallasca",
            "departamento_id" => 2
        ],
        [
            "id" => 216,
            "name" => "Pomabamba",
            "departamento_id" => 2
        ],
        [
            "id" => 217,
            "name" => "Recuay",
            "departamento_id" => 2
        ],
        [
            "id" => 218,
            "name" => "Santa",
            "departamento_id" => 2
        ],
        [
            "id" => 219,
            "name" => "Sihuas",
            "departamento_id" => 2
        ],
        [
            "id" => 220,
            "name" => "Yungay",
            "departamento_id" => 2
        ],
        [
            "id" => 301,
            "name" => "Abancay",
            "departamento_id" => 3
        ],
        [
            "id" => 302,
            "name" => "Andahuaylas",
            "departamento_id" => 3
        ],
        [
            "id" => 303,
            "name" => "Antabamba",
            "departamento_id" => 3
        ],
        [
            "id" => 304,
            "name" => "Aymaraes",
            "departamento_id" => 3
        ],
        [
            "id" => 305,
            "name" => "Cotabambas",
            "departamento_id" => 3
        ],
        [
            "id" => 306,
            "name" => "Chincheros",
            "departamento_id" => 3
        ],
        [
            "id" => 307,
            "name" => "Grau",
            "departamento_id" => 3
        ],
        [
            "id" => 401,
            "name" => "Arequipa",
            "departamento_id" => 4
        ],
        [
            "id" => 402,
            "name" => "Camaná",
            "departamento_id" => 4
        ],
        [
            "id" => 403,
            "name" => "Caravelí",
            "departamento_id" => 4
        ],
        [
            "id" => 404,
            "name" => "Castilla",
            "departamento_id" => 4
        ],
        [
            "id" => 405,
            "name" => "Caylloma",
            "departamento_id" => 4
        ],
        [
            "id" => 406,
            "name" => "Condesuyos",
            "departamento_id" => 4
        ],
        [
            "id" => 407,
            "name" => "Islay",
            "departamento_id" => 4
        ],
        [
            "id" => 408,
            "name" => "La Uniòn",
            "departamento_id" => 4
        ],
        [
            "id" => 501,
            "name" => "Huamanga",
            "departamento_id" => 5
        ],
        [
            "id" => 502,
            "name" => "Cangallo",
            "departamento_id" => 5
        ],
        [
            "id" => 503,
            "name" => "Huanca Sancos",
            "departamento_id" => 5
        ],
        [
            "id" => 504,
            "name" => "Huanta",
            "departamento_id" => 5
        ],
        [
            "id" => 505,
            "name" => "La Mar",
            "departamento_id" => 5
        ],
        [
            "id" => 506,
            "name" => "Lucanas",
            "departamento_id" => 5
        ],
        [
            "id" => 507,
            "name" => "Parinacochas",
            "departamento_id" => 5
        ],
        [
            "id" => 508,
            "name" => "Pàucar del Sara Sara",
            "departamento_id" => 5
        ],
        [
            "id" => 509,
            "name" => "Sucre",
            "departamento_id" => 5
        ],
        [
            "id" => 510,
            "name" => "Víctor Fajardo",
            "departamento_id" => 5
        ],
        [
            "id" => 511,
            "name" => "Vilcas Huamán",
            "departamento_id" => 5
        ],
        [
            "id" => 601,
            "name" => "Cajamarca",
            "departamento_id" => 6
        ],
        [
            "id" => 602,
            "name" => "Cajabamba",
            "departamento_id" => 6
        ],
        [
            "id" => 603,
            "name" => "Celendín",
            "departamento_id" => 6
        ],
        [
            "id" => 604,
            "name" => "Chota",
            "departamento_id" => 6
        ],
        [
            "id" => 605,
            "name" => "Contumazá",
            "departamento_id" => 6
        ],
        [
            "id" => 606,
            "name" => "Cutervo",
            "departamento_id" => 6
        ],
        [
            "id" => 607,
            "name" => "Hualgayoc",
            "departamento_id" => 6
        ],
        [
            "id" => 608,
            "name" => "Jaén",
            "departamento_id" => 6
        ],
        [
            "id" => 609,
            "name" => "San Ignacio",
            "departamento_id" => 6
        ],
        [
            "id" => 610,
            "name" => "San Marcos",
            "departamento_id" => 6
        ],
        [
            "id" => 611,
            "name" => "San Miguel",
            "departamento_id" => 6
        ],
        [
            "id" => 612,
            "name" => "San Pablo",
            "departamento_id" => 6
        ],
        [
            "id" => 613,
            "name" => "Santa Cruz",
            "departamento_id" => 6
        ],
        [
            "id" => 701,
            "name" => "Prov. Const. del Callao",
            "departamento_id" => 7
        ],
        [
            "id" => 801,
            "name" => "Cusco",
            "departamento_id" => 8
        ],
        [
            "id" => 802,
            "name" => "Acomayo",
            "departamento_id" => 8
        ],
        [
            "id" => 803,
            "name" => "Anta",
            "departamento_id" => 8
        ],
        [
            "id" => 804,
            "name" => "Calca",
            "departamento_id" => 8
        ],
        [
            "id" => 805,
            "name" => "Canas",
            "departamento_id" => 8
        ],
        [
            "id" => 806,
            "name" => "Canchis",
            "departamento_id" => 8
        ],
        [
            "id" => 807,
            "name" => "Chumbivilcas",
            "departamento_id" => 8
        ],
        [
            "id" => 808,
            "name" => "Espinar",
            "departamento_id" => 8
        ],
        [
            "id" => 809,
            "name" => "La Convención",
            "departamento_id" => 8
        ],
        [
            "id" => 810,
            "name" => "Paruro",
            "departamento_id" => 8
        ],
        [
            "id" => 811,
            "name" => "Paucartambo",
            "departamento_id" => 8
        ],
        [
            "id" => 812,
            "name" => "Quispicanchi",
            "departamento_id" => 8
        ],
        [
            "id" => 813,
            "name" => "Urubamba",
            "departamento_id" => 8
        ],
        [
            "id" => 901,
            "name" => "Huancavelica",
            "departamento_id" => 9
        ],
        [
            "id" => 902,
            "name" => "Acobamba",
            "departamento_id" => 9
        ],
        [
            "id" => 903,
            "name" => "Angaraes",
            "departamento_id" => 9
        ],
        [
            "id" => 904,
            "name" => "Castrovirreyna",
            "departamento_id" => 9
        ],
        [
            "id" => 905,
            "name" => "Churcampa",
            "departamento_id" => 9
        ],
        [
            "id" => 906,
            "name" => "Huaytará",
            "departamento_id" => 9
        ],
        [
            "id" => 907,
            "name" => "Tayacaja",
            "departamento_id" => 9
        ],
        [
            "id" => 1001,
            "name" => "Huánuco",
            "departamento_id" => 10
        ],
        [
            "id" => 1002,
            "name" => "Ambo",
            "departamento_id" => 10
        ],
        [
            "id" => 1003,
            "name" => "Dos de Mayo",
            "departamento_id" => 10
        ],
        [
            "id" => 1004,
            "name" => "Huacaybamba",
            "departamento_id" => 10
        ],
        [
            "id" => 1005,
            "name" => "Huamalíes",
            "departamento_id" => 10
        ],
        [
            "id" => 1006,
            "name" => "Leoncio Prado",
            "departamento_id" => 10
        ],
        [
            "id" => 1007,
            "name" => "Marañón",
            "departamento_id" => 10
        ],
        [
            "id" => 1008,
            "name" => "Pachitea",
            "departamento_id" => 10
        ],
        [
            "id" => 1009,
            "name" => "Puerto Inca",
            "departamento_id" => 10
        ],
        [
            "id" => 1010,
            "name" => "Lauricocha ",
            "departamento_id" => 10
        ],
        [
            "id" => 1011,
            "name" => "Yarowilca ",
            "departamento_id" => 10
        ],
        [
            "id" => 1101,
            "name" => "Ica ",
            "departamento_id" => 11
        ],
        [
            "id" => 1102,
            "name" => "Chincha ",
            "departamento_id" => 11
        ],
        [
            "id" => 1103,
            "name" => "Nasca ",
            "departamento_id" => 11
        ],
        [
            "id" => 1104,
            "name" => "Palpa ",
            "departamento_id" => 11
        ],
        [
            "id" => 1105,
            "name" => "Pisco ",
            "departamento_id" => 11
        ],
        [
            "id" => 1201,
            "name" => "Huancayo ",
            "departamento_id" => 12
        ],
        [
            "id" => 1202,
            "name" => "Concepción ",
            "departamento_id" => 12
        ],
        [
            "id" => 1203,
            "name" => "Chanchamayo ",
            "departamento_id" => 12
        ],
        [
            "id" => 1204,
            "name" => "Jauja ",
            "departamento_id" => 12
        ],
        [
            "id" => 1205,
            "name" => "Junín ",
            "departamento_id" => 12
        ],
        [
            "id" => 1206,
            "name" => "Satipo ",
            "departamento_id" => 12
        ],
        [
            "id" => 1207,
            "name" => "Tarma ",
            "departamento_id" => 12
        ],
        [
            "id" => 1208,
            "name" => "Yauli ",
            "departamento_id" => 12
        ],
        [
            "id" => 1209,
            "name" => "Chupaca ",
            "departamento_id" => 12
        ],
        [
            "id" => 1301,
            "name" => "Trujillo ",
            "departamento_id" => 13
        ],
        [
            "id" => 1302,
            "name" => "Ascope ",
            "departamento_id" => 13
        ],
        [
            "id" => 1303,
            "name" => "Bolívar ",
            "departamento_id" => 13
        ],
        [
            "id" => 1304,
            "name" => "Chepén ",
            "departamento_id" => 13
        ],
        [
            "id" => 1305,
            "name" => "Julcán ",
            "departamento_id" => 13
        ],
        [
            "id" => 1306,
            "name" => "Otuzco ",
            "departamento_id" => 13
        ],
        [
            "id" => 1307,
            "name" => "Pacasmayo ",
            "departamento_id" => 13
        ],
        [
            "id" => 1308,
            "name" => "Pataz ",
            "departamento_id" => 13
        ],
        [
            "id" => 1309,
            "name" => "Sánchez Carrión ",
            "departamento_id" => 13
        ],
        [
            "id" => 1310,
            "name" => "Santiago de Chuco ",
            "departamento_id" => 13
        ],
        [
            "id" => 1311,
            "name" => "Gran Chimú ",
            "departamento_id" => 13
        ],
        [
            "id" => 1312,
            "name" => "Virú ",
            "departamento_id" => 13
        ],
        [
            "id" => 1401,
            "name" => "Chiclayo ",
            "departamento_id" => 14
        ],
        [
            "id" => 1402,
            "name" => "Ferreñafe ",
            "departamento_id" => 14
        ],
        [
            "id" => 1403,
            "name" => "Lambayeque ",
            "departamento_id" => 14
        ],
        [
            "id" => 1501,
            "name" => "Lima ",
            "departamento_id" => 15
        ],
        [
            "id" => 1502,
            "name" => "Barranca ",
            "departamento_id" => 15
        ],
        [
            "id" => 1503,
            "name" => "Cajatambo ",
            "departamento_id" => 15
        ],
        [
            "id" => 1504,
            "name" => "Canta ",
            "departamento_id" => 15
        ],
        [
            "id" => 1505,
            "name" => "Cañete ",
            "departamento_id" => 15
        ],
        [
            "id" => 1506,
            "name" => "Huaral ",
            "departamento_id" => 15
        ],
        [
            "id" => 1507,
            "name" => "Huarochirí ",
            "departamento_id" => 15
        ],
        [
            "id" => 1508,
            "name" => "Huaura ",
            "departamento_id" => 15
        ],
        [
            "id" => 1509,
            "name" => "Oyón ",
            "departamento_id" => 15
        ],
        [
            "id" => 1510,
            "name" => "Yauyos ",
            "departamento_id" => 15
        ],
        [
            "id" => 1601,
            "name" => "Maynas ",
            "departamento_id" => 16
        ],
        [
            "id" => 1602,
            "name" => "Alto Amazonas ",
            "departamento_id" => 16
        ],
        [
            "id" => 1603,
            "name" => "Loreto ",
            "departamento_id" => 16
        ],
        [
            "id" => 1604,
            "name" => "Mariscal Ramón Castilla ",
            "departamento_id" => 16
        ],
        [
            "id" => 1605,
            "name" => "Requena ",
            "departamento_id" => 16
        ],
        [
            "id" => 1606,
            "name" => "Ucayali ",
            "departamento_id" => 16
        ],
        [
            "id" => 1607,
            "name" => "Datem del Marañón ",
            "departamento_id" => 16
        ],
        [
            "id" => 1608,
            "name" => "Putumayo",
            "departamento_id" => 16
        ],
        [
            "id" => 1701,
            "name" => "Tambopata ",
            "departamento_id" => 17
        ],
        [
            "id" => 1702,
            "name" => "Manu ",
            "departamento_id" => 17
        ],
        [
            "id" => 1703,
            "name" => "Tahuamanu ",
            "departamento_id" => 17
        ],
        [
            "id" => 1801,
            "name" => "Mariscal Nieto ",
            "departamento_id" => 18
        ],
        [
            "id" => 1802,
            "name" => "General Sánchez Cerro ",
            "departamento_id" => 18
        ],
        [
            "id" => 1803,
            "name" => "Ilo ",
            "departamento_id" => 18
        ],
        [
            "id" => 1901,
            "name" => "Pasco ",
            "departamento_id" => 19
        ],
        [
            "id" => 1902,
            "name" => "Daniel Alcides Carrión ",
            "departamento_id" => 19
        ],
        [
            "id" => 1903,
            "name" => "Oxapampa ",
            "departamento_id" => 19
        ],
        [
            "id" => 2001,
            "name" => "Piura ",
            "departamento_id" => 20
        ],
        [
            "id" => 2002,
            "name" => "Ayabaca ",
            "departamento_id" => 20
        ],
        [
            "id" => 2003,
            "name" => "Huancabamba ",
            "departamento_id" => 20
        ],
        [
            "id" => 2004,
            "name" => "Morropón ",
            "departamento_id" => 20
        ],
        [
            "id" => 2005,
            "name" => "Paita ",
            "departamento_id" => 20
        ],
        [
            "id" => 2006,
            "name" => "Sullana ",
            "departamento_id" => 20
        ],
        [
            "id" => 2007,
            "name" => "Talara ",
            "departamento_id" => 20
        ],
        [
            "id" => 2008,
            "name" => "Sechura ",
            "departamento_id" => 20
        ],
        [
            "id" => 2101,
            "name" => "Puno ",
            "departamento_id" => 21
        ],
        [
            "id" => 2102,
            "name" => "Azángaro ",
            "departamento_id" => 21
        ],
        [
            "id" => 2103,
            "name" => "Carabaya ",
            "departamento_id" => 21
        ],
        [
            "id" => 2104,
            "name" => "Chucuito ",
            "departamento_id" => 21
        ],
        [
            "id" => 2105,
            "name" => "El Collao ",
            "departamento_id" => 21
        ],
        [
            "id" => 2106,
            "name" => "Huancané ",
            "departamento_id" => 21
        ],
        [
            "id" => 2107,
            "name" => "Lampa ",
            "departamento_id" => 21
        ],
        [
            "id" => 2108,
            "name" => "Melgar ",
            "departamento_id" => 21
        ],
        [
            "id" => 2109,
            "name" => "Moho ",
            "departamento_id" => 21
        ],
        [
            "id" => 2110,
            "name" => "San Antonio de Putina ",
            "departamento_id" => 21
        ],
        [
            "id" => 2111,
            "name" => "San Román ",
            "departamento_id" => 21
        ],
        [
            "id" => 2112,
            "name" => "Sandia ",
            "departamento_id" => 21
        ],
        [
            "id" => 2113,
            "name" => "Yunguyo ",
            "departamento_id" => 21
        ],
        [
            "id" => 2201,
            "name" => "Moyobamba ",
            "departamento_id" => 22
        ],
        [
            "id" => 2202,
            "name" => "Bellavista ",
            "departamento_id" => 22
        ],
        [
            "id" => 2203,
            "name" => "El Dorado ",
            "departamento_id" => 22
        ],
        [
            "id" => 2204,
            "name" => "Huallaga ",
            "departamento_id" => 22
        ],
        [
            "id" => 2205,
            "name" => "Lamas ",
            "departamento_id" => 22
        ],
        [
            "id" => 2206,
            "name" => "Mariscal Cáceres ",
            "departamento_id" => 22
        ],
        [
            "id" => 2207,
            "name" => "Picota ",
            "departamento_id" => 22
        ],
        [
            "id" => 2208,
            "name" => "Rioja ",
            "departamento_id" => 22
        ],
        [
            "id" => 2209,
            "name" => "San Martín ",
            "departamento_id" => 22
        ],
        [
            "id" => 2210,
            "name" => "Tocache ",
            "departamento_id" => 22
        ],
        [
            "id" => 2301,
            "name" => "Tacna ",
            "departamento_id" => 23
        ],
        [
            "id" => 2302,
            "name" => "Candarave ",
            "departamento_id" => 23
        ],
        [
            "id" => 2303,
            "name" => "Jorge Basadre ",
            "departamento_id" => 23
        ],
        [
            "id" => 2304,
            "name" => "Tarata ",
            "departamento_id" => 23
        ],
        [
            "id" => 2401,
            "name" => "Tumbes ",
            "departamento_id" => 24
        ],
        [
            "id" => 2402,
            "name" => "Contralmirante Villar ",
            "departamento_id" => 24
        ],
        [
            "id" => 2403,
            "name" => "Zarumilla ",
            "departamento_id" => 24
        ],
        [
            "id" => 2501,
            "name" => "Coronel Portillo ",
            "departamento_id" => 25
        ],
        [
            "id" => 2502,
            "name" => "Atalaya ",
            "departamento_id" => 25
        ],
        [
            "id" => 2503,
            "name" => "Padre Abad ",
            "departamento_id" => 25
        ],
        [
            "id" => 2504,
            "name" => "Purús",
            "departamento_id" => 25
        ]
    ];

    public function distrito()
    {
        return $this->hasMany(Distrito::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}

