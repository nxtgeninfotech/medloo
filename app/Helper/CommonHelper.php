<?php

namespace App\Helper;

class CommonHelper
{

    public static function createImage($imageBaseCode, $imagePath)
    {
        $image_parts = explode(";base64,", $imageBaseCode);

        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.' . $image_type;
        $file = $imagePath . $imageName;

        file_put_contents($file, $image_base64);

        return $imageName;
    }
}
