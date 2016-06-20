<?php
namespace controllers;

class Products extends Controller
{
    public function getStaticImage(\Base $f3)
    {
        $this->layout = null;
        $imageName = $f3->get('PARAMS.imageName');
        $path = ROOT_DIR . IMAGES_DIR . $imageName . ".jpg";
        $img_width = JACKET_EXTRA_WIDTH;
        $img_height = JACKET_EXTRA_HEIGHT;
        //die(print_r(getcwd(), 1));
        //if (is_readable($path)) {
        //die(print_r($path, 1));

        $gm = new \Imagick();

        $gm->setSize($img_width * 2, $img_height * 2); //Makes the process a lot faster
        $gm->readImage($path);
        $gm->setCompressionQuality(100);
        $gm->stripimage();
        $gm->resizeimage($img_width, $img_height, \Imagick::FILTER_LANCZOS, 1, true);
        //$gm->thumbnailImage($img_width, $img_height, true);

        $img = $gm->getImageBlob();

        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT', true, 200);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400 * 365) . ' GMT', true, 200);
        header('Content-Length: ' . strlen($img));
        header('Content-Type: image/jpeg');
        header('ETag: ' . md5($img));
        print $img;

        exit;
        //}
    }
}
