
<?php
$title = 'Корзина';
include('views/layouts/header.php');
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem):?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="/category/<?=$categoryItem['id']?>"><?=$categoryItem['name']?></a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>

                    <?php if ($result): ?>

                        <p>Закак оформлен. Мы вам перезвоним.</p>
                    <?php else: ?>
                        <p>Выбрано товаров: <?=$totalQuantity?> на сумму: <?=$totalPrice?> USD.</p>

                    <div class="col-sm-4">
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li> - <?=$error;?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <p>Для оформления заказа заполните форму. Наш менеджер свяжеться с Вами.</p>

                        <div class="login-form">
                            <form action="#" method="post">
                                <p>Ваше имя</p>
                                <input type="text" name="userName" placeholder="" value="<?=$userName?>">
                                <p>Номер телефона</p>
                                <input type="text" name="userPhone" placeholder="" value="<?=$userPhone?>">
                                <p>Коментарий к заказу</p>
                                <input type="text" name="userComment" placeholder="" value="<?=$userComment?>">
                                <br>
                                <br>
                                <input type="submit" name="submit">
                            </form>
                        </div>
                    </div>
                <?php endif;?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include('views/layouts/footer.php');?>