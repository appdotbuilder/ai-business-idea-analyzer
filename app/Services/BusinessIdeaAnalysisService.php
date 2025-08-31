<?php

namespace App\Services;

use App\Models\BusinessIdea;

/**
 * Service class for analyzing business ideas using AI-powered evaluation.
 *
 * This service provides comprehensive analysis of business ideas across multiple
 * criteria including market demand, feasibility, profitability, uniqueness,
 * scalability, and risk assessment.
 */
class BusinessIdeaAnalysisService
{
    /**
     * Analyze a business idea and return structured feedback.
     *
     * @param BusinessIdea $businessIdea
     * @return array
     */
    public function analyze(BusinessIdea $businessIdea): array
    {
        // Simulate AI analysis - in a real app, this would call an AI service
        $description = strtolower($businessIdea->description);
        
        // Extract keywords to tailor analysis
        $keywords = $this->extractKeywords($description);
        
        return [
            'market_demand' => $this->analyzeMarketDemand($description, $keywords),
            'feasibility' => $this->analyzeFeasibility($description, $keywords),
            'profitability' => $this->analyzeProfitability($description, $keywords),
            'uniqueness' => $this->analyzeUniqueness($description, $keywords),
            'scalability' => $this->analyzeScalability($description, $keywords),
            'risk_assessment' => $this->analyzeRiskAssessment($description, $keywords),
            'recommendations' => $this->generateRecommendations($description, $keywords),
        ];
    }

    /**
     * Extract relevant keywords from the business idea description.
     *
     * @param string $description The business idea description text
     * @return array<string, bool> Array of keyword categories and their presence
     */
    protected function extractKeywords(string $description): array
    {
        $techKeywords = ['app', 'ai', 'platform', 'software', 'digital', 'online', 'mobile', 'web', 'saas', 'api'];
        $serviceKeywords = ['service', 'consulting', 'coaching', 'training', 'support', 'maintenance'];
        $productKeywords = ['product', 'goods', 'merchandise', 'item', 'subscription', 'box'];
        $socialKeywords = ['social', 'community', 'network', 'connect', 'share', 'collaborate'];
        
        return [
            'is_tech' => $this->containsKeywords($description, $techKeywords),
            'is_service' => $this->containsKeywords($description, $serviceKeywords),
            'is_product' => $this->containsKeywords($description, $productKeywords),
            'is_social' => $this->containsKeywords($description, $socialKeywords),
        ];
    }

    /**
     * Check if text contains any of the specified keywords.
     *
     * @param string $text The text to search in
     * @param array<string> $keywords Keywords to search for
     * @return bool True if any keyword is found
     */
    protected function containsKeywords(string $text, array $keywords): bool
    {
        foreach ($keywords as $keyword) {
            if (strpos($text, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Analyze market demand for the business idea.
     *
     * @param string $description Business idea description
     * @param array<string, bool> $keywords Extracted keywords
     * @return array{score: int, pros: string[], cons: string[]} Analysis results
     */
    protected function analyzeMarketDemand(string $description, array $keywords): array
    {
        $baseScore = random_int(5, 8);
        
        $pros = ['Identifies a real market need', 'Target audience is clearly defined'];
        $cons = ['Market size may be limited', 'Seasonal demand variations possible'];
        
        if ($keywords['is_tech']) {
            $baseScore += 1;
            $pros[] = 'Growing digital market demand';
        }
        
        if ($keywords['is_social']) {
            $pros[] = 'Strong network effects potential';
            $cons[] = 'User acquisition can be challenging initially';
        }
        
        return [
            'score' => min(10, $baseScore),
            'pros' => $pros,
            'cons' => $cons,
        ];
    }

    /**
     * Analyze technical and operational feasibility.
     *
     * @param string $description Business idea description
     * @param array<string, bool> $keywords Extracted keywords
     * @return array{score: int, pros: string[], cons: string[]} Analysis results
     */
    protected function analyzeFeasibility(string $description, array $keywords): array
    {
        $baseScore = random_int(6, 8);
        
        $pros = ['Clear execution path', 'Required resources are available'];
        $cons = ['Implementation complexity', 'Time to market considerations'];
        
        if ($keywords['is_tech']) {
            $cons[] = 'Technical expertise required';
            $pros[] = 'Scalable technology foundation';
        }
        
        if ($keywords['is_service']) {
            $pros[] = 'Lower initial investment required';
            $baseScore += 1;
        }
        
        return [
            'score' => min(10, $baseScore),
            'pros' => $pros,
            'cons' => $cons,
        ];
    }

    /**
     * Analyze profitability potential of the business idea.
     *
     * @param string $description Business idea description
     * @param array<string, bool> $keywords Extracted keywords
     * @return array{score: int, pros: string[], cons: string[]} Analysis results
     */
    protected function analyzeProfitability(string $description, array $keywords): array
    {
        $baseScore = random_int(5, 7);
        
        $pros = ['Multiple revenue stream opportunities', 'Scalable business model'];
        $cons = ['Customer acquisition costs', 'Competition pressure on pricing'];
        
        if (strpos($description, 'subscription') !== false) {
            $baseScore += 2;
            $pros[] = 'Recurring revenue model';
        }
        
        if ($keywords['is_product']) {
            $cons[] = 'Inventory and logistics costs';
        }
        
        return [
            'score' => min(10, $baseScore),
            'pros' => $pros,
            'cons' => $cons,
        ];
    }

    /**
     * Analyze uniqueness and innovation level of the business idea.
     *
     * @param string $description Business idea description
     * @param array<string, bool> $keywords Extracted keywords
     * @return array{score: int, pros: string[], cons: string[]} Analysis results
     */
    protected function analyzeUniqueness(string $description, array $keywords): array
    {
        $baseScore = random_int(4, 8);
        
        $pros = ['Novel approach to existing problem', 'Potential for differentiation'];
        $cons = ['Similar solutions exist', 'Easy to replicate concept'];
        
        if (strpos($description, 'ai') !== false || strpos($description, 'artificial intelligence') !== false) {
            $baseScore += 1;
            $pros[] = 'Leverages cutting-edge technology';
        }
        
        return [
            'score' => min(10, $baseScore),
            'pros' => $pros,
            'cons' => $cons,
        ];
    }

    /**
     * Analyze scalability potential of the business idea.
     *
     * @param string $description Business idea description
     * @param array<string, bool> $keywords Extracted keywords
     * @return array{score: int, pros: string[], cons: string[]} Analysis results
     */
    protected function analyzeScalability(string $description, array $keywords): array
    {
        $baseScore = random_int(6, 8);
        
        $pros = ['Digital scalability potential', 'Automation opportunities'];
        $cons = ['Quality control at scale', 'Resource constraints'];
        
        if ($keywords['is_tech']) {
            $baseScore += 1;
            $pros[] = 'Technology enables rapid scaling';
        }
        
        if ($keywords['is_service'] && !$keywords['is_tech']) {
            $baseScore -= 1;
            $cons[] = 'Human resource scaling challenges';
        }
        
        return [
            'score' => min(10, $baseScore),
            'pros' => $pros,
            'cons' => $cons,
        ];
    }

    /**
     * Analyze risk profile and potential challenges.
     *
     * @param string $description Business idea description
     * @param array<string, bool> $keywords Extracted keywords
     * @return array{score: int, pros: string[], cons: string[]} Analysis results
     */
    protected function analyzeRiskAssessment(string $description, array $keywords): array
    {
        $baseScore = random_int(5, 8);
        
        $pros = ['Manageable risk profile', 'Clear mitigation strategies'];
        $cons = ['Market uncertainty', 'Competitive threats'];
        
        if ($keywords['is_tech']) {
            $cons[] = 'Technology obsolescence risk';
            $cons[] = 'Development timeline risks';
        }
        
        return [
            'score' => min(10, $baseScore),
            'pros' => $pros,
            'cons' => $cons,
        ];
    }

    /**
     * Generate specific recommendations for the business idea.
     *
     * @param string $description Business idea description
     * @param array<string, bool> $keywords Extracted keywords
     * @return string[] List of actionable recommendations
     */
    protected function generateRecommendations(string $description, array $keywords): array
    {
        $recommendations = [
            'Conduct detailed market research to validate demand',
            'Create a minimum viable product (MVP) to test core assumptions',
            'Develop a comprehensive business plan with financial projections',
        ];
        
        if ($keywords['is_tech']) {
            $recommendations[] = 'Build a technical prototype to validate feasibility';
            $recommendations[] = 'Consider patent protection for unique innovations';
        }
        
        if ($keywords['is_social']) {
            $recommendations[] = 'Focus on building an initial community of engaged users';
            $recommendations[] = 'Develop viral growth mechanisms';
        }
        
        if (strpos($description, 'subscription') !== false) {
            $recommendations[] = 'Design strong customer retention and churn reduction strategies';
        }
        
        return $recommendations;
    }

    /**
     * Calculate overall score based on individual criterion scores.
     *
     * @param array<string, mixed> $analysis The complete analysis results
     * @return float The weighted overall score (0.0 to 10.0)
     */
    public function calculateOverallScore(array $analysis): float
    {
        $weights = [
            'market_demand' => 0.25,
            'feasibility' => 0.20,
            'profitability' => 0.20,
            'uniqueness' => 0.15,
            'scalability' => 0.15,
            'risk_assessment' => 0.05,
        ];
        
        $weightedSum = 0;
        
        foreach ($weights as $criterion => $weight) {
            if (isset($analysis[$criterion]['score'])) {
                $weightedSum += $analysis[$criterion]['score'] * $weight;
            }
        }
        
        return round($weightedSum, 1);
    }
}