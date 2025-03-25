<?php
    global $contactsAlreadySent;
?>

<div class="container-fluid">
    <?php if ($contactsAlreadySent) { ?>
        <div class="container d-flex justify-content-center">
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill text-success me-2" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <span>Контактные данные успешно отрпавлены</span>
            </div>
        </div>
    <?php } else { ?>
        <div class="container d-flex justify-content-center" style="max-width: 450px;">
            <form action="/api/api.php?method=sendContacts" method="post" enctype="multipart/form-data" class="d-flex flex-column w-100 sendContactsForm">
                <h5 class="h5 mb-3 fw-normal text-center mb-4">Форма сбора контактных данных</h5>

                <div class="form-floating">
                    <input type="text" class="form-control rounded-0 rounded-top" id="nameInput" name="name" placeholder="Имя" required>
                    <label for="nameInput">Имя</label>
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control rounded-0 border-top-0 border-bottom-0" id="emailInput" name="email" placeholder="Почта" required>
                    <label for="emailInput">Адрес эл. почты</label>
                </div>
                <div class="form-floating">
                    <input type="tel" class="form-control rounded-0 border-bottom-0" id="phoneInput" name="phone" placeholder="Телефон">
                    <label for="phoneInput">Телефон</label>
                </div>
                <div class="form-floating">
                    <input type="file" class="form-control rounded-0 rounded-bottom" id="photoInput" name="photo" placeholder="Фото">
                    <label for="photoInput">Фото</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mt-4 fs-6" type="submit">Отправить</button>
                <p class="mt-3 text-muted text-center">© 2025</p>
            </form>
        </div>
    <?php } ?>
</div>
