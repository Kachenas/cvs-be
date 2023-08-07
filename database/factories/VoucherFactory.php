<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Voucher;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minNumber = 1;
        $maxNumber = 10;

        return [
            'user_id' => $this->faker->numberBetween($minNumber, $maxNumber), 
            'group_id' => $this->faker->numberBetween($minNumber, $maxNumber), 
            'voucher_code' => Str::random(16)
        ];
    }
}
