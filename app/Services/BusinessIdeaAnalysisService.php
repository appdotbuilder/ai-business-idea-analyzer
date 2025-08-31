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
        
        // Perform individual analyses
        $marketDemand = $this->analyzeMarketDemand($description, $keywords);
        $feasibility = $this->analyzeFeasibility($description, $keywords);
        $profitability = $this->analyzeProfitability($description, $keywords);
        $uniqueness = $this->analyzeUniqueness($description, $keywords);
        $scalability = $this->analyzeScalability($description, $keywords);
        $riskAssessment = $this->analyzeRiskAssessment($description, $keywords);
        
        // Generate score-based recommendations
        $scores = [
            'market_demand' => $marketDemand['score'],
            'feasibility' => $feasibility['score'],
            'profitability' => $profitability['score'],
            'uniqueness' => $uniqueness['score'],
            'scalability' => $scalability['score'],
            'risk_assessment' => $riskAssessment['score'],
        ];
        
        return [
            'market_demand' => $marketDemand,
            'feasibility' => $feasibility,
            'profitability' => $profitability,
            'uniqueness' => $uniqueness,
            'scalability' => $scalability,
            'risk_assessment' => $riskAssessment,
            'recommendations' => $this->generateRecommendations($description, $keywords, $scores),
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
     * Generate specific recommendations for the business idea based on analysis scores.
     *
     * @param string $description Business idea description
     * @param array<string, bool> $keywords Extracted keywords
     * @param array<string, int> $scores Analysis scores for each criterion
     * @return string[] List of actionable recommendations
     */
    protected function generateRecommendations(string $description, array $keywords, array $scores): array
    {
        $recommendations = [];
        
        // Score-based specific recommendations
        if ($scores['market_demand'] < 5) {
            $recommendations[] = 'Conduct extensive market research to identify target demographics and validate actual market demand for your solution';
            $recommendations[] = 'Survey potential customers to understand their pain points and willingness to pay';
            $recommendations[] = 'Analyze competitor products and identify gaps in the current market offerings';
        } elseif ($scores['market_demand'] >= 8) {
            $recommendations[] = 'Leverage the strong market demand by accelerating your go-to-market strategy';
            $recommendations[] = 'Consider expanding to adjacent markets with similar demand patterns';
        }
        
        if ($scores['feasibility'] < 5) {
            $recommendations[] = 'Develop a detailed technical roadmap breaking down implementation into manageable phases';
            $recommendations[] = 'Create a proof-of-concept to validate the most challenging technical assumptions';
            $recommendations[] = 'Identify key technical partners or hire specialized talent to address feasibility gaps';
        } elseif ($scores['feasibility'] >= 8) {
            $recommendations[] = 'Fast-track development given the high feasibility - consider agile development methodologies';
        }
        
        if ($scores['profitability'] < 5) {
            $recommendations[] = 'Re-evaluate your revenue model and explore diverse pricing strategies (freemium, subscription, usage-based)';
            $recommendations[] = 'Conduct detailed cost analysis to identify areas for optimization and margin improvement';
            $recommendations[] = 'Consider strategic partnerships that could reduce costs or increase revenue potential';
        } elseif ($scores['profitability'] >= 8) {
            $recommendations[] = 'Maximize the strong profitability potential by optimizing your pricing strategy and cost structure';
        }
        
        if ($scores['uniqueness'] < 5) {
            $recommendations[] = 'Innovate on existing solutions by adding unique features or pivot to a more distinct value proposition';
            $recommendations[] = 'Focus on superior execution and customer experience as differentiators';
            $recommendations[] = 'Consider targeting a specific niche market where you can establish a unique position';
        } elseif ($scores['uniqueness'] >= 8) {
            $recommendations[] = 'Protect your unique advantages through patents, trade secrets, or first-mover advantage';
            $recommendations[] = 'Build strong brand recognition around your innovative approach';
        }
        
        if ($scores['scalability'] < 5) {
            $recommendations[] = 'Design a scalable infrastructure and operational plan for future growth from day one';
            $recommendations[] = 'Identify key bottlenecks that could limit scaling and develop solutions early';
            $recommendations[] = 'Consider automation opportunities to reduce human dependency as you scale';
        } elseif ($scores['scalability'] >= 8) {
            $recommendations[] = 'Prepare for rapid scaling by building robust systems and processes that can handle growth';
            $recommendations[] = 'Consider geographic expansion strategies to leverage your scalability advantages';
        }
        
        if ($scores['risk_assessment'] > 7) {
            $recommendations[] = 'Identify and actively mitigate key risks - consider starting with a smaller pilot program to reduce exposure';
            $recommendations[] = 'Develop contingency plans for major risk scenarios (technical failures, market changes, competition)';
            $recommendations[] = 'Consider diversifying your approach or building in flexibility to pivot if needed';
        } elseif ($scores['risk_assessment'] <= 3) {
            $recommendations[] = 'Take advantage of the low-risk profile by being more aggressive in your market entry strategy';
        }
        
        // Add general foundational recommendations
        $specificRecommendationCount = count($recommendations);
        
        if ($specificRecommendationCount > 0) {
            $recommendations[] = 'Create a minimum viable product (MVP) to test and validate your improvements';
        } else {
            $recommendations[] = 'Create a minimum viable product (MVP) to test core assumptions with real users';
            $recommendations[] = 'Develop a comprehensive business plan with detailed financial projections';
        }
        
        // Add keyword-based contextual recommendations
        if ($keywords['is_tech']) {
            if ($scores['feasibility'] < 6) {
                $recommendations[] = 'Build a technical prototype focusing on the core functionality before adding advanced features';
            }
            if ($scores['uniqueness'] >= 7) {
                $recommendations[] = 'Consider patent protection for your unique technical innovations';
            }
        }
        
        if ($keywords['is_social']) {
            if ($scores['market_demand'] >= 6) {
                $recommendations[] = 'Focus on building an initial community of highly engaged users who can drive viral growth';
                $recommendations[] = 'Develop network effects and viral growth mechanisms to leverage social dynamics';
            }
        }
        
        if ($keywords['is_service']) {
            if ($scores['scalability'] < 6) {
                $recommendations[] = 'Standardize your service delivery processes and create training materials for easier scaling';
            }
        }
        
        if (strpos($description, 'subscription') !== false) {
            if ($scores['profitability'] >= 6) {
                $recommendations[] = 'Design strong customer retention strategies and churn reduction programs to maximize lifetime value';
            }
        }
        
        return array_unique($recommendations);
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