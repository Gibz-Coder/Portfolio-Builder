<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Social;

class UpdateSocialVisibility extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:update-visibility';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all social links to be visible';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // First, let's see what we have
        $allSocials = Social::all();
        $this->info("Total social links in database: {$allSocials->count()}");

        // Show all social links
        foreach ($allSocials as $social) {
            $this->info("Social: {$social->platform} (User ID: {$social->user_id}, Visible: " . ($social->is_visible ? 'Yes' : 'No') . ")");
        }

        // Get the first user (admin)
        $user = \App\Models\User::first();
        $this->info("User: {$user->name} (ID: {$user->id})");

        // Check if user has any socials
        $userSocials = $user->socials()->count();
        $this->info("User socials count (with visibility filter): {$userSocials}");

        // Check user socials without visibility filter
        $allUserSocials = $user->socials()->withoutGlobalScopes()->count();
        $this->info("User socials count (without filter): {$allUserSocials}");

        // Update ALL social links to be visible
        $updated = Social::where('is_visible', false)->update(['is_visible' => true]);
        $this->info("Updated {$updated} social links to be visible.");

        // If still no visible socials for this user, create some default ones
        if ($user->socials()->count() == 0) {
            $this->info("Creating default social links...");

            Social::create([
                'user_id' => $user->id,
                'platform' => 'GitHub',
                'username' => 'gibz-coder',
                'url' => 'https://github.com/gibz-coder',
                'icon' => 'uil uil-github-alt',
                'is_visible' => true,
                'sort_order' => 1
            ]);

            Social::create([
                'user_id' => $user->id,
                'platform' => 'LinkedIn',
                'username' => 'gibz-hapita',
                'url' => 'https://linkedin.com/in/gibz-hapita',
                'icon' => 'uil uil-linkedin-alt',
                'is_visible' => true,
                'sort_order' => 2
            ]);

            Social::create([
                'user_id' => $user->id,
                'platform' => 'Dribbble',
                'username' => 'gibz-hapita',
                'url' => 'https://dribbble.com/gibz-hapita',
                'icon' => 'uil uil-dribbble',
                'is_visible' => true,
                'sort_order' => 3
            ]);

            $this->info("Created 3 default social links.");
        }

        return 0;
    }
}
