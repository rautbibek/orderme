<?php

namespace App\Services;

class AddressServices {
    public function getAllState(){
        $subdivison = [
            'ON' => [
                "iso_code" => "NP-ON",
                "name" => "Province No. 1",
                "has_children" => true
            ],
            'TW' => [
                "iso_code" => "NP-TW",
                "name" => "Province No. 2",
                "has_children" => true
            ],
            'TH' => [
                "iso_code" => "NP-TH",
                "name" => "Bagmati Pradesh",
                "has_children" => true
            ],
            'FO' => [
                "iso_code" => "NP-FO",
                "name" => "Gandaki Pradesh",
                "has_children" => true
            ],
            'FI' => [
                "iso_code" => "NP-FI",
                "name" => "Province No. 5",
                "has_children" => true
            ],
            'SI' => [
                "iso_code" => "NP-SI",
                "name" => "Karnali Pradesh",
                "has_children" => true
            ],
            'SE' => [
                "iso_code" => "NP-SE",
                "name" => "Sudurpashchim Pradesh",
                "has_children" => true
            ],
        ];

        return $subdivison;
    }

    public function getCityByState($stateCode){
        $parents = $stateCode;
        if ($parents == ['NP', "ON"]) {
            $definitions = [
                'country_code' => 'NP',
                'parents' => $parents,
                'subdivisions' => [
                    'Bhojpur',
                    'Dhankuta',
                    'Ilam',
                    'Jhapa',
                    'Khotang',
                    'Morang',
                    'Okhaldhunga',
                    'Panchthar',
                    'Sankhuwasabha',
                    'Solukhumbu',
                    'Sunsari',
                    'Taplejung',
                    'Terathum',
                    'Udayapur',
                ]
            ];
        }

        if ($parents == ['NP', "TW"]) {
            $definitions = [
                'country_code' => 'NP',
                'parents' => $parents,
                'subdivisions' => [
                    'Parsa',
                    'Bara',
                    'Rautahat',
                    'Sarlahi',
                    'Siraha',
                    'Dhanusha',
                    'Saptari',
                    'Mahottari',
                ]
            ];
        }

        if ($parents == ['NP', "TH"]) {
            $definitions = [
                'country_code' => 'NP',
                'parents' => $parents,
                'subdivisions' => [
                    'Bhaktapur',
                    'Chitwan',
                    'Dhading',
                    'Dolakha',
                    'Kathmandu' => [
                        "has_children" => true
                    ],
                    'Kavrepalanchok',
                    'Lalitpur',
                    'Makwanpur',
                    'Nuwakot',
                    'Ramechhap',
                    'Rasuwa',
                    'Sindhuli',
                    'Sindhupalchok',
                ]
            ];
        }

        if ($parents == ['NP', "FO"]) {
            $definitions = [
                'country_code' => 'NP',
                'parents' => $parents,
                'subdivisions' => [
                    'Baglung',
                    'Gorkha',
                    'Kaski',
                    'Lamjung',
                    'Manang',
                    'Mustang',
                    'Myagdi',
                    'Nawalpur',
                    'Parbat',
                    'Syangya',
                    'Tanahun',
                ]
            ];
        }


        if ($parents == ['NP', "FI"]) {
            $definitions = [
                'country_code' => 'NP',
                'parents' => $parents,
                'subdivisions' => [
                    'Arghakhanchi',
                    'Banke',
                    'Bardiya',
                    'Dang Deukhuri',
                    'Eastern Rukum',
                    'Gulmi',
                    'Kapilvastu',
                    'Parasi',
                    'Palpa',
                    'Pyuthan',
                    'Rolpa',
                    'Rupandehi',
                ]
            ];
        }

        if ($parents == ['NP', "SI"]) {
            $definitions = [
                'country_code' => 'NP',
                'parents' => $parents,
                'subdivisions' => [
                    'Dailekh',
                    'Dolpa',
                    'Humla',
                    'Jajarkot',
                    'Jumla',
                    'Kalikot',
                    'Mugu',
                    'Salyan',
                    'Surkhet',
                    'Western Rukum'
                ]
            ];
        }

        if ($parents == "SE") {
            $definitions = [
                'country_code' => 'NP',
                'parents' => $parents,
                'subdivisions' => [
                    'Achhham' ,
                    'Baitadi' ,
                    'Bajhang' ,
                    'Bajura' ,
                    'Dadeldhura' ,
                    'Darchula' ,
                    'Doti' ,
                    'Kailali' ,
                    'Kanchanpur' ,
                ]
            ];
        }

        return $definitions;
    }
}
