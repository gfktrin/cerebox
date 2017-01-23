<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Cerebox\Product::truncate();

        \Cerebox\Product::create([
            'name' => 'Inscrição',
            'price' => 15
        ]);
    }
}
