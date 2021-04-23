<?php

    $link;
    
    // Функцию используем для того, чтобы спрятать данные для авторизации
    function db_connect () {

        // Все переменные локальные, извне не узнать
        $db_address = "";
        $db_user = "";
        $db_password = "";
        $db_dbname = "";
        
        // Указатель делаем глобальным, чтобы обращаться к БД извне
        global $link;
        $link = mysqli_connect($db_address, $db_user, $db_password, $db_dbname);

        // Проверка состояния подключения
        if ($link == false){
            print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
        }
        // else {
        //     print("Соединение установлено успешно");
        // }
    }
    db_connect ();
?>