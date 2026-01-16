<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Joy of Reading: Building a Daily Reading Habit',
                'content' => 'Reading has the power to transform your mind and enrich your life. In this post, we\'ll explore practical strategies for building a daily reading habit, choosing the right books, and creating a reading routine that fits seamlessly into your lifestyle. Discover how just 20 minutes of reading each day can expand your knowledge, improve focus, and provide much-needed mental relaxation.',
                'category_id' => 2, // Lifestyle
            ],
            [
                'title' => '10 Tips for a Balanced Lifestyle',
                'content' => 'Maintaining a balanced lifestyle in today\'s fast-paced world can be challenging. Here are ten practical tips to help you achieve better work-life balance, improve your mental health, and create sustainable habits that will enhance your overall well-being.',
                'category_id' => 2, // Lifestyle
            ],
            [
                'title' => 'Exploring the Hidden Gems of Southeast Asia',
                'content' => 'Southeast Asia is full of incredible destinations beyond the typical tourist spots. Join us as we discover hidden beaches, remote villages, and authentic cultural experiences that will make your next adventure truly unforgettable. From Thailand to Indonesia, these gems await.',
                'category_id' => 3, // Travel
            ],
            [
                'title' => 'The Art of Making Perfect Pasta at Home',
                'content' => 'Making pasta from scratch is easier than you think! Learn the secrets to creating restaurant-quality pasta in your own kitchen. We\'ll cover everything from selecting the right flour to mastering the perfect dough consistency, plus delicious sauce recipes to complement your homemade pasta.',
                'category_id' => 4, // Food
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}

