<?php
namespace data;

class Images
{
    public static function processImage($imageName, $type = 'static', $size = 'b')
    {
        if ($type == 'static') {
            $path = ROOT_DIR . STATIC_IMAGES_DIR . $imageName . ".jpg";
        } else {
            $path = ROOT_DIR . PRODUCTS_IMAGES_DIR . $imageName . ".jpg";
        }

        $img_width = JACKET_EXTRA_WIDTH;
        $img_height = JACKET_EXTRA_HEIGHT;
        if ($size == 'n') {
            $img_width = JACKET_NORMAL_WIDTH;
            $img_height = JACKET_NORMAL_HEIGHT;
        }

        $img_height = 250;
        //die(print_r(['width' => $img_width, 'height' => $img_height], 1));

        $im = new \Imagick();

        $im->setSize($img_width * 2, $img_height * 2); //Makes the process a lot faster
        $im->readImage($path);
        $im->setCompressionQuality(80);
        $im->stripimage();
        $im->resizeimage($img_width, $img_height, \Imagick::FILTER_LANCZOS, 1, false);
        $im->thumbnailImage($img_width, $img_height, true);

        $img = $im->getImageBlob();

        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT', true, 200);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400 * 365) . ' GMT', true, 200);
        header('Content-Length: ' . strlen($img));
        header('Content-Type: image/jpeg');
        header('ETag: ' . md5($img));
        return $img;
    }

    public static function getProductImageUrl($id)
    {
        if ($id == null) {
            $id = '404-image';
        }
        return DOMAIN . MAIN_URL . '/imagini/produse/' . $id;
    }
}
