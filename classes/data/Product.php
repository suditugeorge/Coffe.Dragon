<?php
namespace data;

use data\Images;

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
        $ret['int'] = floor($value);
        $ret['dec'] = str_pad(round(($value - $ret['int']) * 100), 2, '0', STR_PAD_LEFT);
        return $ret['int'] . '<sup><span class="hidden">.</span>' . $ret['dec'] . '</sup> ' . CURRENCY;
    }

    public static function processProduct($product, $small = false)
    {
        if ($product['has_image']) {
            $product['image_url'] = Images::getProductImageUrl($product['id']);
        } else {
            $product['image_url'] = '/images/404-image.jpg';
        }
        $product['price'] = floatval($product['price']);

        if ($small) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'description' => $product['description'],
                'image_url' => $product['image_url'],
                'price' => $product['price'],
                'product_url' => self::getProductUrl($product['name'], $product['id']),
            ];
        }

        return $product;
    }

    public static function getProductUrl($productName, $productId)
    {
        return '/produs/' . self::stringToUrl($productName) . '/' . $productId;
    }

}
