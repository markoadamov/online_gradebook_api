<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    private static $userIndex = -1;
    private static $gradebookIndex = -1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = DB::table('users')->orderBy('id')->pluck('id')->toArray();
        $gradebookIds = DB::table('gradebooks')->orderBy('id')->pluck('id')->toArray();
        self::$userIndex++;
        self::$gradebookIndex++;

        //if (self::$gradebookIndex<count($gradebookIds)) {

            if(self::$userIndex===count($userIds))
            {
                self::$userIndex = 0;
            }
            if(self::$gradebookIndex===count($gradebookIds))
            {
                self::$gradebookIndex = 0;
            }
            return [
                'body' => $this->faker->text(20),
                'user_id' => $userIds[self::$userIndex],
                'gradebook_id' => $userIds[self::$userIndex],
            ];
    }
}
