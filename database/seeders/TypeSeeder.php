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
                    1 => [
                        'title' => 'слово с переводом и изображением, аудио',
                        'code' => 'WORD',
                    ],
                    2 => [
                        'title' => 'видео для прасмотра',
                        'code' => 'VIDEO', 
                    ],
                    3 => [
                        'title' => 'аудио с английским текстом с учетом двух переводов: один правильный, другой неправильный, когда вы нажимаете на правильное слово, начинается воспроизведение этого слова',
                        'code' => 'QUESTION_WORD', 
                    ],
                    4 => [
                        'title' => 'аудио и текст с переводом',
                        'code' => 'AUDIO_TRANSLATIONS', 
                    ],
                    5 => [
                        'title' => 'картинка со звуком и даны два английских слова, одно правильное, другое неправильное, когда пользователь выбирает правильный ответ, запускается звук',
                        'code' => 'QUESTION_IMAGE', 
                    ],
                    6 => [
                        'title' => 'изучение и классификация звуков речи, в каждом упражнении пятое слово',
                        'code' => 'PHONETICS', 
                    ],
                    7 => [
                        'title' => 'произношение только аудио',
                        'code' => 'PRONUNCIATION',  
                    ],
                    8 => [
                        'title' => 'грамматика с теорией и практикой',
                        'code' => 'GRAMMAR_THEORY_PRACTICS', 
                    ],
                    9 => [
                        'title' => 'аудио и два изображения, сначала запускается звук, и пользователь должен выбрать правильное изображение',
                        'code' => 'VOCABULARY_AUDIO_IMAGE', 
                    ],
                    10 => [
                        'title' => 'со звуком английский текст дается на языке по выбору пользователя, а ниже даны два варианта на английском языке. Если щелкнуть правильный ответ, начнется звук',
                        'code' => 'VOCABULARY_AUDIO_WORD', 
                    ],
                    11 => [
                        'title' => 'найди слово, поняв значение картинки',
                        'code' => 'SPELLING', 
                    ],
                    12 => [
                        'title' => 'только звук, звук воспроизводится автоматически при запуске этой задачи',
                        'code' => 'LISTENING', 
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
