<?php

    /** Главная страница с формой сбора контактных данных */

    require_once $_SERVER['DOCUMENT_ROOT'] . '/../init.php';

    use src\Models\Shared\DependencyContainer;
    use src\WebApi\Controllers\{AuthController, ContactsController};

    $pageTitle = 'Форма сбора контактных данных';

    $authController = DependencyContainer::createScope(AuthController::class);
    $contactsController = DependencyContainer::createScope(ContactsController::class);

    $isAuthorized = $authController->isAuthorized();
    $contactsAlreadySent = $contactsController->checkContactsAlreadySent();

    require_once VIEWS_DIR . 'header.tpl.php';
    require_once VIEWS_DIR . 'index.tpl.php';
    require_once VIEWS_DIR . 'footer.tpl.php';
