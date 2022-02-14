<?php

namespace Tests\Feature;

use App\Models\Credential;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CredentialTest extends TestCase
{


    public function test_store()
    {

        $response = $this->post('/api/v1/user/credentials',[
            'bank' => 'Keshavarzi',
            'shaba_id' => 'IR'.rand(11111111111,99999999999).rand(1111111111111,9999999999999),
            'card_id' => rand(1111111111111111,9999999999999999),
            'account_id' => rand(1111111111111,9999999999999),
            'expire_time' => '04-04',
        ],[
            'token' => User::factory()->create()->first()->token
        ]);

        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data" => [
                'user',
                'bank',
                'shaba_id',
                'card_id',
                'account_id',
                'expire_time',
            ],
        ]);

        $response->assertStatus(200);
    }

    public function test_list()
    {

        $user = User::factory(1)->has(Credential::factory()->count(rand(5,20)))->create();

        $response = $this->get('/api/v1/user/credentials',[
            'token' => $user->first()->token
        ]);


        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data" => [
                '*'=>[
                    'bank',
                    'shaba_id',
                    'card_id',
                    'account_id',
                    'expire_time',
                ]
            ],
        ]);

        $response->assertStatus(200);
    }

    public function test_information()
    {
        $user = User::factory(1)->has(Credential::factory()->count(rand(5,20)))->create();

        $response = $this->get('/api/v1/user/credentials/'.$user->first()->credentials->first()->id,[
            'token' => $user->first()->token
        ]);

        $response->assertJsonStructure([
            "massage",
            "data" => [
                'user',
                'bank',
                'shaba_id',
                'card_id',
                'account_id',
                'expire_time',
            ],
        ]);

        $response->assertStatus(200);
    }

    public function test_delete()
    {
        $user = User::factory(1)->has(Credential::factory()->count(rand(5,20)))->create();

        $response = $this->delete('/api/v1/user/credentials/'.$user->first()->credentials->first()->id,[],[
            'token' => $user->first()->token
        ]);

        $response->assertJsonStructure([
            "massage",
            "data",
        ]);

        $response->assertStatus(200);
    }
}
