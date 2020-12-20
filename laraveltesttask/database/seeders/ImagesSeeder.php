<?php

namespace Database\Seeders;

use App\Models\Images;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Images::factory()
        ->times(5)
        ->create();
    }
}
