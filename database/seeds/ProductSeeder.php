<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        DB::table('products')->insert([
            'name' => 'Maritime Law',
            'description' => 'Take to the sea!',
            'price' => 10.00,
            'image' => '',
        ]);

        DB::table('products')->insert([
            'name' => 'Marriage Law',
            'description' => 'Husbands and wives can not be tried for the same crime',
            'price' => 20.00,
            'image' => '',
        ]);

        DB::table('products')->insert([
            'name' => 'Plea Bargains',
            'description' => 'Have you read it yet, and should you take it?',
            'price' => 15.00,
            'image' => '',
        ]);

        DB::table('products')->insert([
            'name' => 'International Law',
            'description' => 'Is your client potentially at risk for some light treason?',
            'price' => 50.00,
            'image' => '',
        ]);

        DB::table('products')->insert([
            'name' => 'Professionalism',
            'description' => 'What is the one word clients would use to describe you',
            'price' => 50.00,
            'image' => '',
        ]);

        $this->command->info('Products table seeded!');
    }
}
