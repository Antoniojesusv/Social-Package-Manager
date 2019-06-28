<?php

use Illuminate\Database\Seeder;

class SocialPackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socialpackages')->insert([
            'id' => 1,
            'name' => 'Kindergarten Pepe',
            'description' => 'Description of Kindergarten Pepe',
            'startDate' => '2019-05-01',
            'endDate' => '2019-05-02',
            'amount' => 100.5
        ]);

        DB::table('socialpackages')->insert([
            'id' => 2,
            'name' => 'Restaurant Tickets Blue Sea',
            'description' => 'Description of Restaurant Tickets Blue Sea',
            'startDate' => '2019-05-02',
            'endDate' => '2019-05-03',
            'amount' => 30.4
        ]);

        DB::table('socialpackages')->insert([
            'id' => 3,
            'name' => 'Hairdresser Tickets',
            'description' => 'Description of Hairdresser Tickets',
            'startDate' => '2019-05-02',
            'endDate' => '2019-05-03',
            'amount' => 20.4
        ]);

        DB::table('socialpackages')->insert([
            'id' => 4,
            'name' => 'Coffe Tickets',
            'description' => 'Description of Coffe Tickets',
            'startDate' => '2019-10-20',
            'endDate' => '2020-10-20',
            'amount' => 5.3
        ]);

        DB::table('socialpackages')->insert([
            'id' => 5,
            'name' => 'Bakery Tickets',
            'description' => 'Description of Bakery Tickets',
            'startDate' => '2019-04-02',
            'endDate' => '2020-04-02',
            'amount' => 0.62
        ]);

        DB::table('socialpackages')->insert([
            'id' => 6,
            'name' => 'Bookstore Tickets',
            'description' => 'Description of Bookstore Tickets',
            'startDate' => '2019-08-02',
            'endDate' => '2020-08-02',
            'amount' => 20.4
        ]);
    }
}
