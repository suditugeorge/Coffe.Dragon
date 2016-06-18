<?php
namespace data;

class StaticContent
{

    public static function getStaticImage($image)
    {
        return IMAGES_DIR . $image . ".jpg";
    }
}
