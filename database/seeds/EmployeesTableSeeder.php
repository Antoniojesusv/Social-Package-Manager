<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
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
            'name' => 'Antonio',
            'email' => 'Antonio.Vazquez@gmail.com',
            'password' => '$2y$10$3DxB9OqKKxA/qTJAjjZH3ud4Dg4rPfvUtjwAh4o52EOIUxozX4iRG'
        ]);

        DB::table('employees')->insert([
            'id' => 5,
            'name' => 'Fernando',
            'email' => 'Fernando.Garcia@voiceworks.com',
            'password' => '$2y$10$3DxB9OqKKxA/qTJAjjZH3ud4Dg4rPfvUtjwAh4o52EOIUxozX4iRG'
        ]);

        DB::table('employees')->insert([
            'id' => 6,
            'name' => 'Pedro',
            'email' => 'Pedro.Alcantara@voiceworks.com',
            'password' => '$2y$10$3DxB9OqKKxA/qTJAjjZH3ud4Dg4rPfvUtjwAh4o52EOIUxozX4iRG'
        ]);
    }
}
