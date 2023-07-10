<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\NewPostNotification;
use App\Models\Subscription\Website;
use Illuminate\Support\Facades\Mail;

class SendNewPostNotifications extends Command
{
    protected $signature = 'send:post-notifications';

    protected $description = 'Send email notifications to subscribers for new posts';

    public function handle()
    {
        // Get all websites
        $websites = Website::all();

        // Loop through each website
        foreach ($websites as $website) {
            // Get all new posts for this website that haven't been sent yet
            $newPosts = $website->posts()->where('sent', false)->get();

            // If there are new posts
            if ($newPosts->count() > 0) {
                // Get all subscribers for this website
                $subscribers = $website->subscribers()->where('active', true)->get();

                // Loop through each subscriber
                foreach ($subscribers as $subscriber) {
                    // Send email notification to subscriber
                    Mail::to($subscriber->email)->send(new NewPostNotification($newPosts));

                    // Update the 'sent' column for each post to prevent duplicate notifications
                    foreach ($newPosts as $post) {
                        $post->update(['sent' => true]);
                    }
                }
            }
        }
    }
}
