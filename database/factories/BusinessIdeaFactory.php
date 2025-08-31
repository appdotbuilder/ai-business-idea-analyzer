<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessIdea>
 */
class BusinessIdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ideas = [
            'A mobile app that connects dog owners for playdates and walking groups in local neighborhoods.',
            'An AI-powered meal planning service that creates shopping lists and recipes based on dietary restrictions and preferences.',
            'A subscription box service for indoor plants with care instructions and plant health monitoring tools.',
            'A platform for freelance developers to find short-term coding projects and collaborate on open source initiatives.',
            'A virtual reality fitness app that gamifies workouts with immersive environments and multiplayer challenges.',
        ];

        $titles = [
            'PupPlay - Dog Social Network',
            'MealMind AI',
            'PlantBox Subscription',
            'DevConnect Platform',
            'FitVR Gaming',
        ];

        $sampleAnalysis = [
            'market_demand' => [
                'score' => fake()->numberBetween(6, 9),
                'pros' => ['Growing pet industry', 'Strong community aspect', 'High user engagement potential'],
                'cons' => ['Seasonal variations', 'Local market dependency'],
            ],
            'feasibility' => [
                'score' => fake()->numberBetween(5, 8),
                'pros' => ['Available technology', 'Clear development path'],
                'cons' => ['Location services complexity', 'User acquisition challenges'],
            ],
            'profitability' => [
                'score' => fake()->numberBetween(4, 8),
                'pros' => ['Multiple revenue streams', 'Subscription potential'],
                'cons' => ['High customer acquisition cost', 'Competitive market'],
            ],
            'uniqueness' => [
                'score' => fake()->numberBetween(5, 9),
                'pros' => ['Novel approach', 'Untapped niche'],
                'cons' => ['Easy to replicate', 'Limited differentiation'],
            ],
            'scalability' => [
                'score' => fake()->numberBetween(6, 9),
                'pros' => ['Network effects', 'Digital platform'],
                'cons' => ['Local market focus', 'Quality control challenges'],
            ],
            'risk_assessment' => [
                'score' => fake()->numberBetween(5, 8),
                'pros' => ['Low technical risk', 'Proven business model'],
                'cons' => ['Market saturation risk', 'Regulatory considerations'],
            ],
        ];

        return [
            'description' => fake()->randomElement($ideas),
            'title' => fake()->randomElement($titles),
            'analysis' => $sampleAnalysis,
            'overall_score' => fake()->randomFloat(1, 5.0, 9.0),
            'status' => fake()->randomElement(['pending', 'analyzing', 'completed']),
        ];
    }

    /**
     * Indicate that the business idea is pending analysis.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'analysis' => null,
            'overall_score' => null,
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the business idea analysis failed.
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'analysis' => null,
            'overall_score' => null,
            'status' => 'failed',
        ]);
    }
}