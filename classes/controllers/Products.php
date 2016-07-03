<?php
namespace controllers;

use data\Images;
use data\Product;

class Products extends Controller
{

    public function viewProduct(\Base $f3)
    {
        $id = $f3->get('PARAMS.id');
        if (!$id) {
            $f3->error(404);
            return;
        }
        $mongo = $f3->get('MONGO');
        $product = $mongo->CoffeeDragon->products->findOne(['id' => (int) $id]);
        if (!$product) {
            $f3->error(404);
            return;
        }
        $product = Product::processProduct($product);
        $f3->push('styles', 'product/product.css');
        $f3->set('product', $product);
        $f3->set('content', 'html/product/productView.html');
        $f3->set('title', $product['name']);
        $f3->set('description', $product['description']);
    }

    public function productList(\Base $f3)
    {
        $mongo = $f3->get('MONGO');
        $products = $mongo->CoffeeDragon->products->find();

        $processedProducts = [];
        foreach ($products as $product) {
            $processedProducts[] = Product::processProduct($product, true);
        }

        $f3->set('category', 'Toate produsele');
        $f3->set('products', $processedProducts);
        $f3->set('description', 'Încercăm să aducem cât mai multe produse pentru a satisface fiecare client!');
        $f3->push('styles', 'product/productList.css');
        $f3->push('scripts', 'ui/js/product/productList.js');
        $f3->set('content', 'html/product/productList.html');

    }

    public function redirectToProduct(\Base $f3)
    {
        $id = $f3->get('PARAMS.id');
        if (!$id) {
            $f3->error(404);
            return;
        }
        $mongo = $f3->get('MONGO');
        $result = $mongo->CoffeeDragon->products->findOne(['id' => (int) $id], ['name' => 1]);
        if (!$result) {
            $f3->error(404);
            return;
        }
        $url = DOMAIN . MAIN_URL . '/produs/' . Product::stringToUrl($result['name']) . '/' . $id;
        $f3->reroute($url, true);
    }

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
        print Images::processImage($imageName);
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

    public function getImage(\Base $f3)
    {
        $this->layout = null;
        $id = $f3->get('PARAMS.id');
        echo Images::processImage($id, 'product');
        exit;
    }
}
