<?php
    /** @var \src\Models\DTO\Contact $contact */
    global $contact;
?>

<div class="card d-flex position-relative" style="max-width: 540px;">
    <div class="btn-group position-absolute top-0 end-0 mt-1 me-2">
        <button class="btn btn-sm rounded-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
            </svg>
        </button>
        <ul class="dropdown-menu dropdown-menu-end p-0 border-0">
            <li><button type="button" class="btn btn-danger w-100 deleteContactButton" contact-id="<?= $contact->id ?>">Удалить</button></li>
        </ul>
    </div>
    <div class="row g-0">
        <div class="rounded-start col-md-4 border-end p-0 overflow-hidden d-flex justify-content-center align-items-center" style="background-color: #e6e6e6; max-height: 170px;">
            <img src="<?= empty($contact->photo) ? UNKNOWN_USER_PHOTO : (MEDIA_DIR . $contact->photo) ?>" class="img-fluid h-100" style="object-fit: cover;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $contact->name ?></h5>
                <p class="card-text"><small class="text-body-secondary">Отправлено <?= date('H:i:s d.m.Y', strtotime($contact->created)) ?></small></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item border-top d-flex flex-row p-0">
                    <div class="d-flex justify-content-center align-items-center me-1 border-end" style="width: 48px; background-color: #e8ecee;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                        </svg>
                    </div>
                    <span class="p-2"><?= empty($contact->phone) ? 'Не указан' : ('+' . $contact->phone) ?></span>
                </li>
                <li class="list-group-item d-flex flex-row p-0">
                    <div class="d-flex justify-content-center align-items-center me-1 border-end" style="width: 48px; background-color: #e8ecee;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"></path>
                        </svg>
                    </div>
                    <span class="p-2"><?= $contact->email ?></span>
                </li>
            </ul>
        </div>
    </div>
</div>
