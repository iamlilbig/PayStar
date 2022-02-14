<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Credential>
 */
class CredentialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bank' => $this->getBank(),
            'shaba_id' => 'IR'.rand(11111111111,99999999999).rand(1111111111111,9999999999999),
            'card_id' => rand(1111111111111111,9999999999999999),
            'account_id' => rand(1111111111111,9999999999999),
            'expire_time' => '04-04',
        ];
    }

    private function getBank(): string
    {
        $banks = ['Keshavarzi','Ayandeh','Parsian'];
        return $banks[rand(0,2)];
    }
}
