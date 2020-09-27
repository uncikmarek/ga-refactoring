<?php

namespace App\Controller;

use App\Log;
use App\Model\Brand;
use App\Model\Product;

class ProductsController extends AbstractController
{
    protected function getName()
    {
        return 'product';
    }

    protected function getData()
    {
        $name =  $_GET['name'] ?? "";
        $brand = $_GET['brand'] ?? "";
        $order = $_GET['order'] ?? "id";
        $limit = $_GET['limit'] ?? 10;

        Log::info(sprintf('Rendering products action.'), $_GET);

        $brandModel = new Brand();
        $brands = $brandModel->load();

        $productModel = new Product();
        $products = $productModel->load($name, $brand, $order, 'ASC', $limit);
        $title = "Products";
        return compact(
            'brands',
            'products',
            'title'
        );
    }
}
