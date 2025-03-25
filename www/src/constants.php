<?php

    /** @var string Путь к корневой директории */
    define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

    /** @var string Путь к директории с конфигурационными файлами */
    const CONFIGS_DIR = ROOT . 'configs' . DIRECTORY_SEPARATOR;

    /** @var string Путь к директории с шаблонами HTML-страниц */
    const VIEWS_DIR = ROOT . 'views' . DIRECTORY_SEPARATOR;

    /** @var string Путь к директории с медиа файлами относительно рабочей директории */
    const MEDIA_DIR = DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR;

    /** @var string Полный путь к директории с медиа файлами */
    const BACKEND_MEDIA_DIR = ROOT . 'public' . MEDIA_DIR;

    /** @var string Путь к файлу отсутвующего изображения */
    const UNKNOWN_USER_PHOTO = MEDIA_DIR . 'photo-unknown.png';