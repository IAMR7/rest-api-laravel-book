<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i=0; $i<10; $i++){
            DB::table('book')->insert([
                "judul" => $faker->name,
                "penulis" => $faker->name,
                "tahun" => $faker->numberBetween(2015, 2022),
                "penerbit" => $faker->name,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
