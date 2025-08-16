<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $user = auth()->user();

        // Basic stats
        $stats = [
            'messages' => Message::where('user_id', $user->id)->where('status', 'unread')->count(),
            'total_messages' => Message::where('user_id', $user->id)->count(),
            'projects' => Project::where('user_id', $user->id)->count(),
            'completed_projects' => Project::where('user_id', $user->id)->where('status', 'completed')->count(),
            'skills' => Skill::where('user_id', $user->id)->count(),
            'experiences' => Experience::where('user_id', $user->id)->count(),
            'services' => Service::where('user_id', $user->id)->count(),
            'testimonials' => Testimonial::where('user_id', $user->id)->where('is_approved', true)->count(),
            'education' => Education::where('user_id', $user->id)->count(),
        ];

        // Recent activity
        $recentMessages = Message::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $featuredProjects = Project::where('user_id', $user->id)
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        // Chart data for analytics
        $messagesByMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = Message::where('user_id', $user->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $messagesByMonth[] = [
                'month' => $month->format('M'),
                'count' => $count
            ];
        }

        $projectsByStatus = Project::where('user_id', $user->id)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Portfolio completion percentage
        $completionData = $this->calculateProfileCompletion($user);

        return view('dashboard', compact(
            'stats',
            'recentMessages',
            'featuredProjects',
            'messagesByMonth',
            'projectsByStatus',
            'completionData'
        ));
    }

    private function calculateProfileCompletion($user)
    {
        $sections = [
            'profile' => $user->profile ? 1 : 0,
            'skills' => $user->skills->count() > 0 ? 1 : 0,
            'experience' => $user->experiences->count() > 0 ? 1 : 0,
            'education' => $user->education->count() > 0 ? 1 : 0,
            'projects' => $user->projects->count() > 0 ? 1 : 0,
            'services' => $user->services->count() > 0 ? 1 : 0,
            'socials' => $user->socials->count() > 0 ? 1 : 0,
        ];

        $completed = array_sum($sections);
        $total = count($sections);
        $percentage = round(($completed / $total) * 100);

        return [
            'percentage' => $percentage,
            'completed' => $completed,
            'total' => $total,
            'sections' => $sections
        ];
    }
}
