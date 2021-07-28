<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->truncate();
        $types = [
            [
                'title' => 'food',
                'field' => [
                    [
                        'name' => 'weight',
                        'type' => 'number',
                        'as' => 'Weight'
                    ]
                ],
                'cart_system' => true
            ],
            [
                'title' => 'clothes',
                'field' => [
                    [
                        'name' => 'color',
                        'type' => 'text',
                        'as' => 'Color'
                    ],
                    [
                        'name' => 'size',
                        'type' => 'text',
                        'as' => 'Size'
                    ]
                ],
                'cart_system' => true
            ],
            [
                'title' => 'land',
                'field' => [
                    [
                        'name' => 'area',
                        'type' => 'number',
                        'as' => 'Area'
                    ]
                ],
                'cart_system' => false
            ]

        ];
        foreach ($types as $type){

            DB::table('product_types')->insert([
                'title' => $type['title'],
                'field' => json_encode($type['field']),
                'cart_system' => $type['cart_system']
            ]);
        }
    }
}
