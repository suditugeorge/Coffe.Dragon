<?php
namespace data;

class StaticContent
{
    public static function css($value)
    {
        $url = DOMAIN . MAIN_URL . '/ui/css/' . $value;
        return $url;
    }
}
