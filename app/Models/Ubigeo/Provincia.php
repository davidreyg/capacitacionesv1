<?php

namespace App\Models\Ubigeo;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Provincia extends Model
{
    use Sushi;
    public $incrementing = false;
    protected $keyType = "string";

    protected $rows = [
        [
            "id" => "0101",
            "nombre" => "Chachapoyas",
            "departamento_id" => "01",
        ],
        [
            "id" => "0102",
            "nombre" => "Bagua",
            "departamento_id" => "01",
        ],
        [
            "id" => "0103",
            "nombre" => "Bongara",
            "departamento_id" => "01",
        ],
        [
            "id" => "0104",
            "nombre" => "Luya",
            "departamento_id" => "01",
        ],
        [
            "id" => "0105",
            "nombre" => "Rodriguez De Mendoza",
            "departamento_id" => "01",
        ],
        [
            "id" => "0106",
            "nombre" => "Condorcanqui",
            "departamento_id" => "01",
        ],
        [
            "id" => "0107",
            "nombre" => "Utcubamba",
            "departamento_id" => "01",
        ],
        [
            "id" => "0201",
            "nombre" => "Huaraz",
            "departamento_id" => "02",
        ],
        [
            "id" => "0202",
            "nombre" => "Aija",
            "departamento_id" => "02",
        ],
        [
            "id" => "0203",
            "nombre" => "Bolognesi",
            "departamento_id" => "02",
        ],
        [
            "id" => "0204",
            "nombre" => "Carhuaz",
            "departamento_id" => "02",
        ],
        [
            "id" => "0205",
            "nombre" => "Casma",
            "departamento_id" => "02",
        ],
        [
            "id" => "0206",
            "nombre" => "Corongo",
            "departamento_id" => "02",
        ],
        [
            "id" => "0207",
            "nombre" => "Huaylas",
            "departamento_id" => "02",
        ],
        [
            "id" => "0208",
            "nombre" => "Huari",
            "departamento_id" => "02",
        ],
        [
            "id" => "0209",
            "nombre" => "Mariscal Luzuriaga",
            "departamento_id" => "02",
        ],
        [
            "id" => "0210",
            "nombre" => "Pallasca",
            "departamento_id" => "02",
        ],
        [
            "id" => "0211",
            "nombre" => "Pomabamba",
            "departamento_id" => "02",
        ],
        [
            "id" => "0212",
            "nombre" => "Recuay",
            "departamento_id" => "02",
        ],
        [
            "id" => "0213",
            "nombre" => "Santa",
            "departamento_id" => "02",
        ],
        [
            "id" => "0214",
            "nombre" => "Sihuas",
            "departamento_id" => "02",
        ],
        [
            "id" => "0215",
            "nombre" => "Yungay",
            "departamento_id" => "02",
        ],
        [
            "id" => "0216",
            "nombre" => "Antonio Raimondi",
            "departamento_id" => "02",
        ],
        [
            "id" => "0217",
            "nombre" => "Carlos Fermin Fitzcarrald",
            "departamento_id" => "02",
        ],
        [
            "id" => "0218",
            "nombre" => "Asuncion",
            "departamento_id" => "02",
        ],
        [
            "id" => "0219",
            "nombre" => "Huarmey",
            "departamento_id" => "02",
        ],
        [
            "id" => "0220",
            "nombre" => "Ocros",
            "departamento_id" => "02",
        ],
        [
            "id" => "0301",
            "nombre" => "Abancay",
            "departamento_id" => "03",
        ],
        [
            "id" => "0302",
            "nombre" => "Aymaraes",
            "departamento_id" => "03",
        ],
        [
            "id" => "0303",
            "nombre" => "Andahuaylas",
            "departamento_id" => "03",
        ],
        [
            "id" => "0304",
            "nombre" => "Antabamba",
            "departamento_id" => "03",
        ],
        [
            "id" => "0305",
            "nombre" => "Cotabambas",
            "departamento_id" => "03",
        ],
        [
            "id" => "0306",
            "nombre" => "Grau",
            "departamento_id" => "03",
        ],
        [
            "id" => "0307",
            "nombre" => "Chincheros",
            "departamento_id" => "03",
        ],
        [
            "id" => "0401",
            "nombre" => "Arequipa",
            "departamento_id" => "04",
        ],
        [
            "id" => "0402",
            "nombre" => "Caylloma",
            "departamento_id" => "04",
        ],
        [
            "id" => "0403",
            "nombre" => "Camana",
            "departamento_id" => "04",
        ],
        [
            "id" => "0404",
            "nombre" => "Caraveli",
            "departamento_id" => "04",
        ],
        [
            "id" => "0405",
            "nombre" => "Castilla",
            "departamento_id" => "04",
        ],
        [
            "id" => "0406",
            "nombre" => "Condesuyos",
            "departamento_id" => "04",
        ],
        [
            "id" => "0407",
            "nombre" => "Islay",
            "departamento_id" => "04",
        ],
        [
            "id" => "0408",
            "nombre" => "La Union",
            "departamento_id" => "04",
        ],
        [
            "id" => "0501",
            "nombre" => "Huamanga",
            "departamento_id" => "05",
        ],
        [
            "id" => "0502",
            "nombre" => "Cangallo",
            "departamento_id" => "05",
        ],
        [
            "id" => "0503",
            "nombre" => "Huanta",
            "departamento_id" => "05",
        ],
        [
            "id" => "0504",
            "nombre" => "La Mar",
            "departamento_id" => "05",
        ],
        [
            "id" => "0505",
            "nombre" => "Lucanas",
            "departamento_id" => "05",
        ],
        [
            "id" => "0506",
            "nombre" => "Parinacochas",
            "departamento_id" => "05",
        ],
        [
            "id" => "0507",
            "nombre" => "Victor Fajardo",
            "departamento_id" => "05",
        ],
        [
            "id" => "0508",
            "nombre" => "Huanca Sancos",
            "departamento_id" => "05",
        ],
        [
            "id" => "0509",
            "nombre" => "Vilcas Huaman",
            "departamento_id" => "05",
        ],
        [
            "id" => "0510",
            "nombre" => "Paucar Del Sara Sara",
            "departamento_id" => "05",
        ],
        [
            "id" => "0511",
            "nombre" => "Sucre",
            "departamento_id" => "05",
        ],
        [
            "id" => "0601",
            "nombre" => "Cajamarca",
            "departamento_id" => "06",
        ],
        [
            "id" => "0602",
            "nombre" => "Cajabamba",
            "departamento_id" => "06",
        ],
        [
            "id" => "0603",
            "nombre" => "Celendin",
            "departamento_id" => "06",
        ],
        [
            "id" => "0604",
            "nombre" => "Contumaza",
            "departamento_id" => "06",
        ],
        [
            "id" => "0605",
            "nombre" => "Cutervo",
            "departamento_id" => "06",
        ],
        [
            "id" => "0606",
            "nombre" => "Chota",
            "departamento_id" => "06",
        ],
        [
            "id" => "0607",
            "nombre" => "Hualgayoc",
            "departamento_id" => "06",
        ],
        [
            "id" => "0608",
            "nombre" => "Jaen",
            "departamento_id" => "06",
        ],
        [
            "id" => "0609",
            "nombre" => "Santa Cruz",
            "departamento_id" => "06",
        ],
        [
            "id" => "0610",
            "nombre" => "San Miguel",
            "departamento_id" => "06",
        ],
        [
            "id" => "0611",
            "nombre" => "San Ignacio",
            "departamento_id" => "06",
        ],
        [
            "id" => "0612",
            "nombre" => "San Marcos",
            "departamento_id" => "06",
        ],
        [
            "id" => "0613",
            "nombre" => "San Pablo",
            "departamento_id" => "06",
        ],
        [
            "id" => "0701",
            "nombre" => "Cusco",
            "departamento_id" => "07",
        ],
        [
            "id" => "0702",
            "nombre" => "Acomayo",
            "departamento_id" => "07",
        ],
        [
            "id" => "0703",
            "nombre" => "Anta",
            "departamento_id" => "07",
        ],
        [
            "id" => "0704",
            "nombre" => "Calca",
            "departamento_id" => "07",
        ],
        [
            "id" => "0705",
            "nombre" => "Canas",
            "departamento_id" => "07",
        ],
        [
            "id" => "0706",
            "nombre" => "Canchis",
            "departamento_id" => "07",
        ],
        [
            "id" => "0707",
            "nombre" => "Chumbivilcas",
            "departamento_id" => "07",
        ],
        [
            "id" => "0708",
            "nombre" => "Espinar",
            "departamento_id" => "07",
        ],
        [
            "id" => "0709",
            "nombre" => "La Convencion",
            "departamento_id" => "07",
        ],
        [
            "id" => "0710",
            "nombre" => "Paruro",
            "departamento_id" => "07",
        ],
        [
            "id" => "0711",
            "nombre" => "Paucartambo",
            "departamento_id" => "07",
        ],
        [
            "id" => "0712",
            "nombre" => "Quispicanchi",
            "departamento_id" => "07",
        ],
        [
            "id" => "0713",
            "nombre" => "Urubamba",
            "departamento_id" => "07",
        ],
        [
            "id" => "0801",
            "nombre" => "Huancavelica",
            "departamento_id" => "08",
        ],
        [
            "id" => "0802",
            "nombre" => "Acobamba",
            "departamento_id" => "08",
        ],
        [
            "id" => "0803",
            "nombre" => "Angaraes",
            "departamento_id" => "08",
        ],
        [
            "id" => "0804",
            "nombre" => "Castrovirreyna",
            "departamento_id" => "08",
        ],
        [
            "id" => "0805",
            "nombre" => "Tayacaja",
            "departamento_id" => "08",
        ],
        [
            "id" => "0806",
            "nombre" => "Huaytara",
            "departamento_id" => "08",
        ],
        [
            "id" => "0807",
            "nombre" => "Churcampa",
            "departamento_id" => "08",
        ],
        [
            "id" => "0901",
            "nombre" => "Huanuco",
            "departamento_id" => "09",
        ],
        [
            "id" => "0902",
            "nombre" => "Ambo",
            "departamento_id" => "09",
        ],
        [
            "id" => "0903",
            "nombre" => "Dos De Mayo",
            "departamento_id" => "09",
        ],
        [
            "id" => "0904",
            "nombre" => "Huamalies",
            "departamento_id" => "09",
        ],
        [
            "id" => "0905",
            "nombre" => "Marañon",
            "departamento_id" => "09",
        ],
        [
            "id" => "0906",
            "nombre" => "Leoncio Prado",
            "departamento_id" => "09",
        ],
        [
            "id" => "0907",
            "nombre" => "Pachitea",
            "departamento_id" => "09",
        ],
        [
            "id" => "0908",
            "nombre" => "Puerto Inca",
            "departamento_id" => "09",
        ],
        [
            "id" => "0909",
            "nombre" => "Huacaybamba",
            "departamento_id" => "09",
        ],
        [
            "id" => "0910",
            "nombre" => "Lauricocha",
            "departamento_id" => "09",
        ],
        [
            "id" => "0911",
            "nombre" => "Yarowilca",
            "departamento_id" => "09",
        ],
        [
            "id" => "1001",
            "nombre" => "Ica",
            "departamento_id" => "10",
        ],
        [
            "id" => "1002",
            "nombre" => "Chincha",
            "departamento_id" => "10",
        ],
        [
            "id" => "1003",
            "nombre" => "Nazca",
            "departamento_id" => "10",
        ],
        [
            "id" => "1004",
            "nombre" => "Pisco",
            "departamento_id" => "10",
        ],
        [
            "id" => "1005",
            "nombre" => "Palpa",
            "departamento_id" => "10",
        ],
        [
            "id" => "1101",
            "nombre" => "Huancayo",
            "departamento_id" => "11",
        ],
        [
            "id" => "1102",
            "nombre" => "Concepcion",
            "departamento_id" => "11",
        ],
        [
            "id" => "1103",
            "nombre" => "Jauja",
            "departamento_id" => "11",
        ],
        [
            "id" => "1104",
            "nombre" => "Junin",
            "departamento_id" => "11",
        ],
        [
            "id" => "1105",
            "nombre" => "Tarma",
            "departamento_id" => "11",
        ],
        [
            "id" => "1106",
            "nombre" => "Yauli",
            "departamento_id" => "11",
        ],
        [
            "id" => "1107",
            "nombre" => "Satipo",
            "departamento_id" => "11",
        ],
        [
            "id" => "1108",
            "nombre" => "Chanchamayo",
            "departamento_id" => "11",
        ],
        [
            "id" => "1109",
            "nombre" => "Chupaca",
            "departamento_id" => "11",
        ],
        [
            "id" => "1201",
            "nombre" => "Trujillo",
            "departamento_id" => "12",
        ],
        [
            "id" => "1202",
            "nombre" => "Bolivar",
            "departamento_id" => "12",
        ],
        [
            "id" => "1203",
            "nombre" => "Sanchez Carrion",
            "departamento_id" => "12",
        ],
        [
            "id" => "1204",
            "nombre" => "Otuzco",
            "departamento_id" => "12",
        ],
        [
            "id" => "1205",
            "nombre" => "Pacasmayo",
            "departamento_id" => "12",
        ],
        [
            "id" => "1206",
            "nombre" => "Pataz",
            "departamento_id" => "12",
        ],
        [
            "id" => "1207",
            "nombre" => "Santiago De Chuco",
            "departamento_id" => "12",
        ],
        [
            "id" => "1208",
            "nombre" => "Ascope",
            "departamento_id" => "12",
        ],
        [
            "id" => "1209",
            "nombre" => "Chepen",
            "departamento_id" => "12",
        ],
        [
            "id" => "1210",
            "nombre" => "Julcan",
            "departamento_id" => "12",
        ],
        [
            "id" => "1211",
            "nombre" => "Gran Chimu",
            "departamento_id" => "12",
        ],
        [
            "id" => "1212",
            "nombre" => "Viru",
            "departamento_id" => "12",
        ],
        [
            "id" => "1301",
            "nombre" => "Chiclayo",
            "departamento_id" => "13",
        ],
        [
            "id" => "1302",
            "nombre" => "Ferreñafe",
            "departamento_id" => "13",
        ],
        [
            "id" => "1303",
            "nombre" => "Lambayeque",
            "departamento_id" => "13",
        ],
        [
            "id" => "1401",
            "nombre" => "Lima",
            "departamento_id" => "14",
        ],
        [
            "id" => "1402",
            "nombre" => "Cajatambo",
            "departamento_id" => "14",
        ],
        [
            "id" => "1403",
            "nombre" => "Canta",
            "departamento_id" => "14",
        ],
        [
            "id" => "1404",
            "nombre" => "Cañete",
            "departamento_id" => "14",
        ],
        [
            "id" => "1405",
            "nombre" => "Huaura",
            "departamento_id" => "14",
        ],
        [
            "id" => "1406",
            "nombre" => "Huarochiri",
            "departamento_id" => "14",
        ],
        [
            "id" => "1407",
            "nombre" => "Yauyos",
            "departamento_id" => "14",
        ],
        [
            "id" => "1408",
            "nombre" => "Huaral",
            "departamento_id" => "14",
        ],
        [
            "id" => "1409",
            "nombre" => "Barranca",
            "departamento_id" => "14",
        ],
        [
            "id" => "1410",
            "nombre" => "Oyon",
            "departamento_id" => "14",
        ],
        [
            "id" => "1501",
            "nombre" => "Maynas",
            "departamento_id" => "15",
        ],
        [
            "id" => "1502",
            "nombre" => "Alto Amazonas",
            "departamento_id" => "15",
        ],
        [
            "id" => "1503",
            "nombre" => "Loreto",
            "departamento_id" => "15",
        ],
        [
            "id" => "1504",
            "nombre" => "Requena",
            "departamento_id" => "15",
        ],
        [
            "id" => "1505",
            "nombre" => "Ucayali",
            "departamento_id" => "15",
        ],
        [
            "id" => "1506",
            "nombre" => "Mariscal Ramon Castilla",
            "departamento_id" => "15",
        ],
        [
            "id" => "1507",
            "nombre" => "Datem Del Marañon",
            "departamento_id" => "15",
        ],
        [
            "id" => "1601",
            "nombre" => "Tambopata",
            "departamento_id" => "16",
        ],
        [
            "id" => "1602",
            "nombre" => "Manu",
            "departamento_id" => "16",
        ],
        [
            "id" => "1603",
            "nombre" => "Tahuamanu",
            "departamento_id" => "16",
        ],
        [
            "id" => "1701",
            "nombre" => "Mariscal Nieto",
            "departamento_id" => "17",
        ],
        [
            "id" => "1702",
            "nombre" => "General Sanchez Cerro",
            "departamento_id" => "17",
        ],
        [
            "id" => "1703",
            "nombre" => "Ilo",
            "departamento_id" => "17",
        ],
        [
            "id" => "1801",
            "nombre" => "Pasco",
            "departamento_id" => "18",
        ],
        [
            "id" => "1802",
            "nombre" => "Daniel Alcides Carrion",
            "departamento_id" => "18",
        ],
        [
            "id" => "1803",
            "nombre" => "Oxapampa",
            "departamento_id" => "18",
        ],
        [
            "id" => "1901",
            "nombre" => "Piura",
            "departamento_id" => "19",
        ],
        [
            "id" => "1902",
            "nombre" => "Ayabaca",
            "departamento_id" => "19",
        ],
        [
            "id" => "1903",
            "nombre" => "Huancabamba",
            "departamento_id" => "19",
        ],
        [
            "id" => "1904",
            "nombre" => "Morropon",
            "departamento_id" => "19",
        ],
        [
            "id" => "1905",
            "nombre" => "Paita",
            "departamento_id" => "19",
        ],
        [
            "id" => "1906",
            "nombre" => "Sullana",
            "departamento_id" => "19",
        ],
        [
            "id" => "1907",
            "nombre" => "Talara",
            "departamento_id" => "19",
        ],
        [
            "id" => "1908",
            "nombre" => "Sechura",
            "departamento_id" => "19",
        ],
        [
            "id" => "2001",
            "nombre" => "Puno",
            "departamento_id" => "20",
        ],
        [
            "id" => "2002",
            "nombre" => "Azangaro",
            "departamento_id" => "20",
        ],
        [
            "id" => "2003",
            "nombre" => "Carabaya",
            "departamento_id" => "20",
        ],
        [
            "id" => "2004",
            "nombre" => "Chucuito",
            "departamento_id" => "20",
        ],
        [
            "id" => "2005",
            "nombre" => "Huancane",
            "departamento_id" => "20",
        ],
        [
            "id" => "2006",
            "nombre" => "Lampa",
            "departamento_id" => "20",
        ],
        [
            "id" => "2007",
            "nombre" => "Melgar",
            "departamento_id" => "20",
        ],
        [
            "id" => "2008",
            "nombre" => "Sandia",
            "departamento_id" => "20",
        ],
        [
            "id" => "2009",
            "nombre" => "San Roman",
            "departamento_id" => "20",
        ],
        [
            "id" => "2010",
            "nombre" => "Yunguyo",
            "departamento_id" => "20",
        ],
        [
            "id" => "2011",
            "nombre" => "San Antonio De Putina",
            "departamento_id" => "20",
        ],
        [
            "id" => "2012",
            "nombre" => "El Collao",
            "departamento_id" => "20",
        ],
        [
            "id" => "2013",
            "nombre" => "Moho",
            "departamento_id" => "20",
        ],
        [
            "id" => "2101",
            "nombre" => "Moyobamba",
            "departamento_id" => "21",
        ],
        [
            "id" => "2102",
            "nombre" => "Huallaga",
            "departamento_id" => "21",
        ],
        [
            "id" => "2103",
            "nombre" => "Lamas",
            "departamento_id" => "21",
        ],
        [
            "id" => "2104",
            "nombre" => "Mariscal Caceres",
            "departamento_id" => "21",
        ],
        [
            "id" => "2105",
            "nombre" => "Rioja",
            "departamento_id" => "21",
        ],
        [
            "id" => "2106",
            "nombre" => "San Martin",
            "departamento_id" => "21",
        ],
        [
            "id" => "2107",
            "nombre" => "Bellavista",
            "departamento_id" => "21",
        ],
        [
            "id" => "2108",
            "nombre" => "Tocache",
            "departamento_id" => "21",
        ],
        [
            "id" => "2109",
            "nombre" => "Picota",
            "departamento_id" => "21",
        ],
        [
            "id" => "2110",
            "nombre" => "El Dorado",
            "departamento_id" => "21",
        ],
        [
            "id" => "2201",
            "nombre" => "Tacna",
            "departamento_id" => "22",
        ],
        [
            "id" => "2202",
            "nombre" => "Tarata",
            "departamento_id" => "22",
        ],
        [
            "id" => "2203",
            "nombre" => "Jorge Basadre",
            "departamento_id" => "22",
        ],
        [
            "id" => "2204",
            "nombre" => "Candarave",
            "departamento_id" => "22",
        ],
        [
            "id" => "2301",
            "nombre" => "Tumbes",
            "departamento_id" => "23",
        ],
        [
            "id" => "2302",
            "nombre" => "Contralmirante Villar",
            "departamento_id" => "23",
        ],
        [
            "id" => "2303",
            "nombre" => "Zarumilla",
            "departamento_id" => "23",
        ],
        [
            "id" => "2401",
            "nombre" => "Callao",
            "departamento_id" => "24",
        ],
        [
            "id" => "2501",
            "nombre" => "Coronel Portillo",
            "departamento_id" => "25",
        ],
        [
            "id" => "2502",
            "nombre" => "Padre Abad",
            "departamento_id" => "25",
        ],
        [
            "id" => "2503",
            "nombre" => "Atalaya",
            "departamento_id" => "25",
        ],
        [
            "id" => "2504",
            "nombre" => "Purus",
            "departamento_id" => "25",
        ],
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
