import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface BusinessIdea {
    id: number;
    title: string | null;
    description: string;
    analysis: BusinessIdeaAnalysis | null;
    overall_score: number | null;
    status: 'pending' | 'analyzing' | 'completed' | 'failed';
    created_at: string;
    updated_at: string;
}

export interface BusinessIdeaAnalysis {
    market_demand: AnalysisCriterion;
    feasibility: AnalysisCriterion;
    profitability: AnalysisCriterion;
    uniqueness: AnalysisCriterion;
    scalability: AnalysisCriterion;
    risk_assessment: AnalysisCriterion;
    recommendations: string[];
}

export interface AnalysisCriterion {
    score: number;
    pros: string[];
    cons: string[];
}
