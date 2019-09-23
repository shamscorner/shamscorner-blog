<?php


namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UtilsService
{
    /**
    * Author: shamscorner
    * DateTime: 22/September/2019 - 17:56:58
    *
    * delete old images from a specified directory
    *
    * @param $pathWithImage - the fully specified image path
    *
    */
    public function deleteImage($pathWithImage)
    {
        if (Storage::disk('public')->exists($pathWithImage)) {
            Storage::disk('public')->delete($pathWithImage);
        }
    }

    /**
    * Author: shamscorner
    * DateTime: 22/September/2019 - 18:03:06
    *
    * make a directory in the specified folder
    *
    * @param $path - the fully specified directory path
    *
    */
    public function createDirectory($path)
    {
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }
    }

    /**
    * Author: shamscorner
    * DateTime: 23/September/2019 - 15:50:30
    *
    * upload image into the storage directory
    *
    * @param $image - the image file from the request
    * @param $others - [slug, path, defaultImageName, isResizable, width, height]
    *
    */
    public function uploadImage($image, $others)
    {
        if (isset($image)) {
            // take the current date for uniqueness
            $currentDate = Carbon::now()->toDateString();
            // make an image name from slug, currentdate and unique id with extension
            $imageName = $others['slug'] . '-' . $currentDate . '-' . uniqid(). '.' . $image->getClientOriginalExtension();
            // check whether the categories directory is available or not, if not, then create
            $this->createDirectory($others['path']);
            
            if ($others['isResizable']) {
                // resize the image for optimal space in the thumbnail for the slider image
                $resizedImage = Image::make($image)->fit($others['width'], $others['height'])->stream();
            }

            // put the image into the categories slider directory and save
            Storage::disk('public')->put($others['path'].'/'.$imageName, $resizedImage);
        } else {
            $imageName = $others['defaultImageName'];
        }

        return $imageName;
    }

    /**
    * Author: shamscorner
    * DateTime: 23/September/2019 - 18:44:05
    *
    * update the image and delete the old one
    *
    * @param $image - the image file from the request
    * @param $oldImagePath - the old image path in the directory
    * @param $others - [slug, path, defaultImageName, isResizable, width, height]
    *
    */
    public function updateImage($image, $others)
    {
        if (isset($image)) {
            // take the current date for uniqueness
            $currentDate = Carbon::now()->toDateString();
            // make an image name from slug, currentdate and unique id with extension
            $imageName = $others['slug'] . '-' . $currentDate . '-' . uniqid(). '.' . $image->getClientOriginalExtension();
            // check whether the categories directory is available or not, if not, then create
            $this->createDirectory($others['path']);

            // delete the old image
            $this->deleteImage($others['path'].'/'.$others['oldImage']);
            
            if ($others['isResizable']) {
                // resize the image for optimal space in the thumbnail for the slider image
                $resizedImage = Image::make($image)->fit($others['width'], $others['height'])->stream();
            }

            // put the image into the categories slider directory and save
            Storage::disk('public')->put($others['path'].'/'.$imageName, $resizedImage);
        } else {
            $imageName = $others['oldImage'];
        }

        return $imageName;
    }
}
