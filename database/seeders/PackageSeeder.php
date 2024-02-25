<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodClasses = [
            [
                'title' => 'Starch',
            ],
            [
                'title' => 'Proteins',
            ],
            [
                'title' => 'Vegetables',
            ],
            [
                'title' => 'Salad',
            ],
            [
                'title' => 'Dessert',
            ],
            [
                'title' => 'Beverages',
            ],
        ];

        DB::table('food_classes')->insert($foodClasses);

        $foodItems = [
            [
                'food_class_id' => 1,
                'title' => 'Pilau'
            ],
            [
                'food_class_id' => 1,
                'title' => 'Vegetable Rice'
            ],
            [
                'food_class_id' => 1,
                'title' => 'Chapati'
            ],
            [
                'food_class_id' => 1,
                'title' => 'Ugali'
            ],
            [
                'food_class_id' => 1,
                'title' => 'Mashed Potatoes'
            ],
            [
                'food_class_id' => 1,
                'title' => 'Fries'
            ],
            [
                'food_class_id' => 2,
                'title' => 'Roast Chicken'
            ],
            [
                'food_class_id' => 2,
                'title' => 'Beef Stew'
            ],
            [
                'food_class_id' => 2,
                'title' => 'Roasted Chevon (Mbuzi Choma)'
            ],
            [
                'food_class_id' => 2,
                'title' => 'Roasted Mutton (Kondoo Choma)'
            ],
            [
                'food_class_id' => 2,
                'title' => 'Bean Stew'
            ],
            [
                'food_class_id' => 2,
                'title' => 'Tilapia'
            ],
            [
                'food_class_id' => 3,
                'title' => 'Creamed Spinach'
            ],
            [
                'food_class_id' => 3,
                'title' => 'Kienyeji Greens'
            ],
            [
                'food_class_id' => 3,
                'title' => 'Stir Fry Mixed vegetables'
            ],
            [
                'food_class_id' => 4,
                'title' => 'Vegetable Salad'
            ],
            [
                'food_class_id' => 4,
                'title' => 'Fruit Salad'
            ],
            [
                'food_class_id' => 5,
                'title' => 'Fruits'
            ],
            [
                'food_class_id' => 5,
                'title' => 'Cake'
            ],
            [
                'food_class_id' => 5,
                'title' => 'Assorted Cookies and Brownies'
            ],
            [
                'food_class_id' => 5,
                'title' => 'Icecream'
            ],
            [
                'food_class_id' => 6,
                'title' => 'Soda'
            ],
            [
                'food_class_id' => 6,
                'title' => 'Mineral Water'
            ],
        ];

        DB::table('food_items')->insert($foodItems);


        $packages = [
            [
                'title' => 'Menu 1',
                'price' => 1500
            ],
            [
                'title' => 'Menu 2',
                'price' => 2000
            ],
            [
                'title' => 'Menu 3',
                'price' => 2000
            ],
            [
                'title' => 'Menu 4',
                'price' => 2500
            ],
        ];

        DB::table('packages')->insert($packages);

        $foodClassPackage = [
            // Menu 1
            [
                'package_id' => 1,
                'food_class_id' => 1,
                'amount' => 3,
            ],
            [
                'package_id' => 1,
                'food_class_id' => 2,
                'amount' => 2,
            ],
            [
                'package_id' => 1,
                'food_class_id' => 3,
                'amount' => 2,
            ],
            [
                'package_id' => 1,
                'food_class_id' => 4,
                'amount' => 1,
            ],
            [
                'package_id' => 1,
                'food_class_id' => 5,
                'amount' => 2,
            ],
            [
                'package_id' => 1,
                'food_class_id' => 6,
                'amount' => 1,
            ],

            // Menu 2
            [
                'package_id' => 2,
                'food_class_id' => 1,
                'amount' => 3,
            ],
            [
                'package_id' => 2,
                'food_class_id' => 2,
                'amount' => 3,
            ],
            [
                'package_id' => 2,
                'food_class_id' => 3,
                'amount' => 2,
            ],
            [
                'package_id' => 2,
                'food_class_id' => 4,
                'amount' => 1,
            ],
            [
                'package_id' => 2,
                'food_class_id' => 5,
                'amount' => 2,
            ],
            [
                'package_id' => 2,
                'food_class_id' => 6,
                'amount' => 1,
            ],
            // Menu 3
            [
                'package_id' => 3,
                'food_class_id' => 1,
                'amount' => 4,
            ],
            [
                'package_id' => 3,
                'food_class_id' => 2,
                'amount' => 2,
            ],
            [
                'package_id' => 3,
                'food_class_id' => 3,
                'amount' => 2,
            ],
            [
                'package_id' => 3,
                'food_class_id' => 4,
                'amount' => 1,
            ],
            [
                'package_id' => 3,
                'food_class_id' => 5,
                'amount' => 2,
            ],
            [
                'package_id' => 3,
                'food_class_id' => 6,
                'amount' => 1,
            ],
            // Menu 4
            [
                'package_id' => 4,
                'food_class_id' => 1,
                'amount' => 4,
            ],
            [
                'package_id' => 4,
                'food_class_id' => 2,
                'amount' => 3,
            ],
            [
                'package_id' => 4,
                'food_class_id' => 3,
                'amount' => 2,
            ],
            [
                'package_id' => 4,
                'food_class_id' => 4,
                'amount' => 1,
            ],
            [
                'package_id' => 4,
                'food_class_id' => 5,
                'amount' => 2,
            ],
            [
                'package_id' => 4,
                'food_class_id' => 6,
                'amount' => 1,
            ],
        ];

        DB::table('food_class_package')->insert($foodClassPackage);
    }
}
