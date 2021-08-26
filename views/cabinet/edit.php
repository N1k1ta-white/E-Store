<?php include('views/layouts/header.php'); ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if ($result): ?>
                    <h5>Данные отредоктированы!</h5>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error;?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form">
                        <h2>Редактироание данных</h2>
                        <form action="#" method="post">
                            <p>Имя</p>
                            <input type="text" name="name" placeholder="Имя" value="<?=$name?>">
                            <p>Пароль</p>
                            <input type="password" name="password" placeholder="Пароль" value="<?=$password?>">
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        </form>
                    </div>
                <?php endif; ?>
                <br>
                <br>

            </div>
        </div>
    </div>
</section>

<?php include('views/layouts/footer.php'); ?>

