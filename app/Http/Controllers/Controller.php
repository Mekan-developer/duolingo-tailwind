<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

abstract class Controller
{
    
    
    protected function uploadFile($file,$path,$icon = false)
    {
        // create image manager with desired driver
        $manager = new ImageManager(new Driver());
        $random = hexdec(uniqid());
        // $filename = $random . '.' . $file->extension();
        $webpFilename = $random . '.webp';

        $img = $manager->read($file);

        if($icon){
            $web_image_width = 100;
        }else{
            $web_image_width = 420;
        }
        

        $height = $img->height();
        $width = $img->width();
        $scale = $height / $width;

        $web_image_height = $scale * $web_image_width;


        create_folder($path);

        $web_img = $img->resize($web_image_width, $web_image_height);
        $web_img->toWebp(90)->save(storage_path('app/public/uploads/'. $path .'/' . $webpFilename));
        return $webpFilename;
    }

    protected function removeFile($file, $path)
    {
        $filePath = 'public/uploads/'.$path .'/' . $file;
        if(Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

    public function sortItems($table,$fromOrder,$toOrder){
        if($fromOrder !== $toOrder){
            if($fromOrder > $toOrder){
                for($i = $fromOrder-1; $i >= $toOrder; $i--){
                    $poem_order_up = $table->where('order',$i)->first();
                    $poem_order_up->update([
                        'order' => $poem_order_up->order+1,
                    ]);
                }
            }else{
                for($i = $fromOrder+1; $i <= $toOrder; $i++){
                    $poem_order_up = $table->where('order',$i)->first();
                    $poem_order_up->update([
                        'order' => $poem_order_up->order - 1,
                    ]);
                }
            }
        }
    }

    public function reorderAfterRemoval($table,$orderDeletedRow)
    {
        $itemsToUpdate = $table->where('order', '>', $orderDeletedRow);
        foreach ($itemsToUpdate as $item) {
            $item->update(['order' => $item->order - 1]);
        }
    }
    


}
