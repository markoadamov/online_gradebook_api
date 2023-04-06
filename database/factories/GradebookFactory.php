<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gradebook>
 */
class GradebookFactory extends Factory
{
    private static $userIndex = -1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        self::$userIndex++;

        return [
            'name' => $this->faker->name(),
            'user_id' => $userIds[self::$userIndex],
        ];
    }
}
