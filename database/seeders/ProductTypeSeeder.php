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
