<?php


if (!function_exists('create_folder')) {
    function create_folder($folder)
    {
        $path_gallery = 'public/uploads/'.$folder;

        // Check if directories exist, if not create them
        if (!Storage::disk('local')->exists($path_gallery)) {
            Storage::disk('local')->makeDirectory($path_gallery, 0777, true, true);
        }
    }
}