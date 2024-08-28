<?php

namespace Database\Seeders;

use App\Models\ExerciseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
                    [
                        'title' => 'слово с переводом и изображением, аудио',
                        'code' => 'WORD',
                    ],
                    [
                    'title' => 'видео для прасмотра',
                        'code' => 'VIDEO', 
                    ],
                    [
                        'title' => '2 слово и аудио,при нажатии на правильное слово начинается воспроизведение этого слова',
                        'code' => 'QUESTION_WORD', 
                    ],
                ];

            foreach ($data as $key => $value) {
                ExerciseType::create([
                    'title' => $value['title'],
                    'code' => $value['code'],
                ]);
            }

        
    }
}
