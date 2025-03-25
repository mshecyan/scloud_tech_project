<?php
    global $pageTitle, $isAuthorized;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> <?= $pageTitle ?> </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/resources/script/script.js"></script>
</head>

<body>
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 me-4 text-white text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 w-auto">
                    <li><a href="/" class="nav-link px-2 text-secondary">Главная</a></li>
                </ul>

                <?php if ($isAuthorized ?? false) { ?>
                    <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0 w-auto">
                        <li><a href="/admin/" class="nav-link px-2 text-secondary">Управление</a></li>
                    </ul>
                <?php } ?>

                <div class="text-end ms-4">
                    <?php if ($isAuthorized ?? false) { ?>
                        <button type="button" class="btn btn-outline-light logoutButton">Выйти</button>
                    <?php } else { ?>
                        <a href="/admin/login.php"><button type="button" class="btn btn-outline-light">Войти</button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>

    <div class="modal fade" id="errorModalWindow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Произошла ошибка</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#errorModalWindow" id="errorModalToggle"></button>

	<div class="container-fluid py-5">