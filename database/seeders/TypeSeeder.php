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
                        'title' => 'аудио и 2 слово,при нажатии на правильное слово начинается воспроизведение этого слова',
                        'code' => 'QUESTION_WORD', 
                    ],
                    [
                        'title' => 'аудио и текст с переводом',
                        'code' => 'AUDIO_TRANSLATIONS', 
                    ],
                    [
                        'title' => 'посмотрев на картинку вы должны узнать правильный ответ,`2 слово, image и аудио `,при нажатии на правильное слово начинается воспроизведение этого слова',
                        'code' => 'QUESTION_IMAGE', 
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
