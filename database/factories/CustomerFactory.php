<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arResult = [
            'name' => fake()->name()
        ];

        switch (rand(1, 3)) {
            case 1:
                $arResult['email'] = fake()->unique()->safeEmail();
                break;
            case 2:
                $arResult['phone'] = '+' . fake()->randomNumber(6, true) . fake()->randomNumber(6, true);
                break;
            case 3:
                $arResult['email'] = fake()->unique()->safeEmail();
                $arResult['phone'] = '+' . fake()->randomNumber(6, true) . fake()->randomNumber(6, true);
                break;
        }

        return $arResult;
    }
}
