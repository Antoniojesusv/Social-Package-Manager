<?php

use Illuminate\Database\Seeder;

class FakeEmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'id' => 2,
            'name' => 'abc',
            'email' => 'Elise.Gielen@voiceworks.com',
            'password' => '$2y$10$3DxB9OqKKxA/qTJAjjZH3ud4Dg4rPfvUtjwAh4o52EOIUxozX4iRG'
        ]);

        DB::table('employees')->insert([
            'id' => 3,
            'name' => 'def',
            'email' => 'Elise.Gielen@voiceworks.com',
            'password' => '$2y$10$3DxB9OqKKxA/qTJAjjZH3ud4Dg4rPfvUtjwAh4o52EOIUxozX4iRG'
        ]);

        DB::table('employees')->insert([
            'id' => 4,
            'name' => 'ghi',
            'email' => 'Elise.Gielen@voiceworks.com',
            'password' => '$2y$10$3DxB9OqKKxA/qTJAjjZH3ud4Dg4rPfvUtjwAh4o52EOIUxozX4iRG'
        ]);

        DB::table('employees')->insert([
            'id' => 5,
            'name' => 'jkl',
            'email' => 'Elise.Gielen@voiceworks.com',
            'password' => '$2y$10$3DxB9OqKKxA/qTJAjjZH3ud4Dg4rPfvUtjwAh4o52EOIUxozX4iRG'
        ]);
    }
}
