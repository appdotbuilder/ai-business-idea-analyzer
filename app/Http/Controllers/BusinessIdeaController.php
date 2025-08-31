<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessIdeaRequest;
use App\Models\BusinessIdea;
use App\Services\BusinessIdeaAnalysisService;
use Inertia\Inertia;

class BusinessIdeaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param BusinessIdeaAnalysisService $analysisService
     */
    public function __construct(
        private BusinessIdeaAnalysisService $analysisService
    ) {}

    /**
     * Display the main business idea validation page.
     */
    public function index()
    {
        $recentIdeas = BusinessIdea::where('status', 'completed')
            ->latest()
            ->limit(5)
            ->get(['id', 'title', 'overall_score', 'created_at'])
            ->map(function ($idea) {
                return [
                    'id' => $idea->id,
                    'title' => $idea->title ?: 'Untitled Idea',
                    'score' => $idea->overall_score,
                    'date' => $idea->created_at->format('M j, Y'),
                ];
            });

        return Inertia::render('business-idea-validator', [
            'recentIdeas' => $recentIdeas,
        ]);
    }

    /**
     * Store a new business idea and analyze it.
     */
    public function store(StoreBusinessIdeaRequest $request)
    {
        // Create the business idea
        $businessIdea = BusinessIdea::create([
            'description' => $request->validated()['description'],
            'title' => $request->validated()['title'],
            'status' => 'analyzing',
        ]);

        // Analyze the business idea
        $analysis = $this->analysisService->analyze($businessIdea);
        $overallScore = $this->analysisService->calculateOverallScore($analysis);

        // Update with analysis results
        $businessIdea->update([
            'analysis' => $analysis,
            'overall_score' => $overallScore,
            'status' => 'completed',
        ]);

        return Inertia::render('business-idea-result', [
            'businessIdea' => [
                'id' => $businessIdea->id,
                'title' => $businessIdea->title ?: 'Your Business Idea',
                'description' => $businessIdea->description,
                'overall_score' => $businessIdea->overall_score,
                'analysis' => $businessIdea->analysis,
                'created_at' => $businessIdea->created_at->format('F j, Y \a\t g:i A'),
            ],
        ]);
    }

    /**
     * Display a specific business idea analysis.
     */
    public function show(BusinessIdea $businessIdea)
    {
        if ($businessIdea->status !== 'completed') {
            return redirect()->route('home')
                ->with('error', 'This business idea analysis is not yet complete.');
        }

        return Inertia::render('business-idea-result', [
            'businessIdea' => [
                'id' => $businessIdea->id,
                'title' => $businessIdea->title ?: 'Business Idea Analysis',
                'description' => $businessIdea->description,
                'overall_score' => $businessIdea->overall_score,
                'analysis' => $businessIdea->analysis,
                'created_at' => $businessIdea->created_at->format('F j, Y \a\t g:i A'),
            ],
        ]);
    }
}