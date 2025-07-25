<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Faq;
use App\Models\Category;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $json = File::get(database_path('data/fragen-antworten.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $category = Category::firstOrCreate([
                'name' => $item['category'],
            ]);

            Faq::create([
                'question' => $item['question'],
                'answer' => $item['answer'],
                'category_id' => $category->id,
            ]);
        }
    }
}
