<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Education;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // System Statistics
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'regular_users' => User::where('role', 'user')->count(),
            'total_portfolios' => User::where('role', 'user')->whereHas('profile')->count(),
            'total_projects' => Project::count(),
            'total_messages' => Message::count(),
            'unread_messages' => Message::where('status', 'unread')->count(),
            'total_skills' => Skill::count(),
            'total_experiences' => Experience::count(),
            'total_services' => Service::count(),
            'total_testimonials' => Testimonial::count(),
            'total_education' => Education::count(),
        ];

        // Recent Activity
        $recentUsers = User::with('profile')
            ->latest()
            ->take(5)
            ->get();

        $recentMessages = Message::with('user')
            ->latest()
            ->take(10)
            ->get();

        // User Registration Trends (Last 6 months)
        $userRegistrations = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $userRegistrations[] = [
                'month' => $month->format('M'),
                'count' => $count
            ];
        }

        // Portfolio Completion Stats
        $portfolioStats = [
            'complete' => User::where('role', 'user')
                ->whereHas('profile')
                ->whereHas('projects')
                ->whereHas('skills')
                ->count(),
            'partial' => User::where('role', 'user')
                ->whereHas('profile')
                ->where(function($query) {
                    $query->whereDoesntHave('projects')
                          ->orWhereDoesntHave('skills');
                })
                ->count(),
            'empty' => User::where('role', 'user')
                ->whereDoesntHave('profile')
                ->count(),
        ];

        // Message Activity (Last 30 days)
        $messageActivity = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Message::whereDate('created_at', $date->toDateString())->count();
            $messageActivity[] = [
                'date' => $date->format('M j'),
                'count' => $count
            ];
        }

        return view('admin.dashboard', compact(
            'stats',
            'recentUsers',
            'recentMessages',
            'userRegistrations',
            'portfolioStats',
            'messageActivity'
        ));
    }
}
