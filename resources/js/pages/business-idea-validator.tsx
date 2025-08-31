import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

interface RecentIdea {
    id: number;
    title: string;
    score: number;
    date: string;
}

interface Props {
    recentIdeas: RecentIdea[];
    [key: string]: unknown;
}

export default function BusinessIdeaValidator({ recentIdeas }: Props) {
    const [isAnalyzing, setIsAnalyzing] = useState(false);
    
    const { data, setData, post, processing, errors, reset } = useForm({
        title: '',
        description: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        setIsAnalyzing(true);
        
        post(route('business-ideas.store'), {
            preserveState: false,
            onFinish: () => {
                setIsAnalyzing(false);
                reset();
            },
        });
    };

    const getScoreColor = (score: number) => {
        if (score >= 8) return 'text-green-600 bg-green-100';
        if (score >= 6) return 'text-yellow-600 bg-yellow-100';
        return 'text-red-600 bg-red-100';
    };

    return (
        <>
            <Head title="Business Idea Validator - AI-Powered Analysis" />
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <div className="bg-white shadow-sm dark:bg-gray-800 dark:shadow-gray-700/50">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                        <div className="flex items-center justify-between">
                            <div className="flex items-center space-x-3">
                                <span className="text-3xl">🚀</span>
                                <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                                    Business Idea Validator
                                </h1>
                            </div>
                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                AI-Powered Business Analysis
                            </div>
                        </div>
                    </div>
                </div>

                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div className="grid lg:grid-cols-3 gap-8">
                        {/* Main Form */}
                        <div className="lg:col-span-2">
                            <div className="bg-white rounded-xl shadow-lg p-6 dark:bg-gray-800 dark:shadow-gray-700/50" id="validator">
                                <div className="mb-6">
                                    <h2 className="text-2xl font-bold text-gray-900 mb-2 dark:text-white">
                                        📝 Describe Your Business Idea
                                    </h2>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Share your business concept and get comprehensive AI analysis 
                                        covering market demand, feasibility, profitability, and more.
                                    </p>
                                </div>

                                <form onSubmit={handleSubmit} className="space-y-6">
                                    <div>
                                        <label htmlFor="title" className="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">
                                            💡 Business Idea Title (Optional)
                                        </label>
                                        <input
                                            type="text"
                                            id="title"
                                            value={data.title}
                                            onChange={(e) => setData('title', e.target.value)}
                                            placeholder="e.g., Social Network for Dog Owners"
                                            className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                            disabled={processing || isAnalyzing}
                                        />
                                        {errors.title && (
                                            <p className="mt-2 text-sm text-red-600">{errors.title}</p>
                                        )}
                                    </div>

                                    <div>
                                        <label htmlFor="description" className="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">
                                            📋 Detailed Description <span className="text-red-500">*</span>
                                        </label>
                                        <textarea
                                            id="description"
                                            value={data.description}
                                            onChange={(e) => setData('description', e.target.value)}
                                            rows={6}
                                            placeholder="Describe your business idea in detail. Include what problem it solves, who your target audience is, how it works, and what makes it unique. The more detail you provide, the better the AI analysis will be. (Minimum 50 characters)"
                                            className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                            disabled={processing || isAnalyzing}
                                        />
                                        <div className="flex justify-between items-center mt-2">
                                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                                {data.description.length}/2000 characters
                                                {data.description.length < 50 && (
                                                    <span className="text-red-500 ml-2">
                                                        (Minimum 50 characters required)
                                                    </span>
                                                )}
                                            </div>
                                        </div>
                                        {errors.description && (
                                            <p className="mt-2 text-sm text-red-600">{errors.description}</p>
                                        )}
                                    </div>

                                    <div className="bg-indigo-50 rounded-lg p-4 dark:bg-indigo-900/20">
                                        <h4 className="font-medium text-indigo-900 mb-2 dark:text-indigo-300">
                                            💡 Your idea will be analyzed on:
                                        </h4>
                                        <div className="grid sm:grid-cols-2 gap-2 text-sm text-indigo-700 dark:text-indigo-300">
                                            <div>📈 Market Demand & Size</div>
                                            <div>⚙️ Technical Feasibility</div>
                                            <div>💰 Profitability Potential</div>
                                            <div>✨ Uniqueness & Innovation</div>
                                            <div>📊 Scalability</div>
                                            <div>⚠️ Risk Assessment</div>
                                        </div>
                                    </div>

                                    <Button
                                        type="submit"
                                        disabled={processing || isAnalyzing || data.description.length < 50}
                                        className="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-4 text-lg rounded-lg shadow-lg transition-all transform hover:scale-105 disabled:transform-none disabled:opacity-50"
                                    >
                                        {isAnalyzing ? (
                                            <>
                                                <div className="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-3"></div>
                                                Analyzing Your Idea...
                                            </>
                                        ) : (
                                            <>🚀 Analyze My Business Idea</>
                                        )}
                                    </Button>

                                    <p className="text-center text-sm text-gray-500 dark:text-gray-400">
                                        Analysis typically takes 2-3 seconds • Free • No account required
                                    </p>
                                </form>
                            </div>
                        </div>

                        {/* Sidebar */}
                        <div className="space-y-6">
                            {/* Recent Analyses */}
                            {recentIdeas.length > 0 && (
                                <div className="bg-white rounded-xl shadow-lg p-6 dark:bg-gray-800 dark:shadow-gray-700/50">
                                    <h3 className="text-xl font-bold text-gray-900 mb-4 dark:text-white">
                                        📊 Recent Analyses
                                    </h3>
                                    <div className="space-y-3">
                                        {recentIdeas.map((idea) => (
                                            <div key={idea.id} className="flex items-center justify-between p-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                                                <div className="flex-1 min-w-0">
                                                    <p className="font-medium text-gray-900 truncate dark:text-white">
                                                        {idea.title}
                                                    </p>
                                                    <p className="text-sm text-gray-500 dark:text-gray-400">
                                                        {idea.date}
                                                    </p>
                                                </div>
                                                <div className={`px-2 py-1 rounded-full text-xs font-semibold ${getScoreColor(idea.score)}`}>
                                                    {idea.score}/10
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            )}

                            {/* Tips */}
                            <div className="bg-white rounded-xl shadow-lg p-6 dark:bg-gray-800 dark:shadow-gray-700/50">
                                <h3 className="text-xl font-bold text-gray-900 mb-4 dark:text-white">
                                    💡 Pro Tips
                                </h3>
                                <div className="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                                    <div className="flex items-start space-x-2">
                                        <span className="text-green-500 font-semibold">✓</span>
                                        <span>Be specific about your target audience and the problem you're solving</span>
                                    </div>
                                    <div className="flex items-start space-x-2">
                                        <span className="text-green-500 font-semibold">✓</span>
                                        <span>Explain your unique value proposition and competitive advantages</span>
                                    </div>
                                    <div className="flex items-start space-x-2">
                                        <span className="text-green-500 font-semibold">✓</span>
                                        <span>Include details about your business model and revenue streams</span>
                                    </div>
                                    <div className="flex items-start space-x-2">
                                        <span className="text-green-500 font-semibold">✓</span>
                                        <span>Mention any technology, resources, or partnerships needed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}