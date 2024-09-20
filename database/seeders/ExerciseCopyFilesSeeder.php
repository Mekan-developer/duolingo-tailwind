<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ExerciseCopyFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Define source and destination directories
         $source = storage_path('app/public/uploads/copy_exercises'); // Replace with your source folder path
         $destination = storage_path('app/public/uploads/exercises'); // Replace with your destination folder path
 
         // Ensure the destination directory exists
         if (!File::exists($destination)) {
             File::makeDirectory($destination, 0755, true);
         }
 
         // Get all files in the source directory
         $files = File::files($source);
 
         // Loop through the files and copy each one to the destination
         foreach ($files as $file) {
             $fileName = $file->getFilename();
             File::copy($file->getPathname(), $destination . '/' . $fileName);
         }
 
         $this->command->info('Files have been copied successfully!');
    }
}
