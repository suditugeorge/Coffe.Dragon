<?php
namespace controllers;

use data\Product;

class Products extends Controller
{
    public function createNewProduct(\Base $f3)
    {
        $this->layout = null;
        $product = [
            //'id' => Products::getNextProductId(),
            'name' => 'Produs Nou',
            'description' => '',
            'has_image' => false,
            'time_prepare' => ['hours' => 0, 'minutes' => 0, 'seconds' => 0],
            'ingredients' => [],
        ];
        $testProduct = [
            'id' => Product::getNextProductId(),
            'name' => 'Produs Nou',
            'description' => '',
            'has_image' => true,
            'img' => ['w' => 600, 'h' => 398],
            'time_prepare' => ['hours' => 0, 'minutes' => 0, 'seconds' => 0],
            'ingredients' => [],
        ];
        $mongo = $f3->get('MONGO');
        $mongo->CoffeeDragon->products->insert($testProduct, ['j' => 1]);
        exit;
    }
    public function getStaticImage(\Base $f3)
    {
        $this->layout = null;
        $imageName = $f3->get('PARAMS.imageName');
        $path = ROOT_DIR . IMAGES_DIR . $imageName . ".jpg";
        $img_width = JACKET_EXTRA_WIDTH;
        $img_height = JACKET_EXTRA_HEIGHT;

        $im = new \Imagick();

        $im->setSize($img_width * 2, $img_height * 2); //Makes the process a lot faster
        $im->readImage($path);
        $im->setCompressionQuality(100);
        $im->stripimage();
        $im->resizeimage($img_width, $img_height, \Imagick::FILTER_LANCZOS, 1, true);
        $im->thumbnailImage($img_width, $img_height, true);

        $img = $im->getImageBlob();

        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT', true, 200);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400 * 365) . ' GMT', true, 200);
        header('Content-Length: ' . strlen($img));
        header('Content-Type: image/jpeg');
        header('ETag: ' . md5($img));
        print $img;
        exit;

    }

    public function setIds(\Base $f3)
    {
        $this->layout = null;
        $mongo = $f3->get('MONGO');
        $products = ['_id' => 'products', 'id' => 1];
        $users = ['_id' => 'users', 'id' => 1];
        $mongo->CoffeeDragon->ids->insert($products, ['j' => 1]);
        $mongo->CoffeeDragon->ids->insert($users, ['j' => 1]);
        exit;
    }
}
