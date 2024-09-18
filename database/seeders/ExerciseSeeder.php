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
            1 => ['name' => 'Vocabulary', 'description' => 'Vocabulary| This vocabulary section contain image + english text with audio reading + translation text',  'type_id' => $typeIds[1]],
            2 => ['name' =>'Vocabulary','description' => 'Vocabulary| This vocabulary section contain english text with audio reading + correct + incorrect translation text (user need choose answer)','type_id' => $typeIds[2]],
            3 => ['name' =>'Video','description' => 'Video| This video section contain only video (user can play and stop video after run one time)','type_id' => $typeIds[3]],
            4 => ['name' =>'Translation','description' => 'Translation| This translation section contains only English text with audio reading and translation (user can only read the text and control the audio)','type_id' => $typeIds[4]],
            5 => ['name' =>'Vocabulary','description' => 'Vocabulary| This translation section contains only Image with audio and correct + incorrect english  text (user can only select answer by looking image)','type_id' => $typeIds[5]],
            6 => ['name' =>'Vocabulary','description' => 'description','type_id' => $typeIds[6]],
            7 => ['name' =>'Vocabulary','description' => 'description','type_id' => $typeIds[7]],
            8 => ['name' =>'Grammar','description' => 'description','type_id' => $typeIds[8]],
            9 => ['name' =>'Vocabulary','description' => 'description','type_id' => $typeIds[9]],
            10 => ['name' =>'Vocabulary','description' => 'description','type_id' => $typeIds[10]],
            11 => ['name' =>'Listening','description' => 'description','type_id' => $typeIds[11]],
        ];
                
        foreach ($names as $data) {
            Exercise::create($data);
        }
    }
}
