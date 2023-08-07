<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;
use App\Models\Group;
use Database\Factories\GroupFactory;
use App\Models\Voucher;
use Database\Factories\VoucherFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        Group::factory()->count(10)->create();
        Voucher::factory()->count(10)->create();
    }
}
