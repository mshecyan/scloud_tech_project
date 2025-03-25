<?php

    namespace src\Models\Shared\Exceptions;

    use Exception;

    /**
     * Класс общих ошибок при работе с приложением
     *
     * @author n.mshecyan
     */
    class AppException extends Exception
    {
        /** @var string[] Список соответствия кодов и текстов ошибок */
        private const array ERROR_MESSAGES = [
            ErrorCodes::CLASS_DOES_NOT_EXIST => 'Класс не найден.',
            ErrorCodes::DEPENDENCY_NOT_FOUND => 'Класс зависимости не найден.',
            ErrorCodes::INVALID_COLLECTION_ITEM_TYPE => 'Некорректный тип элемента коллекции.',
            ErrorCodes::USER_NOT_FOUND => 'Пользователь не найден.',
            ErrorCodes::FILE_UPLOAD_ERROR => 'Возникла ошибка при загрузке файла.',
            ErrorCodes::UPLOAD_FILE_MOVE_FAILED => 'Ошибка при копировании файла.',
            ErrorCodes::UPLOADED_FILE_TOO_BIG => 'Файл имеет слишком большой размер.',
        ];

        public function __construct(int $code)
        {
            $message = self::ERROR_MESSAGES[$code] ?? '';

            parent::__construct($message, $code);
        }
    }
