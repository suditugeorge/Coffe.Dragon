<?php

require_once __DIR__ . '/../config.php';
use \data\Product;
$productsFile = ROOT_DIR . "/scripts/export_products.csv";

$f3 = Base::instance();
$mongo = $f3->get('MONGO');

$f = fopen($productsFile,'w');

$products = $mongo->CoffeeDragon->products->find();

foreach ($products as $product) {
	$data = [];
	$data[] = '"'.Product::removeDiacritics($product['name']).'"';
	$data[] = '"'.Product::removeDiacritics($product['description']).'"';
	$data[] = '"'.Product::removeDiacritics($product['has_image']).'"';
	$data[] = '"'.implode("|", $product['time_prepare']).'"';
	$ingredients = removeDiacriticsFromArray($product['ingredients']);
	$data[] = '"'.implode("|", $ingredients).'"';
	fwrite($f, implode(",", $data) . "\n");
}
function removeDiacriticsFromArray($array)
{
	foreach ($array as &$element){
		$element = Product::removeDiacritics($element);
	}
	return $array;
}