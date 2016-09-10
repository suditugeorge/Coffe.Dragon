<?php
namespace data;

class StaticContent
{
    public static function css($value)
    {
        $url = DOMAIN . MAIN_URL . '/ui/css/' . $value;
        return $url;
    }

    public static function js($value)
    {
        $url = DOMAIN . MAIN_URL . '/ui/js/'. $value;
        return $url;
    }

    public static function trimWholeWord($str, $len, $elipsis = '')
    {
        if (strlen($str) > $len) {
            $str = substr($str, 0, $len);
            $p = strrpos($str, ' ');
            return substr($str, 0, $p) . $elipsis;
        } else {
            return $str;
        }
    }
}
