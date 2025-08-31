import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

interface AnalysisCriterion {
    score: number;
    pros: string[];
    cons: string[];
}

interface Analysis {
    market_demand: AnalysisCriterion;
    feasibility: AnalysisCriterion;
    profitability: AnalysisCriterion;
    uniqueness: AnalysisCriterion;
    scalability: AnalysisCriterion;
    risk_assessment: AnalysisCriterion;
    recommendations: string[];
}

interface BusinessIdeaData {
    id: number;
    title: string;
    description: string;
    overall_score: number;
    analysis: Analysis;
    created_at: string;
}

interface Props {
    businessIdea: BusinessIdeaData;
    [key: string]: unknown;
}

export default function BusinessIdeaResult({ businessIdea }: Props) {
    const getScoreColor = (score: number) => {
        if (score >= 8) return 'text-green-600 bg-green-100 border-green-200';
        if (score >= 6) return 'text-yellow-600 bg-yellow-100 border-yellow-200';
        return 'text-red-600 bg-red-100 border-red-200';
    };

    const getOverallScoreColor = (score: number) => {
        if (score >= 8) return 'text-green-600';
        if (score >= 6) return 'text-yellow-600';
        return 'text-red-600';
    };

    const getScoreEmoji = (score: number) => {
        if (score >= 9) return '🏆';
        if (score >= 8) return '🌟';
        if (score >= 7) return '👍';
        if (score >= 6) return '👌';
        if (score >= 5) return '⚖️';
        return '⚠️';
    };

    const criteriaInfo = {
        market_demand: {
            title: 'Market Demand & Size',
            icon: '📈',
            description: 'How much demand exists for this solution in the market'
        },
        feasibility: {
            title: 'Technical & Operational Feasibility',
            icon: '⚙️',
            description: 'How realistic and achievable this business idea is'
        },
        profitability: {
            title: 'Profitability Potential',
            icon: '💰',
            description: 'Expected financial returns and revenue potential'
        },
        uniqueness: {
            title: 'Uniqueness & Innovation',
            icon: '✨',
            description: 'How different and innovative this idea is compared to existing solutions'
        },
        scalability: {
            title: 'Scalability',
            icon: '📊',
            description: 'Potential for growth and expansion over time'
        },
        risk_assessment: {
            title: 'Risk Assessment',
            icon: '⚠️',
            description: 'Overall risk profile and potential challenges'
        }
    };

    return (
        <>
            <Head title={`Analysis: ${businessIdea.title} - Business Idea Validator`} />
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <div className="bg-white shadow-sm dark:bg-gray-800 dark:shadow-gray-700/50">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                        <div className="flex items-center justify-between">
                            <div className="flex items-center space-x-3">
                                <Link href={route('home')} className="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">
                                    <span className="text-2xl">←</span>
                                </Link>
                                <span className="text-3xl">📊</span>
                                <div>
                                    <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                                        Analysis Results
                                    </h1>
                                    <p className="text-sm text-gray-500 dark:text-gray-400">
                                        Generated on {businessIdea.created_at}
                                    </p>
                                </div>
                            </div>
                            <Link href={route('home')}>
                                <Button className="bg-indigo-600 hover:bg-indigo-700 text-white">
                                    Analyze Another Idea
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>

                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    {/* Business Idea Summary */}
                    <div className="bg-white rounded-xl shadow-lg p-6 mb-8 dark:bg-gray-800 dark:shadow-gray-700/50">
                        <div className="flex items-center justify-between mb-6">
                            <div className="flex-1">
                                <h2 className="text-3xl font-bold text-gray-900 mb-2 dark:text-white">
                                    {businessIdea.title}
                                </h2>
                                <p className="text-gray-600 text-lg leading-relaxed dark:text-gray-300">
                                    {businessIdea.description}
                                </p>
                            </div>
                        </div>
                        
                        {/* Overall Score */}
                        <div className="border-t pt-6 mt-6 dark:border-gray-700">
                            <div className="text-center">
                                <div className="inline-flex items-center space-x-4">
                                    <div className="text-6xl">
                                        {getScoreEmoji(businessIdea.overall_score)}
                                    </div>
                                    <div>
                                        <div className={`text-5xl font-bold ${getOverallScoreColor(businessIdea.overall_score)}`}>
                                            {businessIdea.overall_score}/10
                                        </div>
                                        <p className="text-xl text-gray-600 font-medium dark:text-gray-300">
                                            Overall Validation Score
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Detailed Analysis */}
                    <div className="grid lg:grid-cols-2 gap-6 mb-8">
                        {Object.entries(criteriaInfo).map(([key, info]) => {
                            const criterion = businessIdea.analysis[key as keyof Analysis] as AnalysisCriterion;
                            
                            return (
                                <div key={key} className="bg-white rounded-xl shadow-lg p-6 dark:bg-gray-800 dark:shadow-gray-700/50">
                                    <div className="flex items-center justify-between mb-4">
                                        <div className="flex items-center space-x-3">
                                            <span className="text-2xl">{info.icon}</span>
                                            <div>
                                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {info.title}
                                                </h3>
                                                <p className="text-sm text-gray-500 dark:text-gray-400">
                                                    {info.description}
                                                </p>
                                            </div>
                                        </div>
                                        <div className={`px-3 py-1 rounded-lg border font-semibold ${getScoreColor(criterion.score)}`}>
                                            {criterion.score}/10
                                        </div>
                                    </div>

                                    <div className="grid sm:grid-cols-2 gap-4">
                                        <div>
                                            <h4 className="font-medium text-green-700 mb-2 flex items-center dark:text-green-400">
                                                <span className="mr-2">✅</span> Strengths
                                            </h4>
                                            <ul className="space-y-1">
                                                {criterion.pros.map((pro, index) => (
                                                    <li key={index} className="text-sm text-gray-600 flex items-start dark:text-gray-300">
                                                        <span className="text-green-500 mr-2 mt-0.5">•</span>
                                                        {pro}
                                                    </li>
                                                ))}
                                            </ul>
                                        </div>
                                        
                                        <div>
                                            <h4 className="font-medium text-red-700 mb-2 flex items-center dark:text-red-400">
                                                <span className="mr-2">⚠️</span> Challenges
                                            </h4>
                                            <ul className="space-y-1">
                                                {criterion.cons.map((con, index) => (
                                                    <li key={index} className="text-sm text-gray-600 flex items-start dark:text-gray-300">
                                                        <span className="text-red-500 mr-2 mt-0.5">•</span>
                                                        {con}
                                                    </li>
                                                ))}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            );
                        })}
                    </div>

                    {/* Recommendations */}
                    <div className="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                        <h3 className="text-2xl font-bold mb-4 flex items-center">
                            <span className="mr-3">🎯</span>
                            Recommended Next Steps
                        </h3>
                        <p className="mb-6 text-indigo-100">
                            Based on our analysis, here are specific actions to improve your business idea:
                        </p>
                        <div className="grid sm:grid-cols-2 gap-4">
                            {businessIdea.analysis.recommendations.map((recommendation, index) => (
                                <div key={index} className="bg-white/10 rounded-lg p-4 backdrop-blur-sm">
                                    <div className="flex items-start space-x-3">
                                        <div className="bg-white/20 rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <span className="text-sm font-bold">{index + 1}</span>
                                        </div>
                                        <p className="text-sm text-white/90">
                                            {recommendation}
                                        </p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Action Buttons */}
                    <div className="mt-8 text-center space-y-4">
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link href={route('home')}>
                                <Button className="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3">
                                    🚀 Analyze Another Idea
                                </Button>
                            </Link>
                            <Button
                                onClick={() => window.print()}
                                className="w-full sm:w-auto bg-gray-600 hover:bg-gray-700 text-white px-8 py-3"
                            >
                                🖨️ Print Report
                            </Button>
                        </div>
                        
                        <div className="text-sm text-gray-500 dark:text-gray-400">
                            <p>
                                💡 <strong>Remember:</strong> This analysis is AI-generated and should be used as a starting point 
                                for your business planning. Consider consulting with industry experts and conducting 
                                thorough market research before making investment decisions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}