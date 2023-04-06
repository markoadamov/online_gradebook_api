<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    private static $imageUrlNumber = 0;
    private static $gradebookIndex = -1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        self::$imageUrlNumber++;
        self::$gradebookIndex++;
        $gradebookIds = DB::table('gradebooks')->pluck('id')->toArray();

        if(self::$gradebookIndex === count($gradebookIds))
        {
            self::$gradebookIndex = 0;
        }

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gradebook_id' => $gradebookIds[self::$gradebookIndex],
            'image_url' => "https://randomuser.me/api/portraits/men/" . self::$imageUrlNumber . ".jpg",
        ];
    }
}
