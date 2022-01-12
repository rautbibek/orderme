<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'title' => 'daily-needs',
                'field' => [
                    [
                        'name' => 'weight',
                        'type' => 'text',
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
                'title' => 'shoes',
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
                'title' => 'laptop & computer',
                'field' => [
                    [
                        'name' => 'ram',
                        'type' => 'text',
                        'as' => 'Ram'
                    ],
                    [
                        'name' => 'rom',
                        'type' => 'text',
                        'as' => 'Rom'
                    ],
                    [
                        'name' => 'processor',
                        'type' => 'text',
                        'as' => 'Processor'
                    ],
                    [
                        'name' => 'graphic',
                        'type' => 'text',
                        'as' => 'Graphic'
                    ],
                    [
                        'name' => 'storage_type',
                        'type' => 'text',
                        'as' => 'Storage Type'
                    ],
                    [
                        'name' => 'gen',
                        'type' => 'text',
                        'as' => 'Generation'
                    ]
                ],
                'cart_system' => true
            ],
            [
                'title' => 'TV',
                'field' => [
                    [
                        'name' => 'display-resolution',
                        'type' => 'text',
                        'as' => 'Display Resolution'
                    ],
                    [
                        'name' => 'refresh-rate',
                        'type' => 'text',
                        'as' => 'Refresh Rate'
                    ],
                    [
                        'name' => 'technology',
                        'type' => 'text',
                        'as' => 'Technology'
                    ],
                    [
                        'name' => 'size',
                        'type' => 'text',
                        'as' => 'Size'
                    ],

                ],
                'cart_system' => true
            ],
            [
                'title' => 'mobile',
                'field' => [
                    [
                        'name' => 'ram',
                        'type' => 'text',
                        'as' => 'Ram'
                    ],
                    [
                        'name' => 'storage',
                        'type' => 'text',
                        'as' => 'Storage'
                    ],
                    [
                        'name' => 'processor',
                        'type' => 'text',
                        'as' => 'Processor'
                    ],
                    [
                        'name' => 'battery-capacity',
                        'type' => 'text',
                        'as' => 'Battery Capacity'
                    ],
                    [
                        'name' => 'protection',
                        'type' => 'text',
                        'as' => 'Protection'
                    ],
                    [
                        'name' => 'size',
                        'type' => 'text',
                        'as' => 'Size'
                    ],
                    [
                        'name' => 'model-year',
                        'type' => 'text',
                        'as' => 'Model Year'
                    ],

                ],
                'cart_system' => true
            ],
            [
                'title' => 'refrigerator',
                'field' => [
                    [
                        'name' => 'capacity',
                        'type' => 'text',
                        'as' => 'Capacity'
                    ],
                    [
                        'name' => 'type',
                        'type' => 'text',
                        'as' => 'Type'
                    ],
                    [
                        'name' => 'model',
                        'type' => 'text',
                        'as' => 'Model'
                    ],

                ],
                'cart_system' => true
            ],
            [
                'title' => 'washing-machine',
                'field' => [
                    [
                        'name' => 'capacity',
                        'type' => 'text',
                        'as' => 'Capacity'
                    ],
                    [
                        'name' => 'type',
                        'type' => 'text',
                        'as' => 'Type'
                    ],
                    [
                        'name' => 'model',
                        'type' => 'text',
                        'as' => 'Model'
                    ],

                ],
                'cart_system' => true
            ],
            [
                'title' => 'automobile-and-parts',
                'field' => [
                    [
                        'name' => 'type',
                        'type' => 'text',
                        'as' => 'Type'
                    ],
                    [
                        'name' => 'model',
                        'type' => 'text',
                        'as' => 'Model'
                    ]

                ],
                'cart_system' => true
            ],
            [
                'title' => 'home-and-land',
                'field' => [
                    [
                        'name' => 'area',
                        'type' => 'text',
                        'as' => 'Area'
                    ],
                    [
                        'name' => 'type',
                        'type' => 'landType',
                        'as' => 'Type'
                    ],
                    [
                        'name' => 'phone',
                        'type' => 'text',
                        'as' => 'Phone'
                    ],
                    [
                        'name' => 'address',
                        'type' => 'text',
                        'as' => 'Address'
                    ]

                ],
                'cart_system' => false
            ]


        ];
        foreach ($types as $type){

            $productType = ProductType::where('title', $type['title'])->first();

            if($productType){
                $productType->field = json_encode($type['field']);
                $productType->cart_system = $type['cart_system'];
                $productType->update();
                continue;
            }

            $productType = new ProductType();
            $productType->title = $type['title'];
            $productType->field = json_encode($type['field']);
            $productType->cart_system = $type['cart_system'];
            $productType->save();
        }
    }
}
