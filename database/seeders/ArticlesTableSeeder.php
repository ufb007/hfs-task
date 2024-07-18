<?php

namespace Database\Seeders;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTime = Carbon::now();

        $articles = [
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Unveiling the Power of Artificial Intelligence: Transforming Industries and Shaping the Future',
                'content' => '<p>Artificial Intelligence (AI) is a rapidly evolving field within computer science that aims to create machines capable of performing tasks that typically require human intelligence. From self-driving cars to voice assistants like Siri and Alexa, AI has permeated various aspects of our daily lives and industries.</p>
                <p>What is Artificial Intelligence?</p>
                <p>AI refers to the ability of machines to simulate human intelligence. This includes learning from data, reasoning, understanding natural language, and making decisions based on insights. AI systems are designed to perform specific tasks autonomously, often improving their performance with experience.</p>
                <p>Applications of Artificial Intelligence</p>
                <ul>
                    <li><strong>Natural Language Processing (NLP)</strong>: AI powers language translation, sentiment analysis, and speech recognition systems.</li>
                    <li><strong>Machine Learning</strong>: Algorithms allow systems to learn patterns from data and make predictions or decisions.</li>
                    <li><strong>Computer Vision</strong>: AI enables machines to interpret visual information, aiding in image recognition and autonomous driving.</li>
                    <li><strong>Robotics</strong>: AI-driven robots perform tasks in manufacturing, healthcare, and exploration.</li>
                </ul>
                <p>Ethical Considerations</p>
                <p>As AI advances, ethical concerns arise regarding privacy, bias in algorithms, and the impact on jobs. Responsible AI development includes ensuring transparency, fairness, and accountability in AI systems.</p>
                <p>Future Trends</p>
                <p>The future of AI holds promise in areas like healthcare diagnostics, personalized learning, and autonomous systems. Continued research and ethical guidelines will shape the evolution of AI, impacting societies globally.</p>
                <p>In conclusion, Artificial Intelligence is revolutionizing industries and enhancing human capabilities, yet it necessitates thoughtful consideration of its societal implications and ethical frameworks.</p>',
            ]
        ];

        foreach ($articles as $article) {
            $article['created_at'] = $currentTime;
            $article['updated_at'] = $currentTime;

            Article::create($article);
        }
    }
}
