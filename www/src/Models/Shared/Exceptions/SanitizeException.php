<?php

    namespace src\Models\Shared\Exceptions;

    use Exception;

    /**
     * Класс ошибок санитизации
     *
     * @author n.mshecyan
     */
    class SanitizeException extends Exception
    {
        /** @var string[] Список соответствия кодов и текстов ошибок */
        private const array ERROR_MESSAGES = [
            ErrorCodes::SANITIZE_INVALID_VALUE_TYPE => 'Некорректный тип значения.',
            ErrorCodes::SANITIZE_INCORRECT_STRING_LENGTH => 'Некорректная длина строки.',
            ErrorCodes::SANITIZE_STRING_CONTAINS_INVALID_CHARS => 'Строка содержит недопустимые символы.',
            ErrorCodes::SANITIZE_INCORRECT_NUMBER_RANGE => 'Некорректный диапазон числа.',
            ErrorCodes::SANITIZE_NOT_ALLOWED_UPLOAD_FILE_TYPE => 'Некорректный тип файла.',
            ErrorCodes::SANITIZE_INCORRECT_PHONE => 'Некорректный номер телефона.',
        ];

        public function __construct(int $code)
        {
            $message = self::ERROR_MESSAGES[$code] ?? '';

            parent::__construct($message, $code);
        }
    }
