<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use File;

class BackUpsController extends Controller
{
    public function download()
    {
        // Database connection details
        $dbHost = env('DB_HOST');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $dbName = env('DB_DATABASE');
        
        // Path to save the dump file
        $backupPath = storage_path('app/backups/' . $dbName . '_backup_' . date('Y-m-d_H-i-s') . '.sql');
        
        // Command to export the database
        $command = "mysqldump --user={$dbUser} --password={$dbPass} --host={$dbHost} {$dbName} > {$backupPath}";

        // Execute the command
        exec($command);

        // Check if the file exists
        if (file_exists($backupPath)) {
            // Return the file as a response to download
            return response()->download($backupPath)->deleteFileAfterSend(true);
        }

        return response()->json(['message' => 'Database backup failed.'], 500);
    }

    public function downloadfiles()
    {
        // Path to the folder containing the uploads
        $folderPath = storage_path('app/public/uploads/');

        // Check if the folder exists
        if (!File::exists($folderPath)) {
            return response()->json(['message' => 'Folder does not exist.'], 404);
        }

        // Name of the zip file that will be created
        $zipFileName = 'uploads.zip';

        // Path where the zip file will be temporarily stored
        $zipFilePath = storage_path('app/' . $zipFileName);

        // Initialize ZipArchive
        $zip = new ZipArchive;

        // Create the zip file
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // Recursively add the folder and its contents to the zip
            $this->addFolderToZip($folderPath, $zip, strlen($folderPath));

            // Close the zip file
            $zip->close();
        } else {
            return response()->json(['message' => 'Could not create zip file.'], 500);
        }

        // Check if the zip file exists and return it for download
        if (file_exists($zipFilePath)) {
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        }

        return response()->json(['message' => 'Zip file was not created.'], 500);
    }

    private function addFolderToZip($folder, $zip, $folderLength)
    {
        // Get all files and directories within the folder
        $files = File::allFiles($folder);
        $directories = File::directories($folder);

        // Add files to zip
        foreach ($files as $file) {
            $relativePath = substr($file->getRealPath(), $folderLength);
            $zip->addFile($file->getRealPath(), $relativePath);
        }

        // Recursively add directories to zip
        foreach ($directories as $dir) {
            $relativeDir = substr($dir, $folderLength);
            $zip->addEmptyDir($relativeDir); // Add directory to the zip
            $this->addFolderToZip($dir, $zip, $folderLength); // Recursively add subdirectories and their files
        }
    }
}
