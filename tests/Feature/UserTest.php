<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_forbidden()
    {
        $response = $this->get('/api/v1/user/',['token'=>111]);

        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "status",
        ]);

        $response->assertStatus(403);
    }

    public function test_register()
    {
        $response = $this->postJson('/api/v1/register',['name'=>Str::random(16),'email'=>Str::random(20).'@gmail.com','password'=>'password']);

        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data"=> [
                "id",
                "name",
                "email",
                "token",
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $name = Str::random(16);
        $this->postJson('/api/v1/register',['email'=>$name.'@example.com','name'=>$name,'password'=>'password']);
        $response = $this->postJson('/api/v1/login',['email'=>$name.'@example.com','password'=>'password']);

        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data"=> [
                "id",
                "name",
                "email",
                "token",
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_information()
    {
        $user = User::factory()->create();
        $response = $this->get('/api/v1/user',['token'=>$user->token]);

        //Get data Test
        $response->assertJsonStructure([
            "massage",
            "data"=> [
                "id",
                "name",
                "email",
                "token",
            ]
        ]);

        $response->assertStatus(200);
    }
}
