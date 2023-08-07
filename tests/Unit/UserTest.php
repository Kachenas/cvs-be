<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
//use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserTest extends TestCase
{


    const USER_URL = '/api';
    const MIN_NUMBER = 1;
    const MAX_NUMBER = 10;

    /**
     *
     *
     * @test - for register
     */
    public function test_endpoint_register()
    {
        $response = $this->postJson('/api/user/register', [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(), 
            'last_name' => $this->faker->lastName(), 
            'email' => $this->faker->email(), 
            'password' => 'samplePassword90',
        ]);
        // dd($response);
        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);
    }

    /**
     *
     *
     * @test - for login
     */
    public function test_endpoint_login()
    {

        $response = $this->post(self::USER_URL."/user/login", [
            'email' => 'almonte.s.chester@gmail.com',
            'password' => 'samplePassword90',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);
    }

    /* 

    Starting test for Regular Users
    1. Generate Vouchers
    2. View Vouchers
    3. Delete Voucher
    
    */

    public function test_endpoint_generate_voucher()
    {

        $user = User::create([
            'first_name' => $this->faker->firstName(), 
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(), 
            'user_role' => '1', 
            'group_id' => $this->faker->numberBetween(self::MIN_NUMBER, self::MAX_NUMBER), 
            'email_verified_at' => now(),
            'password' => Hash::make('samplePassword90'), 
            'remember_token' => Str::random(10)
        ]);

        Passport::actingAs($user);

        $response = $this->post('/api/regular-user/generate');
        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);

    }

    public function test_endpoint_view_vouchers()
    {

        $user = User::create([
            'first_name' => $this->faker->firstName(), 
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(), 
            'user_role' => '1', 
            'group_id' => $this->faker->numberBetween(self::MIN_NUMBER, self::MAX_NUMBER), 
            'email_verified_at' => now(),
            'password' => Hash::make('samplePassword90'), 
            'remember_token' => Str::random(10)
        ]);

        Passport::actingAs($user);

        $response = $this->post('/api/regular-user/show');
        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);

    }

    /* 

    Starting test for Admin Users
    1. Generate Vouchers
    2. View Vouchers
    3. Delete Voucher
    
    */


    /**
     *
     *
     * @test - for view users
     */
    public function test_endpoint_view_users()
    {

        $user = User::create([
            'first_name' => $this->faker->firstName(), 
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(), 
            'user_role' => '3', 
            'group_id' => $this->faker->numberBetween(self::MIN_NUMBER, self::MAX_NUMBER), 
            'email_verified_at' => now(),
            'password' => Hash::make('samplePassword90'), 
            'remember_token' => Str::random(10)
        ]);

        Passport::actingAs($user);

        $response = $this->post('/api/super-admin/view-users');
        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);

    }

   
}
