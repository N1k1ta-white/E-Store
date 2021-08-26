<?php


class CatalogController
{
    public function actionIndex() {
        $categories = array();
        $categories = Category::getCategoryList();

        $latestProduct = array();
        $latestProduct = Product::getLatestProduct();

        require_once('views/catalog/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1) {

        $categories = array();
        $categories = Category::getCategoryList();

        $categoryProducts = array();
        $categoryProducts = Product::getProductListByCategory($categoryId, $page);

        $total = Product::getTotalProductsInCategory($categoryId);

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once('views/catalog/category.php');

        return true;
    }
}