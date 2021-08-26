<?php


class SiteController
{
    public function actionIndex() {
        $categories = array();
        $categories = Category::getCategoryList();

        $latestProduct = array();
        $latestProduct = Product::getLatestProduct();

        require_once('views/site/index.php');

        return true;
    }

    public function actionContact() {
        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if ($errors == false) {
                $adminEmail = '';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        require_once('views/site/contact.php');
        return true;
    }
}