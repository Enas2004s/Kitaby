<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Academic Books',
                'description' => 'Files and study books for university courses such as programming, databases, networks, and mathematics.',
            ],
            [
                'name' => 'Scientific Resources',
                'description' => 'Study files and books related to sciences such as physics, chemistry, biology, and numerical analysis.',
            ],
            [
                'name' => 'Technology & IT',
                'description' => 'Books and files related to information technology such as programming, artificial intelligence, cybersecurity, and software engineering.',
            ],
            [
                'name' => 'Study Summaries',
                'description' => 'Ready-made summaries for university courses that help students review quickly and understand the material more easily before exams.',
            ],
            [
                'name' => 'Past Exams',
                'description' => 'Previous exam models that help students practice and understand the pattern of questions.',
            ],
            [
                'name' => 'University Materials',
                'description' => 'General university materials and lecture notes shared by students from different departments.',
            ],
            [
                'name' => 'Engineering Resources',
                'description' => 'Books and study materials related to engineering fields such as civil, electrical, mechanical, and computer engineering.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
