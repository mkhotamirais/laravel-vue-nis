<?php

namespace Database\Factories;

use App\Models\Infocat;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Info>
 */
class InfoFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(10);

        // Ambil user_id random dari yang tersedia
        $userId = fake()->randomElement([1, 2, 3, 4, 5]);

        // Ambil hanya infocat yang dimiliki user tersebut
        $infocatId = Infocat::where('user_id', $userId)->inRandomOrder()->first()?->id;

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'user_id' => $userId,
            'infocat_id' => $infocatId,
            'tags' => fake()->randomElement([
                'html,css,js',
                'laravel,php',
                'wordpress,php',
                'angular,vue,react,js'
            ]),
            'content' => fake()->paragraphs(3, true),
        ];
    }
}
