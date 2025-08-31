<?php

use App\Models\BusinessIdea;
use App\Services\BusinessIdeaAnalysisService;

test('home page displays business idea validator', function () {
    $response = $this->get('/');
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('business-idea-validator')
            ->has('recentIdeas')
    );
});

test('can submit business idea for analysis', function () {
    $businessIdeaData = [
        'title' => 'Dog Walking App',
        'description' => 'A mobile application that connects dog owners with professional dog walkers in their neighborhood. Users can schedule walks, track their dog\'s activity, and receive updates with photos during walks. The app includes GPS tracking, secure payments, walker ratings and reviews, and emergency contact features. Perfect for busy professionals who want to ensure their dogs get proper exercise and care.',
    ];
    
    $response = $this->post('/analyze', $businessIdeaData);
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('business-idea-result')
            ->has('businessIdea')
            ->where('businessIdea.title', 'Dog Walking App')
            ->where('businessIdea.description', $businessIdeaData['description'])
            ->has('businessIdea.overall_score')
            ->has('businessIdea.analysis')
    );
    
    $this->assertDatabaseHas('business_ideas', [
        'title' => 'Dog Walking App',
        'status' => 'completed',
    ]);
});

test('validates business idea description length', function () {
    $response = $this->post('/analyze', [
        'title' => 'Short Idea',
        'description' => 'Too short', // Less than 50 characters
    ]);
    
    $response->assertStatus(302);
    $response->assertSessionHasErrors('description');
});

test('can view completed business idea analysis', function () {
    $businessIdea = BusinessIdea::factory()->create([
        'status' => 'completed',
        'title' => 'Test Business Idea',
    ]);
    
    $response = $this->get("/idea/{$businessIdea->id}");
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('business-idea-result')
            ->where('businessIdea.id', $businessIdea->id)
            ->where('businessIdea.title', 'Test Business Idea')
    );
});

test('redirects when viewing incomplete business idea', function () {
    $businessIdea = BusinessIdea::factory()->pending()->create();
    
    $response = $this->get("/idea/{$businessIdea->id}");
    
    $response->assertRedirect('/');
    $response->assertSessionHas('error');
});

test('analysis service generates proper analysis structure', function () {
    $businessIdea = BusinessIdea::factory()->create([
        'description' => 'An AI-powered meal planning app that creates personalized shopping lists and recipes based on dietary restrictions, preferences, and nutritional goals.',
    ]);
    
    $service = new BusinessIdeaAnalysisService();
    $analysis = $service->analyze($businessIdea);
    
    expect($analysis)->toHaveKeys([
        'market_demand',
        'feasibility', 
        'profitability',
        'uniqueness',
        'scalability',
        'risk_assessment',
        'recommendations'
    ]);
    
    foreach (['market_demand', 'feasibility', 'profitability', 'uniqueness', 'scalability', 'risk_assessment'] as $criterion) {
        expect($analysis[$criterion])->toHaveKeys(['score', 'pros', 'cons']);
        expect($analysis[$criterion]['score'])->toBeBetween(1, 10);
        expect($analysis[$criterion]['pros'])->toBeArray();
        expect($analysis[$criterion]['cons'])->toBeArray();
    }
    
    expect($analysis['recommendations'])->toBeArray();
    expect(count($analysis['recommendations']))->toBeGreaterThan(0);
});

test('overall score calculation works correctly', function () {
    $service = new BusinessIdeaAnalysisService();
    
    $sampleAnalysis = [
        'market_demand' => ['score' => 8],
        'feasibility' => ['score' => 7],
        'profitability' => ['score' => 6],
        'uniqueness' => ['score' => 9],
        'scalability' => ['score' => 8],
        'risk_assessment' => ['score' => 7],
    ];
    
    $overallScore = $service->calculateOverallScore($sampleAnalysis);
    
    // Weighted calculation: 8*0.25 + 7*0.20 + 6*0.20 + 9*0.15 + 8*0.15 + 7*0.05 = 7.5
    expect($overallScore)->toBe(7.5);
});