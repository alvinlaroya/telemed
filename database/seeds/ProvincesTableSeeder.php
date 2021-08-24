<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provinces')->delete();
        
        \DB::table('provinces')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '012800000',
                'name' => 'Ilocos Norte',
                'region_id' => '01',
                'province_id' => '0128',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => '012900000',
                'name' => 'Ilocos Sur',
                'region_id' => '01',
                'province_id' => '0129',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => '013300000',
                'name' => 'La Union',
                'region_id' => '01',
                'province_id' => '0133',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => '015500000',
                'name' => 'Pangasinan',
                'region_id' => '01',
                'province_id' => '0155',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => '020900000',
                'name' => 'Batanes',
                'region_id' => '02',
                'province_id' => '0209',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => '021500000',
                'name' => 'Cagayan',
                'region_id' => '02',
                'province_id' => '0215',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => '023100000',
                'name' => 'Isabela',
                'region_id' => '02',
                'province_id' => '0231',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => '025000000',
                'name' => 'Nueva Vizcaya',
                'region_id' => '02',
                'province_id' => '0250',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => '025700000',
                'name' => 'Quirino',
                'region_id' => '02',
                'province_id' => '0257',
            ),
            9 => 
            array (
                'id' => 10,
                'code' => '030800000',
                'name' => 'Bataan',
                'region_id' => '03',
                'province_id' => '0308',
            ),
            10 => 
            array (
                'id' => 11,
                'code' => '031400000',
                'name' => 'Bulacan',
                'region_id' => '03',
                'province_id' => '0314',
            ),
            11 => 
            array (
                'id' => 12,
                'code' => '034900000',
                'name' => 'Nueva Ecija',
                'region_id' => '03',
                'province_id' => '0349',
            ),
            12 => 
            array (
                'id' => 13,
                'code' => '035400000',
                'name' => 'Pampanga',
                'region_id' => '03',
                'province_id' => '0354',
            ),
            13 => 
            array (
                'id' => 14,
                'code' => '036900000',
                'name' => 'Tarlac',
                'region_id' => '03',
                'province_id' => '0369',
            ),
            14 => 
            array (
                'id' => 15,
                'code' => '037100000',
                'name' => 'Zambales',
                'region_id' => '03',
                'province_id' => '0371',
            ),
            15 => 
            array (
                'id' => 16,
                'code' => '037700000',
                'name' => 'Aurora',
                'region_id' => '03',
                'province_id' => '0377',
            ),
            16 => 
            array (
                'id' => 17,
                'code' => '041000000',
                'name' => 'Batangas',
                'region_id' => '04',
                'province_id' => '0410',
            ),
            17 => 
            array (
                'id' => 18,
                'code' => '042100000',
                'name' => 'Cavite',
                'region_id' => '04',
                'province_id' => '0421',
            ),
            18 => 
            array (
                'id' => 19,
                'code' => '043400000',
                'name' => 'Laguna',
                'region_id' => '04',
                'province_id' => '0434',
            ),
            19 => 
            array (
                'id' => 20,
                'code' => '045600000',
                'name' => 'Quezon',
                'region_id' => '04',
                'province_id' => '0456',
            ),
            20 => 
            array (
                'id' => 21,
                'code' => '045800000',
                'name' => 'Rizal',
                'region_id' => '04',
                'province_id' => '0458',
            ),
            21 => 
            array (
                'id' => 22,
                'code' => '174000000',
                'name' => 'Marinduque',
                'region_id' => '17',
                'province_id' => '1740',
            ),
            22 => 
            array (
                'id' => 23,
                'code' => '175100000',
                'name' => 'Occidental Mindoro',
                'region_id' => '17',
                'province_id' => '1751',
            ),
            23 => 
            array (
                'id' => 24,
                'code' => '175200000',
                'name' => 'Oriental Mindoro',
                'region_id' => '17',
                'province_id' => '1752',
            ),
            24 => 
            array (
                'id' => 25,
                'code' => '175300000',
                'name' => 'Palawan',
                'region_id' => '17',
                'province_id' => '1753',
            ),
            25 => 
            array (
                'id' => 26,
                'code' => '175900000',
                'name' => 'Romblon',
                'region_id' => '17',
                'province_id' => '1759',
            ),
            26 => 
            array (
                'id' => 27,
                'code' => '050500000',
                'name' => 'Albay',
                'region_id' => '05',
                'province_id' => '0505',
            ),
            27 => 
            array (
                'id' => 28,
                'code' => '051600000',
                'name' => 'Camarines Norte',
                'region_id' => '05',
                'province_id' => '0516',
            ),
            28 => 
            array (
                'id' => 29,
                'code' => '051700000',
                'name' => 'Camarines Sur',
                'region_id' => '05',
                'province_id' => '0517',
            ),
            29 => 
            array (
                'id' => 30,
                'code' => '052000000',
                'name' => 'Catanduanes',
                'region_id' => '05',
                'province_id' => '0520',
            ),
            30 => 
            array (
                'id' => 31,
                'code' => '054100000',
                'name' => 'Masbate',
                'region_id' => '05',
                'province_id' => '0541',
            ),
            31 => 
            array (
                'id' => 32,
                'code' => '056200000',
                'name' => 'Sorsogon',
                'region_id' => '05',
                'province_id' => '0562',
            ),
            32 => 
            array (
                'id' => 33,
                'code' => '060400000',
                'name' => 'Aklan',
                'region_id' => '06',
                'province_id' => '0604',
            ),
            33 => 
            array (
                'id' => 34,
                'code' => '060600000',
                'name' => 'Antique',
                'region_id' => '06',
                'province_id' => '0606',
            ),
            34 => 
            array (
                'id' => 35,
                'code' => '061900000',
                'name' => 'Capiz',
                'region_id' => '06',
                'province_id' => '0619',
            ),
            35 => 
            array (
                'id' => 36,
                'code' => '063000000',
                'name' => 'Iloilo',
                'region_id' => '06',
                'province_id' => '0630',
            ),
            36 => 
            array (
                'id' => 37,
                'code' => '064500000',
                'name' => 'Negros Occidental',
                'region_id' => '06',
                'province_id' => '0645',
            ),
            37 => 
            array (
                'id' => 38,
                'code' => '067900000',
                'name' => 'Guimaras',
                'region_id' => '06',
                'province_id' => '0679',
            ),
            38 => 
            array (
                'id' => 39,
                'code' => '071200000',
                'name' => 'Bohol',
                'region_id' => '07',
                'province_id' => '0712',
            ),
            39 => 
            array (
                'id' => 40,
                'code' => '072200000',
                'name' => 'Cebu',
                'region_id' => '07',
                'province_id' => '0722',
            ),
            40 => 
            array (
                'id' => 41,
                'code' => '074600000',
                'name' => 'Negros Oriental',
                'region_id' => '07',
                'province_id' => '0746',
            ),
            41 => 
            array (
                'id' => 42,
                'code' => '076100000',
                'name' => 'Siquijor',
                'region_id' => '07',
                'province_id' => '0761',
            ),
            42 => 
            array (
                'id' => 43,
                'code' => '082600000',
                'name' => 'Eastern Samar',
                'region_id' => '08',
                'province_id' => '0826',
            ),
            43 => 
            array (
                'id' => 44,
                'code' => '083700000',
                'name' => 'Leyte',
                'region_id' => '08',
                'province_id' => '0837',
            ),
            44 => 
            array (
                'id' => 45,
                'code' => '084800000',
                'name' => 'Northern Samar',
                'region_id' => '08',
                'province_id' => '0848',
            ),
            45 => 
            array (
                'id' => 46,
                'code' => '086000000',
                'name' => 'Samar',
                'region_id' => '08',
                'province_id' => '0860',
            ),
            46 => 
            array (
                'id' => 47,
                'code' => '086400000',
                'name' => 'Southern Leyte',
                'region_id' => '08',
                'province_id' => '0864',
            ),
            47 => 
            array (
                'id' => 48,
                'code' => '087800000',
                'name' => 'Biliran',
                'region_id' => '08',
                'province_id' => '0878',
            ),
            48 => 
            array (
                'id' => 49,
                'code' => '097200000',
                'name' => 'Zamboanga del Norte',
                'region_id' => '09',
                'province_id' => '0972',
            ),
            49 => 
            array (
                'id' => 50,
                'code' => '097300000',
                'name' => 'Zamboanga del Sur',
                'region_id' => '09',
                'province_id' => '0973',
            ),
            50 => 
            array (
                'id' => 51,
                'code' => '098300000',
                'name' => 'Zamboanga Sibugay',
                'region_id' => '09',
                'province_id' => '0983',
            ),
            51 => 
            array (
                'id' => 52,
                'code' => '099700000',
            'name' => 'City of Isabela (Not a Province)',
                'region_id' => '09',
                'province_id' => '0997',
            ),
            52 => 
            array (
                'id' => 53,
                'code' => '101300000',
                'name' => 'Bukidnon',
                'region_id' => '10',
                'province_id' => '1013',
            ),
            53 => 
            array (
                'id' => 54,
                'code' => '101800000',
                'name' => 'Camiguin',
                'region_id' => '10',
                'province_id' => '1018',
            ),
            54 => 
            array (
                'id' => 55,
                'code' => '103500000',
                'name' => 'Lanao del Norte',
                'region_id' => '10',
                'province_id' => '1035',
            ),
            55 => 
            array (
                'id' => 56,
                'code' => '104200000',
                'name' => 'Misamis Occidental',
                'region_id' => '10',
                'province_id' => '1042',
            ),
            56 => 
            array (
                'id' => 57,
                'code' => '104300000',
                'name' => 'Misamis Oriental',
                'region_id' => '10',
                'province_id' => '1043',
            ),
            57 => 
            array (
                'id' => 58,
                'code' => '112300000',
                'name' => 'Davao del Norte',
                'region_id' => '11',
                'province_id' => '1123',
            ),
            58 => 
            array (
                'id' => 59,
                'code' => '112400000',
                'name' => 'Davao del Sur',
                'region_id' => '11',
                'province_id' => '1124',
            ),
            59 => 
            array (
                'id' => 60,
                'code' => '112500000',
                'name' => 'Davao Oriental',
                'region_id' => '11',
                'province_id' => '1125',
            ),
            60 => 
            array (
                'id' => 61,
                'code' => '118200000',
                'name' => 'Davao de Oro',
                'region_id' => '11',
                'province_id' => '1182',
            ),
            61 => 
            array (
                'id' => 62,
                'code' => '118600000',
                'name' => 'Davao Occidental',
                'region_id' => '11',
                'province_id' => '1186',
            ),
            62 => 
            array (
                'id' => 63,
                'code' => '124700000',
                'name' => 'Cotabato',
                'region_id' => '12',
                'province_id' => '1247',
            ),
            63 => 
            array (
                'id' => 64,
                'code' => '126300000',
                'name' => 'South Cotabato',
                'region_id' => '12',
                'province_id' => '1263',
            ),
            64 => 
            array (
                'id' => 65,
                'code' => '126500000',
                'name' => 'Sultan Kudarat',
                'region_id' => '12',
                'province_id' => '1265',
            ),
            65 => 
            array (
                'id' => 66,
                'code' => '128000000',
                'name' => 'Sarangani',
                'region_id' => '12',
                'province_id' => '1280',
            ),
            66 => 
            array (
                'id' => 67,
                'code' => '129800000',
            'name' => 'City of Cotabato (Not a Province)',
                'region_id' => '12',
                'province_id' => '1298',
            ),
            67 => 
            array (
                'id' => 68,
                'code' => '133900000',
            'name' => 'NCR, City of Manila, First District (Not a Province)',
                'region_id' => '13',
                'province_id' => '1339',
            ),
            68 => 
            array (
                'id' => 69,
                'code' => '137400000',
            'name' => 'NCR, Second District (Not a Province)',
                'region_id' => '13',
                'province_id' => '1374',
            ),
            69 => 
            array (
                'id' => 70,
                'code' => '137500000',
            'name' => 'NCR, Third District (Not a Province)',
                'region_id' => '13',
                'province_id' => '1375',
            ),
            70 => 
            array (
                'id' => 71,
                'code' => '137600000',
            'name' => 'NCR, Fourth District (Not a Province)',
                'region_id' => '13',
                'province_id' => '1376',
            ),
            71 => 
            array (
                'id' => 72,
                'code' => '140100000',
                'name' => 'Abra',
                'region_id' => '14',
                'province_id' => '1401',
            ),
            72 => 
            array (
                'id' => 73,
                'code' => '141100000',
                'name' => 'Benguet',
                'region_id' => '14',
                'province_id' => '1411',
            ),
            73 => 
            array (
                'id' => 74,
                'code' => '142700000',
                'name' => 'Ifugao',
                'region_id' => '14',
                'province_id' => '1427',
            ),
            74 => 
            array (
                'id' => 75,
                'code' => '143200000',
                'name' => 'Kalinga',
                'region_id' => '14',
                'province_id' => '1432',
            ),
            75 => 
            array (
                'id' => 76,
                'code' => '144400000',
                'name' => 'Mountain Province',
                'region_id' => '14',
                'province_id' => '1444',
            ),
            76 => 
            array (
                'id' => 77,
                'code' => '148100000',
                'name' => 'Apayao',
                'region_id' => '14',
                'province_id' => '1481',
            ),
            77 => 
            array (
                'id' => 78,
                'code' => '150700000',
                'name' => 'Basilan',
                'region_id' => '15',
                'province_id' => '1507',
            ),
            78 => 
            array (
                'id' => 79,
                'code' => '153600000',
                'name' => 'Lanao del Sur',
                'region_id' => '15',
                'province_id' => '1536',
            ),
            79 => 
            array (
                'id' => 80,
                'code' => '153800000',
                'name' => 'Maguindanao',
                'region_id' => '15',
                'province_id' => '1538',
            ),
            80 => 
            array (
                'id' => 81,
                'code' => '156600000',
                'name' => 'Sulu',
                'region_id' => '15',
                'province_id' => '1566',
            ),
            81 => 
            array (
                'id' => 82,
                'code' => '157000000',
                'name' => 'Tawi-Tawi',
                'region_id' => '15',
                'province_id' => '1570',
            ),
            82 => 
            array (
                'id' => 83,
                'code' => '160200000',
                'name' => 'Agusan del Norte',
                'region_id' => '16',
                'province_id' => '1602',
            ),
            83 => 
            array (
                'id' => 84,
                'code' => '160300000',
                'name' => 'Agusan del Sur',
                'region_id' => '16',
                'province_id' => '1603',
            ),
            84 => 
            array (
                'id' => 85,
                'code' => '166700000',
                'name' => 'Surigao del Norte',
                'region_id' => '16',
                'province_id' => '1667',
            ),
            85 => 
            array (
                'id' => 86,
                'code' => '166800000',
                'name' => 'Surigao del Sur',
                'region_id' => '16',
                'province_id' => '1668',
            ),
            86 => 
            array (
                'id' => 87,
                'code' => '168500000',
                'name' => 'Dinagat Islands',
                'region_id' => '16',
                'province_id' => '1685',
            ),
        ));
        
        
    }
}