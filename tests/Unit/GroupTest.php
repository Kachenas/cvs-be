<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GroupTest extends TestCase
{
    const USER_URL = '/api';
    const MIN_NUMBER = 1;
    const MAX_NUMBER = 10;
    /**
     * A basic feature test example.
     */
    public function test_create_group()
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

        $response = $this->postJson('/api/super-admin/create-group', [
            'group_name' => $this->faker->firstName(),
            'group_admin_id' => $this->faker->numberBetween(self::MIN_NUMBER, self::MAX_NUMBER), 
            'email' => $this->faker->email(), 
        ]);
      
        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);
    }

    public function test_retrieve_group()
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

        $response = $this->post('/api/super-admin/view-groups');

        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);
    }

    public function test_update_group()
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

        $response = $this->postJson('/api/super-admin/update-group', [
            'id' => $this->faker->numberBetween(self::MIN_NUMBER, self::MAX_NUMBER),
            'group_name' => $this->faker->firstName(),
            'group_admin_id' => $this->faker->numberBetween(self::MIN_NUMBER, self::MAX_NUMBER), 
            'email' => $this->faker->email(), 
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);

    }

    public function test_delete_group()
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

        $response = $this->postJson('/api/super-admin/delete-group', [
            'id' => $this->faker->numberBetween(self::MIN_NUMBER, self::MAX_NUMBER)
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['code', 'message', 'result']);
    }
}
