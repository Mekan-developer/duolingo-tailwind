<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data = [
            'ru' => [
                'locale' => 'ru',
                'name' => 'Russian',
                'native' => 'Русский',
                'flag' => '1808655768973744.webp',
                'order' => 1,
            ],
            'es' => [
                'locale' => 'es',
                'name' => 'Spanish',
                'native' => 'español',
                'flag' => '1808655636136919.webp',
                'order' => 2,
            ],
            'tm' => [
                'locale' => 'tm',
                'name' => 'Turkmen',
                'native' => 'Türkmen',
                'flag' => '1808655463089450.webp',
                'order' => 3,
            ],

        ];

        foreach ($data as $key => $value) {
            Language::create($value);
        }
        
    }
}
