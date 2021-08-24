<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cities')->delete();
        
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '012801000',
                'name' => 'Adams',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012801',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => '012802000',
                'name' => 'Bacarra',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012802',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => '012803000',
                'name' => 'Badoc',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012803',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => '012804000',
                'name' => 'Bangui',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012804',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => '012805000',
                'name' => 'City of Batac',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012805',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => '012806000',
                'name' => 'Burgos',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012806',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => '012807000',
                'name' => 'Carasi',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012807',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => '012808000',
                'name' => 'Currimao',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012808',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => '012809000',
                'name' => 'Dingras',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012809',
            ),
            9 => 
            array (
                'id' => 10,
                'code' => '012810000',
                'name' => 'Dumalneg',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012810',
            ),
            10 => 
            array (
                'id' => 11,
                'code' => '012811000',
                'name' => 'Banna',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012811',
            ),
            11 => 
            array (
                'id' => 12,
                'code' => '012812000',
            'name' => 'City of Laoag (Capital)',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012812',
            ),
            12 => 
            array (
                'id' => 13,
                'code' => '012813000',
                'name' => 'Marcos',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012813',
            ),
            13 => 
            array (
                'id' => 14,
                'code' => '012814000',
                'name' => 'Nueva Era',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012814',
            ),
            14 => 
            array (
                'id' => 15,
                'code' => '012815000',
                'name' => 'Pagudpud',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012815',
            ),
            15 => 
            array (
                'id' => 16,
                'code' => '012816000',
                'name' => 'Paoay',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012816',
            ),
            16 => 
            array (
                'id' => 17,
                'code' => '012817000',
                'name' => 'Pasuquin',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012817',
            ),
            17 => 
            array (
                'id' => 18,
                'code' => '012818000',
                'name' => 'Piddig',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012818',
            ),
            18 => 
            array (
                'id' => 19,
                'code' => '012819000',
                'name' => 'Pinili',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012819',
            ),
            19 => 
            array (
                'id' => 20,
                'code' => '012820000',
                'name' => 'San Nicolas',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012820',
            ),
            20 => 
            array (
                'id' => 21,
                'code' => '012821000',
                'name' => 'Sarrat',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012821',
            ),
            21 => 
            array (
                'id' => 22,
                'code' => '012822000',
                'name' => 'Solsona',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012822',
            ),
            22 => 
            array (
                'id' => 23,
                'code' => '012823000',
                'name' => 'Vintar',
                'region_id' => '01',
                'province_id' => '0128',
                'city_id' => '012823',
            ),
            23 => 
            array (
                'id' => 24,
                'code' => '012901000',
                'name' => 'Alilem',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012901',
            ),
            24 => 
            array (
                'id' => 25,
                'code' => '012902000',
                'name' => 'Banayoyo',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012902',
            ),
            25 => 
            array (
                'id' => 26,
                'code' => '012903000',
                'name' => 'Bantay',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012903',
            ),
            26 => 
            array (
                'id' => 27,
                'code' => '012904000',
                'name' => 'Burgos',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012904',
            ),
            27 => 
            array (
                'id' => 28,
                'code' => '012905000',
                'name' => 'Cabugao',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012905',
            ),
            28 => 
            array (
                'id' => 29,
                'code' => '012906000',
                'name' => 'City of Candon',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012906',
            ),
            29 => 
            array (
                'id' => 30,
                'code' => '012907000',
                'name' => 'Caoayan',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012907',
            ),
            30 => 
            array (
                'id' => 31,
                'code' => '012908000',
                'name' => 'Cervantes',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012908',
            ),
            31 => 
            array (
                'id' => 32,
                'code' => '012909000',
                'name' => 'Galimuyod',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012909',
            ),
            32 => 
            array (
                'id' => 33,
                'code' => '012910000',
                'name' => 'Gregorio del Pilar',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012910',
            ),
            33 => 
            array (
                'id' => 34,
                'code' => '012911000',
                'name' => 'Lidlidda',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012911',
            ),
            34 => 
            array (
                'id' => 35,
                'code' => '012912000',
                'name' => 'Magsingal',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012912',
            ),
            35 => 
            array (
                'id' => 36,
                'code' => '012913000',
                'name' => 'Nagbukel',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012913',
            ),
            36 => 
            array (
                'id' => 37,
                'code' => '012914000',
                'name' => 'Narvacan',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012914',
            ),
            37 => 
            array (
                'id' => 38,
                'code' => '012915000',
                'name' => 'Quirino',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012915',
            ),
            38 => 
            array (
                'id' => 39,
                'code' => '012916000',
                'name' => 'Salcedo',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012916',
            ),
            39 => 
            array (
                'id' => 40,
                'code' => '012917000',
                'name' => 'San Emilio',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012917',
            ),
            40 => 
            array (
                'id' => 41,
                'code' => '012918000',
                'name' => 'San Esteban',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012918',
            ),
            41 => 
            array (
                'id' => 42,
                'code' => '012919000',
                'name' => 'San Ildefonso',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012919',
            ),
            42 => 
            array (
                'id' => 43,
                'code' => '012920000',
                'name' => 'San Juan',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012920',
            ),
            43 => 
            array (
                'id' => 44,
                'code' => '012921000',
                'name' => 'San Vicente',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012921',
            ),
            44 => 
            array (
                'id' => 45,
                'code' => '012922000',
                'name' => 'Santa',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012922',
            ),
            45 => 
            array (
                'id' => 46,
                'code' => '012923000',
                'name' => 'Santa Catalina',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012923',
            ),
            46 => 
            array (
                'id' => 47,
                'code' => '012924000',
                'name' => 'Santa Cruz',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012924',
            ),
            47 => 
            array (
                'id' => 48,
                'code' => '012925000',
                'name' => 'Santa Lucia',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012925',
            ),
            48 => 
            array (
                'id' => 49,
                'code' => '012926000',
                'name' => 'Santa Maria',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012926',
            ),
            49 => 
            array (
                'id' => 50,
                'code' => '012927000',
                'name' => 'Santiago',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012927',
            ),
            50 => 
            array (
                'id' => 51,
                'code' => '012928000',
                'name' => 'Santo Domingo',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012928',
            ),
            51 => 
            array (
                'id' => 52,
                'code' => '012929000',
                'name' => 'Sigay',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012929',
            ),
            52 => 
            array (
                'id' => 53,
                'code' => '012930000',
                'name' => 'Sinait',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012930',
            ),
            53 => 
            array (
                'id' => 54,
                'code' => '012931000',
                'name' => 'Sugpon',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012931',
            ),
            54 => 
            array (
                'id' => 55,
                'code' => '012932000',
                'name' => 'Suyo',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012932',
            ),
            55 => 
            array (
                'id' => 56,
                'code' => '012933000',
                'name' => 'Tagudin',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012933',
            ),
            56 => 
            array (
                'id' => 57,
                'code' => '012934000',
            'name' => 'City of Vigan (Capital)',
                'region_id' => '01',
                'province_id' => '0129',
                'city_id' => '012934',
            ),
            57 => 
            array (
                'id' => 58,
                'code' => '013301000',
                'name' => 'Agoo',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013301',
            ),
            58 => 
            array (
                'id' => 59,
                'code' => '013302000',
                'name' => 'Aringay',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013302',
            ),
            59 => 
            array (
                'id' => 60,
                'code' => '013303000',
                'name' => 'Bacnotan',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013303',
            ),
            60 => 
            array (
                'id' => 61,
                'code' => '013304000',
                'name' => 'Bagulin',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013304',
            ),
            61 => 
            array (
                'id' => 62,
                'code' => '013305000',
                'name' => 'Balaoan',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013305',
            ),
            62 => 
            array (
                'id' => 63,
                'code' => '013306000',
                'name' => 'Bangar',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013306',
            ),
            63 => 
            array (
                'id' => 64,
                'code' => '013307000',
                'name' => 'Bauang',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013307',
            ),
            64 => 
            array (
                'id' => 65,
                'code' => '013308000',
                'name' => 'Burgos',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013308',
            ),
            65 => 
            array (
                'id' => 66,
                'code' => '013309000',
                'name' => 'Caba',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013309',
            ),
            66 => 
            array (
                'id' => 67,
                'code' => '013310000',
                'name' => 'Luna',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013310',
            ),
            67 => 
            array (
                'id' => 68,
                'code' => '013311000',
                'name' => 'Naguilian',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013311',
            ),
            68 => 
            array (
                'id' => 69,
                'code' => '013312000',
                'name' => 'Pugo',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013312',
            ),
            69 => 
            array (
                'id' => 70,
                'code' => '013313000',
                'name' => 'Rosario',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013313',
            ),
            70 => 
            array (
                'id' => 71,
                'code' => '013314000',
            'name' => 'City of San Fernando (Capital)',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013314',
            ),
            71 => 
            array (
                'id' => 72,
                'code' => '013315000',
                'name' => 'San Gabriel',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013315',
            ),
            72 => 
            array (
                'id' => 73,
                'code' => '013316000',
                'name' => 'San Juan',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013316',
            ),
            73 => 
            array (
                'id' => 74,
                'code' => '013317000',
                'name' => 'Santo Tomas',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013317',
            ),
            74 => 
            array (
                'id' => 75,
                'code' => '013318000',
                'name' => 'Santol',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013318',
            ),
            75 => 
            array (
                'id' => 76,
                'code' => '013319000',
                'name' => 'Sudipen',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013319',
            ),
            76 => 
            array (
                'id' => 77,
                'code' => '013320000',
                'name' => 'Tubao',
                'region_id' => '01',
                'province_id' => '0133',
                'city_id' => '013320',
            ),
            77 => 
            array (
                'id' => 78,
                'code' => '015501000',
                'name' => 'Agno',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015501',
            ),
            78 => 
            array (
                'id' => 79,
                'code' => '015502000',
                'name' => 'Aguilar',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015502',
            ),
            79 => 
            array (
                'id' => 80,
                'code' => '015503000',
                'name' => 'City of Alaminos',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015503',
            ),
            80 => 
            array (
                'id' => 81,
                'code' => '015504000',
                'name' => 'Alcala',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015504',
            ),
            81 => 
            array (
                'id' => 82,
                'code' => '015505000',
                'name' => 'Anda',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015505',
            ),
            82 => 
            array (
                'id' => 83,
                'code' => '015506000',
                'name' => 'Asingan',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015506',
            ),
            83 => 
            array (
                'id' => 84,
                'code' => '015507000',
                'name' => 'Balungao',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015507',
            ),
            84 => 
            array (
                'id' => 85,
                'code' => '015508000',
                'name' => 'Bani',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015508',
            ),
            85 => 
            array (
                'id' => 86,
                'code' => '015509000',
                'name' => 'Basista',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015509',
            ),
            86 => 
            array (
                'id' => 87,
                'code' => '015510000',
                'name' => 'Bautista',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015510',
            ),
            87 => 
            array (
                'id' => 88,
                'code' => '015511000',
                'name' => 'Bayambang',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015511',
            ),
            88 => 
            array (
                'id' => 89,
                'code' => '015512000',
                'name' => 'Binalonan',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015512',
            ),
            89 => 
            array (
                'id' => 90,
                'code' => '015513000',
                'name' => 'Binmaley',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015513',
            ),
            90 => 
            array (
                'id' => 91,
                'code' => '015514000',
                'name' => 'Bolinao',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015514',
            ),
            91 => 
            array (
                'id' => 92,
                'code' => '015515000',
                'name' => 'Bugallon',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015515',
            ),
            92 => 
            array (
                'id' => 93,
                'code' => '015516000',
                'name' => 'Burgos',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015516',
            ),
            93 => 
            array (
                'id' => 94,
                'code' => '015517000',
                'name' => 'Calasiao',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015517',
            ),
            94 => 
            array (
                'id' => 95,
                'code' => '015518000',
                'name' => 'City of Dagupan',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015518',
            ),
            95 => 
            array (
                'id' => 96,
                'code' => '015519000',
                'name' => 'Dasol',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015519',
            ),
            96 => 
            array (
                'id' => 97,
                'code' => '015520000',
                'name' => 'Infanta',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015520',
            ),
            97 => 
            array (
                'id' => 98,
                'code' => '015521000',
                'name' => 'Labrador',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015521',
            ),
            98 => 
            array (
                'id' => 99,
                'code' => '015522000',
            'name' => 'Lingayen (Capital)',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015522',
            ),
            99 => 
            array (
                'id' => 100,
                'code' => '015523000',
                'name' => 'Mabini',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015523',
            ),
            100 => 
            array (
                'id' => 101,
                'code' => '015524000',
                'name' => 'Malasiqui',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015524',
            ),
            101 => 
            array (
                'id' => 102,
                'code' => '015525000',
                'name' => 'Manaoag',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015525',
            ),
            102 => 
            array (
                'id' => 103,
                'code' => '015526000',
                'name' => 'Mangaldan',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015526',
            ),
            103 => 
            array (
                'id' => 104,
                'code' => '015527000',
                'name' => 'Mangatarem',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015527',
            ),
            104 => 
            array (
                'id' => 105,
                'code' => '015528000',
                'name' => 'Mapandan',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015528',
            ),
            105 => 
            array (
                'id' => 106,
                'code' => '015529000',
                'name' => 'Natividad',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015529',
            ),
            106 => 
            array (
                'id' => 107,
                'code' => '015530000',
                'name' => 'Pozorrubio',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015530',
            ),
            107 => 
            array (
                'id' => 108,
                'code' => '015531000',
                'name' => 'Rosales',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015531',
            ),
            108 => 
            array (
                'id' => 109,
                'code' => '015532000',
                'name' => 'City of San Carlos',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015532',
            ),
            109 => 
            array (
                'id' => 110,
                'code' => '015533000',
                'name' => 'San Fabian',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015533',
            ),
            110 => 
            array (
                'id' => 111,
                'code' => '015534000',
                'name' => 'San Jacinto',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015534',
            ),
            111 => 
            array (
                'id' => 112,
                'code' => '015535000',
                'name' => 'San Manuel',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015535',
            ),
            112 => 
            array (
                'id' => 113,
                'code' => '015536000',
                'name' => 'San Nicolas',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015536',
            ),
            113 => 
            array (
                'id' => 114,
                'code' => '015537000',
                'name' => 'San Quintin',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015537',
            ),
            114 => 
            array (
                'id' => 115,
                'code' => '015538000',
                'name' => 'Santa Barbara',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015538',
            ),
            115 => 
            array (
                'id' => 116,
                'code' => '015539000',
                'name' => 'Santa Maria',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015539',
            ),
            116 => 
            array (
                'id' => 117,
                'code' => '015540000',
                'name' => 'Santo Tomas',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015540',
            ),
            117 => 
            array (
                'id' => 118,
                'code' => '015541000',
                'name' => 'Sison',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015541',
            ),
            118 => 
            array (
                'id' => 119,
                'code' => '015542000',
                'name' => 'Sual',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015542',
            ),
            119 => 
            array (
                'id' => 120,
                'code' => '015543000',
                'name' => 'Tayug',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015543',
            ),
            120 => 
            array (
                'id' => 121,
                'code' => '015544000',
                'name' => 'Umingan',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015544',
            ),
            121 => 
            array (
                'id' => 122,
                'code' => '015545000',
                'name' => 'Urbiztondo',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015545',
            ),
            122 => 
            array (
                'id' => 123,
                'code' => '015546000',
                'name' => 'City of Urdaneta',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015546',
            ),
            123 => 
            array (
                'id' => 124,
                'code' => '015547000',
                'name' => 'Villasis',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015547',
            ),
            124 => 
            array (
                'id' => 125,
                'code' => '015548000',
                'name' => 'Laoac',
                'region_id' => '01',
                'province_id' => '0155',
                'city_id' => '015548',
            ),
            125 => 
            array (
                'id' => 126,
                'code' => '020901000',
            'name' => 'Basco (Capital)',
                'region_id' => '02',
                'province_id' => '0209',
                'city_id' => '020901',
            ),
            126 => 
            array (
                'id' => 127,
                'code' => '020902000',
                'name' => 'Itbayat',
                'region_id' => '02',
                'province_id' => '0209',
                'city_id' => '020902',
            ),
            127 => 
            array (
                'id' => 128,
                'code' => '020903000',
                'name' => 'Ivana',
                'region_id' => '02',
                'province_id' => '0209',
                'city_id' => '020903',
            ),
            128 => 
            array (
                'id' => 129,
                'code' => '020904000',
                'name' => 'Mahatao',
                'region_id' => '02',
                'province_id' => '0209',
                'city_id' => '020904',
            ),
            129 => 
            array (
                'id' => 130,
                'code' => '020905000',
                'name' => 'Sabtang',
                'region_id' => '02',
                'province_id' => '0209',
                'city_id' => '020905',
            ),
            130 => 
            array (
                'id' => 131,
                'code' => '020906000',
                'name' => 'Uyugan',
                'region_id' => '02',
                'province_id' => '0209',
                'city_id' => '020906',
            ),
            131 => 
            array (
                'id' => 132,
                'code' => '021501000',
                'name' => 'Abulug',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021501',
            ),
            132 => 
            array (
                'id' => 133,
                'code' => '021502000',
                'name' => 'Alcala',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021502',
            ),
            133 => 
            array (
                'id' => 134,
                'code' => '021503000',
                'name' => 'Allacapan',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021503',
            ),
            134 => 
            array (
                'id' => 135,
                'code' => '021504000',
                'name' => 'Amulung',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021504',
            ),
            135 => 
            array (
                'id' => 136,
                'code' => '021505000',
                'name' => 'Aparri',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021505',
            ),
            136 => 
            array (
                'id' => 137,
                'code' => '021506000',
                'name' => 'Baggao',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021506',
            ),
            137 => 
            array (
                'id' => 138,
                'code' => '021507000',
                'name' => 'Ballesteros',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021507',
            ),
            138 => 
            array (
                'id' => 139,
                'code' => '021508000',
                'name' => 'Buguey',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021508',
            ),
            139 => 
            array (
                'id' => 140,
                'code' => '021509000',
                'name' => 'Calayan',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021509',
            ),
            140 => 
            array (
                'id' => 141,
                'code' => '021510000',
                'name' => 'Camalaniugan',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021510',
            ),
            141 => 
            array (
                'id' => 142,
                'code' => '021511000',
                'name' => 'Claveria',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021511',
            ),
            142 => 
            array (
                'id' => 143,
                'code' => '021512000',
                'name' => 'Enrile',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021512',
            ),
            143 => 
            array (
                'id' => 144,
                'code' => '021513000',
                'name' => 'Gattaran',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021513',
            ),
            144 => 
            array (
                'id' => 145,
                'code' => '021514000',
                'name' => 'Gonzaga',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021514',
            ),
            145 => 
            array (
                'id' => 146,
                'code' => '021515000',
                'name' => 'Iguig',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021515',
            ),
            146 => 
            array (
                'id' => 147,
                'code' => '021516000',
                'name' => 'Lal-Lo',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021516',
            ),
            147 => 
            array (
                'id' => 148,
                'code' => '021517000',
                'name' => 'Lasam',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021517',
            ),
            148 => 
            array (
                'id' => 149,
                'code' => '021518000',
                'name' => 'Pamplona',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021518',
            ),
            149 => 
            array (
                'id' => 150,
                'code' => '021519000',
                'name' => 'Peñablanca',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021519',
            ),
            150 => 
            array (
                'id' => 151,
                'code' => '021520000',
                'name' => 'Piat',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021520',
            ),
            151 => 
            array (
                'id' => 152,
                'code' => '021521000',
                'name' => 'Rizal',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021521',
            ),
            152 => 
            array (
                'id' => 153,
                'code' => '021522000',
                'name' => 'Sanchez-Mira',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021522',
            ),
            153 => 
            array (
                'id' => 154,
                'code' => '021523000',
                'name' => 'Santa Ana',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021523',
            ),
            154 => 
            array (
                'id' => 155,
                'code' => '021524000',
                'name' => 'Santa Praxedes',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021524',
            ),
            155 => 
            array (
                'id' => 156,
                'code' => '021525000',
                'name' => 'Santa Teresita',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021525',
            ),
            156 => 
            array (
                'id' => 157,
                'code' => '021526000',
                'name' => 'Santo Niño',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021526',
            ),
            157 => 
            array (
                'id' => 158,
                'code' => '021527000',
                'name' => 'Solana',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021527',
            ),
            158 => 
            array (
                'id' => 159,
                'code' => '021528000',
                'name' => 'Tuao',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021528',
            ),
            159 => 
            array (
                'id' => 160,
                'code' => '021529000',
            'name' => 'Tuguegarao City (Capital)',
                'region_id' => '02',
                'province_id' => '0215',
                'city_id' => '021529',
            ),
            160 => 
            array (
                'id' => 161,
                'code' => '023101000',
                'name' => 'Alicia',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023101',
            ),
            161 => 
            array (
                'id' => 162,
                'code' => '023102000',
                'name' => 'Angadanan',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023102',
            ),
            162 => 
            array (
                'id' => 163,
                'code' => '023103000',
                'name' => 'Aurora',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023103',
            ),
            163 => 
            array (
                'id' => 164,
                'code' => '023104000',
                'name' => 'Benito Soliven',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023104',
            ),
            164 => 
            array (
                'id' => 165,
                'code' => '023105000',
                'name' => 'Burgos',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023105',
            ),
            165 => 
            array (
                'id' => 166,
                'code' => '023106000',
                'name' => 'Cabagan',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023106',
            ),
            166 => 
            array (
                'id' => 167,
                'code' => '023107000',
                'name' => 'Cabatuan',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023107',
            ),
            167 => 
            array (
                'id' => 168,
                'code' => '023108000',
                'name' => 'City of Cauayan',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023108',
            ),
            168 => 
            array (
                'id' => 169,
                'code' => '023109000',
                'name' => 'Cordon',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023109',
            ),
            169 => 
            array (
                'id' => 170,
                'code' => '023110000',
                'name' => 'Dinapigue',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023110',
            ),
            170 => 
            array (
                'id' => 171,
                'code' => '023111000',
                'name' => 'Divilacan',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023111',
            ),
            171 => 
            array (
                'id' => 172,
                'code' => '023112000',
                'name' => 'Echague',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023112',
            ),
            172 => 
            array (
                'id' => 173,
                'code' => '023113000',
                'name' => 'Gamu',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023113',
            ),
            173 => 
            array (
                'id' => 174,
                'code' => '023114000',
            'name' => 'City of Ilagan (Capital)',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023114',
            ),
            174 => 
            array (
                'id' => 175,
                'code' => '023115000',
                'name' => 'Jones',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023115',
            ),
            175 => 
            array (
                'id' => 176,
                'code' => '023116000',
                'name' => 'Luna',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023116',
            ),
            176 => 
            array (
                'id' => 177,
                'code' => '023117000',
                'name' => 'Maconacon',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023117',
            ),
            177 => 
            array (
                'id' => 178,
                'code' => '023118000',
                'name' => 'Delfin Albano',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023118',
            ),
            178 => 
            array (
                'id' => 179,
                'code' => '023119000',
                'name' => 'Mallig',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023119',
            ),
            179 => 
            array (
                'id' => 180,
                'code' => '023120000',
                'name' => 'Naguilian',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023120',
            ),
            180 => 
            array (
                'id' => 181,
                'code' => '023121000',
                'name' => 'Palanan',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023121',
            ),
            181 => 
            array (
                'id' => 182,
                'code' => '023122000',
                'name' => 'Quezon',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023122',
            ),
            182 => 
            array (
                'id' => 183,
                'code' => '023123000',
                'name' => 'Quirino',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023123',
            ),
            183 => 
            array (
                'id' => 184,
                'code' => '023124000',
                'name' => 'Ramon',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023124',
            ),
            184 => 
            array (
                'id' => 185,
                'code' => '023125000',
                'name' => 'Reina Mercedes',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023125',
            ),
            185 => 
            array (
                'id' => 186,
                'code' => '023126000',
                'name' => 'Roxas',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023126',
            ),
            186 => 
            array (
                'id' => 187,
                'code' => '023127000',
                'name' => 'San Agustin',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023127',
            ),
            187 => 
            array (
                'id' => 188,
                'code' => '023128000',
                'name' => 'San Guillermo',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023128',
            ),
            188 => 
            array (
                'id' => 189,
                'code' => '023129000',
                'name' => 'San Isidro',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023129',
            ),
            189 => 
            array (
                'id' => 190,
                'code' => '023130000',
                'name' => 'San Manuel',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023130',
            ),
            190 => 
            array (
                'id' => 191,
                'code' => '023131000',
                'name' => 'San Mariano',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023131',
            ),
            191 => 
            array (
                'id' => 192,
                'code' => '023132000',
                'name' => 'San Mateo',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023132',
            ),
            192 => 
            array (
                'id' => 193,
                'code' => '023133000',
                'name' => 'San Pablo',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023133',
            ),
            193 => 
            array (
                'id' => 194,
                'code' => '023134000',
                'name' => 'Santa Maria',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023134',
            ),
            194 => 
            array (
                'id' => 195,
                'code' => '023135000',
                'name' => 'City of Santiago',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023135',
            ),
            195 => 
            array (
                'id' => 196,
                'code' => '023136000',
                'name' => 'Santo Tomas',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023136',
            ),
            196 => 
            array (
                'id' => 197,
                'code' => '023137000',
                'name' => 'Tumauini',
                'region_id' => '02',
                'province_id' => '0231',
                'city_id' => '023137',
            ),
            197 => 
            array (
                'id' => 198,
                'code' => '025001000',
                'name' => 'Ambaguio',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025001',
            ),
            198 => 
            array (
                'id' => 199,
                'code' => '025002000',
                'name' => 'Aritao',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025002',
            ),
            199 => 
            array (
                'id' => 200,
                'code' => '025003000',
                'name' => 'Bagabag',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025003',
            ),
            200 => 
            array (
                'id' => 201,
                'code' => '025004000',
                'name' => 'Bambang',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025004',
            ),
            201 => 
            array (
                'id' => 202,
                'code' => '025005000',
            'name' => 'Bayombong (Capital)',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025005',
            ),
            202 => 
            array (
                'id' => 203,
                'code' => '025006000',
                'name' => 'Diadi',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025006',
            ),
            203 => 
            array (
                'id' => 204,
                'code' => '025007000',
                'name' => 'Dupax del Norte',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025007',
            ),
            204 => 
            array (
                'id' => 205,
                'code' => '025008000',
                'name' => 'Dupax del Sur',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025008',
            ),
            205 => 
            array (
                'id' => 206,
                'code' => '025009000',
                'name' => 'Kasibu',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025009',
            ),
            206 => 
            array (
                'id' => 207,
                'code' => '025010000',
                'name' => 'Kayapa',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025010',
            ),
            207 => 
            array (
                'id' => 208,
                'code' => '025011000',
                'name' => 'Quezon',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025011',
            ),
            208 => 
            array (
                'id' => 209,
                'code' => '025012000',
                'name' => 'Santa Fe',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025012',
            ),
            209 => 
            array (
                'id' => 210,
                'code' => '025013000',
                'name' => 'Solano',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025013',
            ),
            210 => 
            array (
                'id' => 211,
                'code' => '025014000',
                'name' => 'Villaverde',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025014',
            ),
            211 => 
            array (
                'id' => 212,
                'code' => '025015000',
                'name' => 'Alfonso Castaneda',
                'region_id' => '02',
                'province_id' => '0250',
                'city_id' => '025015',
            ),
            212 => 
            array (
                'id' => 213,
                'code' => '025701000',
                'name' => 'Aglipay',
                'region_id' => '02',
                'province_id' => '0257',
                'city_id' => '025701',
            ),
            213 => 
            array (
                'id' => 214,
                'code' => '025702000',
            'name' => 'Cabarroguis (Capital)',
                'region_id' => '02',
                'province_id' => '0257',
                'city_id' => '025702',
            ),
            214 => 
            array (
                'id' => 215,
                'code' => '025703000',
                'name' => 'Diffun',
                'region_id' => '02',
                'province_id' => '0257',
                'city_id' => '025703',
            ),
            215 => 
            array (
                'id' => 216,
                'code' => '025704000',
                'name' => 'Maddela',
                'region_id' => '02',
                'province_id' => '0257',
                'city_id' => '025704',
            ),
            216 => 
            array (
                'id' => 217,
                'code' => '025705000',
                'name' => 'Saguday',
                'region_id' => '02',
                'province_id' => '0257',
                'city_id' => '025705',
            ),
            217 => 
            array (
                'id' => 218,
                'code' => '025706000',
                'name' => 'Nagtipunan',
                'region_id' => '02',
                'province_id' => '0257',
                'city_id' => '025706',
            ),
            218 => 
            array (
                'id' => 219,
                'code' => '030801000',
                'name' => 'Abucay',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030801',
            ),
            219 => 
            array (
                'id' => 220,
                'code' => '030802000',
                'name' => 'Bagac',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030802',
            ),
            220 => 
            array (
                'id' => 221,
                'code' => '030803000',
            'name' => 'City of Balanga (Capital)',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030803',
            ),
            221 => 
            array (
                'id' => 222,
                'code' => '030804000',
                'name' => 'Dinalupihan',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030804',
            ),
            222 => 
            array (
                'id' => 223,
                'code' => '030805000',
                'name' => 'Hermosa',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030805',
            ),
            223 => 
            array (
                'id' => 224,
                'code' => '030806000',
                'name' => 'Limay',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030806',
            ),
            224 => 
            array (
                'id' => 225,
                'code' => '030807000',
                'name' => 'Mariveles',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030807',
            ),
            225 => 
            array (
                'id' => 226,
                'code' => '030808000',
                'name' => 'Morong',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030808',
            ),
            226 => 
            array (
                'id' => 227,
                'code' => '030809000',
                'name' => 'Orani',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030809',
            ),
            227 => 
            array (
                'id' => 228,
                'code' => '030810000',
                'name' => 'Orion',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030810',
            ),
            228 => 
            array (
                'id' => 229,
                'code' => '030811000',
                'name' => 'Pilar',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030811',
            ),
            229 => 
            array (
                'id' => 230,
                'code' => '030812000',
                'name' => 'Samal',
                'region_id' => '03',
                'province_id' => '0308',
                'city_id' => '030812',
            ),
            230 => 
            array (
                'id' => 231,
                'code' => '031401000',
                'name' => 'Angat',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031401',
            ),
            231 => 
            array (
                'id' => 232,
                'code' => '031402000',
                'name' => 'Balagtas',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031402',
            ),
            232 => 
            array (
                'id' => 233,
                'code' => '031403000',
                'name' => 'Baliuag',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031403',
            ),
            233 => 
            array (
                'id' => 234,
                'code' => '031404000',
                'name' => 'Bocaue',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031404',
            ),
            234 => 
            array (
                'id' => 235,
                'code' => '031405000',
                'name' => 'Bulacan',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031405',
            ),
            235 => 
            array (
                'id' => 236,
                'code' => '031406000',
                'name' => 'Bustos',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031406',
            ),
            236 => 
            array (
                'id' => 237,
                'code' => '031407000',
                'name' => 'Calumpit',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031407',
            ),
            237 => 
            array (
                'id' => 238,
                'code' => '031408000',
                'name' => 'Guiguinto',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031408',
            ),
            238 => 
            array (
                'id' => 239,
                'code' => '031409000',
                'name' => 'Hagonoy',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031409',
            ),
            239 => 
            array (
                'id' => 240,
                'code' => '031410000',
            'name' => 'City of Malolos (Capital)',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031410',
            ),
            240 => 
            array (
                'id' => 241,
                'code' => '031411000',
                'name' => 'Marilao',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031411',
            ),
            241 => 
            array (
                'id' => 242,
                'code' => '031412000',
                'name' => 'City of Meycauayan',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031412',
            ),
            242 => 
            array (
                'id' => 243,
                'code' => '031413000',
                'name' => 'Norzagaray',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031413',
            ),
            243 => 
            array (
                'id' => 244,
                'code' => '031414000',
                'name' => 'Obando',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031414',
            ),
            244 => 
            array (
                'id' => 245,
                'code' => '031415000',
                'name' => 'Pandi',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031415',
            ),
            245 => 
            array (
                'id' => 246,
                'code' => '031416000',
                'name' => 'Paombong',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031416',
            ),
            246 => 
            array (
                'id' => 247,
                'code' => '031417000',
                'name' => 'Plaridel',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031417',
            ),
            247 => 
            array (
                'id' => 248,
                'code' => '031418000',
                'name' => 'Pulilan',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031418',
            ),
            248 => 
            array (
                'id' => 249,
                'code' => '031419000',
                'name' => 'San Ildefonso',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031419',
            ),
            249 => 
            array (
                'id' => 250,
                'code' => '031420000',
                'name' => 'City of San Jose Del Monte',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031420',
            ),
            250 => 
            array (
                'id' => 251,
                'code' => '031421000',
                'name' => 'San Miguel',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031421',
            ),
            251 => 
            array (
                'id' => 252,
                'code' => '031422000',
                'name' => 'San Rafael',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031422',
            ),
            252 => 
            array (
                'id' => 253,
                'code' => '031423000',
                'name' => 'Santa Maria',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031423',
            ),
            253 => 
            array (
                'id' => 254,
                'code' => '031424000',
                'name' => 'Doña Remedios Trinidad',
                'region_id' => '03',
                'province_id' => '0314',
                'city_id' => '031424',
            ),
            254 => 
            array (
                'id' => 255,
                'code' => '034901000',
                'name' => 'Aliaga',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034901',
            ),
            255 => 
            array (
                'id' => 256,
                'code' => '034902000',
                'name' => 'Bongabon',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034902',
            ),
            256 => 
            array (
                'id' => 257,
                'code' => '034903000',
                'name' => 'City of Cabanatuan',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034903',
            ),
            257 => 
            array (
                'id' => 258,
                'code' => '034904000',
                'name' => 'Cabiao',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034904',
            ),
            258 => 
            array (
                'id' => 259,
                'code' => '034905000',
                'name' => 'Carranglan',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034905',
            ),
            259 => 
            array (
                'id' => 260,
                'code' => '034906000',
                'name' => 'Cuyapo',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034906',
            ),
            260 => 
            array (
                'id' => 261,
                'code' => '034907000',
                'name' => 'Gabaldon',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034907',
            ),
            261 => 
            array (
                'id' => 262,
                'code' => '034908000',
                'name' => 'City of Gapan',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034908',
            ),
            262 => 
            array (
                'id' => 263,
                'code' => '034909000',
                'name' => 'General Mamerto Natividad',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034909',
            ),
            263 => 
            array (
                'id' => 264,
                'code' => '034910000',
                'name' => 'General Tinio',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034910',
            ),
            264 => 
            array (
                'id' => 265,
                'code' => '034911000',
                'name' => 'Guimba',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034911',
            ),
            265 => 
            array (
                'id' => 266,
                'code' => '034912000',
                'name' => 'Jaen',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034912',
            ),
            266 => 
            array (
                'id' => 267,
                'code' => '034913000',
                'name' => 'Laur',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034913',
            ),
            267 => 
            array (
                'id' => 268,
                'code' => '034914000',
                'name' => 'Licab',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034914',
            ),
            268 => 
            array (
                'id' => 269,
                'code' => '034915000',
                'name' => 'Llanera',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034915',
            ),
            269 => 
            array (
                'id' => 270,
                'code' => '034916000',
                'name' => 'Lupao',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034916',
            ),
            270 => 
            array (
                'id' => 271,
                'code' => '034917000',
                'name' => 'Science City of Muñoz',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034917',
            ),
            271 => 
            array (
                'id' => 272,
                'code' => '034918000',
                'name' => 'Nampicuan',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034918',
            ),
            272 => 
            array (
                'id' => 273,
                'code' => '034919000',
            'name' => 'City of Palayan (Capital)',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034919',
            ),
            273 => 
            array (
                'id' => 274,
                'code' => '034920000',
                'name' => 'Pantabangan',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034920',
            ),
            274 => 
            array (
                'id' => 275,
                'code' => '034921000',
                'name' => 'Peñaranda',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034921',
            ),
            275 => 
            array (
                'id' => 276,
                'code' => '034922000',
                'name' => 'Quezon',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034922',
            ),
            276 => 
            array (
                'id' => 277,
                'code' => '034923000',
                'name' => 'Rizal',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034923',
            ),
            277 => 
            array (
                'id' => 278,
                'code' => '034924000',
                'name' => 'San Antonio',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034924',
            ),
            278 => 
            array (
                'id' => 279,
                'code' => '034925000',
                'name' => 'San Isidro',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034925',
            ),
            279 => 
            array (
                'id' => 280,
                'code' => '034926000',
                'name' => 'San Jose City',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034926',
            ),
            280 => 
            array (
                'id' => 281,
                'code' => '034927000',
                'name' => 'San Leonardo',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034927',
            ),
            281 => 
            array (
                'id' => 282,
                'code' => '034928000',
                'name' => 'Santa Rosa',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034928',
            ),
            282 => 
            array (
                'id' => 283,
                'code' => '034929000',
                'name' => 'Santo Domingo',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034929',
            ),
            283 => 
            array (
                'id' => 284,
                'code' => '034930000',
                'name' => 'Talavera',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034930',
            ),
            284 => 
            array (
                'id' => 285,
                'code' => '034931000',
                'name' => 'Talugtug',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034931',
            ),
            285 => 
            array (
                'id' => 286,
                'code' => '034932000',
                'name' => 'Zaragoza',
                'region_id' => '03',
                'province_id' => '0349',
                'city_id' => '034932',
            ),
            286 => 
            array (
                'id' => 287,
                'code' => '035401000',
                'name' => 'City of Angeles',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035401',
            ),
            287 => 
            array (
                'id' => 288,
                'code' => '035402000',
                'name' => 'Apalit',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035402',
            ),
            288 => 
            array (
                'id' => 289,
                'code' => '035403000',
                'name' => 'Arayat',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035403',
            ),
            289 => 
            array (
                'id' => 290,
                'code' => '035404000',
                'name' => 'Bacolor',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035404',
            ),
            290 => 
            array (
                'id' => 291,
                'code' => '035405000',
                'name' => 'Candaba',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035405',
            ),
            291 => 
            array (
                'id' => 292,
                'code' => '035406000',
                'name' => 'Floridablanca',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035406',
            ),
            292 => 
            array (
                'id' => 293,
                'code' => '035407000',
                'name' => 'Guagua',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035407',
            ),
            293 => 
            array (
                'id' => 294,
                'code' => '035408000',
                'name' => 'Lubao',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035408',
            ),
            294 => 
            array (
                'id' => 295,
                'code' => '035409000',
                'name' => 'Mabalacat City',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035409',
            ),
            295 => 
            array (
                'id' => 296,
                'code' => '035410000',
                'name' => 'Macabebe',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035410',
            ),
            296 => 
            array (
                'id' => 297,
                'code' => '035411000',
                'name' => 'Magalang',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035411',
            ),
            297 => 
            array (
                'id' => 298,
                'code' => '035412000',
                'name' => 'Masantol',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035412',
            ),
            298 => 
            array (
                'id' => 299,
                'code' => '035413000',
                'name' => 'Mexico',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035413',
            ),
            299 => 
            array (
                'id' => 300,
                'code' => '035414000',
                'name' => 'Minalin',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035414',
            ),
            300 => 
            array (
                'id' => 301,
                'code' => '035415000',
                'name' => 'Porac',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035415',
            ),
            301 => 
            array (
                'id' => 302,
                'code' => '035416000',
            'name' => 'City of San Fernando (Capital)',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035416',
            ),
            302 => 
            array (
                'id' => 303,
                'code' => '035417000',
                'name' => 'San Luis',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035417',
            ),
            303 => 
            array (
                'id' => 304,
                'code' => '035418000',
                'name' => 'San Simon',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035418',
            ),
            304 => 
            array (
                'id' => 305,
                'code' => '035419000',
                'name' => 'Santa Ana',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035419',
            ),
            305 => 
            array (
                'id' => 306,
                'code' => '035420000',
                'name' => 'Santa Rita',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035420',
            ),
            306 => 
            array (
                'id' => 307,
                'code' => '035421000',
                'name' => 'Santo Tomas',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035421',
            ),
            307 => 
            array (
                'id' => 308,
                'code' => '035422000',
                'name' => 'Sasmuan',
                'region_id' => '03',
                'province_id' => '0354',
                'city_id' => '035422',
            ),
            308 => 
            array (
                'id' => 309,
                'code' => '036901000',
                'name' => 'Anao',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036901',
            ),
            309 => 
            array (
                'id' => 310,
                'code' => '036902000',
                'name' => 'Bamban',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036902',
            ),
            310 => 
            array (
                'id' => 311,
                'code' => '036903000',
                'name' => 'Camiling',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036903',
            ),
            311 => 
            array (
                'id' => 312,
                'code' => '036904000',
                'name' => 'Capas',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036904',
            ),
            312 => 
            array (
                'id' => 313,
                'code' => '036905000',
                'name' => 'Concepcion',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036905',
            ),
            313 => 
            array (
                'id' => 314,
                'code' => '036906000',
                'name' => 'Gerona',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036906',
            ),
            314 => 
            array (
                'id' => 315,
                'code' => '036907000',
                'name' => 'La Paz',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036907',
            ),
            315 => 
            array (
                'id' => 316,
                'code' => '036908000',
                'name' => 'Mayantoc',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036908',
            ),
            316 => 
            array (
                'id' => 317,
                'code' => '036909000',
                'name' => 'Moncada',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036909',
            ),
            317 => 
            array (
                'id' => 318,
                'code' => '036910000',
                'name' => 'Paniqui',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036910',
            ),
            318 => 
            array (
                'id' => 319,
                'code' => '036911000',
                'name' => 'Pura',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036911',
            ),
            319 => 
            array (
                'id' => 320,
                'code' => '036912000',
                'name' => 'Ramos',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036912',
            ),
            320 => 
            array (
                'id' => 321,
                'code' => '036913000',
                'name' => 'San Clemente',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036913',
            ),
            321 => 
            array (
                'id' => 322,
                'code' => '036914000',
                'name' => 'San Manuel',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036914',
            ),
            322 => 
            array (
                'id' => 323,
                'code' => '036915000',
                'name' => 'Santa Ignacia',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036915',
            ),
            323 => 
            array (
                'id' => 324,
                'code' => '036916000',
            'name' => 'City of Tarlac (Capital)',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036916',
            ),
            324 => 
            array (
                'id' => 325,
                'code' => '036917000',
                'name' => 'Victoria',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036917',
            ),
            325 => 
            array (
                'id' => 326,
                'code' => '036918000',
                'name' => 'San Jose',
                'region_id' => '03',
                'province_id' => '0369',
                'city_id' => '036918',
            ),
            326 => 
            array (
                'id' => 327,
                'code' => '037101000',
                'name' => 'Botolan',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037101',
            ),
            327 => 
            array (
                'id' => 328,
                'code' => '037102000',
                'name' => 'Cabangan',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037102',
            ),
            328 => 
            array (
                'id' => 329,
                'code' => '037103000',
                'name' => 'Candelaria',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037103',
            ),
            329 => 
            array (
                'id' => 330,
                'code' => '037104000',
                'name' => 'Castillejos',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037104',
            ),
            330 => 
            array (
                'id' => 331,
                'code' => '037105000',
            'name' => 'Iba (Capital)',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037105',
            ),
            331 => 
            array (
                'id' => 332,
                'code' => '037106000',
                'name' => 'Masinloc',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037106',
            ),
            332 => 
            array (
                'id' => 333,
                'code' => '037107000',
                'name' => 'City of Olongapo',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037107',
            ),
            333 => 
            array (
                'id' => 334,
                'code' => '037108000',
                'name' => 'Palauig',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037108',
            ),
            334 => 
            array (
                'id' => 335,
                'code' => '037109000',
                'name' => 'San Antonio',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037109',
            ),
            335 => 
            array (
                'id' => 336,
                'code' => '037110000',
                'name' => 'San Felipe',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037110',
            ),
            336 => 
            array (
                'id' => 337,
                'code' => '037111000',
                'name' => 'San Marcelino',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037111',
            ),
            337 => 
            array (
                'id' => 338,
                'code' => '037112000',
                'name' => 'San Narciso',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037112',
            ),
            338 => 
            array (
                'id' => 339,
                'code' => '037113000',
                'name' => 'Santa Cruz',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037113',
            ),
            339 => 
            array (
                'id' => 340,
                'code' => '037114000',
                'name' => 'Subic',
                'region_id' => '03',
                'province_id' => '0371',
                'city_id' => '037114',
            ),
            340 => 
            array (
                'id' => 341,
                'code' => '037701000',
            'name' => 'Baler (Capital)',
                'region_id' => '03',
                'province_id' => '0377',
                'city_id' => '037701',
            ),
            341 => 
            array (
                'id' => 342,
                'code' => '037702000',
                'name' => 'Casiguran',
                'region_id' => '03',
                'province_id' => '0377',
                'city_id' => '037702',
            ),
            342 => 
            array (
                'id' => 343,
                'code' => '037703000',
                'name' => 'Dilasag',
                'region_id' => '03',
                'province_id' => '0377',
                'city_id' => '037703',
            ),
            343 => 
            array (
                'id' => 344,
                'code' => '037704000',
                'name' => 'Dinalungan',
                'region_id' => '03',
                'province_id' => '0377',
                'city_id' => '037704',
            ),
            344 => 
            array (
                'id' => 345,
                'code' => '037705000',
                'name' => 'Dingalan',
                'region_id' => '03',
                'province_id' => '0377',
                'city_id' => '037705',
            ),
            345 => 
            array (
                'id' => 346,
                'code' => '037706000',
                'name' => 'Dipaculao',
                'region_id' => '03',
                'province_id' => '0377',
                'city_id' => '037706',
            ),
            346 => 
            array (
                'id' => 347,
                'code' => '037707000',
                'name' => 'Maria Aurora',
                'region_id' => '03',
                'province_id' => '0377',
                'city_id' => '037707',
            ),
            347 => 
            array (
                'id' => 348,
                'code' => '037708000',
                'name' => 'San Luis',
                'region_id' => '03',
                'province_id' => '0377',
                'city_id' => '037708',
            ),
            348 => 
            array (
                'id' => 349,
                'code' => '041001000',
                'name' => 'Agoncillo',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041001',
            ),
            349 => 
            array (
                'id' => 350,
                'code' => '041002000',
                'name' => 'Alitagtag',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041002',
            ),
            350 => 
            array (
                'id' => 351,
                'code' => '041003000',
                'name' => 'Balayan',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041003',
            ),
            351 => 
            array (
                'id' => 352,
                'code' => '041004000',
                'name' => 'Balete',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041004',
            ),
            352 => 
            array (
                'id' => 353,
                'code' => '041005000',
            'name' => 'Batangas City (Capital)',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041005',
            ),
            353 => 
            array (
                'id' => 354,
                'code' => '041006000',
                'name' => 'Bauan',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041006',
            ),
            354 => 
            array (
                'id' => 355,
                'code' => '041007000',
                'name' => 'Calaca',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041007',
            ),
            355 => 
            array (
                'id' => 356,
                'code' => '041008000',
                'name' => 'Calatagan',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041008',
            ),
            356 => 
            array (
                'id' => 357,
                'code' => '041009000',
                'name' => 'Cuenca',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041009',
            ),
            357 => 
            array (
                'id' => 358,
                'code' => '041010000',
                'name' => 'Ibaan',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041010',
            ),
            358 => 
            array (
                'id' => 359,
                'code' => '041011000',
                'name' => 'Laurel',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041011',
            ),
            359 => 
            array (
                'id' => 360,
                'code' => '041012000',
                'name' => 'Lemery',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041012',
            ),
            360 => 
            array (
                'id' => 361,
                'code' => '041013000',
                'name' => 'Lian',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041013',
            ),
            361 => 
            array (
                'id' => 362,
                'code' => '041014000',
                'name' => 'City of Lipa',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041014',
            ),
            362 => 
            array (
                'id' => 363,
                'code' => '041015000',
                'name' => 'Lobo',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041015',
            ),
            363 => 
            array (
                'id' => 364,
                'code' => '041016000',
                'name' => 'Mabini',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041016',
            ),
            364 => 
            array (
                'id' => 365,
                'code' => '041017000',
                'name' => 'Malvar',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041017',
            ),
            365 => 
            array (
                'id' => 366,
                'code' => '041018000',
                'name' => 'Mataasnakahoy',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041018',
            ),
            366 => 
            array (
                'id' => 367,
                'code' => '041019000',
                'name' => 'Nasugbu',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041019',
            ),
            367 => 
            array (
                'id' => 368,
                'code' => '041020000',
                'name' => 'Padre Garcia',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041020',
            ),
            368 => 
            array (
                'id' => 369,
                'code' => '041021000',
                'name' => 'Rosario',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041021',
            ),
            369 => 
            array (
                'id' => 370,
                'code' => '041022000',
                'name' => 'San Jose',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041022',
            ),
            370 => 
            array (
                'id' => 371,
                'code' => '041023000',
                'name' => 'San Juan',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041023',
            ),
            371 => 
            array (
                'id' => 372,
                'code' => '041024000',
                'name' => 'San Luis',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041024',
            ),
            372 => 
            array (
                'id' => 373,
                'code' => '041025000',
                'name' => 'San Nicolas',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041025',
            ),
            373 => 
            array (
                'id' => 374,
                'code' => '041026000',
                'name' => 'San Pascual',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041026',
            ),
            374 => 
            array (
                'id' => 375,
                'code' => '041027000',
                'name' => 'Santa Teresita',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041027',
            ),
            375 => 
            array (
                'id' => 376,
                'code' => '041028000',
                'name' => 'City of Sto. Tomas',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041028',
            ),
            376 => 
            array (
                'id' => 377,
                'code' => '041029000',
                'name' => 'Taal',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041029',
            ),
            377 => 
            array (
                'id' => 378,
                'code' => '041030000',
                'name' => 'Talisay',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041030',
            ),
            378 => 
            array (
                'id' => 379,
                'code' => '041031000',
                'name' => 'City of Tanauan',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041031',
            ),
            379 => 
            array (
                'id' => 380,
                'code' => '041032000',
                'name' => 'Taysan',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041032',
            ),
            380 => 
            array (
                'id' => 381,
                'code' => '041033000',
                'name' => 'Tingloy',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041033',
            ),
            381 => 
            array (
                'id' => 382,
                'code' => '041034000',
                'name' => 'Tuy',
                'region_id' => '04',
                'province_id' => '0410',
                'city_id' => '041034',
            ),
            382 => 
            array (
                'id' => 383,
                'code' => '042101000',
                'name' => 'Alfonso',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042101',
            ),
            383 => 
            array (
                'id' => 384,
                'code' => '042102000',
                'name' => 'Amadeo',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042102',
            ),
            384 => 
            array (
                'id' => 385,
                'code' => '042103000',
                'name' => 'City of Bacoor',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042103',
            ),
            385 => 
            array (
                'id' => 386,
                'code' => '042104000',
                'name' => 'Carmona',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042104',
            ),
            386 => 
            array (
                'id' => 387,
                'code' => '042105000',
                'name' => 'City of Cavite',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042105',
            ),
            387 => 
            array (
                'id' => 388,
                'code' => '042106000',
                'name' => 'City of Dasmariñas',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042106',
            ),
            388 => 
            array (
                'id' => 389,
                'code' => '042107000',
                'name' => 'General Emilio Aguinaldo',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042107',
            ),
            389 => 
            array (
                'id' => 390,
                'code' => '042108000',
                'name' => 'City of General Trias',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042108',
            ),
            390 => 
            array (
                'id' => 391,
                'code' => '042109000',
                'name' => 'City of Imus',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042109',
            ),
            391 => 
            array (
                'id' => 392,
                'code' => '042110000',
                'name' => 'Indang',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042110',
            ),
            392 => 
            array (
                'id' => 393,
                'code' => '042111000',
                'name' => 'Kawit',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042111',
            ),
            393 => 
            array (
                'id' => 394,
                'code' => '042112000',
                'name' => 'Magallanes',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042112',
            ),
            394 => 
            array (
                'id' => 395,
                'code' => '042113000',
                'name' => 'Maragondon',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042113',
            ),
            395 => 
            array (
                'id' => 396,
                'code' => '042114000',
                'name' => 'Mendez',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042114',
            ),
            396 => 
            array (
                'id' => 397,
                'code' => '042115000',
                'name' => 'Naic',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042115',
            ),
            397 => 
            array (
                'id' => 398,
                'code' => '042116000',
                'name' => 'Noveleta',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042116',
            ),
            398 => 
            array (
                'id' => 399,
                'code' => '042117000',
                'name' => 'Rosario',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042117',
            ),
            399 => 
            array (
                'id' => 400,
                'code' => '042118000',
                'name' => 'Silang',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042118',
            ),
            400 => 
            array (
                'id' => 401,
                'code' => '042119000',
                'name' => 'City of Tagaytay',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042119',
            ),
            401 => 
            array (
                'id' => 402,
                'code' => '042120000',
                'name' => 'Tanza',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042120',
            ),
            402 => 
            array (
                'id' => 403,
                'code' => '042121000',
                'name' => 'Ternate',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042121',
            ),
            403 => 
            array (
                'id' => 404,
                'code' => '042122000',
            'name' => 'City of Trece Martires (Capital)',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042122',
            ),
            404 => 
            array (
                'id' => 405,
                'code' => '042123000',
                'name' => 'Gen. Mariano Alvarez',
                'region_id' => '04',
                'province_id' => '0421',
                'city_id' => '042123',
            ),
            405 => 
            array (
                'id' => 406,
                'code' => '043401000',
                'name' => 'Alaminos',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043401',
            ),
            406 => 
            array (
                'id' => 407,
                'code' => '043402000',
                'name' => 'Bay',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043402',
            ),
            407 => 
            array (
                'id' => 408,
                'code' => '043403000',
                'name' => 'City of Biñan',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043403',
            ),
            408 => 
            array (
                'id' => 409,
                'code' => '043404000',
                'name' => 'City of Cabuyao',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043404',
            ),
            409 => 
            array (
                'id' => 410,
                'code' => '043405000',
                'name' => 'City of Calamba',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043405',
            ),
            410 => 
            array (
                'id' => 411,
                'code' => '043406000',
                'name' => 'Calauan',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043406',
            ),
            411 => 
            array (
                'id' => 412,
                'code' => '043407000',
                'name' => 'Cavinti',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043407',
            ),
            412 => 
            array (
                'id' => 413,
                'code' => '043408000',
                'name' => 'Famy',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043408',
            ),
            413 => 
            array (
                'id' => 414,
                'code' => '043409000',
                'name' => 'Kalayaan',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043409',
            ),
            414 => 
            array (
                'id' => 415,
                'code' => '043410000',
                'name' => 'Liliw',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043410',
            ),
            415 => 
            array (
                'id' => 416,
                'code' => '043411000',
                'name' => 'Los Baños',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043411',
            ),
            416 => 
            array (
                'id' => 417,
                'code' => '043412000',
                'name' => 'Luisiana',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043412',
            ),
            417 => 
            array (
                'id' => 418,
                'code' => '043413000',
                'name' => 'Lumban',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043413',
            ),
            418 => 
            array (
                'id' => 419,
                'code' => '043414000',
                'name' => 'Mabitac',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043414',
            ),
            419 => 
            array (
                'id' => 420,
                'code' => '043415000',
                'name' => 'Magdalena',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043415',
            ),
            420 => 
            array (
                'id' => 421,
                'code' => '043416000',
                'name' => 'Majayjay',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043416',
            ),
            421 => 
            array (
                'id' => 422,
                'code' => '043417000',
                'name' => 'Nagcarlan',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043417',
            ),
            422 => 
            array (
                'id' => 423,
                'code' => '043418000',
                'name' => 'Paete',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043418',
            ),
            423 => 
            array (
                'id' => 424,
                'code' => '043419000',
                'name' => 'Pagsanjan',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043419',
            ),
            424 => 
            array (
                'id' => 425,
                'code' => '043420000',
                'name' => 'Pakil',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043420',
            ),
            425 => 
            array (
                'id' => 426,
                'code' => '043421000',
                'name' => 'Pangil',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043421',
            ),
            426 => 
            array (
                'id' => 427,
                'code' => '043422000',
                'name' => 'Pila',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043422',
            ),
            427 => 
            array (
                'id' => 428,
                'code' => '043423000',
                'name' => 'Rizal',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043423',
            ),
            428 => 
            array (
                'id' => 429,
                'code' => '043424000',
                'name' => 'City of San Pablo',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043424',
            ),
            429 => 
            array (
                'id' => 430,
                'code' => '043425000',
                'name' => 'City of San Pedro',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043425',
            ),
            430 => 
            array (
                'id' => 431,
                'code' => '043426000',
            'name' => 'Santa Cruz (Capital)',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043426',
            ),
            431 => 
            array (
                'id' => 432,
                'code' => '043427000',
                'name' => 'Santa Maria',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043427',
            ),
            432 => 
            array (
                'id' => 433,
                'code' => '043428000',
                'name' => 'City of Santa Rosa',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043428',
            ),
            433 => 
            array (
                'id' => 434,
                'code' => '043429000',
                'name' => 'Siniloan',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043429',
            ),
            434 => 
            array (
                'id' => 435,
                'code' => '043430000',
                'name' => 'Victoria',
                'region_id' => '04',
                'province_id' => '0434',
                'city_id' => '043430',
            ),
            435 => 
            array (
                'id' => 436,
                'code' => '045601000',
                'name' => 'Agdangan',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045601',
            ),
            436 => 
            array (
                'id' => 437,
                'code' => '045602000',
                'name' => 'Alabat',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045602',
            ),
            437 => 
            array (
                'id' => 438,
                'code' => '045603000',
                'name' => 'Atimonan',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045603',
            ),
            438 => 
            array (
                'id' => 439,
                'code' => '045605000',
                'name' => 'Buenavista',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045605',
            ),
            439 => 
            array (
                'id' => 440,
                'code' => '045606000',
                'name' => 'Burdeos',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045606',
            ),
            440 => 
            array (
                'id' => 441,
                'code' => '045607000',
                'name' => 'Calauag',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045607',
            ),
            441 => 
            array (
                'id' => 442,
                'code' => '045608000',
                'name' => 'Candelaria',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045608',
            ),
            442 => 
            array (
                'id' => 443,
                'code' => '045610000',
                'name' => 'Catanauan',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045610',
            ),
            443 => 
            array (
                'id' => 444,
                'code' => '045615000',
                'name' => 'Dolores',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045615',
            ),
            444 => 
            array (
                'id' => 445,
                'code' => '045616000',
                'name' => 'General Luna',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045616',
            ),
            445 => 
            array (
                'id' => 446,
                'code' => '045617000',
                'name' => 'General Nakar',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045617',
            ),
            446 => 
            array (
                'id' => 447,
                'code' => '045618000',
                'name' => 'Guinayangan',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045618',
            ),
            447 => 
            array (
                'id' => 448,
                'code' => '045619000',
                'name' => 'Gumaca',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045619',
            ),
            448 => 
            array (
                'id' => 449,
                'code' => '045620000',
                'name' => 'Infanta',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045620',
            ),
            449 => 
            array (
                'id' => 450,
                'code' => '045621000',
                'name' => 'Jomalig',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045621',
            ),
            450 => 
            array (
                'id' => 451,
                'code' => '045622000',
                'name' => 'Lopez',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045622',
            ),
            451 => 
            array (
                'id' => 452,
                'code' => '045623000',
                'name' => 'Lucban',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045623',
            ),
            452 => 
            array (
                'id' => 453,
                'code' => '045624000',
            'name' => 'City of Lucena (Capital)',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045624',
            ),
            453 => 
            array (
                'id' => 454,
                'code' => '045625000',
                'name' => 'Macalelon',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045625',
            ),
            454 => 
            array (
                'id' => 455,
                'code' => '045627000',
                'name' => 'Mauban',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045627',
            ),
            455 => 
            array (
                'id' => 456,
                'code' => '045628000',
                'name' => 'Mulanay',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045628',
            ),
            456 => 
            array (
                'id' => 457,
                'code' => '045629000',
                'name' => 'Padre Burgos',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045629',
            ),
            457 => 
            array (
                'id' => 458,
                'code' => '045630000',
                'name' => 'Pagbilao',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045630',
            ),
            458 => 
            array (
                'id' => 459,
                'code' => '045631000',
                'name' => 'Panukulan',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045631',
            ),
            459 => 
            array (
                'id' => 460,
                'code' => '045632000',
                'name' => 'Patnanungan',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045632',
            ),
            460 => 
            array (
                'id' => 461,
                'code' => '045633000',
                'name' => 'Perez',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045633',
            ),
            461 => 
            array (
                'id' => 462,
                'code' => '045634000',
                'name' => 'Pitogo',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045634',
            ),
            462 => 
            array (
                'id' => 463,
                'code' => '045635000',
                'name' => 'Plaridel',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045635',
            ),
            463 => 
            array (
                'id' => 464,
                'code' => '045636000',
                'name' => 'Polillo',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045636',
            ),
            464 => 
            array (
                'id' => 465,
                'code' => '045637000',
                'name' => 'Quezon',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045637',
            ),
            465 => 
            array (
                'id' => 466,
                'code' => '045638000',
                'name' => 'Real',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045638',
            ),
            466 => 
            array (
                'id' => 467,
                'code' => '045639000',
                'name' => 'Sampaloc',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045639',
            ),
            467 => 
            array (
                'id' => 468,
                'code' => '045640000',
                'name' => 'San Andres',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045640',
            ),
            468 => 
            array (
                'id' => 469,
                'code' => '045641000',
                'name' => 'San Antonio',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045641',
            ),
            469 => 
            array (
                'id' => 470,
                'code' => '045642000',
                'name' => 'San Francisco',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045642',
            ),
            470 => 
            array (
                'id' => 471,
                'code' => '045644000',
                'name' => 'San Narciso',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045644',
            ),
            471 => 
            array (
                'id' => 472,
                'code' => '045645000',
                'name' => 'Sariaya',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045645',
            ),
            472 => 
            array (
                'id' => 473,
                'code' => '045646000',
                'name' => 'Tagkawayan',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045646',
            ),
            473 => 
            array (
                'id' => 474,
                'code' => '045647000',
                'name' => 'City of Tayabas',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045647',
            ),
            474 => 
            array (
                'id' => 475,
                'code' => '045648000',
                'name' => 'Tiaong',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045648',
            ),
            475 => 
            array (
                'id' => 476,
                'code' => '045649000',
                'name' => 'Unisan',
                'region_id' => '04',
                'province_id' => '0456',
                'city_id' => '045649',
            ),
            476 => 
            array (
                'id' => 477,
                'code' => '045801000',
                'name' => 'Angono',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045801',
            ),
            477 => 
            array (
                'id' => 478,
                'code' => '045802000',
            'name' => 'City of Antipolo (Capital)',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045802',
            ),
            478 => 
            array (
                'id' => 479,
                'code' => '045803000',
                'name' => 'Baras',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045803',
            ),
            479 => 
            array (
                'id' => 480,
                'code' => '045804000',
                'name' => 'Binangonan',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045804',
            ),
            480 => 
            array (
                'id' => 481,
                'code' => '045805000',
                'name' => 'Cainta',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045805',
            ),
            481 => 
            array (
                'id' => 482,
                'code' => '045806000',
                'name' => 'Cardona',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045806',
            ),
            482 => 
            array (
                'id' => 483,
                'code' => '045807000',
                'name' => 'Jala-Jala',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045807',
            ),
            483 => 
            array (
                'id' => 484,
                'code' => '045808000',
                'name' => 'Rodriguez',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045808',
            ),
            484 => 
            array (
                'id' => 485,
                'code' => '045809000',
                'name' => 'Morong',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045809',
            ),
            485 => 
            array (
                'id' => 486,
                'code' => '045810000',
                'name' => 'Pililla',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045810',
            ),
            486 => 
            array (
                'id' => 487,
                'code' => '045811000',
                'name' => 'San Mateo',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045811',
            ),
            487 => 
            array (
                'id' => 488,
                'code' => '045812000',
                'name' => 'Tanay',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045812',
            ),
            488 => 
            array (
                'id' => 489,
                'code' => '045813000',
                'name' => 'Taytay',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045813',
            ),
            489 => 
            array (
                'id' => 490,
                'code' => '045814000',
                'name' => 'Teresa',
                'region_id' => '04',
                'province_id' => '0458',
                'city_id' => '045814',
            ),
            490 => 
            array (
                'id' => 491,
                'code' => '174001000',
            'name' => 'Boac (Capital)',
                'region_id' => '17',
                'province_id' => '1740',
                'city_id' => '174001',
            ),
            491 => 
            array (
                'id' => 492,
                'code' => '174002000',
                'name' => 'Buenavista',
                'region_id' => '17',
                'province_id' => '1740',
                'city_id' => '174002',
            ),
            492 => 
            array (
                'id' => 493,
                'code' => '174003000',
                'name' => 'Gasan',
                'region_id' => '17',
                'province_id' => '1740',
                'city_id' => '174003',
            ),
            493 => 
            array (
                'id' => 494,
                'code' => '174004000',
                'name' => 'Mogpog',
                'region_id' => '17',
                'province_id' => '1740',
                'city_id' => '174004',
            ),
            494 => 
            array (
                'id' => 495,
                'code' => '174005000',
                'name' => 'Santa Cruz',
                'region_id' => '17',
                'province_id' => '1740',
                'city_id' => '174005',
            ),
            495 => 
            array (
                'id' => 496,
                'code' => '174006000',
                'name' => 'Torrijos',
                'region_id' => '17',
                'province_id' => '1740',
                'city_id' => '174006',
            ),
            496 => 
            array (
                'id' => 497,
                'code' => '175101000',
                'name' => 'Abra De Ilog',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175101',
            ),
            497 => 
            array (
                'id' => 498,
                'code' => '175102000',
                'name' => 'Calintaan',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175102',
            ),
            498 => 
            array (
                'id' => 499,
                'code' => '175103000',
                'name' => 'Looc',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175103',
            ),
            499 => 
            array (
                'id' => 500,
                'code' => '175104000',
                'name' => 'Lubang',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175104',
            ),
        ));
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 501,
                'code' => '175105000',
                'name' => 'Magsaysay',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175105',
            ),
            1 => 
            array (
                'id' => 502,
                'code' => '175106000',
            'name' => 'Mamburao (Capital)',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175106',
            ),
            2 => 
            array (
                'id' => 503,
                'code' => '175107000',
                'name' => 'Paluan',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175107',
            ),
            3 => 
            array (
                'id' => 504,
                'code' => '175108000',
                'name' => 'Rizal',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175108',
            ),
            4 => 
            array (
                'id' => 505,
                'code' => '175109000',
                'name' => 'Sablayan',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175109',
            ),
            5 => 
            array (
                'id' => 506,
                'code' => '175110000',
                'name' => 'San Jose',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175110',
            ),
            6 => 
            array (
                'id' => 507,
                'code' => '175111000',
                'name' => 'Santa Cruz',
                'region_id' => '17',
                'province_id' => '1751',
                'city_id' => '175111',
            ),
            7 => 
            array (
                'id' => 508,
                'code' => '175201000',
                'name' => 'Baco',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175201',
            ),
            8 => 
            array (
                'id' => 509,
                'code' => '175202000',
                'name' => 'Bansud',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175202',
            ),
            9 => 
            array (
                'id' => 510,
                'code' => '175203000',
                'name' => 'Bongabong',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175203',
            ),
            10 => 
            array (
                'id' => 511,
                'code' => '175204000',
                'name' => 'Bulalacao',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175204',
            ),
            11 => 
            array (
                'id' => 512,
                'code' => '175205000',
            'name' => 'City of Calapan (Capital)',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175205',
            ),
            12 => 
            array (
                'id' => 513,
                'code' => '175206000',
                'name' => 'Gloria',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175206',
            ),
            13 => 
            array (
                'id' => 514,
                'code' => '175207000',
                'name' => 'Mansalay',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175207',
            ),
            14 => 
            array (
                'id' => 515,
                'code' => '175208000',
                'name' => 'Naujan',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175208',
            ),
            15 => 
            array (
                'id' => 516,
                'code' => '175209000',
                'name' => 'Pinamalayan',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175209',
            ),
            16 => 
            array (
                'id' => 517,
                'code' => '175210000',
                'name' => 'Pola',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175210',
            ),
            17 => 
            array (
                'id' => 518,
                'code' => '175211000',
                'name' => 'Puerto Galera',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175211',
            ),
            18 => 
            array (
                'id' => 519,
                'code' => '175212000',
                'name' => 'Roxas',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175212',
            ),
            19 => 
            array (
                'id' => 520,
                'code' => '175213000',
                'name' => 'San Teodoro',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175213',
            ),
            20 => 
            array (
                'id' => 521,
                'code' => '175214000',
                'name' => 'Socorro',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175214',
            ),
            21 => 
            array (
                'id' => 522,
                'code' => '175215000',
                'name' => 'Victoria',
                'region_id' => '17',
                'province_id' => '1752',
                'city_id' => '175215',
            ),
            22 => 
            array (
                'id' => 523,
                'code' => '175301000',
                'name' => 'Aborlan',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175301',
            ),
            23 => 
            array (
                'id' => 524,
                'code' => '175302000',
                'name' => 'Agutaya',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175302',
            ),
            24 => 
            array (
                'id' => 525,
                'code' => '175303000',
                'name' => 'Araceli',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175303',
            ),
            25 => 
            array (
                'id' => 526,
                'code' => '175304000',
                'name' => 'Balabac',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175304',
            ),
            26 => 
            array (
                'id' => 527,
                'code' => '175305000',
                'name' => 'Bataraza',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175305',
            ),
            27 => 
            array (
                'id' => 528,
                'code' => '175306000',
                'name' => 'Brooke\'S Point',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175306',
            ),
            28 => 
            array (
                'id' => 529,
                'code' => '175307000',
                'name' => 'Busuanga',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175307',
            ),
            29 => 
            array (
                'id' => 530,
                'code' => '175308000',
                'name' => 'Cagayancillo',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175308',
            ),
            30 => 
            array (
                'id' => 531,
                'code' => '175309000',
                'name' => 'Coron',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175309',
            ),
            31 => 
            array (
                'id' => 532,
                'code' => '175310000',
                'name' => 'Cuyo',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175310',
            ),
            32 => 
            array (
                'id' => 533,
                'code' => '175311000',
                'name' => 'Dumaran',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175311',
            ),
            33 => 
            array (
                'id' => 534,
                'code' => '175312000',
                'name' => 'El Nido',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175312',
            ),
            34 => 
            array (
                'id' => 535,
                'code' => '175313000',
                'name' => 'Linapacan',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175313',
            ),
            35 => 
            array (
                'id' => 536,
                'code' => '175314000',
                'name' => 'Magsaysay',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175314',
            ),
            36 => 
            array (
                'id' => 537,
                'code' => '175315000',
                'name' => 'Narra',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175315',
            ),
            37 => 
            array (
                'id' => 538,
                'code' => '175316000',
            'name' => 'City of Puerto Princesa (Capital)',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175316',
            ),
            38 => 
            array (
                'id' => 539,
                'code' => '175317000',
                'name' => 'Quezon',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175317',
            ),
            39 => 
            array (
                'id' => 540,
                'code' => '175318000',
                'name' => 'Roxas',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175318',
            ),
            40 => 
            array (
                'id' => 541,
                'code' => '175319000',
                'name' => 'San Vicente',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175319',
            ),
            41 => 
            array (
                'id' => 542,
                'code' => '175320000',
                'name' => 'Taytay',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175320',
            ),
            42 => 
            array (
                'id' => 543,
                'code' => '175321000',
                'name' => 'Kalayaan',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175321',
            ),
            43 => 
            array (
                'id' => 544,
                'code' => '175322000',
                'name' => 'Culion',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175322',
            ),
            44 => 
            array (
                'id' => 545,
                'code' => '175323000',
                'name' => 'Rizal',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175323',
            ),
            45 => 
            array (
                'id' => 546,
                'code' => '175324000',
                'name' => 'Sofronio Española',
                'region_id' => '17',
                'province_id' => '1753',
                'city_id' => '175324',
            ),
            46 => 
            array (
                'id' => 547,
                'code' => '175901000',
                'name' => 'Alcantara',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175901',
            ),
            47 => 
            array (
                'id' => 548,
                'code' => '175902000',
                'name' => 'Banton',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175902',
            ),
            48 => 
            array (
                'id' => 549,
                'code' => '175903000',
                'name' => 'Cajidiocan',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175903',
            ),
            49 => 
            array (
                'id' => 550,
                'code' => '175904000',
                'name' => 'Calatrava',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175904',
            ),
            50 => 
            array (
                'id' => 551,
                'code' => '175905000',
                'name' => 'Concepcion',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175905',
            ),
            51 => 
            array (
                'id' => 552,
                'code' => '175906000',
                'name' => 'Corcuera',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175906',
            ),
            52 => 
            array (
                'id' => 553,
                'code' => '175907000',
                'name' => 'Looc',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175907',
            ),
            53 => 
            array (
                'id' => 554,
                'code' => '175908000',
                'name' => 'Magdiwang',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175908',
            ),
            54 => 
            array (
                'id' => 555,
                'code' => '175909000',
                'name' => 'Odiongan',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175909',
            ),
            55 => 
            array (
                'id' => 556,
                'code' => '175910000',
            'name' => 'Romblon (Capital)',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175910',
            ),
            56 => 
            array (
                'id' => 557,
                'code' => '175911000',
                'name' => 'San Agustin',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175911',
            ),
            57 => 
            array (
                'id' => 558,
                'code' => '175912000',
                'name' => 'San Andres',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175912',
            ),
            58 => 
            array (
                'id' => 559,
                'code' => '175913000',
                'name' => 'San Fernando',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175913',
            ),
            59 => 
            array (
                'id' => 560,
                'code' => '175914000',
                'name' => 'San Jose',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175914',
            ),
            60 => 
            array (
                'id' => 561,
                'code' => '175915000',
                'name' => 'Santa Fe',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175915',
            ),
            61 => 
            array (
                'id' => 562,
                'code' => '175916000',
                'name' => 'Ferrol',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175916',
            ),
            62 => 
            array (
                'id' => 563,
                'code' => '175917000',
                'name' => 'Santa Maria',
                'region_id' => '17',
                'province_id' => '1759',
                'city_id' => '175917',
            ),
            63 => 
            array (
                'id' => 564,
                'code' => '050501000',
                'name' => 'Bacacay',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050501',
            ),
            64 => 
            array (
                'id' => 565,
                'code' => '050502000',
                'name' => 'Camalig',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050502',
            ),
            65 => 
            array (
                'id' => 566,
                'code' => '050503000',
                'name' => 'Daraga',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050503',
            ),
            66 => 
            array (
                'id' => 567,
                'code' => '050504000',
                'name' => 'Guinobatan',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050504',
            ),
            67 => 
            array (
                'id' => 568,
                'code' => '050505000',
                'name' => 'Jovellar',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050505',
            ),
            68 => 
            array (
                'id' => 569,
                'code' => '050506000',
            'name' => 'City of Legazpi (Capital)',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050506',
            ),
            69 => 
            array (
                'id' => 570,
                'code' => '050507000',
                'name' => 'Libon',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050507',
            ),
            70 => 
            array (
                'id' => 571,
                'code' => '050508000',
                'name' => 'City of Ligao',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050508',
            ),
            71 => 
            array (
                'id' => 572,
                'code' => '050509000',
                'name' => 'Malilipot',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050509',
            ),
            72 => 
            array (
                'id' => 573,
                'code' => '050510000',
                'name' => 'Malinao',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050510',
            ),
            73 => 
            array (
                'id' => 574,
                'code' => '050511000',
                'name' => 'Manito',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050511',
            ),
            74 => 
            array (
                'id' => 575,
                'code' => '050512000',
                'name' => 'Oas',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050512',
            ),
            75 => 
            array (
                'id' => 576,
                'code' => '050513000',
                'name' => 'Pio Duran',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050513',
            ),
            76 => 
            array (
                'id' => 577,
                'code' => '050514000',
                'name' => 'Polangui',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050514',
            ),
            77 => 
            array (
                'id' => 578,
                'code' => '050515000',
                'name' => 'Rapu-Rapu',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050515',
            ),
            78 => 
            array (
                'id' => 579,
                'code' => '050516000',
                'name' => 'Santo Domingo',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050516',
            ),
            79 => 
            array (
                'id' => 580,
                'code' => '050517000',
                'name' => 'City of Tabaco',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050517',
            ),
            80 => 
            array (
                'id' => 581,
                'code' => '050518000',
                'name' => 'Tiwi',
                'region_id' => '05',
                'province_id' => '0505',
                'city_id' => '050518',
            ),
            81 => 
            array (
                'id' => 582,
                'code' => '051601000',
                'name' => 'Basud',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051601',
            ),
            82 => 
            array (
                'id' => 583,
                'code' => '051602000',
                'name' => 'Capalonga',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051602',
            ),
            83 => 
            array (
                'id' => 584,
                'code' => '051603000',
            'name' => 'Daet (Capital)',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051603',
            ),
            84 => 
            array (
                'id' => 585,
                'code' => '051604000',
                'name' => 'San Lorenzo Ruiz',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051604',
            ),
            85 => 
            array (
                'id' => 586,
                'code' => '051605000',
                'name' => 'Jose Panganiban',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051605',
            ),
            86 => 
            array (
                'id' => 587,
                'code' => '051606000',
                'name' => 'Labo',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051606',
            ),
            87 => 
            array (
                'id' => 588,
                'code' => '051607000',
                'name' => 'Mercedes',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051607',
            ),
            88 => 
            array (
                'id' => 589,
                'code' => '051608000',
                'name' => 'Paracale',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051608',
            ),
            89 => 
            array (
                'id' => 590,
                'code' => '051609000',
                'name' => 'San Vicente',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051609',
            ),
            90 => 
            array (
                'id' => 591,
                'code' => '051610000',
                'name' => 'Santa Elena',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051610',
            ),
            91 => 
            array (
                'id' => 592,
                'code' => '051611000',
                'name' => 'Talisay',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051611',
            ),
            92 => 
            array (
                'id' => 593,
                'code' => '051612000',
                'name' => 'Vinzons',
                'region_id' => '05',
                'province_id' => '0516',
                'city_id' => '051612',
            ),
            93 => 
            array (
                'id' => 594,
                'code' => '051701000',
                'name' => 'Baao',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051701',
            ),
            94 => 
            array (
                'id' => 595,
                'code' => '051702000',
                'name' => 'Balatan',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051702',
            ),
            95 => 
            array (
                'id' => 596,
                'code' => '051703000',
                'name' => 'Bato',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051703',
            ),
            96 => 
            array (
                'id' => 597,
                'code' => '051704000',
                'name' => 'Bombon',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051704',
            ),
            97 => 
            array (
                'id' => 598,
                'code' => '051705000',
                'name' => 'Buhi',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051705',
            ),
            98 => 
            array (
                'id' => 599,
                'code' => '051706000',
                'name' => 'Bula',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051706',
            ),
            99 => 
            array (
                'id' => 600,
                'code' => '051707000',
                'name' => 'Cabusao',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051707',
            ),
            100 => 
            array (
                'id' => 601,
                'code' => '051708000',
                'name' => 'Calabanga',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051708',
            ),
            101 => 
            array (
                'id' => 602,
                'code' => '051709000',
                'name' => 'Camaligan',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051709',
            ),
            102 => 
            array (
                'id' => 603,
                'code' => '051710000',
                'name' => 'Canaman',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051710',
            ),
            103 => 
            array (
                'id' => 604,
                'code' => '051711000',
                'name' => 'Caramoan',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051711',
            ),
            104 => 
            array (
                'id' => 605,
                'code' => '051712000',
                'name' => 'Del Gallego',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051712',
            ),
            105 => 
            array (
                'id' => 606,
                'code' => '051713000',
                'name' => 'Gainza',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051713',
            ),
            106 => 
            array (
                'id' => 607,
                'code' => '051714000',
                'name' => 'Garchitorena',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051714',
            ),
            107 => 
            array (
                'id' => 608,
                'code' => '051715000',
                'name' => 'Goa',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051715',
            ),
            108 => 
            array (
                'id' => 609,
                'code' => '051716000',
                'name' => 'City of Iriga',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051716',
            ),
            109 => 
            array (
                'id' => 610,
                'code' => '051717000',
                'name' => 'Lagonoy',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051717',
            ),
            110 => 
            array (
                'id' => 611,
                'code' => '051718000',
                'name' => 'Libmanan',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051718',
            ),
            111 => 
            array (
                'id' => 612,
                'code' => '051719000',
                'name' => 'Lupi',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051719',
            ),
            112 => 
            array (
                'id' => 613,
                'code' => '051720000',
                'name' => 'Magarao',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051720',
            ),
            113 => 
            array (
                'id' => 614,
                'code' => '051721000',
                'name' => 'Milaor',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051721',
            ),
            114 => 
            array (
                'id' => 615,
                'code' => '051722000',
                'name' => 'Minalabac',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051722',
            ),
            115 => 
            array (
                'id' => 616,
                'code' => '051723000',
                'name' => 'Nabua',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051723',
            ),
            116 => 
            array (
                'id' => 617,
                'code' => '051724000',
                'name' => 'City of Naga',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051724',
            ),
            117 => 
            array (
                'id' => 618,
                'code' => '051725000',
                'name' => 'Ocampo',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051725',
            ),
            118 => 
            array (
                'id' => 619,
                'code' => '051726000',
                'name' => 'Pamplona',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051726',
            ),
            119 => 
            array (
                'id' => 620,
                'code' => '051727000',
                'name' => 'Pasacao',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051727',
            ),
            120 => 
            array (
                'id' => 621,
                'code' => '051728000',
            'name' => 'Pili (Capital)',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051728',
            ),
            121 => 
            array (
                'id' => 622,
                'code' => '051729000',
                'name' => 'Presentacion',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051729',
            ),
            122 => 
            array (
                'id' => 623,
                'code' => '051730000',
                'name' => 'Ragay',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051730',
            ),
            123 => 
            array (
                'id' => 624,
                'code' => '051731000',
                'name' => 'Sagñay',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051731',
            ),
            124 => 
            array (
                'id' => 625,
                'code' => '051732000',
                'name' => 'San Fernando',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051732',
            ),
            125 => 
            array (
                'id' => 626,
                'code' => '051733000',
                'name' => 'San Jose',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051733',
            ),
            126 => 
            array (
                'id' => 627,
                'code' => '051734000',
                'name' => 'Sipocot',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051734',
            ),
            127 => 
            array (
                'id' => 628,
                'code' => '051735000',
                'name' => 'Siruma',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051735',
            ),
            128 => 
            array (
                'id' => 629,
                'code' => '051736000',
                'name' => 'Tigaon',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051736',
            ),
            129 => 
            array (
                'id' => 630,
                'code' => '051737000',
                'name' => 'Tinambac',
                'region_id' => '05',
                'province_id' => '0517',
                'city_id' => '051737',
            ),
            130 => 
            array (
                'id' => 631,
                'code' => '052001000',
                'name' => 'Bagamanoc',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052001',
            ),
            131 => 
            array (
                'id' => 632,
                'code' => '052002000',
                'name' => 'Baras',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052002',
            ),
            132 => 
            array (
                'id' => 633,
                'code' => '052003000',
                'name' => 'Bato',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052003',
            ),
            133 => 
            array (
                'id' => 634,
                'code' => '052004000',
                'name' => 'Caramoran',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052004',
            ),
            134 => 
            array (
                'id' => 635,
                'code' => '052005000',
                'name' => 'Gigmoto',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052005',
            ),
            135 => 
            array (
                'id' => 636,
                'code' => '052006000',
                'name' => 'Pandan',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052006',
            ),
            136 => 
            array (
                'id' => 637,
                'code' => '052007000',
                'name' => 'Panganiban',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052007',
            ),
            137 => 
            array (
                'id' => 638,
                'code' => '052008000',
                'name' => 'San Andres',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052008',
            ),
            138 => 
            array (
                'id' => 639,
                'code' => '052009000',
                'name' => 'San Miguel',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052009',
            ),
            139 => 
            array (
                'id' => 640,
                'code' => '052010000',
                'name' => 'Viga',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052010',
            ),
            140 => 
            array (
                'id' => 641,
                'code' => '052011000',
            'name' => 'Virac (Capital)',
                'region_id' => '05',
                'province_id' => '0520',
                'city_id' => '052011',
            ),
            141 => 
            array (
                'id' => 642,
                'code' => '054101000',
                'name' => 'Aroroy',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054101',
            ),
            142 => 
            array (
                'id' => 643,
                'code' => '054102000',
                'name' => 'Baleno',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054102',
            ),
            143 => 
            array (
                'id' => 644,
                'code' => '054103000',
                'name' => 'Balud',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054103',
            ),
            144 => 
            array (
                'id' => 645,
                'code' => '054104000',
                'name' => 'Batuan',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054104',
            ),
            145 => 
            array (
                'id' => 646,
                'code' => '054105000',
                'name' => 'Cataingan',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054105',
            ),
            146 => 
            array (
                'id' => 647,
                'code' => '054106000',
                'name' => 'Cawayan',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054106',
            ),
            147 => 
            array (
                'id' => 648,
                'code' => '054107000',
                'name' => 'Claveria',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054107',
            ),
            148 => 
            array (
                'id' => 649,
                'code' => '054108000',
                'name' => 'Dimasalang',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054108',
            ),
            149 => 
            array (
                'id' => 650,
                'code' => '054109000',
                'name' => 'Esperanza',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054109',
            ),
            150 => 
            array (
                'id' => 651,
                'code' => '054110000',
                'name' => 'Mandaon',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054110',
            ),
            151 => 
            array (
                'id' => 652,
                'code' => '054111000',
            'name' => 'City of Masbate (Capital)',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054111',
            ),
            152 => 
            array (
                'id' => 653,
                'code' => '054112000',
                'name' => 'Milagros',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054112',
            ),
            153 => 
            array (
                'id' => 654,
                'code' => '054113000',
                'name' => 'Mobo',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054113',
            ),
            154 => 
            array (
                'id' => 655,
                'code' => '054114000',
                'name' => 'Monreal',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054114',
            ),
            155 => 
            array (
                'id' => 656,
                'code' => '054115000',
                'name' => 'Palanas',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054115',
            ),
            156 => 
            array (
                'id' => 657,
                'code' => '054116000',
                'name' => 'Pio V. Corpuz',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054116',
            ),
            157 => 
            array (
                'id' => 658,
                'code' => '054117000',
                'name' => 'Placer',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054117',
            ),
            158 => 
            array (
                'id' => 659,
                'code' => '054118000',
                'name' => 'San Fernando',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054118',
            ),
            159 => 
            array (
                'id' => 660,
                'code' => '054119000',
                'name' => 'San Jacinto',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054119',
            ),
            160 => 
            array (
                'id' => 661,
                'code' => '054120000',
                'name' => 'San Pascual',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054120',
            ),
            161 => 
            array (
                'id' => 662,
                'code' => '054121000',
                'name' => 'Uson',
                'region_id' => '05',
                'province_id' => '0541',
                'city_id' => '054121',
            ),
            162 => 
            array (
                'id' => 663,
                'code' => '056202000',
                'name' => 'Barcelona',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056202',
            ),
            163 => 
            array (
                'id' => 664,
                'code' => '056203000',
                'name' => 'Bulan',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056203',
            ),
            164 => 
            array (
                'id' => 665,
                'code' => '056204000',
                'name' => 'Bulusan',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056204',
            ),
            165 => 
            array (
                'id' => 666,
                'code' => '056205000',
                'name' => 'Casiguran',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056205',
            ),
            166 => 
            array (
                'id' => 667,
                'code' => '056206000',
                'name' => 'Castilla',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056206',
            ),
            167 => 
            array (
                'id' => 668,
                'code' => '056207000',
                'name' => 'Donsol',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056207',
            ),
            168 => 
            array (
                'id' => 669,
                'code' => '056208000',
                'name' => 'Gubat',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056208',
            ),
            169 => 
            array (
                'id' => 670,
                'code' => '056209000',
                'name' => 'Irosin',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056209',
            ),
            170 => 
            array (
                'id' => 671,
                'code' => '056210000',
                'name' => 'Juban',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056210',
            ),
            171 => 
            array (
                'id' => 672,
                'code' => '056211000',
                'name' => 'Magallanes',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056211',
            ),
            172 => 
            array (
                'id' => 673,
                'code' => '056212000',
                'name' => 'Matnog',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056212',
            ),
            173 => 
            array (
                'id' => 674,
                'code' => '056213000',
                'name' => 'Pilar',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056213',
            ),
            174 => 
            array (
                'id' => 675,
                'code' => '056214000',
                'name' => 'Prieto Diaz',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056214',
            ),
            175 => 
            array (
                'id' => 676,
                'code' => '056215000',
                'name' => 'Santa Magdalena',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056215',
            ),
            176 => 
            array (
                'id' => 677,
                'code' => '056216000',
            'name' => 'City of Sorsogon (Capital)',
                'region_id' => '05',
                'province_id' => '0562',
                'city_id' => '056216',
            ),
            177 => 
            array (
                'id' => 678,
                'code' => '060401000',
                'name' => 'Altavas',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060401',
            ),
            178 => 
            array (
                'id' => 679,
                'code' => '060402000',
                'name' => 'Balete',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060402',
            ),
            179 => 
            array (
                'id' => 680,
                'code' => '060403000',
                'name' => 'Banga',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060403',
            ),
            180 => 
            array (
                'id' => 681,
                'code' => '060404000',
                'name' => 'Batan',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060404',
            ),
            181 => 
            array (
                'id' => 682,
                'code' => '060405000',
                'name' => 'Buruanga',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060405',
            ),
            182 => 
            array (
                'id' => 683,
                'code' => '060406000',
                'name' => 'Ibajay',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060406',
            ),
            183 => 
            array (
                'id' => 684,
                'code' => '060407000',
            'name' => 'Kalibo (Capital)',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060407',
            ),
            184 => 
            array (
                'id' => 685,
                'code' => '060408000',
                'name' => 'Lezo',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060408',
            ),
            185 => 
            array (
                'id' => 686,
                'code' => '060409000',
                'name' => 'Libacao',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060409',
            ),
            186 => 
            array (
                'id' => 687,
                'code' => '060410000',
                'name' => 'Madalag',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060410',
            ),
            187 => 
            array (
                'id' => 688,
                'code' => '060411000',
                'name' => 'Makato',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060411',
            ),
            188 => 
            array (
                'id' => 689,
                'code' => '060412000',
                'name' => 'Malay',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060412',
            ),
            189 => 
            array (
                'id' => 690,
                'code' => '060413000',
                'name' => 'Malinao',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060413',
            ),
            190 => 
            array (
                'id' => 691,
                'code' => '060414000',
                'name' => 'Nabas',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060414',
            ),
            191 => 
            array (
                'id' => 692,
                'code' => '060415000',
                'name' => 'New Washington',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060415',
            ),
            192 => 
            array (
                'id' => 693,
                'code' => '060416000',
                'name' => 'Numancia',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060416',
            ),
            193 => 
            array (
                'id' => 694,
                'code' => '060417000',
                'name' => 'Tangalan',
                'region_id' => '06',
                'province_id' => '0604',
                'city_id' => '060417',
            ),
            194 => 
            array (
                'id' => 695,
                'code' => '060601000',
                'name' => 'Anini-Y',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060601',
            ),
            195 => 
            array (
                'id' => 696,
                'code' => '060602000',
                'name' => 'Barbaza',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060602',
            ),
            196 => 
            array (
                'id' => 697,
                'code' => '060603000',
                'name' => 'Belison',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060603',
            ),
            197 => 
            array (
                'id' => 698,
                'code' => '060604000',
                'name' => 'Bugasong',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060604',
            ),
            198 => 
            array (
                'id' => 699,
                'code' => '060605000',
                'name' => 'Caluya',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060605',
            ),
            199 => 
            array (
                'id' => 700,
                'code' => '060606000',
                'name' => 'Culasi',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060606',
            ),
            200 => 
            array (
                'id' => 701,
                'code' => '060607000',
                'name' => 'Tobias Fornier',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060607',
            ),
            201 => 
            array (
                'id' => 702,
                'code' => '060608000',
                'name' => 'Hamtic',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060608',
            ),
            202 => 
            array (
                'id' => 703,
                'code' => '060609000',
                'name' => 'Laua-An',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060609',
            ),
            203 => 
            array (
                'id' => 704,
                'code' => '060610000',
                'name' => 'Libertad',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060610',
            ),
            204 => 
            array (
                'id' => 705,
                'code' => '060611000',
                'name' => 'Pandan',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060611',
            ),
            205 => 
            array (
                'id' => 706,
                'code' => '060612000',
                'name' => 'Patnongon',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060612',
            ),
            206 => 
            array (
                'id' => 707,
                'code' => '060613000',
            'name' => 'San Jose (Capital)',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060613',
            ),
            207 => 
            array (
                'id' => 708,
                'code' => '060614000',
                'name' => 'San Remigio',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060614',
            ),
            208 => 
            array (
                'id' => 709,
                'code' => '060615000',
                'name' => 'Sebaste',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060615',
            ),
            209 => 
            array (
                'id' => 710,
                'code' => '060616000',
                'name' => 'Sibalom',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060616',
            ),
            210 => 
            array (
                'id' => 711,
                'code' => '060617000',
                'name' => 'Tibiao',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060617',
            ),
            211 => 
            array (
                'id' => 712,
                'code' => '060618000',
                'name' => 'Valderrama',
                'region_id' => '06',
                'province_id' => '0606',
                'city_id' => '060618',
            ),
            212 => 
            array (
                'id' => 713,
                'code' => '061901000',
                'name' => 'Cuartero',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061901',
            ),
            213 => 
            array (
                'id' => 714,
                'code' => '061902000',
                'name' => 'Dao',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061902',
            ),
            214 => 
            array (
                'id' => 715,
                'code' => '061903000',
                'name' => 'Dumalag',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061903',
            ),
            215 => 
            array (
                'id' => 716,
                'code' => '061904000',
                'name' => 'Dumarao',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061904',
            ),
            216 => 
            array (
                'id' => 717,
                'code' => '061905000',
                'name' => 'Ivisan',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061905',
            ),
            217 => 
            array (
                'id' => 718,
                'code' => '061906000',
                'name' => 'Jamindan',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061906',
            ),
            218 => 
            array (
                'id' => 719,
                'code' => '061907000',
                'name' => 'Ma-Ayon',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061907',
            ),
            219 => 
            array (
                'id' => 720,
                'code' => '061908000',
                'name' => 'Mambusao',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061908',
            ),
            220 => 
            array (
                'id' => 721,
                'code' => '061909000',
                'name' => 'Panay',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061909',
            ),
            221 => 
            array (
                'id' => 722,
                'code' => '061910000',
                'name' => 'Panitan',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061910',
            ),
            222 => 
            array (
                'id' => 723,
                'code' => '061911000',
                'name' => 'Pilar',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061911',
            ),
            223 => 
            array (
                'id' => 724,
                'code' => '061912000',
                'name' => 'Pontevedra',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061912',
            ),
            224 => 
            array (
                'id' => 725,
                'code' => '061913000',
                'name' => 'President Roxas',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061913',
            ),
            225 => 
            array (
                'id' => 726,
                'code' => '061914000',
            'name' => 'City of Roxas (Capital)',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061914',
            ),
            226 => 
            array (
                'id' => 727,
                'code' => '061915000',
                'name' => 'Sapi-An',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061915',
            ),
            227 => 
            array (
                'id' => 728,
                'code' => '061916000',
                'name' => 'Sigma',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061916',
            ),
            228 => 
            array (
                'id' => 729,
                'code' => '061917000',
                'name' => 'Tapaz',
                'region_id' => '06',
                'province_id' => '0619',
                'city_id' => '061917',
            ),
            229 => 
            array (
                'id' => 730,
                'code' => '063001000',
                'name' => 'Ajuy',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063001',
            ),
            230 => 
            array (
                'id' => 731,
                'code' => '063002000',
                'name' => 'Alimodian',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063002',
            ),
            231 => 
            array (
                'id' => 732,
                'code' => '063003000',
                'name' => 'Anilao',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063003',
            ),
            232 => 
            array (
                'id' => 733,
                'code' => '063004000',
                'name' => 'Badiangan',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063004',
            ),
            233 => 
            array (
                'id' => 734,
                'code' => '063005000',
                'name' => 'Balasan',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063005',
            ),
            234 => 
            array (
                'id' => 735,
                'code' => '063006000',
                'name' => 'Banate',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063006',
            ),
            235 => 
            array (
                'id' => 736,
                'code' => '063007000',
                'name' => 'Barotac Nuevo',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063007',
            ),
            236 => 
            array (
                'id' => 737,
                'code' => '063008000',
                'name' => 'Barotac Viejo',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063008',
            ),
            237 => 
            array (
                'id' => 738,
                'code' => '063009000',
                'name' => 'Batad',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063009',
            ),
            238 => 
            array (
                'id' => 739,
                'code' => '063010000',
                'name' => 'Bingawan',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063010',
            ),
            239 => 
            array (
                'id' => 740,
                'code' => '063012000',
                'name' => 'Cabatuan',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063012',
            ),
            240 => 
            array (
                'id' => 741,
                'code' => '063013000',
                'name' => 'Calinog',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063013',
            ),
            241 => 
            array (
                'id' => 742,
                'code' => '063014000',
                'name' => 'Carles',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063014',
            ),
            242 => 
            array (
                'id' => 743,
                'code' => '063015000',
                'name' => 'Concepcion',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063015',
            ),
            243 => 
            array (
                'id' => 744,
                'code' => '063016000',
                'name' => 'Dingle',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063016',
            ),
            244 => 
            array (
                'id' => 745,
                'code' => '063017000',
                'name' => 'Dueñas',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063017',
            ),
            245 => 
            array (
                'id' => 746,
                'code' => '063018000',
                'name' => 'Dumangas',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063018',
            ),
            246 => 
            array (
                'id' => 747,
                'code' => '063019000',
                'name' => 'Estancia',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063019',
            ),
            247 => 
            array (
                'id' => 748,
                'code' => '063020000',
                'name' => 'Guimbal',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063020',
            ),
            248 => 
            array (
                'id' => 749,
                'code' => '063021000',
                'name' => 'Igbaras',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063021',
            ),
            249 => 
            array (
                'id' => 750,
                'code' => '063022000',
            'name' => 'City of Iloilo (Capital)',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063022',
            ),
            250 => 
            array (
                'id' => 751,
                'code' => '063023000',
                'name' => 'Janiuay',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063023',
            ),
            251 => 
            array (
                'id' => 752,
                'code' => '063025000',
                'name' => 'Lambunao',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063025',
            ),
            252 => 
            array (
                'id' => 753,
                'code' => '063026000',
                'name' => 'Leganes',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063026',
            ),
            253 => 
            array (
                'id' => 754,
                'code' => '063027000',
                'name' => 'Lemery',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063027',
            ),
            254 => 
            array (
                'id' => 755,
                'code' => '063028000',
                'name' => 'Leon',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063028',
            ),
            255 => 
            array (
                'id' => 756,
                'code' => '063029000',
                'name' => 'Maasin',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063029',
            ),
            256 => 
            array (
                'id' => 757,
                'code' => '063030000',
                'name' => 'Miagao',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063030',
            ),
            257 => 
            array (
                'id' => 758,
                'code' => '063031000',
                'name' => 'Mina',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063031',
            ),
            258 => 
            array (
                'id' => 759,
                'code' => '063032000',
                'name' => 'New Lucena',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063032',
            ),
            259 => 
            array (
                'id' => 760,
                'code' => '063034000',
                'name' => 'Oton',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063034',
            ),
            260 => 
            array (
                'id' => 761,
                'code' => '063035000',
                'name' => 'City of Passi',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063035',
            ),
            261 => 
            array (
                'id' => 762,
                'code' => '063036000',
                'name' => 'Pavia',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063036',
            ),
            262 => 
            array (
                'id' => 763,
                'code' => '063037000',
                'name' => 'Pototan',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063037',
            ),
            263 => 
            array (
                'id' => 764,
                'code' => '063038000',
                'name' => 'San Dionisio',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063038',
            ),
            264 => 
            array (
                'id' => 765,
                'code' => '063039000',
                'name' => 'San Enrique',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063039',
            ),
            265 => 
            array (
                'id' => 766,
                'code' => '063040000',
                'name' => 'San Joaquin',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063040',
            ),
            266 => 
            array (
                'id' => 767,
                'code' => '063041000',
                'name' => 'San Miguel',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063041',
            ),
            267 => 
            array (
                'id' => 768,
                'code' => '063042000',
                'name' => 'San Rafael',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063042',
            ),
            268 => 
            array (
                'id' => 769,
                'code' => '063043000',
                'name' => 'Santa Barbara',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063043',
            ),
            269 => 
            array (
                'id' => 770,
                'code' => '063044000',
                'name' => 'Sara',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063044',
            ),
            270 => 
            array (
                'id' => 771,
                'code' => '063045000',
                'name' => 'Tigbauan',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063045',
            ),
            271 => 
            array (
                'id' => 772,
                'code' => '063046000',
                'name' => 'Tubungan',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063046',
            ),
            272 => 
            array (
                'id' => 773,
                'code' => '063047000',
                'name' => 'Zarraga',
                'region_id' => '06',
                'province_id' => '0630',
                'city_id' => '063047',
            ),
            273 => 
            array (
                'id' => 774,
                'code' => '064501000',
            'name' => 'City of Bacolod (Capital)',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064501',
            ),
            274 => 
            array (
                'id' => 775,
                'code' => '064502000',
                'name' => 'City of Bago',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064502',
            ),
            275 => 
            array (
                'id' => 776,
                'code' => '064503000',
                'name' => 'Binalbagan',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064503',
            ),
            276 => 
            array (
                'id' => 777,
                'code' => '064504000',
                'name' => 'City of Cadiz',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064504',
            ),
            277 => 
            array (
                'id' => 778,
                'code' => '064505000',
                'name' => 'Calatrava',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064505',
            ),
            278 => 
            array (
                'id' => 779,
                'code' => '064506000',
                'name' => 'Candoni',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064506',
            ),
            279 => 
            array (
                'id' => 780,
                'code' => '064507000',
                'name' => 'Cauayan',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064507',
            ),
            280 => 
            array (
                'id' => 781,
                'code' => '064508000',
                'name' => 'Enrique B. Magalona',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064508',
            ),
            281 => 
            array (
                'id' => 782,
                'code' => '064509000',
                'name' => 'City of Escalante',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064509',
            ),
            282 => 
            array (
                'id' => 783,
                'code' => '064510000',
                'name' => 'City of Himamaylan',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064510',
            ),
            283 => 
            array (
                'id' => 784,
                'code' => '064511000',
                'name' => 'Hinigaran',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064511',
            ),
            284 => 
            array (
                'id' => 785,
                'code' => '064512000',
                'name' => 'Hinoba-an',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064512',
            ),
            285 => 
            array (
                'id' => 786,
                'code' => '064513000',
                'name' => 'Ilog',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064513',
            ),
            286 => 
            array (
                'id' => 787,
                'code' => '064514000',
                'name' => 'Isabela',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064514',
            ),
            287 => 
            array (
                'id' => 788,
                'code' => '064515000',
                'name' => 'City of Kabankalan',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064515',
            ),
            288 => 
            array (
                'id' => 789,
                'code' => '064516000',
                'name' => 'City of La Carlota',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064516',
            ),
            289 => 
            array (
                'id' => 790,
                'code' => '064517000',
                'name' => 'La Castellana',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064517',
            ),
            290 => 
            array (
                'id' => 791,
                'code' => '064518000',
                'name' => 'Manapla',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064518',
            ),
            291 => 
            array (
                'id' => 792,
                'code' => '064519000',
                'name' => 'Moises Padilla',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064519',
            ),
            292 => 
            array (
                'id' => 793,
                'code' => '064520000',
                'name' => 'Murcia',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064520',
            ),
            293 => 
            array (
                'id' => 794,
                'code' => '064521000',
                'name' => 'Pontevedra',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064521',
            ),
            294 => 
            array (
                'id' => 795,
                'code' => '064522000',
                'name' => 'Pulupandan',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064522',
            ),
            295 => 
            array (
                'id' => 796,
                'code' => '064523000',
                'name' => 'City of Sagay',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064523',
            ),
            296 => 
            array (
                'id' => 797,
                'code' => '064524000',
                'name' => 'City of San Carlos',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064524',
            ),
            297 => 
            array (
                'id' => 798,
                'code' => '064525000',
                'name' => 'San Enrique',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064525',
            ),
            298 => 
            array (
                'id' => 799,
                'code' => '064526000',
                'name' => 'City of Silay',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064526',
            ),
            299 => 
            array (
                'id' => 800,
                'code' => '064527000',
                'name' => 'City of Sipalay',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064527',
            ),
            300 => 
            array (
                'id' => 801,
                'code' => '064528000',
                'name' => 'City of Talisay',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064528',
            ),
            301 => 
            array (
                'id' => 802,
                'code' => '064529000',
                'name' => 'Toboso',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064529',
            ),
            302 => 
            array (
                'id' => 803,
                'code' => '064530000',
                'name' => 'Valladolid',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064530',
            ),
            303 => 
            array (
                'id' => 804,
                'code' => '064531000',
                'name' => 'City of Victorias',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064531',
            ),
            304 => 
            array (
                'id' => 805,
                'code' => '064532000',
                'name' => 'Salvador Benedicto',
                'region_id' => '06',
                'province_id' => '0645',
                'city_id' => '064532',
            ),
            305 => 
            array (
                'id' => 806,
                'code' => '067901000',
                'name' => 'Buenavista',
                'region_id' => '06',
                'province_id' => '0679',
                'city_id' => '067901',
            ),
            306 => 
            array (
                'id' => 807,
                'code' => '067902000',
            'name' => 'Jordan (Capital)',
                'region_id' => '06',
                'province_id' => '0679',
                'city_id' => '067902',
            ),
            307 => 
            array (
                'id' => 808,
                'code' => '067903000',
                'name' => 'Nueva Valencia',
                'region_id' => '06',
                'province_id' => '0679',
                'city_id' => '067903',
            ),
            308 => 
            array (
                'id' => 809,
                'code' => '067904000',
                'name' => 'San Lorenzo',
                'region_id' => '06',
                'province_id' => '0679',
                'city_id' => '067904',
            ),
            309 => 
            array (
                'id' => 810,
                'code' => '067905000',
                'name' => 'Sibunag',
                'region_id' => '06',
                'province_id' => '0679',
                'city_id' => '067905',
            ),
            310 => 
            array (
                'id' => 811,
                'code' => '071201000',
                'name' => 'Alburquerque',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071201',
            ),
            311 => 
            array (
                'id' => 812,
                'code' => '071202000',
                'name' => 'Alicia',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071202',
            ),
            312 => 
            array (
                'id' => 813,
                'code' => '071203000',
                'name' => 'Anda',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071203',
            ),
            313 => 
            array (
                'id' => 814,
                'code' => '071204000',
                'name' => 'Antequera',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071204',
            ),
            314 => 
            array (
                'id' => 815,
                'code' => '071205000',
                'name' => 'Baclayon',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071205',
            ),
            315 => 
            array (
                'id' => 816,
                'code' => '071206000',
                'name' => 'Balilihan',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071206',
            ),
            316 => 
            array (
                'id' => 817,
                'code' => '071207000',
                'name' => 'Batuan',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071207',
            ),
            317 => 
            array (
                'id' => 818,
                'code' => '071208000',
                'name' => 'Bilar',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071208',
            ),
            318 => 
            array (
                'id' => 819,
                'code' => '071209000',
                'name' => 'Buenavista',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071209',
            ),
            319 => 
            array (
                'id' => 820,
                'code' => '071210000',
                'name' => 'Calape',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071210',
            ),
            320 => 
            array (
                'id' => 821,
                'code' => '071211000',
                'name' => 'Candijay',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071211',
            ),
            321 => 
            array (
                'id' => 822,
                'code' => '071212000',
                'name' => 'Carmen',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071212',
            ),
            322 => 
            array (
                'id' => 823,
                'code' => '071213000',
                'name' => 'Catigbian',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071213',
            ),
            323 => 
            array (
                'id' => 824,
                'code' => '071214000',
                'name' => 'Clarin',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071214',
            ),
            324 => 
            array (
                'id' => 825,
                'code' => '071215000',
                'name' => 'Corella',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071215',
            ),
            325 => 
            array (
                'id' => 826,
                'code' => '071216000',
                'name' => 'Cortes',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071216',
            ),
            326 => 
            array (
                'id' => 827,
                'code' => '071217000',
                'name' => 'Dagohoy',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071217',
            ),
            327 => 
            array (
                'id' => 828,
                'code' => '071218000',
                'name' => 'Danao',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071218',
            ),
            328 => 
            array (
                'id' => 829,
                'code' => '071219000',
                'name' => 'Dauis',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071219',
            ),
            329 => 
            array (
                'id' => 830,
                'code' => '071220000',
                'name' => 'Dimiao',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071220',
            ),
            330 => 
            array (
                'id' => 831,
                'code' => '071221000',
                'name' => 'Duero',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071221',
            ),
            331 => 
            array (
                'id' => 832,
                'code' => '071222000',
                'name' => 'Garcia Hernandez',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071222',
            ),
            332 => 
            array (
                'id' => 833,
                'code' => '071223000',
                'name' => 'Guindulman',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071223',
            ),
            333 => 
            array (
                'id' => 834,
                'code' => '071224000',
                'name' => 'Inabanga',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071224',
            ),
            334 => 
            array (
                'id' => 835,
                'code' => '071225000',
                'name' => 'Jagna',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071225',
            ),
            335 => 
            array (
                'id' => 836,
                'code' => '071226000',
                'name' => 'Getafe',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071226',
            ),
            336 => 
            array (
                'id' => 837,
                'code' => '071227000',
                'name' => 'Lila',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071227',
            ),
            337 => 
            array (
                'id' => 838,
                'code' => '071228000',
                'name' => 'Loay',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071228',
            ),
            338 => 
            array (
                'id' => 839,
                'code' => '071229000',
                'name' => 'Loboc',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071229',
            ),
            339 => 
            array (
                'id' => 840,
                'code' => '071230000',
                'name' => 'Loon',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071230',
            ),
            340 => 
            array (
                'id' => 841,
                'code' => '071231000',
                'name' => 'Mabini',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071231',
            ),
            341 => 
            array (
                'id' => 842,
                'code' => '071232000',
                'name' => 'Maribojoc',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071232',
            ),
            342 => 
            array (
                'id' => 843,
                'code' => '071233000',
                'name' => 'Panglao',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071233',
            ),
            343 => 
            array (
                'id' => 844,
                'code' => '071234000',
                'name' => 'Pilar',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071234',
            ),
            344 => 
            array (
                'id' => 845,
                'code' => '071235000',
                'name' => 'President Carlos P. Garcia',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071235',
            ),
            345 => 
            array (
                'id' => 846,
                'code' => '071236000',
                'name' => 'Sagbayan',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071236',
            ),
            346 => 
            array (
                'id' => 847,
                'code' => '071237000',
                'name' => 'San Isidro',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071237',
            ),
            347 => 
            array (
                'id' => 848,
                'code' => '071238000',
                'name' => 'San Miguel',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071238',
            ),
            348 => 
            array (
                'id' => 849,
                'code' => '071239000',
                'name' => 'Sevilla',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071239',
            ),
            349 => 
            array (
                'id' => 850,
                'code' => '071240000',
                'name' => 'Sierra Bullones',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071240',
            ),
            350 => 
            array (
                'id' => 851,
                'code' => '071241000',
                'name' => 'Sikatuna',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071241',
            ),
            351 => 
            array (
                'id' => 852,
                'code' => '071242000',
            'name' => 'City of Tagbilaran (Capital)',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071242',
            ),
            352 => 
            array (
                'id' => 853,
                'code' => '071243000',
                'name' => 'Talibon',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071243',
            ),
            353 => 
            array (
                'id' => 854,
                'code' => '071244000',
                'name' => 'Trinidad',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071244',
            ),
            354 => 
            array (
                'id' => 855,
                'code' => '071245000',
                'name' => 'Tubigon',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071245',
            ),
            355 => 
            array (
                'id' => 856,
                'code' => '071246000',
                'name' => 'Ubay',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071246',
            ),
            356 => 
            array (
                'id' => 857,
                'code' => '071247000',
                'name' => 'Valencia',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071247',
            ),
            357 => 
            array (
                'id' => 858,
                'code' => '071248000',
                'name' => 'Bien Unido',
                'region_id' => '07',
                'province_id' => '0712',
                'city_id' => '071248',
            ),
            358 => 
            array (
                'id' => 859,
                'code' => '072201000',
                'name' => 'Alcantara',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072201',
            ),
            359 => 
            array (
                'id' => 860,
                'code' => '072202000',
                'name' => 'Alcoy',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072202',
            ),
            360 => 
            array (
                'id' => 861,
                'code' => '072203000',
                'name' => 'Alegria',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072203',
            ),
            361 => 
            array (
                'id' => 862,
                'code' => '072204000',
                'name' => 'Aloguinsan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072204',
            ),
            362 => 
            array (
                'id' => 863,
                'code' => '072205000',
                'name' => 'Argao',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072205',
            ),
            363 => 
            array (
                'id' => 864,
                'code' => '072206000',
                'name' => 'Asturias',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072206',
            ),
            364 => 
            array (
                'id' => 865,
                'code' => '072207000',
                'name' => 'Badian',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072207',
            ),
            365 => 
            array (
                'id' => 866,
                'code' => '072208000',
                'name' => 'Balamban',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072208',
            ),
            366 => 
            array (
                'id' => 867,
                'code' => '072209000',
                'name' => 'Bantayan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072209',
            ),
            367 => 
            array (
                'id' => 868,
                'code' => '072210000',
                'name' => 'Barili',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072210',
            ),
            368 => 
            array (
                'id' => 869,
                'code' => '072211000',
                'name' => 'City of Bogo',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072211',
            ),
            369 => 
            array (
                'id' => 870,
                'code' => '072212000',
                'name' => 'Boljoon',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072212',
            ),
            370 => 
            array (
                'id' => 871,
                'code' => '072213000',
                'name' => 'Borbon',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072213',
            ),
            371 => 
            array (
                'id' => 872,
                'code' => '072214000',
                'name' => 'City of Carcar',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072214',
            ),
            372 => 
            array (
                'id' => 873,
                'code' => '072215000',
                'name' => 'Carmen',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072215',
            ),
            373 => 
            array (
                'id' => 874,
                'code' => '072216000',
                'name' => 'Catmon',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072216',
            ),
            374 => 
            array (
                'id' => 875,
                'code' => '072217000',
            'name' => 'City of Cebu (Capital)',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072217',
            ),
            375 => 
            array (
                'id' => 876,
                'code' => '072218000',
                'name' => 'Compostela',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072218',
            ),
            376 => 
            array (
                'id' => 877,
                'code' => '072219000',
                'name' => 'Consolacion',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072219',
            ),
            377 => 
            array (
                'id' => 878,
                'code' => '072220000',
                'name' => 'Cordova',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072220',
            ),
            378 => 
            array (
                'id' => 879,
                'code' => '072221000',
                'name' => 'Daanbantayan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072221',
            ),
            379 => 
            array (
                'id' => 880,
                'code' => '072222000',
                'name' => 'Dalaguete',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072222',
            ),
            380 => 
            array (
                'id' => 881,
                'code' => '072223000',
                'name' => 'Danao City',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072223',
            ),
            381 => 
            array (
                'id' => 882,
                'code' => '072224000',
                'name' => 'Dumanjug',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072224',
            ),
            382 => 
            array (
                'id' => 883,
                'code' => '072225000',
                'name' => 'Ginatilan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072225',
            ),
            383 => 
            array (
                'id' => 884,
                'code' => '072226000',
                'name' => 'City of Lapu-Lapu',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072226',
            ),
            384 => 
            array (
                'id' => 885,
                'code' => '072227000',
                'name' => 'Liloan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072227',
            ),
            385 => 
            array (
                'id' => 886,
                'code' => '072228000',
                'name' => 'Madridejos',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072228',
            ),
            386 => 
            array (
                'id' => 887,
                'code' => '072229000',
                'name' => 'Malabuyoc',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072229',
            ),
            387 => 
            array (
                'id' => 888,
                'code' => '072230000',
                'name' => 'City of Mandaue',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072230',
            ),
            388 => 
            array (
                'id' => 889,
                'code' => '072231000',
                'name' => 'Medellin',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072231',
            ),
            389 => 
            array (
                'id' => 890,
                'code' => '072232000',
                'name' => 'Minglanilla',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072232',
            ),
            390 => 
            array (
                'id' => 891,
                'code' => '072233000',
                'name' => 'Moalboal',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072233',
            ),
            391 => 
            array (
                'id' => 892,
                'code' => '072234000',
                'name' => 'City of Naga',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072234',
            ),
            392 => 
            array (
                'id' => 893,
                'code' => '072235000',
                'name' => 'Oslob',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072235',
            ),
            393 => 
            array (
                'id' => 894,
                'code' => '072236000',
                'name' => 'Pilar',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072236',
            ),
            394 => 
            array (
                'id' => 895,
                'code' => '072237000',
                'name' => 'Pinamungajan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072237',
            ),
            395 => 
            array (
                'id' => 896,
                'code' => '072238000',
                'name' => 'Poro',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072238',
            ),
            396 => 
            array (
                'id' => 897,
                'code' => '072239000',
                'name' => 'Ronda',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072239',
            ),
            397 => 
            array (
                'id' => 898,
                'code' => '072240000',
                'name' => 'Samboan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072240',
            ),
            398 => 
            array (
                'id' => 899,
                'code' => '072241000',
                'name' => 'San Fernando',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072241',
            ),
            399 => 
            array (
                'id' => 900,
                'code' => '072242000',
                'name' => 'San Francisco',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072242',
            ),
            400 => 
            array (
                'id' => 901,
                'code' => '072243000',
                'name' => 'San Remigio',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072243',
            ),
            401 => 
            array (
                'id' => 902,
                'code' => '072244000',
                'name' => 'Santa Fe',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072244',
            ),
            402 => 
            array (
                'id' => 903,
                'code' => '072245000',
                'name' => 'Santander',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072245',
            ),
            403 => 
            array (
                'id' => 904,
                'code' => '072246000',
                'name' => 'Sibonga',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072246',
            ),
            404 => 
            array (
                'id' => 905,
                'code' => '072247000',
                'name' => 'Sogod',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072247',
            ),
            405 => 
            array (
                'id' => 906,
                'code' => '072248000',
                'name' => 'Tabogon',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072248',
            ),
            406 => 
            array (
                'id' => 907,
                'code' => '072249000',
                'name' => 'Tabuelan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072249',
            ),
            407 => 
            array (
                'id' => 908,
                'code' => '072250000',
                'name' => 'City of Talisay',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072250',
            ),
            408 => 
            array (
                'id' => 909,
                'code' => '072251000',
                'name' => 'City of Toledo',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072251',
            ),
            409 => 
            array (
                'id' => 910,
                'code' => '072252000',
                'name' => 'Tuburan',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072252',
            ),
            410 => 
            array (
                'id' => 911,
                'code' => '072253000',
                'name' => 'Tudela',
                'region_id' => '07',
                'province_id' => '0722',
                'city_id' => '072253',
            ),
            411 => 
            array (
                'id' => 912,
                'code' => '074601000',
                'name' => 'Amlan',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074601',
            ),
            412 => 
            array (
                'id' => 913,
                'code' => '074602000',
                'name' => 'Ayungon',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074602',
            ),
            413 => 
            array (
                'id' => 914,
                'code' => '074603000',
                'name' => 'Bacong',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074603',
            ),
            414 => 
            array (
                'id' => 915,
                'code' => '074604000',
                'name' => 'City of Bais',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074604',
            ),
            415 => 
            array (
                'id' => 916,
                'code' => '074605000',
                'name' => 'Basay',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074605',
            ),
            416 => 
            array (
                'id' => 917,
                'code' => '074606000',
                'name' => 'City of Bayawan',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074606',
            ),
            417 => 
            array (
                'id' => 918,
                'code' => '074607000',
                'name' => 'Bindoy',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074607',
            ),
            418 => 
            array (
                'id' => 919,
                'code' => '074608000',
                'name' => 'City of Canlaon',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074608',
            ),
            419 => 
            array (
                'id' => 920,
                'code' => '074609000',
                'name' => 'Dauin',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074609',
            ),
            420 => 
            array (
                'id' => 921,
                'code' => '074610000',
            'name' => 'City of Dumaguete (Capital)',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074610',
            ),
            421 => 
            array (
                'id' => 922,
                'code' => '074611000',
                'name' => 'City of Guihulngan',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074611',
            ),
            422 => 
            array (
                'id' => 923,
                'code' => '074612000',
                'name' => 'Jimalalud',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074612',
            ),
            423 => 
            array (
                'id' => 924,
                'code' => '074613000',
                'name' => 'La Libertad',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074613',
            ),
            424 => 
            array (
                'id' => 925,
                'code' => '074614000',
                'name' => 'Mabinay',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074614',
            ),
            425 => 
            array (
                'id' => 926,
                'code' => '074615000',
                'name' => 'Manjuyod',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074615',
            ),
            426 => 
            array (
                'id' => 927,
                'code' => '074616000',
                'name' => 'Pamplona',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074616',
            ),
            427 => 
            array (
                'id' => 928,
                'code' => '074617000',
                'name' => 'San Jose',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074617',
            ),
            428 => 
            array (
                'id' => 929,
                'code' => '074618000',
                'name' => 'Santa Catalina',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074618',
            ),
            429 => 
            array (
                'id' => 930,
                'code' => '074619000',
                'name' => 'Siaton',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074619',
            ),
            430 => 
            array (
                'id' => 931,
                'code' => '074620000',
                'name' => 'Sibulan',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074620',
            ),
            431 => 
            array (
                'id' => 932,
                'code' => '074621000',
                'name' => 'City of Tanjay',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074621',
            ),
            432 => 
            array (
                'id' => 933,
                'code' => '074622000',
                'name' => 'Tayasan',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074622',
            ),
            433 => 
            array (
                'id' => 934,
                'code' => '074623000',
                'name' => 'Valencia',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074623',
            ),
            434 => 
            array (
                'id' => 935,
                'code' => '074624000',
                'name' => 'Vallehermoso',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074624',
            ),
            435 => 
            array (
                'id' => 936,
                'code' => '074625000',
                'name' => 'Zamboanguita',
                'region_id' => '07',
                'province_id' => '0746',
                'city_id' => '074625',
            ),
            436 => 
            array (
                'id' => 937,
                'code' => '076101000',
                'name' => 'Enrique Villanueva',
                'region_id' => '07',
                'province_id' => '0761',
                'city_id' => '076101',
            ),
            437 => 
            array (
                'id' => 938,
                'code' => '076102000',
                'name' => 'Larena',
                'region_id' => '07',
                'province_id' => '0761',
                'city_id' => '076102',
            ),
            438 => 
            array (
                'id' => 939,
                'code' => '076103000',
                'name' => 'Lazi',
                'region_id' => '07',
                'province_id' => '0761',
                'city_id' => '076103',
            ),
            439 => 
            array (
                'id' => 940,
                'code' => '076104000',
                'name' => 'Maria',
                'region_id' => '07',
                'province_id' => '0761',
                'city_id' => '076104',
            ),
            440 => 
            array (
                'id' => 941,
                'code' => '076105000',
                'name' => 'San Juan',
                'region_id' => '07',
                'province_id' => '0761',
                'city_id' => '076105',
            ),
            441 => 
            array (
                'id' => 942,
                'code' => '076106000',
            'name' => 'Siquijor (Capital)',
                'region_id' => '07',
                'province_id' => '0761',
                'city_id' => '076106',
            ),
            442 => 
            array (
                'id' => 943,
                'code' => '082601000',
                'name' => 'Arteche',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082601',
            ),
            443 => 
            array (
                'id' => 944,
                'code' => '082602000',
                'name' => 'Balangiga',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082602',
            ),
            444 => 
            array (
                'id' => 945,
                'code' => '082603000',
                'name' => 'Balangkayan',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082603',
            ),
            445 => 
            array (
                'id' => 946,
                'code' => '082604000',
            'name' => 'City of Borongan (Capital)',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082604',
            ),
            446 => 
            array (
                'id' => 947,
                'code' => '082605000',
                'name' => 'Can-Avid',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082605',
            ),
            447 => 
            array (
                'id' => 948,
                'code' => '082606000',
                'name' => 'Dolores',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082606',
            ),
            448 => 
            array (
                'id' => 949,
                'code' => '082607000',
                'name' => 'General Macarthur',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082607',
            ),
            449 => 
            array (
                'id' => 950,
                'code' => '082608000',
                'name' => 'Giporlos',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082608',
            ),
            450 => 
            array (
                'id' => 951,
                'code' => '082609000',
                'name' => 'Guiuan',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082609',
            ),
            451 => 
            array (
                'id' => 952,
                'code' => '082610000',
                'name' => 'Hernani',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082610',
            ),
            452 => 
            array (
                'id' => 953,
                'code' => '082611000',
                'name' => 'Jipapad',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082611',
            ),
            453 => 
            array (
                'id' => 954,
                'code' => '082612000',
                'name' => 'Lawaan',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082612',
            ),
            454 => 
            array (
                'id' => 955,
                'code' => '082613000',
                'name' => 'Llorente',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082613',
            ),
            455 => 
            array (
                'id' => 956,
                'code' => '082614000',
                'name' => 'Maslog',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082614',
            ),
            456 => 
            array (
                'id' => 957,
                'code' => '082615000',
                'name' => 'Maydolong',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082615',
            ),
            457 => 
            array (
                'id' => 958,
                'code' => '082616000',
                'name' => 'Mercedes',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082616',
            ),
            458 => 
            array (
                'id' => 959,
                'code' => '082617000',
                'name' => 'Oras',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082617',
            ),
            459 => 
            array (
                'id' => 960,
                'code' => '082618000',
                'name' => 'Quinapondan',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082618',
            ),
            460 => 
            array (
                'id' => 961,
                'code' => '082619000',
                'name' => 'Salcedo',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082619',
            ),
            461 => 
            array (
                'id' => 962,
                'code' => '082620000',
                'name' => 'San Julian',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082620',
            ),
            462 => 
            array (
                'id' => 963,
                'code' => '082621000',
                'name' => 'San Policarpo',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082621',
            ),
            463 => 
            array (
                'id' => 964,
                'code' => '082622000',
                'name' => 'Sulat',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082622',
            ),
            464 => 
            array (
                'id' => 965,
                'code' => '082623000',
                'name' => 'Taft',
                'region_id' => '08',
                'province_id' => '0826',
                'city_id' => '082623',
            ),
            465 => 
            array (
                'id' => 966,
                'code' => '083701000',
                'name' => 'Abuyog',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083701',
            ),
            466 => 
            array (
                'id' => 967,
                'code' => '083702000',
                'name' => 'Alangalang',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083702',
            ),
            467 => 
            array (
                'id' => 968,
                'code' => '083703000',
                'name' => 'Albuera',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083703',
            ),
            468 => 
            array (
                'id' => 969,
                'code' => '083705000',
                'name' => 'Babatngon',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083705',
            ),
            469 => 
            array (
                'id' => 970,
                'code' => '083706000',
                'name' => 'Barugo',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083706',
            ),
            470 => 
            array (
                'id' => 971,
                'code' => '083707000',
                'name' => 'Bato',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083707',
            ),
            471 => 
            array (
                'id' => 972,
                'code' => '083708000',
                'name' => 'City of Baybay',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083708',
            ),
            472 => 
            array (
                'id' => 973,
                'code' => '083710000',
                'name' => 'Burauen',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083710',
            ),
            473 => 
            array (
                'id' => 974,
                'code' => '083713000',
                'name' => 'Calubian',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083713',
            ),
            474 => 
            array (
                'id' => 975,
                'code' => '083714000',
                'name' => 'Capoocan',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083714',
            ),
            475 => 
            array (
                'id' => 976,
                'code' => '083715000',
                'name' => 'Carigara',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083715',
            ),
            476 => 
            array (
                'id' => 977,
                'code' => '083717000',
                'name' => 'Dagami',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083717',
            ),
            477 => 
            array (
                'id' => 978,
                'code' => '083718000',
                'name' => 'Dulag',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083718',
            ),
            478 => 
            array (
                'id' => 979,
                'code' => '083719000',
                'name' => 'Hilongos',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083719',
            ),
            479 => 
            array (
                'id' => 980,
                'code' => '083720000',
                'name' => 'Hindang',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083720',
            ),
            480 => 
            array (
                'id' => 981,
                'code' => '083721000',
                'name' => 'Inopacan',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083721',
            ),
            481 => 
            array (
                'id' => 982,
                'code' => '083722000',
                'name' => 'Isabel',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083722',
            ),
            482 => 
            array (
                'id' => 983,
                'code' => '083723000',
                'name' => 'Jaro',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083723',
            ),
            483 => 
            array (
                'id' => 984,
                'code' => '083724000',
                'name' => 'Javier',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083724',
            ),
            484 => 
            array (
                'id' => 985,
                'code' => '083725000',
                'name' => 'Julita',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083725',
            ),
            485 => 
            array (
                'id' => 986,
                'code' => '083726000',
                'name' => 'Kananga',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083726',
            ),
            486 => 
            array (
                'id' => 987,
                'code' => '083728000',
                'name' => 'La Paz',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083728',
            ),
            487 => 
            array (
                'id' => 988,
                'code' => '083729000',
                'name' => 'Leyte',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083729',
            ),
            488 => 
            array (
                'id' => 989,
                'code' => '083730000',
                'name' => 'Macarthur',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083730',
            ),
            489 => 
            array (
                'id' => 990,
                'code' => '083731000',
                'name' => 'Mahaplag',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083731',
            ),
            490 => 
            array (
                'id' => 991,
                'code' => '083733000',
                'name' => 'Matag-Ob',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083733',
            ),
            491 => 
            array (
                'id' => 992,
                'code' => '083734000',
                'name' => 'Matalom',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083734',
            ),
            492 => 
            array (
                'id' => 993,
                'code' => '083735000',
                'name' => 'Mayorga',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083735',
            ),
            493 => 
            array (
                'id' => 994,
                'code' => '083736000',
                'name' => 'Merida',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083736',
            ),
            494 => 
            array (
                'id' => 995,
                'code' => '083738000',
                'name' => 'Ormoc City',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083738',
            ),
            495 => 
            array (
                'id' => 996,
                'code' => '083739000',
                'name' => 'Palo',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083739',
            ),
            496 => 
            array (
                'id' => 997,
                'code' => '083740000',
                'name' => 'Palompon',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083740',
            ),
            497 => 
            array (
                'id' => 998,
                'code' => '083741000',
                'name' => 'Pastrana',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083741',
            ),
            498 => 
            array (
                'id' => 999,
                'code' => '083742000',
                'name' => 'San Isidro',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083742',
            ),
            499 => 
            array (
                'id' => 1000,
                'code' => '083743000',
                'name' => 'San Miguel',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083743',
            ),
        ));
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1001,
                'code' => '083744000',
                'name' => 'Santa Fe',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083744',
            ),
            1 => 
            array (
                'id' => 1002,
                'code' => '083745000',
                'name' => 'Tabango',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083745',
            ),
            2 => 
            array (
                'id' => 1003,
                'code' => '083746000',
                'name' => 'Tabontabon',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083746',
            ),
            3 => 
            array (
                'id' => 1004,
                'code' => '083747000',
            'name' => 'City of Tacloban (Capital)',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083747',
            ),
            4 => 
            array (
                'id' => 1005,
                'code' => '083748000',
                'name' => 'Tanauan',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083748',
            ),
            5 => 
            array (
                'id' => 1006,
                'code' => '083749000',
                'name' => 'Tolosa',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083749',
            ),
            6 => 
            array (
                'id' => 1007,
                'code' => '083750000',
                'name' => 'Tunga',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083750',
            ),
            7 => 
            array (
                'id' => 1008,
                'code' => '083751000',
                'name' => 'Villaba',
                'region_id' => '08',
                'province_id' => '0837',
                'city_id' => '083751',
            ),
            8 => 
            array (
                'id' => 1009,
                'code' => '084801000',
                'name' => 'Allen',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084801',
            ),
            9 => 
            array (
                'id' => 1010,
                'code' => '084802000',
                'name' => 'Biri',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084802',
            ),
            10 => 
            array (
                'id' => 1011,
                'code' => '084803000',
                'name' => 'Bobon',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084803',
            ),
            11 => 
            array (
                'id' => 1012,
                'code' => '084804000',
                'name' => 'Capul',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084804',
            ),
            12 => 
            array (
                'id' => 1013,
                'code' => '084805000',
            'name' => 'Catarman (Capital)',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084805',
            ),
            13 => 
            array (
                'id' => 1014,
                'code' => '084806000',
                'name' => 'Catubig',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084806',
            ),
            14 => 
            array (
                'id' => 1015,
                'code' => '084807000',
                'name' => 'Gamay',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084807',
            ),
            15 => 
            array (
                'id' => 1016,
                'code' => '084808000',
                'name' => 'Laoang',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084808',
            ),
            16 => 
            array (
                'id' => 1017,
                'code' => '084809000',
                'name' => 'Lapinig',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084809',
            ),
            17 => 
            array (
                'id' => 1018,
                'code' => '084810000',
                'name' => 'Las Navas',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084810',
            ),
            18 => 
            array (
                'id' => 1019,
                'code' => '084811000',
                'name' => 'Lavezares',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084811',
            ),
            19 => 
            array (
                'id' => 1020,
                'code' => '084812000',
                'name' => 'Mapanas',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084812',
            ),
            20 => 
            array (
                'id' => 1021,
                'code' => '084813000',
                'name' => 'Mondragon',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084813',
            ),
            21 => 
            array (
                'id' => 1022,
                'code' => '084814000',
                'name' => 'Palapag',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084814',
            ),
            22 => 
            array (
                'id' => 1023,
                'code' => '084815000',
                'name' => 'Pambujan',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084815',
            ),
            23 => 
            array (
                'id' => 1024,
                'code' => '084816000',
                'name' => 'Rosario',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084816',
            ),
            24 => 
            array (
                'id' => 1025,
                'code' => '084817000',
                'name' => 'San Antonio',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084817',
            ),
            25 => 
            array (
                'id' => 1026,
                'code' => '084818000',
                'name' => 'San Isidro',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084818',
            ),
            26 => 
            array (
                'id' => 1027,
                'code' => '084819000',
                'name' => 'San Jose',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084819',
            ),
            27 => 
            array (
                'id' => 1028,
                'code' => '084820000',
                'name' => 'San Roque',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084820',
            ),
            28 => 
            array (
                'id' => 1029,
                'code' => '084821000',
                'name' => 'San Vicente',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084821',
            ),
            29 => 
            array (
                'id' => 1030,
                'code' => '084822000',
                'name' => 'Silvino Lobos',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084822',
            ),
            30 => 
            array (
                'id' => 1031,
                'code' => '084823000',
                'name' => 'Victoria',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084823',
            ),
            31 => 
            array (
                'id' => 1032,
                'code' => '084824000',
                'name' => 'Lope De Vega',
                'region_id' => '08',
                'province_id' => '0848',
                'city_id' => '084824',
            ),
            32 => 
            array (
                'id' => 1033,
                'code' => '086001000',
                'name' => 'Almagro',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086001',
            ),
            33 => 
            array (
                'id' => 1034,
                'code' => '086002000',
                'name' => 'Basey',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086002',
            ),
            34 => 
            array (
                'id' => 1035,
                'code' => '086003000',
                'name' => 'City of Calbayog',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086003',
            ),
            35 => 
            array (
                'id' => 1036,
                'code' => '086004000',
                'name' => 'Calbiga',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086004',
            ),
            36 => 
            array (
                'id' => 1037,
                'code' => '086005000',
            'name' => 'City of Catbalogan (Capital)',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086005',
            ),
            37 => 
            array (
                'id' => 1038,
                'code' => '086006000',
                'name' => 'Daram',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086006',
            ),
            38 => 
            array (
                'id' => 1039,
                'code' => '086007000',
                'name' => 'Gandara',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086007',
            ),
            39 => 
            array (
                'id' => 1040,
                'code' => '086008000',
                'name' => 'Hinabangan',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086008',
            ),
            40 => 
            array (
                'id' => 1041,
                'code' => '086009000',
                'name' => 'Jiabong',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086009',
            ),
            41 => 
            array (
                'id' => 1042,
                'code' => '086010000',
                'name' => 'Marabut',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086010',
            ),
            42 => 
            array (
                'id' => 1043,
                'code' => '086011000',
                'name' => 'Matuguinao',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086011',
            ),
            43 => 
            array (
                'id' => 1044,
                'code' => '086012000',
                'name' => 'Motiong',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086012',
            ),
            44 => 
            array (
                'id' => 1045,
                'code' => '086013000',
                'name' => 'Pinabacdao',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086013',
            ),
            45 => 
            array (
                'id' => 1046,
                'code' => '086014000',
                'name' => 'San Jose De Buan',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086014',
            ),
            46 => 
            array (
                'id' => 1047,
                'code' => '086015000',
                'name' => 'San Sebastian',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086015',
            ),
            47 => 
            array (
                'id' => 1048,
                'code' => '086016000',
                'name' => 'Santa Margarita',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086016',
            ),
            48 => 
            array (
                'id' => 1049,
                'code' => '086017000',
                'name' => 'Santa Rita',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086017',
            ),
            49 => 
            array (
                'id' => 1050,
                'code' => '086018000',
                'name' => 'Santo Niño',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086018',
            ),
            50 => 
            array (
                'id' => 1051,
                'code' => '086019000',
                'name' => 'Talalora',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086019',
            ),
            51 => 
            array (
                'id' => 1052,
                'code' => '086020000',
                'name' => 'Tarangnan',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086020',
            ),
            52 => 
            array (
                'id' => 1053,
                'code' => '086021000',
                'name' => 'Villareal',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086021',
            ),
            53 => 
            array (
                'id' => 1054,
                'code' => '086022000',
                'name' => 'Paranas',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086022',
            ),
            54 => 
            array (
                'id' => 1055,
                'code' => '086023000',
                'name' => 'Zumarraga',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086023',
            ),
            55 => 
            array (
                'id' => 1056,
                'code' => '086024000',
                'name' => 'Tagapul-An',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086024',
            ),
            56 => 
            array (
                'id' => 1057,
                'code' => '086025000',
                'name' => 'San Jorge',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086025',
            ),
            57 => 
            array (
                'id' => 1058,
                'code' => '086026000',
                'name' => 'Pagsanghan',
                'region_id' => '08',
                'province_id' => '0860',
                'city_id' => '086026',
            ),
            58 => 
            array (
                'id' => 1059,
                'code' => '086401000',
                'name' => 'Anahawan',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086401',
            ),
            59 => 
            array (
                'id' => 1060,
                'code' => '086402000',
                'name' => 'Bontoc',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086402',
            ),
            60 => 
            array (
                'id' => 1061,
                'code' => '086403000',
                'name' => 'Hinunangan',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086403',
            ),
            61 => 
            array (
                'id' => 1062,
                'code' => '086404000',
                'name' => 'Hinundayan',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086404',
            ),
            62 => 
            array (
                'id' => 1063,
                'code' => '086405000',
                'name' => 'Libagon',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086405',
            ),
            63 => 
            array (
                'id' => 1064,
                'code' => '086406000',
                'name' => 'Liloan',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086406',
            ),
            64 => 
            array (
                'id' => 1065,
                'code' => '086407000',
            'name' => 'City of Maasin (Capital)',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086407',
            ),
            65 => 
            array (
                'id' => 1066,
                'code' => '086408000',
                'name' => 'Macrohon',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086408',
            ),
            66 => 
            array (
                'id' => 1067,
                'code' => '086409000',
                'name' => 'Malitbog',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086409',
            ),
            67 => 
            array (
                'id' => 1068,
                'code' => '086410000',
                'name' => 'Padre Burgos',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086410',
            ),
            68 => 
            array (
                'id' => 1069,
                'code' => '086411000',
                'name' => 'Pintuyan',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086411',
            ),
            69 => 
            array (
                'id' => 1070,
                'code' => '086412000',
                'name' => 'Saint Bernard',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086412',
            ),
            70 => 
            array (
                'id' => 1071,
                'code' => '086413000',
                'name' => 'San Francisco',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086413',
            ),
            71 => 
            array (
                'id' => 1072,
                'code' => '086414000',
                'name' => 'San Juan',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086414',
            ),
            72 => 
            array (
                'id' => 1073,
                'code' => '086415000',
                'name' => 'San Ricardo',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086415',
            ),
            73 => 
            array (
                'id' => 1074,
                'code' => '086416000',
                'name' => 'Silago',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086416',
            ),
            74 => 
            array (
                'id' => 1075,
                'code' => '086417000',
                'name' => 'Sogod',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086417',
            ),
            75 => 
            array (
                'id' => 1076,
                'code' => '086418000',
                'name' => 'Tomas Oppus',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086418',
            ),
            76 => 
            array (
                'id' => 1077,
                'code' => '086419000',
                'name' => 'Limasawa',
                'region_id' => '08',
                'province_id' => '0864',
                'city_id' => '086419',
            ),
            77 => 
            array (
                'id' => 1078,
                'code' => '087801000',
                'name' => 'Almeria',
                'region_id' => '08',
                'province_id' => '0878',
                'city_id' => '087801',
            ),
            78 => 
            array (
                'id' => 1079,
                'code' => '087802000',
                'name' => 'Biliran',
                'region_id' => '08',
                'province_id' => '0878',
                'city_id' => '087802',
            ),
            79 => 
            array (
                'id' => 1080,
                'code' => '087803000',
                'name' => 'Cabucgayan',
                'region_id' => '08',
                'province_id' => '0878',
                'city_id' => '087803',
            ),
            80 => 
            array (
                'id' => 1081,
                'code' => '087804000',
                'name' => 'Caibiran',
                'region_id' => '08',
                'province_id' => '0878',
                'city_id' => '087804',
            ),
            81 => 
            array (
                'id' => 1082,
                'code' => '087805000',
                'name' => 'Culaba',
                'region_id' => '08',
                'province_id' => '0878',
                'city_id' => '087805',
            ),
            82 => 
            array (
                'id' => 1083,
                'code' => '087806000',
                'name' => 'Kawayan',
                'region_id' => '08',
                'province_id' => '0878',
                'city_id' => '087806',
            ),
            83 => 
            array (
                'id' => 1084,
                'code' => '087807000',
                'name' => 'Maripipi',
                'region_id' => '08',
                'province_id' => '0878',
                'city_id' => '087807',
            ),
            84 => 
            array (
                'id' => 1085,
                'code' => '087808000',
            'name' => 'Naval (Capital)',
                'region_id' => '08',
                'province_id' => '0878',
                'city_id' => '087808',
            ),
            85 => 
            array (
                'id' => 1086,
                'code' => '097201000',
                'name' => 'City of Dapitan',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097201',
            ),
            86 => 
            array (
                'id' => 1087,
                'code' => '097202000',
            'name' => 'City of Dipolog (Capital)',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097202',
            ),
            87 => 
            array (
                'id' => 1088,
                'code' => '097203000',
                'name' => 'Katipunan',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097203',
            ),
            88 => 
            array (
                'id' => 1089,
                'code' => '097204000',
                'name' => 'La Libertad',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097204',
            ),
            89 => 
            array (
                'id' => 1090,
                'code' => '097205000',
                'name' => 'Labason',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097205',
            ),
            90 => 
            array (
                'id' => 1091,
                'code' => '097206000',
                'name' => 'Liloy',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097206',
            ),
            91 => 
            array (
                'id' => 1092,
                'code' => '097207000',
                'name' => 'Manukan',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097207',
            ),
            92 => 
            array (
                'id' => 1093,
                'code' => '097208000',
                'name' => 'Mutia',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097208',
            ),
            93 => 
            array (
                'id' => 1094,
                'code' => '097209000',
                'name' => 'Piñan',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097209',
            ),
            94 => 
            array (
                'id' => 1095,
                'code' => '097210000',
                'name' => 'Polanco',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097210',
            ),
            95 => 
            array (
                'id' => 1096,
                'code' => '097211000',
                'name' => 'Pres. Manuel A. Roxas',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097211',
            ),
            96 => 
            array (
                'id' => 1097,
                'code' => '097212000',
                'name' => 'Rizal',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097212',
            ),
            97 => 
            array (
                'id' => 1098,
                'code' => '097213000',
                'name' => 'Salug',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097213',
            ),
            98 => 
            array (
                'id' => 1099,
                'code' => '097214000',
                'name' => 'Sergio Osmeña Sr.',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097214',
            ),
            99 => 
            array (
                'id' => 1100,
                'code' => '097215000',
                'name' => 'Siayan',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097215',
            ),
            100 => 
            array (
                'id' => 1101,
                'code' => '097216000',
                'name' => 'Sibuco',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097216',
            ),
            101 => 
            array (
                'id' => 1102,
                'code' => '097217000',
                'name' => 'Sibutad',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097217',
            ),
            102 => 
            array (
                'id' => 1103,
                'code' => '097218000',
                'name' => 'Sindangan',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097218',
            ),
            103 => 
            array (
                'id' => 1104,
                'code' => '097219000',
                'name' => 'Siocon',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097219',
            ),
            104 => 
            array (
                'id' => 1105,
                'code' => '097220000',
                'name' => 'Sirawai',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097220',
            ),
            105 => 
            array (
                'id' => 1106,
                'code' => '097221000',
                'name' => 'Tampilisan',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097221',
            ),
            106 => 
            array (
                'id' => 1107,
                'code' => '097222000',
                'name' => 'Jose Dalman',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097222',
            ),
            107 => 
            array (
                'id' => 1108,
                'code' => '097223000',
                'name' => 'Gutalac',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097223',
            ),
            108 => 
            array (
                'id' => 1109,
                'code' => '097224000',
                'name' => 'Baliguian',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097224',
            ),
            109 => 
            array (
                'id' => 1110,
                'code' => '097225000',
                'name' => 'Godod',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097225',
            ),
            110 => 
            array (
                'id' => 1111,
                'code' => '097226000',
                'name' => 'Bacungan',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097226',
            ),
            111 => 
            array (
                'id' => 1112,
                'code' => '097227000',
                'name' => 'Kalawit',
                'region_id' => '09',
                'province_id' => '0972',
                'city_id' => '097227',
            ),
            112 => 
            array (
                'id' => 1113,
                'code' => '097302000',
                'name' => 'Aurora',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097302',
            ),
            113 => 
            array (
                'id' => 1114,
                'code' => '097303000',
                'name' => 'Bayog',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097303',
            ),
            114 => 
            array (
                'id' => 1115,
                'code' => '097305000',
                'name' => 'Dimataling',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097305',
            ),
            115 => 
            array (
                'id' => 1116,
                'code' => '097306000',
                'name' => 'Dinas',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097306',
            ),
            116 => 
            array (
                'id' => 1117,
                'code' => '097307000',
                'name' => 'Dumalinao',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097307',
            ),
            117 => 
            array (
                'id' => 1118,
                'code' => '097308000',
                'name' => 'Dumingag',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097308',
            ),
            118 => 
            array (
                'id' => 1119,
                'code' => '097311000',
                'name' => 'Kumalarang',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097311',
            ),
            119 => 
            array (
                'id' => 1120,
                'code' => '097312000',
                'name' => 'Labangan',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097312',
            ),
            120 => 
            array (
                'id' => 1121,
                'code' => '097313000',
                'name' => 'Lapuyan',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097313',
            ),
            121 => 
            array (
                'id' => 1122,
                'code' => '097315000',
                'name' => 'Mahayag',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097315',
            ),
            122 => 
            array (
                'id' => 1123,
                'code' => '097317000',
                'name' => 'Margosatubig',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097317',
            ),
            123 => 
            array (
                'id' => 1124,
                'code' => '097318000',
                'name' => 'Midsalip',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097318',
            ),
            124 => 
            array (
                'id' => 1125,
                'code' => '097319000',
                'name' => 'Molave',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097319',
            ),
            125 => 
            array (
                'id' => 1126,
                'code' => '097322000',
            'name' => 'City of Pagadian (Capital)',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097322',
            ),
            126 => 
            array (
                'id' => 1127,
                'code' => '097323000',
                'name' => 'Ramon Magsaysay',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097323',
            ),
            127 => 
            array (
                'id' => 1128,
                'code' => '097324000',
                'name' => 'San Miguel',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097324',
            ),
            128 => 
            array (
                'id' => 1129,
                'code' => '097325000',
                'name' => 'San Pablo',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097325',
            ),
            129 => 
            array (
                'id' => 1130,
                'code' => '097327000',
                'name' => 'Tabina',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097327',
            ),
            130 => 
            array (
                'id' => 1131,
                'code' => '097328000',
                'name' => 'Tambulig',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097328',
            ),
            131 => 
            array (
                'id' => 1132,
                'code' => '097330000',
                'name' => 'Tukuran',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097330',
            ),
            132 => 
            array (
                'id' => 1133,
                'code' => '097332000',
                'name' => 'City of Zamboanga',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097332',
            ),
            133 => 
            array (
                'id' => 1134,
                'code' => '097333000',
                'name' => 'Lakewood',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097333',
            ),
            134 => 
            array (
                'id' => 1135,
                'code' => '097337000',
                'name' => 'Josefina',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097337',
            ),
            135 => 
            array (
                'id' => 1136,
                'code' => '097338000',
                'name' => 'Pitogo',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097338',
            ),
            136 => 
            array (
                'id' => 1137,
                'code' => '097340000',
                'name' => 'Sominot',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097340',
            ),
            137 => 
            array (
                'id' => 1138,
                'code' => '097341000',
                'name' => 'Vincenzo A. Sagun',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097341',
            ),
            138 => 
            array (
                'id' => 1139,
                'code' => '097343000',
                'name' => 'Guipos',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097343',
            ),
            139 => 
            array (
                'id' => 1140,
                'code' => '097344000',
                'name' => 'Tigbao',
                'region_id' => '09',
                'province_id' => '0973',
                'city_id' => '097344',
            ),
            140 => 
            array (
                'id' => 1141,
                'code' => '098301000',
                'name' => 'Alicia',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098301',
            ),
            141 => 
            array (
                'id' => 1142,
                'code' => '098302000',
                'name' => 'Buug',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098302',
            ),
            142 => 
            array (
                'id' => 1143,
                'code' => '098303000',
                'name' => 'Diplahan',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098303',
            ),
            143 => 
            array (
                'id' => 1144,
                'code' => '098304000',
                'name' => 'Imelda',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098304',
            ),
            144 => 
            array (
                'id' => 1145,
                'code' => '098305000',
            'name' => 'Ipil (Capital)',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098305',
            ),
            145 => 
            array (
                'id' => 1146,
                'code' => '098306000',
                'name' => 'Kabasalan',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098306',
            ),
            146 => 
            array (
                'id' => 1147,
                'code' => '098307000',
                'name' => 'Mabuhay',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098307',
            ),
            147 => 
            array (
                'id' => 1148,
                'code' => '098308000',
                'name' => 'Malangas',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098308',
            ),
            148 => 
            array (
                'id' => 1149,
                'code' => '098309000',
                'name' => 'Naga',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098309',
            ),
            149 => 
            array (
                'id' => 1150,
                'code' => '098310000',
                'name' => 'Olutanga',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098310',
            ),
            150 => 
            array (
                'id' => 1151,
                'code' => '098311000',
                'name' => 'Payao',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098311',
            ),
            151 => 
            array (
                'id' => 1152,
                'code' => '098312000',
                'name' => 'Roseller Lim',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098312',
            ),
            152 => 
            array (
                'id' => 1153,
                'code' => '098313000',
                'name' => 'Siay',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098313',
            ),
            153 => 
            array (
                'id' => 1154,
                'code' => '098314000',
                'name' => 'Talusan',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098314',
            ),
            154 => 
            array (
                'id' => 1155,
                'code' => '098315000',
                'name' => 'Titay',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098315',
            ),
            155 => 
            array (
                'id' => 1156,
                'code' => '098316000',
                'name' => 'Tungawan',
                'region_id' => '09',
                'province_id' => '0983',
                'city_id' => '098316',
            ),
            156 => 
            array (
                'id' => 1157,
                'code' => '099701000',
                'name' => 'City of Isabela',
                'region_id' => '09',
                'province_id' => '0997',
                'city_id' => '099701',
            ),
            157 => 
            array (
                'id' => 1158,
                'code' => '101301000',
                'name' => 'Baungon',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101301',
            ),
            158 => 
            array (
                'id' => 1159,
                'code' => '101302000',
                'name' => 'Damulog',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101302',
            ),
            159 => 
            array (
                'id' => 1160,
                'code' => '101303000',
                'name' => 'Dangcagan',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101303',
            ),
            160 => 
            array (
                'id' => 1161,
                'code' => '101304000',
                'name' => 'Don Carlos',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101304',
            ),
            161 => 
            array (
                'id' => 1162,
                'code' => '101305000',
                'name' => 'Impasug-ong',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101305',
            ),
            162 => 
            array (
                'id' => 1163,
                'code' => '101306000',
                'name' => 'Kadingilan',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101306',
            ),
            163 => 
            array (
                'id' => 1164,
                'code' => '101307000',
                'name' => 'Kalilangan',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101307',
            ),
            164 => 
            array (
                'id' => 1165,
                'code' => '101308000',
                'name' => 'Kibawe',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101308',
            ),
            165 => 
            array (
                'id' => 1166,
                'code' => '101309000',
                'name' => 'Kitaotao',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101309',
            ),
            166 => 
            array (
                'id' => 1167,
                'code' => '101310000',
                'name' => 'Lantapan',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101310',
            ),
            167 => 
            array (
                'id' => 1168,
                'code' => '101311000',
                'name' => 'Libona',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101311',
            ),
            168 => 
            array (
                'id' => 1169,
                'code' => '101312000',
            'name' => 'City of Malaybalay (Capital)',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101312',
            ),
            169 => 
            array (
                'id' => 1170,
                'code' => '101313000',
                'name' => 'Malitbog',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101313',
            ),
            170 => 
            array (
                'id' => 1171,
                'code' => '101314000',
                'name' => 'Manolo Fortich',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101314',
            ),
            171 => 
            array (
                'id' => 1172,
                'code' => '101315000',
                'name' => 'Maramag',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101315',
            ),
            172 => 
            array (
                'id' => 1173,
                'code' => '101316000',
                'name' => 'Pangantucan',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101316',
            ),
            173 => 
            array (
                'id' => 1174,
                'code' => '101317000',
                'name' => 'Quezon',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101317',
            ),
            174 => 
            array (
                'id' => 1175,
                'code' => '101318000',
                'name' => 'San Fernando',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101318',
            ),
            175 => 
            array (
                'id' => 1176,
                'code' => '101319000',
                'name' => 'Sumilao',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101319',
            ),
            176 => 
            array (
                'id' => 1177,
                'code' => '101320000',
                'name' => 'Talakag',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101320',
            ),
            177 => 
            array (
                'id' => 1178,
                'code' => '101321000',
                'name' => 'City of Valencia',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101321',
            ),
            178 => 
            array (
                'id' => 1179,
                'code' => '101322000',
                'name' => 'Cabanglasan',
                'region_id' => '10',
                'province_id' => '1013',
                'city_id' => '101322',
            ),
            179 => 
            array (
                'id' => 1180,
                'code' => '101801000',
                'name' => 'Catarman',
                'region_id' => '10',
                'province_id' => '1018',
                'city_id' => '101801',
            ),
            180 => 
            array (
                'id' => 1181,
                'code' => '101802000',
                'name' => 'Guinsiliban',
                'region_id' => '10',
                'province_id' => '1018',
                'city_id' => '101802',
            ),
            181 => 
            array (
                'id' => 1182,
                'code' => '101803000',
                'name' => 'Mahinog',
                'region_id' => '10',
                'province_id' => '1018',
                'city_id' => '101803',
            ),
            182 => 
            array (
                'id' => 1183,
                'code' => '101804000',
            'name' => 'Mambajao (Capital)',
                'region_id' => '10',
                'province_id' => '1018',
                'city_id' => '101804',
            ),
            183 => 
            array (
                'id' => 1184,
                'code' => '101805000',
                'name' => 'Sagay',
                'region_id' => '10',
                'province_id' => '1018',
                'city_id' => '101805',
            ),
            184 => 
            array (
                'id' => 1185,
                'code' => '103501000',
                'name' => 'Bacolod',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103501',
            ),
            185 => 
            array (
                'id' => 1186,
                'code' => '103502000',
                'name' => 'Baloi',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103502',
            ),
            186 => 
            array (
                'id' => 1187,
                'code' => '103503000',
                'name' => 'Baroy',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103503',
            ),
            187 => 
            array (
                'id' => 1188,
                'code' => '103504000',
                'name' => 'City of Iligan',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103504',
            ),
            188 => 
            array (
                'id' => 1189,
                'code' => '103505000',
                'name' => 'Kapatagan',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103505',
            ),
            189 => 
            array (
                'id' => 1190,
                'code' => '103506000',
                'name' => 'Sultan Naga Dimaporo',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103506',
            ),
            190 => 
            array (
                'id' => 1191,
                'code' => '103507000',
                'name' => 'Kauswagan',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103507',
            ),
            191 => 
            array (
                'id' => 1192,
                'code' => '103508000',
                'name' => 'Kolambugan',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103508',
            ),
            192 => 
            array (
                'id' => 1193,
                'code' => '103509000',
                'name' => 'Lala',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103509',
            ),
            193 => 
            array (
                'id' => 1194,
                'code' => '103510000',
                'name' => 'Linamon',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103510',
            ),
            194 => 
            array (
                'id' => 1195,
                'code' => '103511000',
                'name' => 'Magsaysay',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103511',
            ),
            195 => 
            array (
                'id' => 1196,
                'code' => '103512000',
                'name' => 'Maigo',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103512',
            ),
            196 => 
            array (
                'id' => 1197,
                'code' => '103513000',
                'name' => 'Matungao',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103513',
            ),
            197 => 
            array (
                'id' => 1198,
                'code' => '103514000',
                'name' => 'Munai',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103514',
            ),
            198 => 
            array (
                'id' => 1199,
                'code' => '103515000',
                'name' => 'Nunungan',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103515',
            ),
            199 => 
            array (
                'id' => 1200,
                'code' => '103516000',
                'name' => 'Pantao Ragat',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103516',
            ),
            200 => 
            array (
                'id' => 1201,
                'code' => '103517000',
                'name' => 'Poona Piagapo',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103517',
            ),
            201 => 
            array (
                'id' => 1202,
                'code' => '103518000',
                'name' => 'Salvador',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103518',
            ),
            202 => 
            array (
                'id' => 1203,
                'code' => '103519000',
                'name' => 'Sapad',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103519',
            ),
            203 => 
            array (
                'id' => 1204,
                'code' => '103520000',
                'name' => 'Tagoloan',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103520',
            ),
            204 => 
            array (
                'id' => 1205,
                'code' => '103521000',
                'name' => 'Tangcal',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103521',
            ),
            205 => 
            array (
                'id' => 1206,
                'code' => '103522000',
            'name' => 'Tubod (Capital)',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103522',
            ),
            206 => 
            array (
                'id' => 1207,
                'code' => '103523000',
                'name' => 'Pantar',
                'region_id' => '10',
                'province_id' => '1035',
                'city_id' => '103523',
            ),
            207 => 
            array (
                'id' => 1208,
                'code' => '104201000',
                'name' => 'Aloran',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104201',
            ),
            208 => 
            array (
                'id' => 1209,
                'code' => '104202000',
                'name' => 'Baliangao',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104202',
            ),
            209 => 
            array (
                'id' => 1210,
                'code' => '104203000',
                'name' => 'Bonifacio',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104203',
            ),
            210 => 
            array (
                'id' => 1211,
                'code' => '104204000',
                'name' => 'Calamba',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104204',
            ),
            211 => 
            array (
                'id' => 1212,
                'code' => '104205000',
                'name' => 'Clarin',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104205',
            ),
            212 => 
            array (
                'id' => 1213,
                'code' => '104206000',
                'name' => 'Concepcion',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104206',
            ),
            213 => 
            array (
                'id' => 1214,
                'code' => '104207000',
                'name' => 'Jimenez',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104207',
            ),
            214 => 
            array (
                'id' => 1215,
                'code' => '104208000',
                'name' => 'Lopez Jaena',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104208',
            ),
            215 => 
            array (
                'id' => 1216,
                'code' => '104209000',
            'name' => 'City of Oroquieta (Capital)',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104209',
            ),
            216 => 
            array (
                'id' => 1217,
                'code' => '104210000',
                'name' => 'City of Ozamiz',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104210',
            ),
            217 => 
            array (
                'id' => 1218,
                'code' => '104211000',
                'name' => 'Panaon',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104211',
            ),
            218 => 
            array (
                'id' => 1219,
                'code' => '104212000',
                'name' => 'Plaridel',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104212',
            ),
            219 => 
            array (
                'id' => 1220,
                'code' => '104213000',
                'name' => 'Sapang Dalaga',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104213',
            ),
            220 => 
            array (
                'id' => 1221,
                'code' => '104214000',
                'name' => 'Sinacaban',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104214',
            ),
            221 => 
            array (
                'id' => 1222,
                'code' => '104215000',
                'name' => 'City of Tangub',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104215',
            ),
            222 => 
            array (
                'id' => 1223,
                'code' => '104216000',
                'name' => 'Tudela',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104216',
            ),
            223 => 
            array (
                'id' => 1224,
                'code' => '104217000',
                'name' => 'Don Victoriano Chiongbian',
                'region_id' => '10',
                'province_id' => '1042',
                'city_id' => '104217',
            ),
            224 => 
            array (
                'id' => 1225,
                'code' => '104301000',
                'name' => 'Alubijid',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104301',
            ),
            225 => 
            array (
                'id' => 1226,
                'code' => '104302000',
                'name' => 'Balingasag',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104302',
            ),
            226 => 
            array (
                'id' => 1227,
                'code' => '104303000',
                'name' => 'Balingoan',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104303',
            ),
            227 => 
            array (
                'id' => 1228,
                'code' => '104304000',
                'name' => 'Binuangan',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104304',
            ),
            228 => 
            array (
                'id' => 1229,
                'code' => '104305000',
            'name' => 'City of Cagayan De Oro (Capital)',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104305',
            ),
            229 => 
            array (
                'id' => 1230,
                'code' => '104306000',
                'name' => 'Claveria',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104306',
            ),
            230 => 
            array (
                'id' => 1231,
                'code' => '104307000',
                'name' => 'City of El Salvador',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104307',
            ),
            231 => 
            array (
                'id' => 1232,
                'code' => '104308000',
                'name' => 'City of Gingoog',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104308',
            ),
            232 => 
            array (
                'id' => 1233,
                'code' => '104309000',
                'name' => 'Gitagum',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104309',
            ),
            233 => 
            array (
                'id' => 1234,
                'code' => '104310000',
                'name' => 'Initao',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104310',
            ),
            234 => 
            array (
                'id' => 1235,
                'code' => '104311000',
                'name' => 'Jasaan',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104311',
            ),
            235 => 
            array (
                'id' => 1236,
                'code' => '104312000',
                'name' => 'Kinoguitan',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104312',
            ),
            236 => 
            array (
                'id' => 1237,
                'code' => '104313000',
                'name' => 'Lagonglong',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104313',
            ),
            237 => 
            array (
                'id' => 1238,
                'code' => '104314000',
                'name' => 'Laguindingan',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104314',
            ),
            238 => 
            array (
                'id' => 1239,
                'code' => '104315000',
                'name' => 'Libertad',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104315',
            ),
            239 => 
            array (
                'id' => 1240,
                'code' => '104316000',
                'name' => 'Lugait',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104316',
            ),
            240 => 
            array (
                'id' => 1241,
                'code' => '104317000',
                'name' => 'Magsaysay',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104317',
            ),
            241 => 
            array (
                'id' => 1242,
                'code' => '104318000',
                'name' => 'Manticao',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104318',
            ),
            242 => 
            array (
                'id' => 1243,
                'code' => '104319000',
                'name' => 'Medina',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104319',
            ),
            243 => 
            array (
                'id' => 1244,
                'code' => '104320000',
                'name' => 'Naawan',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104320',
            ),
            244 => 
            array (
                'id' => 1245,
                'code' => '104321000',
                'name' => 'Opol',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104321',
            ),
            245 => 
            array (
                'id' => 1246,
                'code' => '104322000',
                'name' => 'Salay',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104322',
            ),
            246 => 
            array (
                'id' => 1247,
                'code' => '104323000',
                'name' => 'Sugbongcogon',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104323',
            ),
            247 => 
            array (
                'id' => 1248,
                'code' => '104324000',
                'name' => 'Tagoloan',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104324',
            ),
            248 => 
            array (
                'id' => 1249,
                'code' => '104325000',
                'name' => 'Talisayan',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104325',
            ),
            249 => 
            array (
                'id' => 1250,
                'code' => '104326000',
                'name' => 'Villanueva',
                'region_id' => '10',
                'province_id' => '1043',
                'city_id' => '104326',
            ),
            250 => 
            array (
                'id' => 1251,
                'code' => '112301000',
                'name' => 'Asuncion',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112301',
            ),
            251 => 
            array (
                'id' => 1252,
                'code' => '112303000',
                'name' => 'Carmen',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112303',
            ),
            252 => 
            array (
                'id' => 1253,
                'code' => '112305000',
                'name' => 'Kapalong',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112305',
            ),
            253 => 
            array (
                'id' => 1254,
                'code' => '112314000',
                'name' => 'New Corella',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112314',
            ),
            254 => 
            array (
                'id' => 1255,
                'code' => '112315000',
                'name' => 'City of Panabo',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112315',
            ),
            255 => 
            array (
                'id' => 1256,
                'code' => '112317000',
                'name' => 'Island Garden City of Samal',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112317',
            ),
            256 => 
            array (
                'id' => 1257,
                'code' => '112318000',
                'name' => 'Santo Tomas',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112318',
            ),
            257 => 
            array (
                'id' => 1258,
                'code' => '112319000',
            'name' => 'City of Tagum (Capital)',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112319',
            ),
            258 => 
            array (
                'id' => 1259,
                'code' => '112322000',
                'name' => 'Talaingod',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112322',
            ),
            259 => 
            array (
                'id' => 1260,
                'code' => '112323000',
                'name' => 'Braulio E. Dujali',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112323',
            ),
            260 => 
            array (
                'id' => 1261,
                'code' => '112324000',
                'name' => 'San Isidro',
                'region_id' => '11',
                'province_id' => '1123',
                'city_id' => '112324',
            ),
            261 => 
            array (
                'id' => 1262,
                'code' => '112401000',
                'name' => 'Bansalan',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112401',
            ),
            262 => 
            array (
                'id' => 1263,
                'code' => '112402000',
                'name' => 'City of Davao',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112402',
            ),
            263 => 
            array (
                'id' => 1264,
                'code' => '112403000',
            'name' => 'City of Digos (Capital)',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112403',
            ),
            264 => 
            array (
                'id' => 1265,
                'code' => '112404000',
                'name' => 'Hagonoy',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112404',
            ),
            265 => 
            array (
                'id' => 1266,
                'code' => '112406000',
                'name' => 'Kiblawan',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112406',
            ),
            266 => 
            array (
                'id' => 1267,
                'code' => '112407000',
                'name' => 'Magsaysay',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112407',
            ),
            267 => 
            array (
                'id' => 1268,
                'code' => '112408000',
                'name' => 'Malalag',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112408',
            ),
            268 => 
            array (
                'id' => 1269,
                'code' => '112410000',
                'name' => 'Matanao',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112410',
            ),
            269 => 
            array (
                'id' => 1270,
                'code' => '112411000',
                'name' => 'Padada',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112411',
            ),
            270 => 
            array (
                'id' => 1271,
                'code' => '112412000',
                'name' => 'Santa Cruz',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112412',
            ),
            271 => 
            array (
                'id' => 1272,
                'code' => '112414000',
                'name' => 'Sulop',
                'region_id' => '11',
                'province_id' => '1124',
                'city_id' => '112414',
            ),
            272 => 
            array (
                'id' => 1273,
                'code' => '112501000',
                'name' => 'Baganga',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112501',
            ),
            273 => 
            array (
                'id' => 1274,
                'code' => '112502000',
                'name' => 'Banaybanay',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112502',
            ),
            274 => 
            array (
                'id' => 1275,
                'code' => '112503000',
                'name' => 'Boston',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112503',
            ),
            275 => 
            array (
                'id' => 1276,
                'code' => '112504000',
                'name' => 'Caraga',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112504',
            ),
            276 => 
            array (
                'id' => 1277,
                'code' => '112505000',
                'name' => 'Cateel',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112505',
            ),
            277 => 
            array (
                'id' => 1278,
                'code' => '112506000',
                'name' => 'Governor Generoso',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112506',
            ),
            278 => 
            array (
                'id' => 1279,
                'code' => '112507000',
                'name' => 'Lupon',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112507',
            ),
            279 => 
            array (
                'id' => 1280,
                'code' => '112508000',
                'name' => 'Manay',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112508',
            ),
            280 => 
            array (
                'id' => 1281,
                'code' => '112509000',
            'name' => 'City of Mati (Capital)',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112509',
            ),
            281 => 
            array (
                'id' => 1282,
                'code' => '112510000',
                'name' => 'San Isidro',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112510',
            ),
            282 => 
            array (
                'id' => 1283,
                'code' => '112511000',
                'name' => 'Tarragona',
                'region_id' => '11',
                'province_id' => '1125',
                'city_id' => '112511',
            ),
            283 => 
            array (
                'id' => 1284,
                'code' => '118201000',
                'name' => 'Compostela',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118201',
            ),
            284 => 
            array (
                'id' => 1285,
                'code' => '118202000',
                'name' => 'Laak',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118202',
            ),
            285 => 
            array (
                'id' => 1286,
                'code' => '118203000',
                'name' => 'Mabini',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118203',
            ),
            286 => 
            array (
                'id' => 1287,
                'code' => '118204000',
                'name' => 'Maco',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118204',
            ),
            287 => 
            array (
                'id' => 1288,
                'code' => '118205000',
                'name' => 'Maragusan',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118205',
            ),
            288 => 
            array (
                'id' => 1289,
                'code' => '118206000',
                'name' => 'Mawab',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118206',
            ),
            289 => 
            array (
                'id' => 1290,
                'code' => '118207000',
                'name' => 'Monkayo',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118207',
            ),
            290 => 
            array (
                'id' => 1291,
                'code' => '118208000',
                'name' => 'Montevista',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118208',
            ),
            291 => 
            array (
                'id' => 1292,
                'code' => '118209000',
            'name' => 'Nabunturan (Capital)',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118209',
            ),
            292 => 
            array (
                'id' => 1293,
                'code' => '118210000',
                'name' => 'New Bataan',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118210',
            ),
            293 => 
            array (
                'id' => 1294,
                'code' => '118211000',
                'name' => 'Pantukan',
                'region_id' => '11',
                'province_id' => '1182',
                'city_id' => '118211',
            ),
            294 => 
            array (
                'id' => 1295,
                'code' => '118601000',
                'name' => 'Don Marcelino',
                'region_id' => '11',
                'province_id' => '1186',
                'city_id' => '118601',
            ),
            295 => 
            array (
                'id' => 1296,
                'code' => '118602000',
                'name' => 'Jose Abad Santos',
                'region_id' => '11',
                'province_id' => '1186',
                'city_id' => '118602',
            ),
            296 => 
            array (
                'id' => 1297,
                'code' => '118603000',
            'name' => 'Malita (Capital)',
                'region_id' => '11',
                'province_id' => '1186',
                'city_id' => '118603',
            ),
            297 => 
            array (
                'id' => 1298,
                'code' => '118604000',
                'name' => 'Santa Maria',
                'region_id' => '11',
                'province_id' => '1186',
                'city_id' => '118604',
            ),
            298 => 
            array (
                'id' => 1299,
                'code' => '118605000',
                'name' => 'Sarangani',
                'region_id' => '11',
                'province_id' => '1186',
                'city_id' => '118605',
            ),
            299 => 
            array (
                'id' => 1300,
                'code' => '124701000',
                'name' => 'Alamada',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124701',
            ),
            300 => 
            array (
                'id' => 1301,
                'code' => '124702000',
                'name' => 'Carmen',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124702',
            ),
            301 => 
            array (
                'id' => 1302,
                'code' => '124703000',
                'name' => 'Kabacan',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124703',
            ),
            302 => 
            array (
                'id' => 1303,
                'code' => '124704000',
            'name' => 'City of Kidapawan (Capital)',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124704',
            ),
            303 => 
            array (
                'id' => 1304,
                'code' => '124705000',
                'name' => 'Libungan',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124705',
            ),
            304 => 
            array (
                'id' => 1305,
                'code' => '124706000',
                'name' => 'Magpet',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124706',
            ),
            305 => 
            array (
                'id' => 1306,
                'code' => '124707000',
                'name' => 'Makilala',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124707',
            ),
            306 => 
            array (
                'id' => 1307,
                'code' => '124708000',
                'name' => 'Matalam',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124708',
            ),
            307 => 
            array (
                'id' => 1308,
                'code' => '124709000',
                'name' => 'Midsayap',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124709',
            ),
            308 => 
            array (
                'id' => 1309,
                'code' => '124710000',
                'name' => 'M\'Lang',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124710',
            ),
            309 => 
            array (
                'id' => 1310,
                'code' => '124711000',
                'name' => 'Pigkawayan',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124711',
            ),
            310 => 
            array (
                'id' => 1311,
                'code' => '124712000',
                'name' => 'Pikit',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124712',
            ),
            311 => 
            array (
                'id' => 1312,
                'code' => '124713000',
                'name' => 'President Roxas',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124713',
            ),
            312 => 
            array (
                'id' => 1313,
                'code' => '124714000',
                'name' => 'Tulunan',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124714',
            ),
            313 => 
            array (
                'id' => 1314,
                'code' => '124715000',
                'name' => 'Antipas',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124715',
            ),
            314 => 
            array (
                'id' => 1315,
                'code' => '124716000',
                'name' => 'Banisilan',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124716',
            ),
            315 => 
            array (
                'id' => 1316,
                'code' => '124717000',
                'name' => 'Aleosan',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124717',
            ),
            316 => 
            array (
                'id' => 1317,
                'code' => '124718000',
                'name' => 'Arakan',
                'region_id' => '12',
                'province_id' => '1247',
                'city_id' => '124718',
            ),
            317 => 
            array (
                'id' => 1318,
                'code' => '126302000',
                'name' => 'Banga',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126302',
            ),
            318 => 
            array (
                'id' => 1319,
                'code' => '126303000',
                'name' => 'City of General Santos',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126303',
            ),
            319 => 
            array (
                'id' => 1320,
                'code' => '126306000',
            'name' => 'City of Koronadal (Capital)',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126306',
            ),
            320 => 
            array (
                'id' => 1321,
                'code' => '126311000',
                'name' => 'Norala',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126311',
            ),
            321 => 
            array (
                'id' => 1322,
                'code' => '126312000',
                'name' => 'Polomolok',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126312',
            ),
            322 => 
            array (
                'id' => 1323,
                'code' => '126313000',
                'name' => 'Surallah',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126313',
            ),
            323 => 
            array (
                'id' => 1324,
                'code' => '126314000',
                'name' => 'Tampakan',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126314',
            ),
            324 => 
            array (
                'id' => 1325,
                'code' => '126315000',
                'name' => 'Tantangan',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126315',
            ),
            325 => 
            array (
                'id' => 1326,
                'code' => '126316000',
                'name' => 'T\'Boli',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126316',
            ),
            326 => 
            array (
                'id' => 1327,
                'code' => '126317000',
                'name' => 'Tupi',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126317',
            ),
            327 => 
            array (
                'id' => 1328,
                'code' => '126318000',
                'name' => 'Santo Niño',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126318',
            ),
            328 => 
            array (
                'id' => 1329,
                'code' => '126319000',
                'name' => 'Lake Sebu',
                'region_id' => '12',
                'province_id' => '1263',
                'city_id' => '126319',
            ),
            329 => 
            array (
                'id' => 1330,
                'code' => '126501000',
                'name' => 'Bagumbayan',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126501',
            ),
            330 => 
            array (
                'id' => 1331,
                'code' => '126502000',
                'name' => 'Columbio',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126502',
            ),
            331 => 
            array (
                'id' => 1332,
                'code' => '126503000',
                'name' => 'Esperanza',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126503',
            ),
            332 => 
            array (
                'id' => 1333,
                'code' => '126504000',
            'name' => 'Isulan (Capital)',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126504',
            ),
            333 => 
            array (
                'id' => 1334,
                'code' => '126505000',
                'name' => 'Kalamansig',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126505',
            ),
            334 => 
            array (
                'id' => 1335,
                'code' => '126506000',
                'name' => 'Lebak',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126506',
            ),
            335 => 
            array (
                'id' => 1336,
                'code' => '126507000',
                'name' => 'Lutayan',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126507',
            ),
            336 => 
            array (
                'id' => 1337,
                'code' => '126508000',
                'name' => 'Lambayong',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126508',
            ),
            337 => 
            array (
                'id' => 1338,
                'code' => '126509000',
                'name' => 'Palimbang',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126509',
            ),
            338 => 
            array (
                'id' => 1339,
                'code' => '126510000',
                'name' => 'President Quirino',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126510',
            ),
            339 => 
            array (
                'id' => 1340,
                'code' => '126511000',
                'name' => 'City of Tacurong',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126511',
            ),
            340 => 
            array (
                'id' => 1341,
                'code' => '126512000',
                'name' => 'Sen. Ninoy Aquino',
                'region_id' => '12',
                'province_id' => '1265',
                'city_id' => '126512',
            ),
            341 => 
            array (
                'id' => 1342,
                'code' => '128001000',
            'name' => 'Alabel (Capital)',
                'region_id' => '12',
                'province_id' => '1280',
                'city_id' => '128001',
            ),
            342 => 
            array (
                'id' => 1343,
                'code' => '128002000',
                'name' => 'Glan',
                'region_id' => '12',
                'province_id' => '1280',
                'city_id' => '128002',
            ),
            343 => 
            array (
                'id' => 1344,
                'code' => '128003000',
                'name' => 'Kiamba',
                'region_id' => '12',
                'province_id' => '1280',
                'city_id' => '128003',
            ),
            344 => 
            array (
                'id' => 1345,
                'code' => '128004000',
                'name' => 'Maasim',
                'region_id' => '12',
                'province_id' => '1280',
                'city_id' => '128004',
            ),
            345 => 
            array (
                'id' => 1346,
                'code' => '128005000',
                'name' => 'Maitum',
                'region_id' => '12',
                'province_id' => '1280',
                'city_id' => '128005',
            ),
            346 => 
            array (
                'id' => 1347,
                'code' => '128006000',
                'name' => 'Malapatan',
                'region_id' => '12',
                'province_id' => '1280',
                'city_id' => '128006',
            ),
            347 => 
            array (
                'id' => 1348,
                'code' => '128007000',
                'name' => 'Malungon',
                'region_id' => '12',
                'province_id' => '1280',
                'city_id' => '128007',
            ),
            348 => 
            array (
                'id' => 1349,
                'code' => '129804000',
                'name' => 'City of Cotabato',
                'region_id' => '12',
                'province_id' => '1298',
                'city_id' => '129804',
            ),
            349 => 
            array (
                'id' => 1350,
                'code' => '133900000',
                'name' => 'City of Manila',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133900',
            ),
            350 => 
            array (
                'id' => 1351,
                'code' => '133901000',
                'name' => 'Tondo I/II',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133901',
            ),
            351 => 
            array (
                'id' => 1352,
                'code' => '133902000',
                'name' => 'Binondo',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133902',
            ),
            352 => 
            array (
                'id' => 1353,
                'code' => '133903000',
                'name' => 'Quiapo',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133903',
            ),
            353 => 
            array (
                'id' => 1354,
                'code' => '133904000',
                'name' => 'San Nicolas',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133904',
            ),
            354 => 
            array (
                'id' => 1355,
                'code' => '133905000',
                'name' => 'Santa Cruz',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133905',
            ),
            355 => 
            array (
                'id' => 1356,
                'code' => '133906000',
                'name' => 'Sampaloc',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133906',
            ),
            356 => 
            array (
                'id' => 1357,
                'code' => '133907000',
                'name' => 'San Miguel',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133907',
            ),
            357 => 
            array (
                'id' => 1358,
                'code' => '133908000',
                'name' => 'Ermita',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133908',
            ),
            358 => 
            array (
                'id' => 1359,
                'code' => '133909000',
                'name' => 'Intramuros',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133909',
            ),
            359 => 
            array (
                'id' => 1360,
                'code' => '133910000',
                'name' => 'Malate',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133910',
            ),
            360 => 
            array (
                'id' => 1361,
                'code' => '133911000',
                'name' => 'Paco',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133911',
            ),
            361 => 
            array (
                'id' => 1362,
                'code' => '133912000',
                'name' => 'Pandacan',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133912',
            ),
            362 => 
            array (
                'id' => 1363,
                'code' => '133913000',
                'name' => 'Port Area',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133913',
            ),
            363 => 
            array (
                'id' => 1364,
                'code' => '133914000',
                'name' => 'Santa Ana',
                'region_id' => '13',
                'province_id' => '1339',
                'city_id' => '133914',
            ),
            364 => 
            array (
                'id' => 1365,
                'code' => '137401000',
                'name' => 'City of Mandaluyong',
                'region_id' => '13',
                'province_id' => '1374',
                'city_id' => '137401',
            ),
            365 => 
            array (
                'id' => 1366,
                'code' => '137402000',
                'name' => 'City of Marikina',
                'region_id' => '13',
                'province_id' => '1374',
                'city_id' => '137402',
            ),
            366 => 
            array (
                'id' => 1367,
                'code' => '137403000',
                'name' => 'City of Pasig',
                'region_id' => '13',
                'province_id' => '1374',
                'city_id' => '137403',
            ),
            367 => 
            array (
                'id' => 1368,
                'code' => '137404000',
                'name' => 'Quezon City',
                'region_id' => '13',
                'province_id' => '1374',
                'city_id' => '137404',
            ),
            368 => 
            array (
                'id' => 1369,
                'code' => '137405000',
                'name' => 'City of San Juan',
                'region_id' => '13',
                'province_id' => '1374',
                'city_id' => '137405',
            ),
            369 => 
            array (
                'id' => 1370,
                'code' => '137501000',
                'name' => 'City of Caloocan',
                'region_id' => '13',
                'province_id' => '1375',
                'city_id' => '137501',
            ),
            370 => 
            array (
                'id' => 1371,
                'code' => '137502000',
                'name' => 'City of Malabon',
                'region_id' => '13',
                'province_id' => '1375',
                'city_id' => '137502',
            ),
            371 => 
            array (
                'id' => 1372,
                'code' => '137503000',
                'name' => 'City of Navotas',
                'region_id' => '13',
                'province_id' => '1375',
                'city_id' => '137503',
            ),
            372 => 
            array (
                'id' => 1373,
                'code' => '137504000',
                'name' => 'City of Valenzuela',
                'region_id' => '13',
                'province_id' => '1375',
                'city_id' => '137504',
            ),
            373 => 
            array (
                'id' => 1374,
                'code' => '137601000',
                'name' => 'City of Las Piñas',
                'region_id' => '13',
                'province_id' => '1376',
                'city_id' => '137601',
            ),
            374 => 
            array (
                'id' => 1375,
                'code' => '137602000',
                'name' => 'City of Makati',
                'region_id' => '13',
                'province_id' => '1376',
                'city_id' => '137602',
            ),
            375 => 
            array (
                'id' => 1376,
                'code' => '137603000',
                'name' => 'City of Muntinlupa',
                'region_id' => '13',
                'province_id' => '1376',
                'city_id' => '137603',
            ),
            376 => 
            array (
                'id' => 1377,
                'code' => '137604000',
                'name' => 'City of Parañaque',
                'region_id' => '13',
                'province_id' => '1376',
                'city_id' => '137604',
            ),
            377 => 
            array (
                'id' => 1378,
                'code' => '137605000',
                'name' => 'Pasay City',
                'region_id' => '13',
                'province_id' => '1376',
                'city_id' => '137605',
            ),
            378 => 
            array (
                'id' => 1379,
                'code' => '137606000',
                'name' => 'Pateros',
                'region_id' => '13',
                'province_id' => '1376',
                'city_id' => '137606',
            ),
            379 => 
            array (
                'id' => 1380,
                'code' => '137607000',
                'name' => 'City of Taguig',
                'region_id' => '13',
                'province_id' => '1376',
                'city_id' => '137607',
            ),
            380 => 
            array (
                'id' => 1381,
                'code' => '140101000',
            'name' => 'Bangued (Capital)',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140101',
            ),
            381 => 
            array (
                'id' => 1382,
                'code' => '140102000',
                'name' => 'Boliney',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140102',
            ),
            382 => 
            array (
                'id' => 1383,
                'code' => '140103000',
                'name' => 'Bucay',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140103',
            ),
            383 => 
            array (
                'id' => 1384,
                'code' => '140104000',
                'name' => 'Bucloc',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140104',
            ),
            384 => 
            array (
                'id' => 1385,
                'code' => '140105000',
                'name' => 'Daguioman',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140105',
            ),
            385 => 
            array (
                'id' => 1386,
                'code' => '140106000',
                'name' => 'Danglas',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140106',
            ),
            386 => 
            array (
                'id' => 1387,
                'code' => '140107000',
                'name' => 'Dolores',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140107',
            ),
            387 => 
            array (
                'id' => 1388,
                'code' => '140108000',
                'name' => 'La Paz',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140108',
            ),
            388 => 
            array (
                'id' => 1389,
                'code' => '140109000',
                'name' => 'Lacub',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140109',
            ),
            389 => 
            array (
                'id' => 1390,
                'code' => '140110000',
                'name' => 'Lagangilang',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140110',
            ),
            390 => 
            array (
                'id' => 1391,
                'code' => '140111000',
                'name' => 'Lagayan',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140111',
            ),
            391 => 
            array (
                'id' => 1392,
                'code' => '140112000',
                'name' => 'Langiden',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140112',
            ),
            392 => 
            array (
                'id' => 1393,
                'code' => '140113000',
                'name' => 'Licuan-Baay',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140113',
            ),
            393 => 
            array (
                'id' => 1394,
                'code' => '140114000',
                'name' => 'Luba',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140114',
            ),
            394 => 
            array (
                'id' => 1395,
                'code' => '140115000',
                'name' => 'Malibcong',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140115',
            ),
            395 => 
            array (
                'id' => 1396,
                'code' => '140116000',
                'name' => 'Manabo',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140116',
            ),
            396 => 
            array (
                'id' => 1397,
                'code' => '140117000',
                'name' => 'Peñarrubia',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140117',
            ),
            397 => 
            array (
                'id' => 1398,
                'code' => '140118000',
                'name' => 'Pidigan',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140118',
            ),
            398 => 
            array (
                'id' => 1399,
                'code' => '140119000',
                'name' => 'Pilar',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140119',
            ),
            399 => 
            array (
                'id' => 1400,
                'code' => '140120000',
                'name' => 'Sallapadan',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140120',
            ),
            400 => 
            array (
                'id' => 1401,
                'code' => '140121000',
                'name' => 'San Isidro',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140121',
            ),
            401 => 
            array (
                'id' => 1402,
                'code' => '140122000',
                'name' => 'San Juan',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140122',
            ),
            402 => 
            array (
                'id' => 1403,
                'code' => '140123000',
                'name' => 'San Quintin',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140123',
            ),
            403 => 
            array (
                'id' => 1404,
                'code' => '140124000',
                'name' => 'Tayum',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140124',
            ),
            404 => 
            array (
                'id' => 1405,
                'code' => '140125000',
                'name' => 'Tineg',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140125',
            ),
            405 => 
            array (
                'id' => 1406,
                'code' => '140126000',
                'name' => 'Tubo',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140126',
            ),
            406 => 
            array (
                'id' => 1407,
                'code' => '140127000',
                'name' => 'Villaviciosa',
                'region_id' => '14',
                'province_id' => '1401',
                'city_id' => '140127',
            ),
            407 => 
            array (
                'id' => 1408,
                'code' => '141101000',
                'name' => 'Atok',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141101',
            ),
            408 => 
            array (
                'id' => 1409,
                'code' => '141102000',
                'name' => 'City of Baguio',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141102',
            ),
            409 => 
            array (
                'id' => 1410,
                'code' => '141103000',
                'name' => 'Bakun',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141103',
            ),
            410 => 
            array (
                'id' => 1411,
                'code' => '141104000',
                'name' => 'Bokod',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141104',
            ),
            411 => 
            array (
                'id' => 1412,
                'code' => '141105000',
                'name' => 'Buguias',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141105',
            ),
            412 => 
            array (
                'id' => 1413,
                'code' => '141106000',
                'name' => 'Itogon',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141106',
            ),
            413 => 
            array (
                'id' => 1414,
                'code' => '141107000',
                'name' => 'Kabayan',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141107',
            ),
            414 => 
            array (
                'id' => 1415,
                'code' => '141108000',
                'name' => 'Kapangan',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141108',
            ),
            415 => 
            array (
                'id' => 1416,
                'code' => '141109000',
                'name' => 'Kibungan',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141109',
            ),
            416 => 
            array (
                'id' => 1417,
                'code' => '141110000',
            'name' => 'La Trinidad (Capital)',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141110',
            ),
            417 => 
            array (
                'id' => 1418,
                'code' => '141111000',
                'name' => 'Mankayan',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141111',
            ),
            418 => 
            array (
                'id' => 1419,
                'code' => '141112000',
                'name' => 'Sablan',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141112',
            ),
            419 => 
            array (
                'id' => 1420,
                'code' => '141113000',
                'name' => 'Tuba',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141113',
            ),
            420 => 
            array (
                'id' => 1421,
                'code' => '141114000',
                'name' => 'Tublay',
                'region_id' => '14',
                'province_id' => '1411',
                'city_id' => '141114',
            ),
            421 => 
            array (
                'id' => 1422,
                'code' => '142701000',
                'name' => 'Banaue',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142701',
            ),
            422 => 
            array (
                'id' => 1423,
                'code' => '142702000',
                'name' => 'Hungduan',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142702',
            ),
            423 => 
            array (
                'id' => 1424,
                'code' => '142703000',
                'name' => 'Kiangan',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142703',
            ),
            424 => 
            array (
                'id' => 1425,
                'code' => '142704000',
            'name' => 'Lagawe (Capital)',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142704',
            ),
            425 => 
            array (
                'id' => 1426,
                'code' => '142705000',
                'name' => 'Lamut',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142705',
            ),
            426 => 
            array (
                'id' => 1427,
                'code' => '142706000',
                'name' => 'Mayoyao',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142706',
            ),
            427 => 
            array (
                'id' => 1428,
                'code' => '142707000',
                'name' => 'Alfonso Lista',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142707',
            ),
            428 => 
            array (
                'id' => 1429,
                'code' => '142708000',
                'name' => 'Aguinaldo',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142708',
            ),
            429 => 
            array (
                'id' => 1430,
                'code' => '142709000',
                'name' => 'Hingyon',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142709',
            ),
            430 => 
            array (
                'id' => 1431,
                'code' => '142710000',
                'name' => 'Tinoc',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142710',
            ),
            431 => 
            array (
                'id' => 1432,
                'code' => '142711000',
                'name' => 'Asipulo',
                'region_id' => '14',
                'province_id' => '1427',
                'city_id' => '142711',
            ),
            432 => 
            array (
                'id' => 1433,
                'code' => '143201000',
                'name' => 'Balbalan',
                'region_id' => '14',
                'province_id' => '1432',
                'city_id' => '143201',
            ),
            433 => 
            array (
                'id' => 1434,
                'code' => '143206000',
                'name' => 'Lubuagan',
                'region_id' => '14',
                'province_id' => '1432',
                'city_id' => '143206',
            ),
            434 => 
            array (
                'id' => 1435,
                'code' => '143208000',
                'name' => 'Pasil',
                'region_id' => '14',
                'province_id' => '1432',
                'city_id' => '143208',
            ),
            435 => 
            array (
                'id' => 1436,
                'code' => '143209000',
                'name' => 'Pinukpuk',
                'region_id' => '14',
                'province_id' => '1432',
                'city_id' => '143209',
            ),
            436 => 
            array (
                'id' => 1437,
                'code' => '143211000',
                'name' => 'Rizal',
                'region_id' => '14',
                'province_id' => '1432',
                'city_id' => '143211',
            ),
            437 => 
            array (
                'id' => 1438,
                'code' => '143213000',
            'name' => 'City of Tabuk (Capital)',
                'region_id' => '14',
                'province_id' => '1432',
                'city_id' => '143213',
            ),
            438 => 
            array (
                'id' => 1439,
                'code' => '143214000',
                'name' => 'Tanudan',
                'region_id' => '14',
                'province_id' => '1432',
                'city_id' => '143214',
            ),
            439 => 
            array (
                'id' => 1440,
                'code' => '143215000',
                'name' => 'Tinglayan',
                'region_id' => '14',
                'province_id' => '1432',
                'city_id' => '143215',
            ),
            440 => 
            array (
                'id' => 1441,
                'code' => '144401000',
                'name' => 'Barlig',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144401',
            ),
            441 => 
            array (
                'id' => 1442,
                'code' => '144402000',
                'name' => 'Bauko',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144402',
            ),
            442 => 
            array (
                'id' => 1443,
                'code' => '144403000',
                'name' => 'Besao',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144403',
            ),
            443 => 
            array (
                'id' => 1444,
                'code' => '144404000',
            'name' => 'Bontoc (Capital)',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144404',
            ),
            444 => 
            array (
                'id' => 1445,
                'code' => '144405000',
                'name' => 'Natonin',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144405',
            ),
            445 => 
            array (
                'id' => 1446,
                'code' => '144406000',
                'name' => 'Paracelis',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144406',
            ),
            446 => 
            array (
                'id' => 1447,
                'code' => '144407000',
                'name' => 'Sabangan',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144407',
            ),
            447 => 
            array (
                'id' => 1448,
                'code' => '144408000',
                'name' => 'Sadanga',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144408',
            ),
            448 => 
            array (
                'id' => 1449,
                'code' => '144409000',
                'name' => 'Sagada',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144409',
            ),
            449 => 
            array (
                'id' => 1450,
                'code' => '144410000',
                'name' => 'Tadian',
                'region_id' => '14',
                'province_id' => '1444',
                'city_id' => '144410',
            ),
            450 => 
            array (
                'id' => 1451,
                'code' => '148101000',
                'name' => 'Calanasan',
                'region_id' => '14',
                'province_id' => '1481',
                'city_id' => '148101',
            ),
            451 => 
            array (
                'id' => 1452,
                'code' => '148102000',
                'name' => 'Conner',
                'region_id' => '14',
                'province_id' => '1481',
                'city_id' => '148102',
            ),
            452 => 
            array (
                'id' => 1453,
                'code' => '148103000',
                'name' => 'Flora',
                'region_id' => '14',
                'province_id' => '1481',
                'city_id' => '148103',
            ),
            453 => 
            array (
                'id' => 1454,
                'code' => '148104000',
            'name' => 'Kabugao (Capital)',
                'region_id' => '14',
                'province_id' => '1481',
                'city_id' => '148104',
            ),
            454 => 
            array (
                'id' => 1455,
                'code' => '148105000',
                'name' => 'Luna',
                'region_id' => '14',
                'province_id' => '1481',
                'city_id' => '148105',
            ),
            455 => 
            array (
                'id' => 1456,
                'code' => '148106000',
                'name' => 'Pudtol',
                'region_id' => '14',
                'province_id' => '1481',
                'city_id' => '148106',
            ),
            456 => 
            array (
                'id' => 1457,
                'code' => '148107000',
                'name' => 'Santa Marcela',
                'region_id' => '14',
                'province_id' => '1481',
                'city_id' => '148107',
            ),
            457 => 
            array (
                'id' => 1458,
                'code' => '150702000',
            'name' => 'City of Lamitan (Capital)',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150702',
            ),
            458 => 
            array (
                'id' => 1459,
                'code' => '150703000',
                'name' => 'Lantawan',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150703',
            ),
            459 => 
            array (
                'id' => 1460,
                'code' => '150704000',
                'name' => 'Maluso',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150704',
            ),
            460 => 
            array (
                'id' => 1461,
                'code' => '150705000',
                'name' => 'Sumisip',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150705',
            ),
            461 => 
            array (
                'id' => 1462,
                'code' => '150706000',
                'name' => 'Tipo-Tipo',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150706',
            ),
            462 => 
            array (
                'id' => 1463,
                'code' => '150707000',
                'name' => 'Tuburan',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150707',
            ),
            463 => 
            array (
                'id' => 1464,
                'code' => '150708000',
                'name' => 'Akbar',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150708',
            ),
            464 => 
            array (
                'id' => 1465,
                'code' => '150709000',
                'name' => 'Al-Barka',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150709',
            ),
            465 => 
            array (
                'id' => 1466,
                'code' => '150710000',
                'name' => 'Hadji Mohammad Ajul',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150710',
            ),
            466 => 
            array (
                'id' => 1467,
                'code' => '150711000',
                'name' => 'Ungkaya Pukan',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150711',
            ),
            467 => 
            array (
                'id' => 1468,
                'code' => '150712000',
                'name' => 'Hadji Muhtamad',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150712',
            ),
            468 => 
            array (
                'id' => 1469,
                'code' => '150713000',
                'name' => 'Tabuan-Lasa',
                'region_id' => '15',
                'province_id' => '1507',
                'city_id' => '150713',
            ),
            469 => 
            array (
                'id' => 1470,
                'code' => '153601000',
                'name' => 'Bacolod-Kalawi',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153601',
            ),
            470 => 
            array (
                'id' => 1471,
                'code' => '153602000',
                'name' => 'Balabagan',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153602',
            ),
            471 => 
            array (
                'id' => 1472,
                'code' => '153603000',
                'name' => 'Balindong',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153603',
            ),
            472 => 
            array (
                'id' => 1473,
                'code' => '153604000',
                'name' => 'Bayang',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153604',
            ),
            473 => 
            array (
                'id' => 1474,
                'code' => '153605000',
                'name' => 'Binidayan',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153605',
            ),
            474 => 
            array (
                'id' => 1475,
                'code' => '153606000',
                'name' => 'Bubong',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153606',
            ),
            475 => 
            array (
                'id' => 1476,
                'code' => '153607000',
                'name' => 'Butig',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153607',
            ),
            476 => 
            array (
                'id' => 1477,
                'code' => '153609000',
                'name' => 'Ganassi',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153609',
            ),
            477 => 
            array (
                'id' => 1478,
                'code' => '153610000',
                'name' => 'Kapai',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153610',
            ),
            478 => 
            array (
                'id' => 1479,
                'code' => '153611000',
                'name' => 'Lumba-Bayabao',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153611',
            ),
            479 => 
            array (
                'id' => 1480,
                'code' => '153612000',
                'name' => 'Lumbatan',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153612',
            ),
            480 => 
            array (
                'id' => 1481,
                'code' => '153613000',
                'name' => 'Madalum',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153613',
            ),
            481 => 
            array (
                'id' => 1482,
                'code' => '153614000',
                'name' => 'Madamba',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153614',
            ),
            482 => 
            array (
                'id' => 1483,
                'code' => '153615000',
                'name' => 'Malabang',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153615',
            ),
            483 => 
            array (
                'id' => 1484,
                'code' => '153616000',
                'name' => 'Marantao',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153616',
            ),
            484 => 
            array (
                'id' => 1485,
                'code' => '153617000',
            'name' => 'City of Marawi (Capital)',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153617',
            ),
            485 => 
            array (
                'id' => 1486,
                'code' => '153618000',
                'name' => 'Masiu',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153618',
            ),
            486 => 
            array (
                'id' => 1487,
                'code' => '153619000',
                'name' => 'Mulondo',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153619',
            ),
            487 => 
            array (
                'id' => 1488,
                'code' => '153620000',
                'name' => 'Pagayawan',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153620',
            ),
            488 => 
            array (
                'id' => 1489,
                'code' => '153621000',
                'name' => 'Piagapo',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153621',
            ),
            489 => 
            array (
                'id' => 1490,
                'code' => '153622000',
                'name' => 'Poona Bayabao',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153622',
            ),
            490 => 
            array (
                'id' => 1491,
                'code' => '153623000',
                'name' => 'Pualas',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153623',
            ),
            491 => 
            array (
                'id' => 1492,
                'code' => '153624000',
                'name' => 'Ditsaan-Ramain',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153624',
            ),
            492 => 
            array (
                'id' => 1493,
                'code' => '153625000',
                'name' => 'Saguiaran',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153625',
            ),
            493 => 
            array (
                'id' => 1494,
                'code' => '153626000',
                'name' => 'Tamparan',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153626',
            ),
            494 => 
            array (
                'id' => 1495,
                'code' => '153627000',
                'name' => 'Taraka',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153627',
            ),
            495 => 
            array (
                'id' => 1496,
                'code' => '153628000',
                'name' => 'Tubaran',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153628',
            ),
            496 => 
            array (
                'id' => 1497,
                'code' => '153629000',
                'name' => 'Tugaya',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153629',
            ),
            497 => 
            array (
                'id' => 1498,
                'code' => '153630000',
                'name' => 'Wao',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153630',
            ),
            498 => 
            array (
                'id' => 1499,
                'code' => '153631000',
                'name' => 'Marogong',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153631',
            ),
            499 => 
            array (
                'id' => 1500,
                'code' => '153632000',
                'name' => 'Calanogas',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153632',
            ),
        ));
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1501,
                'code' => '153633000',
                'name' => 'Buadiposo-Buntong',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153633',
            ),
            1 => 
            array (
                'id' => 1502,
                'code' => '153634000',
                'name' => 'Maguing',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153634',
            ),
            2 => 
            array (
                'id' => 1503,
                'code' => '153635000',
                'name' => 'Picong',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153635',
            ),
            3 => 
            array (
                'id' => 1504,
                'code' => '153636000',
                'name' => 'Lumbayanague',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153636',
            ),
            4 => 
            array (
                'id' => 1505,
                'code' => '153637000',
                'name' => 'Amai Manabilang',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153637',
            ),
            5 => 
            array (
                'id' => 1506,
                'code' => '153638000',
                'name' => 'Tagoloan Ii',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153638',
            ),
            6 => 
            array (
                'id' => 1507,
                'code' => '153639000',
                'name' => 'Kapatagan',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153639',
            ),
            7 => 
            array (
                'id' => 1508,
                'code' => '153640000',
                'name' => 'Sultan Dumalondong',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153640',
            ),
            8 => 
            array (
                'id' => 1509,
                'code' => '153641000',
                'name' => 'Lumbaca-Unayan',
                'region_id' => '15',
                'province_id' => '1536',
                'city_id' => '153641',
            ),
            9 => 
            array (
                'id' => 1510,
                'code' => '153801000',
                'name' => 'Ampatuan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153801',
            ),
            10 => 
            array (
                'id' => 1511,
                'code' => '153802000',
                'name' => 'Buldon',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153802',
            ),
            11 => 
            array (
                'id' => 1512,
                'code' => '153803000',
                'name' => 'Buluan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153803',
            ),
            12 => 
            array (
                'id' => 1513,
                'code' => '153805000',
                'name' => 'Datu Paglas',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153805',
            ),
            13 => 
            array (
                'id' => 1514,
                'code' => '153806000',
                'name' => 'Datu Piang',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153806',
            ),
            14 => 
            array (
                'id' => 1515,
                'code' => '153807000',
                'name' => 'Datu Odin Sinsuat',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153807',
            ),
            15 => 
            array (
                'id' => 1516,
                'code' => '153808000',
            'name' => 'Shariff Aguak (Capital)',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153808',
            ),
            16 => 
            array (
                'id' => 1517,
                'code' => '153809000',
                'name' => 'Matanog',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153809',
            ),
            17 => 
            array (
                'id' => 1518,
                'code' => '153810000',
                'name' => 'Pagalungan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153810',
            ),
            18 => 
            array (
                'id' => 1519,
                'code' => '153811000',
                'name' => 'Parang',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153811',
            ),
            19 => 
            array (
                'id' => 1520,
                'code' => '153812000',
                'name' => 'Sultan Kudarat',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153812',
            ),
            20 => 
            array (
                'id' => 1521,
                'code' => '153813000',
                'name' => 'Sultan Sa Barongis',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153813',
            ),
            21 => 
            array (
                'id' => 1522,
                'code' => '153814000',
                'name' => 'Kabuntalan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153814',
            ),
            22 => 
            array (
                'id' => 1523,
                'code' => '153815000',
                'name' => 'Upi',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153815',
            ),
            23 => 
            array (
                'id' => 1524,
                'code' => '153816000',
                'name' => 'Talayan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153816',
            ),
            24 => 
            array (
                'id' => 1525,
                'code' => '153817000',
                'name' => 'South Upi',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153817',
            ),
            25 => 
            array (
                'id' => 1526,
                'code' => '153818000',
                'name' => 'Barira',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153818',
            ),
            26 => 
            array (
                'id' => 1527,
                'code' => '153819000',
                'name' => 'Gen. S.K. Pendatun',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153819',
            ),
            27 => 
            array (
                'id' => 1528,
                'code' => '153820000',
                'name' => 'Mamasapano',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153820',
            ),
            28 => 
            array (
                'id' => 1529,
                'code' => '153821000',
                'name' => 'Talitay',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153821',
            ),
            29 => 
            array (
                'id' => 1530,
                'code' => '153822000',
                'name' => 'Pagagawan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153822',
            ),
            30 => 
            array (
                'id' => 1531,
                'code' => '153823000',
                'name' => 'Paglat',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153823',
            ),
            31 => 
            array (
                'id' => 1532,
                'code' => '153824000',
                'name' => 'Sultan Mastura',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153824',
            ),
            32 => 
            array (
                'id' => 1533,
                'code' => '153825000',
                'name' => 'Guindulungan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153825',
            ),
            33 => 
            array (
                'id' => 1534,
                'code' => '153826000',
                'name' => 'Datu Saudi-Ampatuan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153826',
            ),
            34 => 
            array (
                'id' => 1535,
                'code' => '153827000',
                'name' => 'Datu Unsay',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153827',
            ),
            35 => 
            array (
                'id' => 1536,
                'code' => '153828000',
                'name' => 'Datu Abdullah Sangki',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153828',
            ),
            36 => 
            array (
                'id' => 1537,
                'code' => '153829000',
                'name' => 'Rajah Buayan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153829',
            ),
            37 => 
            array (
                'id' => 1538,
                'code' => '153830000',
                'name' => 'Datu Blah T. Sinsuat',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153830',
            ),
            38 => 
            array (
                'id' => 1539,
                'code' => '153831000',
                'name' => 'Datu Anggal Midtimbang',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153831',
            ),
            39 => 
            array (
                'id' => 1540,
                'code' => '153832000',
                'name' => 'Mangudadatu',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153832',
            ),
            40 => 
            array (
                'id' => 1541,
                'code' => '153833000',
                'name' => 'Pandag',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153833',
            ),
            41 => 
            array (
                'id' => 1542,
                'code' => '153834000',
                'name' => 'Northern Kabuntalan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153834',
            ),
            42 => 
            array (
                'id' => 1543,
                'code' => '153835000',
                'name' => 'Datu Hoffer Ampatuan',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153835',
            ),
            43 => 
            array (
                'id' => 1544,
                'code' => '153836000',
                'name' => 'Datu Salibo',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153836',
            ),
            44 => 
            array (
                'id' => 1545,
                'code' => '153837000',
                'name' => 'Shariff Saydona Mustapha',
                'region_id' => '15',
                'province_id' => '1538',
                'city_id' => '153837',
            ),
            45 => 
            array (
                'id' => 1546,
                'code' => '156601000',
                'name' => 'Indanan',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156601',
            ),
            46 => 
            array (
                'id' => 1547,
                'code' => '156602000',
            'name' => 'Jolo (Capital)',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156602',
            ),
            47 => 
            array (
                'id' => 1548,
                'code' => '156603000',
                'name' => 'Kalingalan Caluang',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156603',
            ),
            48 => 
            array (
                'id' => 1549,
                'code' => '156604000',
                'name' => 'Luuk',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156604',
            ),
            49 => 
            array (
                'id' => 1550,
                'code' => '156605000',
                'name' => 'Maimbung',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156605',
            ),
            50 => 
            array (
                'id' => 1551,
                'code' => '156606000',
                'name' => 'Hadji Panglima Tahil',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156606',
            ),
            51 => 
            array (
                'id' => 1552,
                'code' => '156607000',
                'name' => 'Old Panamao',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156607',
            ),
            52 => 
            array (
                'id' => 1553,
                'code' => '156608000',
                'name' => 'Pangutaran',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156608',
            ),
            53 => 
            array (
                'id' => 1554,
                'code' => '156609000',
                'name' => 'Parang',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156609',
            ),
            54 => 
            array (
                'id' => 1555,
                'code' => '156610000',
                'name' => 'Pata',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156610',
            ),
            55 => 
            array (
                'id' => 1556,
                'code' => '156611000',
                'name' => 'Patikul',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156611',
            ),
            56 => 
            array (
                'id' => 1557,
                'code' => '156612000',
                'name' => 'Siasi',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156612',
            ),
            57 => 
            array (
                'id' => 1558,
                'code' => '156613000',
                'name' => 'Talipao',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156613',
            ),
            58 => 
            array (
                'id' => 1559,
                'code' => '156614000',
                'name' => 'Tapul',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156614',
            ),
            59 => 
            array (
                'id' => 1560,
                'code' => '156615000',
                'name' => 'Tongkil',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156615',
            ),
            60 => 
            array (
                'id' => 1561,
                'code' => '156616000',
                'name' => 'Panglima Estino',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156616',
            ),
            61 => 
            array (
                'id' => 1562,
                'code' => '156617000',
                'name' => 'Lugus',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156617',
            ),
            62 => 
            array (
                'id' => 1563,
                'code' => '156618000',
                'name' => 'Pandami',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156618',
            ),
            63 => 
            array (
                'id' => 1564,
                'code' => '156619000',
                'name' => 'Omar',
                'region_id' => '15',
                'province_id' => '1566',
                'city_id' => '156619',
            ),
            64 => 
            array (
                'id' => 1565,
                'code' => '157001000',
                'name' => 'Panglima Sugala',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157001',
            ),
            65 => 
            array (
                'id' => 1566,
                'code' => '157002000',
            'name' => 'Bongao (Capital)',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157002',
            ),
            66 => 
            array (
                'id' => 1567,
                'code' => '157003000',
                'name' => 'Mapun',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157003',
            ),
            67 => 
            array (
                'id' => 1568,
                'code' => '157004000',
                'name' => 'Simunul',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157004',
            ),
            68 => 
            array (
                'id' => 1569,
                'code' => '157005000',
                'name' => 'Sitangkai',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157005',
            ),
            69 => 
            array (
                'id' => 1570,
                'code' => '157006000',
                'name' => 'South Ubian',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157006',
            ),
            70 => 
            array (
                'id' => 1571,
                'code' => '157007000',
                'name' => 'Tandubas',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157007',
            ),
            71 => 
            array (
                'id' => 1572,
                'code' => '157008000',
                'name' => 'Turtle Islands',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157008',
            ),
            72 => 
            array (
                'id' => 1573,
                'code' => '157009000',
                'name' => 'Languyan',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157009',
            ),
            73 => 
            array (
                'id' => 1574,
                'code' => '157010000',
                'name' => 'Sapa-Sapa',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157010',
            ),
            74 => 
            array (
                'id' => 1575,
                'code' => '157011000',
                'name' => 'Sibutu',
                'region_id' => '15',
                'province_id' => '1570',
                'city_id' => '157011',
            ),
            75 => 
            array (
                'id' => 1576,
                'code' => '160201000',
                'name' => 'Buenavista',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160201',
            ),
            76 => 
            array (
                'id' => 1577,
                'code' => '160202000',
            'name' => 'City of Butuan (Capital)',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160202',
            ),
            77 => 
            array (
                'id' => 1578,
                'code' => '160203000',
                'name' => 'City of Cabadbaran',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160203',
            ),
            78 => 
            array (
                'id' => 1579,
                'code' => '160204000',
                'name' => 'Carmen',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160204',
            ),
            79 => 
            array (
                'id' => 1580,
                'code' => '160205000',
                'name' => 'Jabonga',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160205',
            ),
            80 => 
            array (
                'id' => 1581,
                'code' => '160206000',
                'name' => 'Kitcharao',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160206',
            ),
            81 => 
            array (
                'id' => 1582,
                'code' => '160207000',
                'name' => 'Las Nieves',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160207',
            ),
            82 => 
            array (
                'id' => 1583,
                'code' => '160208000',
                'name' => 'Magallanes',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160208',
            ),
            83 => 
            array (
                'id' => 1584,
                'code' => '160209000',
                'name' => 'Nasipit',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160209',
            ),
            84 => 
            array (
                'id' => 1585,
                'code' => '160210000',
                'name' => 'Santiago',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160210',
            ),
            85 => 
            array (
                'id' => 1586,
                'code' => '160211000',
                'name' => 'Tubay',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160211',
            ),
            86 => 
            array (
                'id' => 1587,
                'code' => '160212000',
                'name' => 'Remedios T. Romualdez',
                'region_id' => '16',
                'province_id' => '1602',
                'city_id' => '160212',
            ),
            87 => 
            array (
                'id' => 1588,
                'code' => '160301000',
                'name' => 'City of Bayugan',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160301',
            ),
            88 => 
            array (
                'id' => 1589,
                'code' => '160302000',
                'name' => 'Bunawan',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160302',
            ),
            89 => 
            array (
                'id' => 1590,
                'code' => '160303000',
                'name' => 'Esperanza',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160303',
            ),
            90 => 
            array (
                'id' => 1591,
                'code' => '160304000',
                'name' => 'La Paz',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160304',
            ),
            91 => 
            array (
                'id' => 1592,
                'code' => '160305000',
                'name' => 'Loreto',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160305',
            ),
            92 => 
            array (
                'id' => 1593,
                'code' => '160306000',
            'name' => 'Prosperidad (Capital)',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160306',
            ),
            93 => 
            array (
                'id' => 1594,
                'code' => '160307000',
                'name' => 'Rosario',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160307',
            ),
            94 => 
            array (
                'id' => 1595,
                'code' => '160308000',
                'name' => 'San Francisco',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160308',
            ),
            95 => 
            array (
                'id' => 1596,
                'code' => '160309000',
                'name' => 'San Luis',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160309',
            ),
            96 => 
            array (
                'id' => 1597,
                'code' => '160310000',
                'name' => 'Santa Josefa',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160310',
            ),
            97 => 
            array (
                'id' => 1598,
                'code' => '160311000',
                'name' => 'Talacogon',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160311',
            ),
            98 => 
            array (
                'id' => 1599,
                'code' => '160312000',
                'name' => 'Trento',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160312',
            ),
            99 => 
            array (
                'id' => 1600,
                'code' => '160313000',
                'name' => 'Veruela',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160313',
            ),
            100 => 
            array (
                'id' => 1601,
                'code' => '160314000',
                'name' => 'Sibagat',
                'region_id' => '16',
                'province_id' => '1603',
                'city_id' => '160314',
            ),
            101 => 
            array (
                'id' => 1602,
                'code' => '166701000',
                'name' => 'Alegria',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166701',
            ),
            102 => 
            array (
                'id' => 1603,
                'code' => '166702000',
                'name' => 'Bacuag',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166702',
            ),
            103 => 
            array (
                'id' => 1604,
                'code' => '166704000',
                'name' => 'Burgos',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166704',
            ),
            104 => 
            array (
                'id' => 1605,
                'code' => '166706000',
                'name' => 'Claver',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166706',
            ),
            105 => 
            array (
                'id' => 1606,
                'code' => '166707000',
                'name' => 'Dapa',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166707',
            ),
            106 => 
            array (
                'id' => 1607,
                'code' => '166708000',
                'name' => 'Del Carmen',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166708',
            ),
            107 => 
            array (
                'id' => 1608,
                'code' => '166710000',
                'name' => 'General Luna',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166710',
            ),
            108 => 
            array (
                'id' => 1609,
                'code' => '166711000',
                'name' => 'Gigaquit',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166711',
            ),
            109 => 
            array (
                'id' => 1610,
                'code' => '166714000',
                'name' => 'Mainit',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166714',
            ),
            110 => 
            array (
                'id' => 1611,
                'code' => '166715000',
                'name' => 'Malimono',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166715',
            ),
            111 => 
            array (
                'id' => 1612,
                'code' => '166716000',
                'name' => 'Pilar',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166716',
            ),
            112 => 
            array (
                'id' => 1613,
                'code' => '166717000',
                'name' => 'Placer',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166717',
            ),
            113 => 
            array (
                'id' => 1614,
                'code' => '166718000',
                'name' => 'San Benito',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166718',
            ),
            114 => 
            array (
                'id' => 1615,
                'code' => '166719000',
                'name' => 'San Francisco',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166719',
            ),
            115 => 
            array (
                'id' => 1616,
                'code' => '166720000',
                'name' => 'San Isidro',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166720',
            ),
            116 => 
            array (
                'id' => 1617,
                'code' => '166721000',
                'name' => 'Santa Monica',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166721',
            ),
            117 => 
            array (
                'id' => 1618,
                'code' => '166722000',
                'name' => 'Sison',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166722',
            ),
            118 => 
            array (
                'id' => 1619,
                'code' => '166723000',
                'name' => 'Socorro',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166723',
            ),
            119 => 
            array (
                'id' => 1620,
                'code' => '166724000',
            'name' => 'City of Surigao (Capital)',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166724',
            ),
            120 => 
            array (
                'id' => 1621,
                'code' => '166725000',
                'name' => 'Tagana-An',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166725',
            ),
            121 => 
            array (
                'id' => 1622,
                'code' => '166727000',
                'name' => 'Tubod',
                'region_id' => '16',
                'province_id' => '1667',
                'city_id' => '166727',
            ),
            122 => 
            array (
                'id' => 1623,
                'code' => '166801000',
                'name' => 'Barobo',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166801',
            ),
            123 => 
            array (
                'id' => 1624,
                'code' => '166802000',
                'name' => 'Bayabas',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166802',
            ),
            124 => 
            array (
                'id' => 1625,
                'code' => '166803000',
                'name' => 'City of Bislig',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166803',
            ),
            125 => 
            array (
                'id' => 1626,
                'code' => '166804000',
                'name' => 'Cagwait',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166804',
            ),
            126 => 
            array (
                'id' => 1627,
                'code' => '166805000',
                'name' => 'Cantilan',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166805',
            ),
            127 => 
            array (
                'id' => 1628,
                'code' => '166806000',
                'name' => 'Carmen',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166806',
            ),
            128 => 
            array (
                'id' => 1629,
                'code' => '166807000',
                'name' => 'Carrascal',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166807',
            ),
            129 => 
            array (
                'id' => 1630,
                'code' => '166808000',
                'name' => 'Cortes',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166808',
            ),
            130 => 
            array (
                'id' => 1631,
                'code' => '166809000',
                'name' => 'Hinatuan',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166809',
            ),
            131 => 
            array (
                'id' => 1632,
                'code' => '166810000',
                'name' => 'Lanuza',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166810',
            ),
            132 => 
            array (
                'id' => 1633,
                'code' => '166811000',
                'name' => 'Lianga',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166811',
            ),
            133 => 
            array (
                'id' => 1634,
                'code' => '166812000',
                'name' => 'Lingig',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166812',
            ),
            134 => 
            array (
                'id' => 1635,
                'code' => '166813000',
                'name' => 'Madrid',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166813',
            ),
            135 => 
            array (
                'id' => 1636,
                'code' => '166814000',
                'name' => 'Marihatag',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166814',
            ),
            136 => 
            array (
                'id' => 1637,
                'code' => '166815000',
                'name' => 'San Agustin',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166815',
            ),
            137 => 
            array (
                'id' => 1638,
                'code' => '166816000',
                'name' => 'San Miguel',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166816',
            ),
            138 => 
            array (
                'id' => 1639,
                'code' => '166817000',
                'name' => 'Tagbina',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166817',
            ),
            139 => 
            array (
                'id' => 1640,
                'code' => '166818000',
                'name' => 'Tago',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166818',
            ),
            140 => 
            array (
                'id' => 1641,
                'code' => '166819000',
            'name' => 'City of Tandag (Capital)',
                'region_id' => '16',
                'province_id' => '1668',
                'city_id' => '166819',
            ),
            141 => 
            array (
                'id' => 1642,
                'code' => '168501000',
                'name' => 'Basilisa',
                'region_id' => '16',
                'province_id' => '1685',
                'city_id' => '168501',
            ),
            142 => 
            array (
                'id' => 1643,
                'code' => '168502000',
                'name' => 'Cagdianao',
                'region_id' => '16',
                'province_id' => '1685',
                'city_id' => '168502',
            ),
            143 => 
            array (
                'id' => 1644,
                'code' => '168503000',
                'name' => 'Dinagat',
                'region_id' => '16',
                'province_id' => '1685',
                'city_id' => '168503',
            ),
            144 => 
            array (
                'id' => 1645,
                'code' => '168504000',
                'name' => 'Libjo',
                'region_id' => '16',
                'province_id' => '1685',
                'city_id' => '168504',
            ),
            145 => 
            array (
                'id' => 1646,
                'code' => '168505000',
                'name' => 'Loreto',
                'region_id' => '16',
                'province_id' => '1685',
                'city_id' => '168505',
            ),
            146 => 
            array (
                'id' => 1647,
                'code' => '168506000',
            'name' => 'San Jose (Capital)',
                'region_id' => '16',
                'province_id' => '1685',
                'city_id' => '168506',
            ),
            147 => 
            array (
                'id' => 1648,
                'code' => '168507000',
                'name' => 'Tubajon',
                'region_id' => '16',
                'province_id' => '1685',
                'city_id' => '168507',
            ),
        ));
        
        
    }
}