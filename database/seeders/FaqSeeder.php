<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Faq;
use App\Models\Tag;

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
            $faq = Faq::create([
                'question' => $item['question'],
                'answer' => $item['answer'],
            ]);

            $tag = Tag::firstOrCreate([
                'name' => $item['category'],
            ]);

            $faq->tags()->attach($tag->id);
        }
    }
}
