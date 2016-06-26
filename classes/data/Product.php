<?php
namespace data;

/**
 *
 */
class Product
{
    public static function getNextProductId()
    {
        $f3 = \Base::instance();
        $mongo = $f3->get('MONGO');

        $ret = $mongo->CoffeeDragon->command(
            [
                "findandmodify" => "ids",
                "query" => ["_id" => 'products'],
                "update" => ['$inc' => ["id" => 1]],
            ]
        );
        return $ret['value']['id'];
    }

    public static function stringToUrl($string)
    {
        if (empty($string)) {
            return '';
        }

        $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');

        $string = self::removeDiacritics($string);
        $string = mb_strtolower($string);
        $string = trim(preg_replace('`\W`', '-', $string), '-');
        $length = mb_strlen($string);
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            if ($i == 0 || $string{$i - 1} != '-' || $string{$i} != '-') {
                $result .= $string{$i};
            }
        }
        if (empty($result)) {
            $result = '-';
        }
        return $result;
    }

    public static function removeDiacritics($string)
    {
        $string = str_replace(['ă', 'â', 'î', 'ș', 'ț', 'Ă', 'Â', 'Î', 'Ș', 'Ț'],
            ['a', 'a', 'i', 's', 't', 'A', 'A', 'I', 'S', 'T'], $string);
        return $string;
    }

    public static function formatPrice($value)
    {
        $parts = \util\StringUtil::getNumberParts($value);
        return $parts['int'] . '<sup><span class="hidden">.</span>' . $parts['dec'] . '</sup> ' . CURRENCY;
    }

}
