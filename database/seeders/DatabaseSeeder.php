<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gradebook;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        UserTableSeeder::run();
        GradebooksTableSeeder::run();
        StudentsTableSeeder::run();

        $gradebooks = Gradebook::all();

        //Matchujem naknadno user tabelu sa generisanom gradebook tabelom
        foreach ($gradebooks as $gradebook) {
            $user = $gradebook->user;
            if ($user) {
                $user->gradebook_id = $gradebook->id;
                $user->save();
            }
        }
    }
}
