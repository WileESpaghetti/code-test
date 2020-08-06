<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasColumn('users', 'name')) {
            $this->command->error('Run migrations before running seeder');
            return;
        }

        DB::table('users')->insert([
            'first_name' => 'James',
            'last_name' => 'Smith',
            'email' => 'jsmith@example.com',
            'password' => Hash::make('qwerty'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Mary',
            'last_name' => 'Johnson',
            'email' => 'mjohnson@example.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'John',
            'last_name' => 'Williams',
            'email' => 'jwilliams@example.com',
            'password' => Hash::make('abc123'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Patricia',
            'last_name' => 'Brown',
            'email' => 'pbrown@example.com',
            'password' => Hash::make('iloveyou'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Robert',
            'last_name' => 'Jones',
            'email' => 'rjones@example.com',
            'password' => Hash::make('lovely'),
        ]);

        $this->command->info('User table seeded!');
    }
}
