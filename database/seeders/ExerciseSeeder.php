<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $codes = [
            'WORD','QUESTION_WORD','VIDEO','AUDIO_TRANSLATIONS','QUESTION_IMAGE',
            'SPELLING','PRONUNCIATION','GRAMMAR_THEORY_PRACTICS','VOCABULARY_AUDIO_IMAGE',
            'VOCABULARY_AUDIO_WORD','LISTENING'
        ];
        
        $typeIds = [];
        $count = 0;
        foreach ($codes as $code) {
            $count++;
            $typeIds[$count] = DB::table('exercise_types')->where('code', $code)->value('id');
        }

        $names = [
            1 => ['name' => 'Vocabulary','image' => '1.webp','audio' => '1.jpg' ,'description' => 'Vocabulary| This vocabulary section contain image + english text with audio reading + translation text',  'type_id' => $typeIds[1]],
            2 => ['name' =>'Vocabulary','image' => '2.webp','audio' => '2.jpg' ,'description' => 'Vocabulary| This vocabulary section contain english text with audio reading + correct + incorrect translation text (user need choose answer)','type_id' => $typeIds[2]],
            3 => ['name' =>'Video','image' => '3.webp','audio' => '3.jpg' ,'description' => 'Video| This video section contain only video (user can play and stop video after run one time)','type_id' => $typeIds[3]],
            4 => ['name' =>'Translation','image' => '4.webp','audio' => '4.jpg' ,'description' => 'Translation| This translation section contains only English text with audio reading and translation (user can only read the text and control the audio)','type_id' => $typeIds[4]],
            5 => ['name' =>'Vocabulary','image' => '5.webp','audio' => '5.jpg' ,'description' => 'Vocabulary| This vocabulary section contains only Image with audio and correct + incorrect english  text (user can only select answer by looking image)','type_id' => $typeIds[5]],
            6 => ['name' =>'Vocabulary','image' => '6.webp','audio' => '6.jpg' ,'description' => 'Vocabulary|This vocabulary section contains only an image with sound and text in English (the user should recognize the word by looking at the image and write it down by letter)','type_id' => $typeIds[6]],
            7 => ['name' =>'Vocabulary','image' => '7.webp','audio' => '7.jpg' ,'description' => 'Vocabulary|This vocabulary section contains only an sound (the user can only listening this sound)','type_id' => $typeIds[7]],
            8 => ['name' =>'Grammar','image' => '8.webp','audio' => '8.jpg' ,'description' => "Grammar|This section grammar contains theoretical and practical parts the theoretical part of
                                                        grammar contains a text which is in the user's language and the practical part contains some 
                                                        text which is related to the theoretical part in the user's language and English (correct, incorrect)
                                                        words which are part of the translation of the text (To user shows text in the user's
                                                        language and the user has to choose the true word from two correct and incorrect ones.)",
                                                        'type_id' => $typeIds[8]],
            9 => ['name' =>'Vocabulary','image' => '9.webp','audio' => '9.jpg' ,'description' => 'Vocabulary| This vocabulary contains audio and two image which one is correct anothe one incorrect
                                                        (user sould select true image)','type_id' => $typeIds[9]],
            10 => ['name' =>'Vocabulary','image' => '10.webp','audio' => '10.jpg' ,'description' => "Vocabulary| this vocabulary contains words in the user's language and two translations of these words into English, one of these 
                                                            words is correct, the other is incorrect and audio ^like 3^ (the user should choose the answer)",'type_id' => $typeIds[10]],
            11 => ['name' =>'Listening','image' => '11.webp','audio' => '11.jpg' ,'description' => 'Vocabulary|This vocabulary section contains only an sound ^like 7^ exercise (the user can only listening this sound)','type_id' => $typeIds[11]],
        ];
                
        foreach ($names as $data) {
            Exercise::create($data);
        }
    }
}
