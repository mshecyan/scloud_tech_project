<?php
    global $contactList;
?>

<div class="container-fluid">
    <div class="container d-flex justify-content-center align-items-center flex-wrap gap-3 p-0">
        <?php if ($contactList->isEmpty()) { ?>
            <span>Нет данных</span>
        <?php } ?>

        <?php foreach ($contactList as $contact) {
            require VIEWS_DIR . 'admin' . DIRECTORY_SEPARATOR . 'contact_card.tpl.php';
        } ?>
    </div>
</div>