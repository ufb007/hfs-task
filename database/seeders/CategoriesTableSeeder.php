<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTime = Carbon::now();

        $categories = [
            [
                'topic_id' => 1,
                'name' => 'Artificial Intelligence',
                'description' => 'Explore the latest advancements and applications of artificial intelligence (AI), including machine learning, neural networks, natural language processing, and AI ethics.',
            ],
            [
                'topic_id' => 1,
                'name' => 'Blockchain',
                'description' => 'Learn about blockchain technology, cryptocurrencies, smart contracts, decentralized finance (DeFi), and the impact of blockchain on various industries.',
            ],
            [
                'topic_id' => 1,
                'name' => 'Cybersecurity',
                'description' => 'Discuss cybersecurity strategies, threats, vulnerabilities, data protection, encryption, cybersecurity laws, and best practices to secure digital assets and systems.',
            ],
            [
                'topic_id' => 1,
                'name' => 'Data Science',
                'description' => 'Explore data analysis, data visualization, predictive modeling, big data technologies, data-driven decision making, and the role of data scientists in modern organizations.',
            ],
            [
                'topic_id' => 1,
                'name' => 'Internet of Things (IoT)',
                'description' => 'Discover IoT devices, IoT platforms, IoT security, smart home technology, industrial IoT applications, and the potential of interconnected devices to transform industries.',
            ],
            [
                'topic_id' => 1,
                'name' => 'Software Development',
                'description' => 'Discuss software engineering practices, programming languages, frameworks, agile methodologies, DevOps, continuous integration/continuous deployment (CI/CD), and software architecture.',
            ],
            [
                'topic_id' => 2,
                'name' => 'Biology',
                'description' => 'Explore the study of living organisms, their structure, function, growth, evolution, and ecological relationships.',
            ],
            [
                'topic_id' => 2,
                'name' => 'Chemistry',
                'description' => 'Learn about the composition, structure, properties, and reactions of matter, including atoms, molecules, and chemical bonds.',
            ],
            [
                'topic_id' => 2,
                'name' => 'Physics',
                'description' => 'Discuss the fundamental forces of nature, energy, matter, motion, and the principles governing the universe.',
            ],
            [
                'topic_id' => 2,
                'name' => 'Astronomy',
                'description' => 'Discover celestial objects, the universe, galaxies, stars, planets, black holes, and cosmological theories.',
            ],
            [
                'topic_id' => 2,
                'name' => 'Environmental Science',
                'description' => 'Investigate environmental issues, ecosystems, climate change, pollution, conservation, and sustainable practices.',
            ],
            [
                'topic_id' => 2,
                'name' => 'Neuroscience',
                'description' => 'Study the nervous system, brain function, cognition, neuroplasticity, and neurological disorders.',
            ],
            [
                'topic_id' => 3,
                'name' => 'Entrepreneurship',
                'description' => 'Explore the process of designing, launching, and running a new business or startup, including innovation, risk-taking, and business growth strategies.',
            ],
            [
                'topic_id' => 3,
                'name' => 'Marketing',
                'description' => 'Discuss marketing strategies, consumer behavior, digital marketing, branding, advertising, market research, and social media marketing.',
            ],
            [
                'topic_id' => 3,
                'name' => 'Finance',
                'description' => 'Learn about financial management, accounting principles, investments, budgeting, financial planning, and financial analysis.',
            ],
            [
                'topic_id' => 3,
                'name' => 'E-commerce',
                'description' => 'Explore online business models, e-commerce platforms, payment systems, online retailing, and the digital marketplace.',
            ],
            [
                'topic_id' => 3,
                'name' => 'Startups',
                'description' => 'Discuss the challenges and opportunities of starting and scaling new ventures, including funding, team building, product development, and market entry strategies.',
            ],
            [
                'topic_id' => 3,
                'name' => 'Leadership',
                'description' => 'Study leadership theories, leadership styles, management practices, organizational behavior, and effective leadership skills.',
            ],
            [
                'topic_id' => 4,
                'name' => 'Online Learning',
                'description' => 'Explore online education platforms, courses, e-learning strategies, virtual classrooms, and online teaching tools.',
            ],
            [
                'topic_id' => 4,
                'name' => 'Teaching Strategies',
                'description' => 'Discuss effective teaching methods, instructional design, curriculum development, lesson planning, and classroom management techniques.',
            ],
            [
                'topic_id' => 4,
                'name' => 'Education Technology (EdTech)',
                'description' => 'Learn about educational technology trends, tools, apps, learning management systems (LMS), educational apps, and digital resources for educators.',
            ],
            [
                'topic_id' => 4,
                'name' => 'Higher Education',
                'description' => 'Explore colleges, universities, graduate programs, academic research, student life, admissions, and higher education policy.',
            ],
            [
                'topic_id' => 4,
                'name' => 'Skill Development',
                'description' => 'Discuss lifelong learning, professional development, vocational training, skill-based education, and certifications.',
            ],
            [
                'topic_id' => 4,
                'name' => 'Learning Resources',
                'description' => 'Discover educational resources, study tips, educational apps, open educational resources (OER), and online libraries.',
            ],
            [
                'topic_id' => 5,
                'name' => 'Movies',
                'description' => 'Explore film reviews, movie genres, box office hits, film festivals, directors, actors, and cinematic trends.',
            ],
            [
                'topic_id' => 5,
                'name' => 'Music',
                'description' => 'Discuss music genres, artists, albums, concerts, music festivals, music streaming services, and music industry news.',
            ],
            [
                'topic_id' => 5,
                'name' => 'Television',
                'description' => 'Explore TV shows, series reviews, streaming platforms, binge-watching trends, television networks, and production studios.',
            ],
            [
                'topic_id' => 5,
                'name' => 'Books',
                'description' => 'Discuss book reviews, literary genres, bestsellers, authors, book clubs, reading recommendations, and publishing industry insights.',
            ],
            [
                'topic_id' => 5,
                'name' => 'Gaming',
                'description' => 'Explore video games, gaming consoles, esports, gaming events, game reviews, gaming communities, and gaming industry trends.',
            ],
            [
                'topic_id' => 5,
                'name' => 'Celebrities',
                'description' => 'Discuss celebrity news, gossip, interviews, red carpet events, celebrity lifestyles, and entertainment industry updates.',
            ],
            [
                'topic_id' => 6,
                'name' => 'Football',
                'description' => 'Explore leagues, teams, matches, player transfers, international tournaments, and football culture worldwide.',
            ],
            [
                'topic_id' => 6,
                'name' => 'Basketball',
                'description' => 'Discuss NBA, basketball leagues, players, teams, basketball events, basketball strategies, and basketball culture.',
            ],
            [
                'topic_id' => 6,
                'name' => 'Tennis',
                'description' => 'Explore tennis tournaments, ATP, WTA, Grand Slam events, tennis players, tennis matches, tennis techniques, and tennis news.',
            ],
            [
                'topic_id' => 6,
                'name' => 'Cricket',
                'description' => 'Discuss cricket formats, international cricket matches, cricket leagues, cricket players, cricket techniques, and cricket news.',
            ],
            [
                'topic_id' => 6,
                'name' => 'Athletics',
                'description' => 'Discuss track and field events, Olympic Games, athletics records, athletes, athletics techniques, and athletics news.',
            ],
        ];

        foreach($categories as &$category) {
            $category['created_at'] = $currentTime;
            $category['updated_at'] = $currentTime;

            Category::create($category);
        }
    }
}
