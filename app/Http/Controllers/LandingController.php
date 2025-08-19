<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        // Show main landing page with featured portfolios
        $featuredUsers = User::where('role', 'user')
            ->where('is_active', true)
            ->with(['profile', 'projects' => function($query) {
                $query->where('is_featured', true)->take(3);
            }])
            ->take(6)
            ->get();

        return view('landing.index', compact('featuredUsers'));
    }

    public function portfolio(User $user)
    {
        // Show individual portfolio
        if (!$user->is_active || !in_array($user->role, ['user', 'admin'])) {
            abort(404);
        }

        $user->load([
            'profile',
            'skills' => function($query) {
                $query->orderBy('is_featured', 'desc')->orderBy('proficiency', 'desc');
            },
            'education' => function($query) {
                $query->orderBy('start_date', 'desc');
            },
            'experiences' => function($query) {
                $query->orderBy('start_date', 'desc');
            },
            'projects' => function($query) {
                $query->orderBy('is_featured', 'desc')->orderBy('sort_order');
            },
            'services' => function($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            },
            'testimonials' => function($query) {
                $query->where('is_approved', true)->orderBy('is_featured', 'desc');
            },
            'socials' => function($query) {
                $query->where('is_visible', true)->orderBy('sort_order');
            }
        ]);

        return view('portfolio.template', compact('user'));
    }
}
