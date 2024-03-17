<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            'mpesa',
            'bank'
        ];
        foreach ($methods as $m) {
            # code...
            $method  = new PaymentMethod();
            $method->title = $m;
            $method->save();
        }
    }
}
