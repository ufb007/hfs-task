<?php

namespace Database\Seeders;

use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTime = Carbon::now();

        $topics = [
            [
                'name' => 'Technology',
                'description' => '',
                'icon' => '',
            ],
            [
                'name' => 'Science',
                'description' => '',
                'icon' => '',
            ],
            [
                'name' => 'Business',
                'description' => '',
                'icon' => '',
            ],
            [
                'name' => 'Education',
                'description' => '',
                'icon' => '',
            ],
            [
                'name' => 'Entertainment',
                'description' => '',
                'icon' => '',
            ],
            [
                'name' => 'Sports',
                'description' => '',
                'icon' => '',
            ]
        ];

        foreach($topics as &$topic) {
            $topic['created_at'] = $currentTime;
            $topic['updated_at'] = $currentTime;
        }
        
        Topic::insert($topics);
    }
}
