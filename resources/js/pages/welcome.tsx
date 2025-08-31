import React from 'react';
import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Business Idea Validator - AI-Powered Business Analysis">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-gradient-to-br from-blue-50 to-indigo-100 p-6 text-gray-900 lg:justify-center lg:p-8 dark:from-gray-900 dark:to-gray-800 dark:text-white">
                <header className="mb-8 w-full max-w-4xl">
                    <nav className="flex items-center justify-end gap-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="inline-block rounded-lg border border-indigo-200 bg-white px-6 py-2 text-sm font-medium text-indigo-700 shadow-sm transition hover:bg-indigo-50 hover:border-indigo-300 dark:border-gray-600 dark:bg-gray-800 dark:text-indigo-300 dark:hover:bg-gray-700"
                            >
                                Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="inline-block rounded-lg px-6 py-2 text-sm font-medium text-gray-700 transition hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400"
                                >
                                    Log in
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="inline-block rounded-lg bg-indigo-600 px-6 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    Register
                                </Link>
                            </>
                        )}
                    </nav>
                </header>

                <div className="w-full max-w-6xl">
                    <main className="text-center">
                        {/* Hero Section */}
                        <div className="mb-16">
                            <div className="mb-6">
                                <span className="inline-block text-6xl mb-4">🚀💡</span>
                            </div>
                            <h1 className="mb-6 text-4xl font-bold text-gray-900 sm:text-5xl lg:text-6xl dark:text-white">
                                Business Idea Validator
                            </h1>
                            <p className="mb-8 text-xl text-gray-600 max-w-3xl mx-auto dark:text-gray-300">
                                Get AI-powered analysis of your business ideas. Discover market potential, 
                                feasibility, profitability, and receive actionable recommendations to turn 
                                your vision into reality.
                            </p>
                            
                            <div className="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                                <Link
                                    href="#validator"
                                    className="inline-block bg-indigo-600 text-white px-8 py-4 rounded-lg font-semibold text-lg shadow-lg hover:bg-indigo-700 transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    Validate My Idea →
                                </Link>
                                <div className="flex items-center text-gray-600 dark:text-gray-400">
                                    <span className="text-green-500 mr-2">✓</span>
                                    <span>Free • Instant Results • No Sign-up Required</span>
                                </div>
                            </div>
                        </div>

                        {/* Features Section */}
                        <div className="grid md:grid-cols-3 gap-8 mb-16">
                            <div className="bg-white rounded-xl p-6 shadow-md dark:bg-gray-800 dark:shadow-gray-700/50">
                                <div className="text-4xl mb-4">📊</div>
                                <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                    Comprehensive Analysis
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    6-point evaluation covering market demand, feasibility, profitability, 
                                    uniqueness, scalability, and risk assessment.
                                </p>
                            </div>
                            
                            <div className="bg-white rounded-xl p-6 shadow-md dark:bg-gray-800 dark:shadow-gray-700/50">
                                <div className="text-4xl mb-4">🎯</div>
                                <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                    Actionable Insights
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Get specific recommendations and next steps to improve your 
                                    business concept and increase success probability.
                                </p>
                            </div>
                            
                            <div className="bg-white rounded-xl p-6 shadow-md dark:bg-gray-800 dark:shadow-gray-700/50">
                                <div className="text-4xl mb-4">⚡</div>
                                <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                    Instant Results
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    AI-powered analysis delivers detailed validation reports 
                                    in seconds, not weeks.
                                </p>
                            </div>
                        </div>

                        {/* How it Works */}
                        <div className="bg-white rounded-2xl p-8 shadow-lg mb-16 dark:bg-gray-800 dark:shadow-gray-700/50">
                            <h2 className="text-3xl font-bold mb-8 text-gray-900 dark:text-white">
                                How It Works
                            </h2>
                            <div className="grid md:grid-cols-3 gap-8">
                                <div className="text-center">
                                    <div className="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 dark:bg-indigo-900">
                                        <span className="text-2xl font-bold text-indigo-600 dark:text-indigo-300">1</span>
                                    </div>
                                    <h3 className="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
                                        Describe Your Idea
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Share your business concept in your own words
                                    </p>
                                </div>
                                <div className="text-center">
                                    <div className="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 dark:bg-indigo-900">
                                        <span className="text-2xl font-bold text-indigo-600 dark:text-indigo-300">2</span>
                                    </div>
                                    <h3 className="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
                                        AI Analysis
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Our AI evaluates 6 critical business factors
                                    </p>
                                </div>
                                <div className="text-center">
                                    <div className="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 dark:bg-indigo-900">
                                        <span className="text-2xl font-bold text-indigo-600 dark:text-indigo-300">3</span>
                                    </div>
                                    <h3 className="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
                                        Get Your Report
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Receive detailed analysis and recommendations
                                    </p>
                                </div>
                            </div>
                        </div>

                        {/* CTA Section */}
                        <div className="text-center">
                            <h2 className="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                                Ready to Validate Your Business Idea? 🎯
                            </h2>
                            <p className="text-xl text-gray-600 mb-8 max-w-2xl mx-auto dark:text-gray-300">
                                Join thousands of entrepreneurs who have used our AI-powered 
                                validator to refine their business concepts.
                            </p>
                            <a
                                href="#validator"
                                className="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-lg font-semibold text-lg shadow-lg hover:from-indigo-700 hover:to-purple-700 transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Start Validation Now →
                            </a>
                        </div>
                    </main>
                </div>

                <footer className="mt-16 text-sm text-gray-500 text-center dark:text-gray-400">
                    <p>
                        Built with ❤️ by{" "}
                        <a 
                            href="https://app.build" 
                            target="_blank" 
                            className="font-medium text-indigo-600 hover:text-indigo-700 hover:underline dark:text-indigo-400"
                        >
                            app.build
                        </a>
                        {" "}• Empowering entrepreneurs worldwide
                    </p>
                </footer>
            </div>
        </>
    );
}