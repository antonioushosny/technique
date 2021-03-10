<?php

namespace App\Models;

use Image;
use File;

trait StorageHandle
{
    /**
     * Create name for uploaded file
     */
    public function currentName($file)
    {
        $rand = rand(1, 1000000000) ;
        $original_name = $file->getClientOriginalName();
       
        $current_name = $rand.time(). '_' .$original_name;
        // $current_name = make_slug($current_name) ;
        // dd( $current_name );
        return $current_name;
    }
    
    /**
     * Saves files
     */
    public function saveFile($file, $current_name)
    {
        $filesDestination = env('pathimages','public/uploads') .'/files/';

        $file->move($filesDestination, $current_name);
    }

      /**
     * Saves videos
     */
    public function saveVideo($file, $current_name)
    {
        $videosDestination = env('pathimages','public/uploads') .'/videos/';

        $file->move($videosDestination, $current_name);
    }

    /**
     * Save different sizes for images
     */
    public function originalImage($file, $current_name,$type="images")
    {
        $originalDestination = env('pathimages','public/uploads').'/'.$type.'/original/';

        Image::make($file)->save($originalDestination . $current_name);
        

    }
    // large width =1100
    public function largeImage($file, $current_name, $width=null,$height=null,$type="images")
    {
        $largeDestination = env('pathimages','public/uploads').'/'.$type.'/large/';

        Image::make($file)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($largeDestination . $current_name);
    }

    // large width =600
    public function mediumImage($file, $current_name, $width=null,$height=null,$type="images")
    {
        $mediumDestination = env('pathimages','public/uploads').'/'.$type.'/medium/';

        Image::make($file)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($mediumDestination . $current_name);
    }

    // large width =100
    public function thumbImage($file, $current_name, $width=null,$height=null,$type="images")
    {
        $thumbnailDestination = env('pathimages','public/uploads').'/'.$type.'/thumbnail/';

        Image::make($file)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailDestination . $current_name);
        
    }

 

    public function images_url($image, $size,$type="images")
    {
        
        switch ($size) {
            case 'original':
                $location = env('pathimages','public/uploads').'/'.$type.'/original/'. $image;
                break;
            
            case 'large':
                $location = env('pathimages','public/uploads').'/'.$type.'/large/'. $image;
                break;

            case 'medium':
                $location = env('pathimages','public/uploads').'/'.$type.'/medium/'. $image;
                break;
            
            case 'thumbnail':
                $location = env('pathimages','public/uploads').'/'.$type.'/thumbnail/'. $image;
                break;
            
            default:
                $location = env('pathimages','public/uploads').'/'.$type.'/original/'. $image;
                break;
        }
 
        // dd( asset($location));
       if (File::exists($location)) {
            return asset($location);
        }else{
            $location = asset('img/no-image.png');
            return asset($location);
        }
        
    }

   
    /**
     * Delete files from server
     */
    public function deleteFiles($files_name)
    {
        $files_arr = [];
        if (is_array($files_name)) {
            $files_arr = $files_name;
        } else {
            $files_arr[] = $files_name;
        }

        if (!empty($files_arr)) {
            
            $imagesDestination = env('pathimages','public/uploads').'/images/';
            
            $filesDestination = env('pathimages','public/uploads').'/files/';

          

            $directories = File::directories($imagesDestination);

            $directories[] = $filesDestination;

            // dd($directories) ;
            // 

            foreach ($directories as $directory) {
                
                foreach ($files_arr as $file_name) {
                    
                    // $file = public_path() . '/' .  $directory . '/' . $file_name;
                    $file = $directory . '/' . $file_name;
                    if (File::exists($file)) {
                        File::delete($file);
                    }
                }

            }
        }
    }

    /**
     * Delete record and it's files from server
     */
    public function deleteWithFiles($files_name)
    {
        if ($files_name) {
            $this->deleteFiles($files_name);
        }

        $this->delete();
    }
}
