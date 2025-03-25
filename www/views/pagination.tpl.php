<?php
    global $pagesCount, $currentPage, $paginationUrl;
?>

<div class="container-fluid mt-4">
    <div class="container d-flex flex-row justify-content-center">
        <nav>
            <ul class="pagination">
                <?php if ($currentPage <= 1) { ?>
                    <li class="page-item disabled"><a class="page-link" href="<?= $paginationUrl . 1 ?>">Предыдущая</a></li>
                <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="<?= $paginationUrl . ($currentPage - 1) ?>">Предыдущая</a></li>
                <?php } ?>

                <?php for ($i = 1; $i <= $pagesCount; $i++) { ?>
                    <li class="page-item <?= $currentPage === $i ? 'active' : '' ?>"><a class="page-link px-3" href="<?= $paginationUrl . $i ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage >= $pagesCount) { ?>
                    <li class="page-item disabled"><a class="page-link" href="<?= $paginationUrl . $pagesCount ?>">Следующая</a></li>
                <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="<?= $paginationUrl . ($currentPage + 1) ?>">Следующая</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>