<?php

namespace Tests\Feature;

use App\Models\Credential;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /**
     * Keshavarzi bank test.
     *
     * @return void
     */
    public function test_new_keshavarzi_payment()
    {
        $user = User::factory(1)->has(Credential::factory(1)->count(1)->state([
            'bank' => 'Keshavarzi'
        ]))->create();

        $response = $this->post('/api/v1/user/payments/',[
            'credential'=> Credential::find($user->first()->credentials->first()->id),
            'amount' => rand(10000,99999999),
            'description' => Str::random(29),
            'destination_firstname' => Str::random(rand(3,32)),
            'destination_lastname' => Str::random(rand(3,32)),
            'destination_number' => rand(1111111111111,9999999999999),
            'deposit' => $user->first()->credentials->first()->account_id,
            'source_firstname' => Str::random(rand(3,32)),
            'source_lastname' => Str::random(rand(3,32)),
        ],['token' => $user->first()->token]);

        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data" => [
                'credential',
                'id',
                'status',
                'amount',
                'description',
                'destination_firstname',
                'destination_lastname',
                'destination_number',
            ],
        ]);

        $response->assertStatus(200);
    }
    /**
     * Ayandeh bank test.
     *
     * @return void
     */
    public function test_new_ayandeh_payment()
    {
        $user = User::factory(1)->has(Credential::factory(1)->count(1)->state([
            'bank' => 'Ayandeh'
        ]))->create();

        $response = $this->post('/api/v1/user/payments/',[
            'credential'=> Credential::find($user->first()->credentials->first()->id),
            'amount' => rand(10000,99999999),
            'description' => Str::random(30),
            'destination_firstname' => Str::random(rand(3,33)),
            'destination_lastname' => Str::random(rand(3,33)),
            'destination_number' => rand(1111111111111,9999999999999),
            'payment_number' => rand(0,9999999999999999),
            'reason_description' => Str::random(64),
        ],['token' => $user->first()->token]);

        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data" => [
                'credential',
                'id',
                'status',
                'amount',
                'description',
                'destination_firstname',
                'destination_lastname',
                'destination_number',
            ],
        ]);

        $response->assertStatus(200);
    }
    /**
     * Parsian bank test.
     *
     * @return void
     */
    public function test_new_parsian_payment()
    {
        $user = User::factory(1)->has(Credential::factory()->count(1)->state([
            'bank' => 'Parsian'
        ]))->create();

        $response = $this->post('/api/v1/user/payments/',[
            'credential'=> Credential::find($user->first()->credentials->first()->id),
            'amount' => rand(10000,99999999),
            'description' => Str::random(30),
            'destination_firstname' => Str::random(rand(3,33)),
            'destination_lastname' => Str::random(rand(3,33)),
            'destination_number' => rand(1111111111111,9999999999999),
            'second_password' => rand(111111,999999),
        ],['token' => $user->first()->token]);

        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data" => [
                'credential'=>[
                    'user',
                    'bank',
                    'shaba_id',
                    'card_id',
                    'account_id',
                    'expire_time',
                ],
                'id',
                'status',
                'amount',
                'description',
                'destination_firstname',
                'destination_lastname',
                'destination_number',
            ],
        ]);

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_payments()
    {
        $user = User::factory(1)->has(Credential::factory()->count(1)->has(Payment::factory()->count(10)))->create();


        $response = $this->get('/api/v1/user/payments/',[
            'token' => $user->first()->token
        ]);



        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data" => [
                '*' =>[
                    'credential',
                    'id',
                    'status',
                    'amount',
                    'description',
                    'destination_firstname',
                    'destination_lastname',
                    'destination_number',
                ]
            ],
        ]);


        $response->assertStatus(200);
    }
}
