<?php

    /** Главная страница админ-части */

    require_once $_SERVER['DOCUMENT_ROOT'] . '/../init.php';

    use src\Models\ContactsService;
    use src\Models\Shared\DependencyContainer;
    use src\WebApi\Controllers\{AuthController, ContactsController};

    $pageTitle = 'Администратор - Управление контактными данными';

    $authController = DependencyContainer::createScope(AuthController::class);
    $isAuthorized = $authController->isAuthorized();
    if (!$isAuthorized) {
        header('Location: /admin/login.php');
    }

    $contactsController = DependencyContainer::createScope(ContactsController::class);
    $contactsCount = $contactsController->getContactsCount();
    $contactList = $contactsController->getContactList();

    $currentPage = max(1, (int) $_REQUEST['page']);
    $pagesCount = ceil($contactsCount / ContactsService::DEFAULT_ITEMS_PER_PAGE);
    $pagesCount = max(1, $pagesCount);
    $paginationUrl = '?page=';

    require_once VIEWS_DIR . 'header.tpl.php';
    require_once VIEWS_DIR . 'admin/index.tpl.php';
    require_once VIEWS_DIR . 'pagination.tpl.php';
    require_once VIEWS_DIR . 'footer.tpl.php';
