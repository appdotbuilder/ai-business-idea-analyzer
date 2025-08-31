<?php

namespace Database\Seeders;

use App\Models\BusinessIdea;
use Illuminate\Database\Seeder;

class BusinessIdeaSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create some sample business ideas with completed analyses
        BusinessIdea::factory()
            ->count(8)
            ->create([
                'status' => 'completed'
            ]);
            
        // Create a few pending/analyzing ideas for variety
        BusinessIdea::factory()
            ->pending()
            ->count(2)
            ->create();
    }
}