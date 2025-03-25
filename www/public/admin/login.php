<?php

    /** Страница с формой входа в админ-часть */

    require_once $_SERVER['DOCUMENT_ROOT'] . '/../init.php';

    $pageTitle = 'Авторизация';

    require_once VIEWS_DIR . 'header.tpl.php';
    require_once VIEWS_DIR . 'admin/login.tpl.php';
    require_once VIEWS_DIR . 'footer.tpl.php';
