<?php


class ProductController
{
    public function actionView($id) {
        $categories = array();
        $categories = Category::getCategoryList();

        $product = Product::getProductById($id);

        require_once('views/product/view.php');
        return true;
    }
}