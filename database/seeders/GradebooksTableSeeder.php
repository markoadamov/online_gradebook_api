<?php

namespace Database\Seeders;

use App\Models\Gradebook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradebooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        Gradebook::factory()->count(10)->create();
    }
}
