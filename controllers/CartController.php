<?php

    class CartController
    {

        public function actionAdd($id)
        {

            Cart::addProduct($id);
            // Возращаем пользователя обратно на страницу
            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer");
        }

        public function actionAddAjax($id)
        {

            echo Cart::addProduct($id);
            return true;
        }

        public function actionIndex()
        {
            $categories = array();

            $categories = Category::getCategoryList();

            $productsInCart = false;

            $productsInCart = Cart::getProducts();

            if ($productsInCart) {
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);

                $totalPrice = Cart::getTotalPrice($products);
            }
            require_once('views/cart/index.php');

            return true;
        }


        public function actionCheckout()
        {
            $categories = array();
            $categories = Category::getCategoryList();

            $result = false;

            if (isset($_POST['submit'])) {
                $userName = $_POST['userName'];
                $userPhone = $_POST['userPhone'];
                $userComment = $_POST['userComment'];

                $errors = false;
                if (User::checkName($userName)) {
                    $errors[] = 'Неправильное имя';
                }
                if (User::checkPhone($userPhone)) {
                    $errors[] = 'Неправильный номер';
                }

                if ($errors == false) {
                    $productInCart = Cart::getProducts();
                    if (User::isGuest()) {
                        $userId = false;
                    } else {
                        $userId = User::checkLogged();
                    }

                    $result = Order::save($userName, $userPhone, $userComment, $userId, $productInCart);

                    if ($result) {
                        $adminEmail = '-';
                        $message = '-';
                        $subject = 'Новый заказ';
                        mail($adminEmail, $subject, $message);
                        Cart::clear();
                    }
                } else {
                    $productInCart = Cart::getProducts();
                    $productIds = array_keys($productInCart);
                    $products = Product::getProductsByIds($productIds);
                    $totalPrice = Cart::getTotalPrice($products);
                    $totalQuantity = Cart::countItem();
                }
            } else {
                $productInCart = Cart::getProducts();

                if ($productInCart == false) {
                    header("Location: /");
                } else {
                    $productIds = array_keys($productInCart);
                    $products = Product::getProductsByIds($productIds);
                    $totalPrice = Cart::getTotalPrice($products);
                    $totalQuantity = Cart::countItem();

                    $userName = false;
                    $userPhone = false;
                    $userComment = false;

                    if (User::isGuest()) {

                    } else {
                        $userId = User::checkLogged();
                        $user = User::getUserById($userId);

                        $userName = $user['name'];
                    }

                }
            }
            require_once('views/cart/checkout.php');

            return true;
        }
    }
?>
