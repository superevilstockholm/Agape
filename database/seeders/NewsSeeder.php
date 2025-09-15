<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\News;
use App\Models\User;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('Tidak ada user ditemukan. Seed user terlebih dahulu!');
            return;
        }

        News::factory()->count(100)->create([
            'user_id' => function() use ($users) {
                return $users->random()->id;
            }
        ]);
    }
}
