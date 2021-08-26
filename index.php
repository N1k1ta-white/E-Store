
<?php

  //Front controller

  //1. Общие настройки

  error_reporting(0);
  error_reporting(E_ERROR);
  session_start();

  //2. Подключение файлов сиситемы

  require_once('components/Autoload.php');
  //3. Установка соеденение с БД


  //4. Вызов Router

  $rout = new Router();
  $rout->run();