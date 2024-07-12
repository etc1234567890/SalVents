<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'bio' => fake()->text(50),
            'location' => fake()->country(),
            'birthdate' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'profile_pic' => fake()->uuid(),
            'wallpaper'=> fake()->uuid(),
        ];
    }
}
