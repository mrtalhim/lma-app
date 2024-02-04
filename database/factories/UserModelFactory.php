<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserModelFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'aims' => fake()->unique()->safeEmail(),
            'badan' => $this->faker->randomElement([
                'Khuddam',
                'Lajnah',
                'Ansharullah',
                'Abna',
                'Banath',
                'Athfal',
                'Nasirat'
            ]),
            'cabang' => $this->faker->randomElement([
                'Kawalu',
                'Tangerang',
                'Tasikmalaya',
                'Bandung Tengah'
            ]),
            'is_musi' => $this->faker->randomElement([0,1]),
            'wasiyat_type' => function ($faker, $model) {
                if (!$model->is_musi) {
                    return 0;
                }

                return $faker->randomElement([1,2,3]);
            },

        ];
    }
}
