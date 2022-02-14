<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => rand(10000,99999999),
            'description' => Str::random(30),
            'destination_firstname' => Str::random(rand(3,33)),
            'destination_lastname' => Str::random(rand(3,33)),
            'deposit' => rand(1111111111111,9999999999999),
            'source_firstname' => Str::random(rand(3,32)),
            'source_lastname' => Str::random(rand(3,32)),
            'payment_number' => rand(0,9999999999999999),
            'reason_description' => Str::random(64),
            'second_password' => rand(111111,999999),
            'destination_number' => rand(1111111111111,9999999999999),
        ];
    }
}
