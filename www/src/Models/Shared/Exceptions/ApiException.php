<?php

    namespace src\Models\Shared\Exceptions;

    use Exception;

    /**
     * Класс ошибок при работе с API
     *
     * @author n.mshecyan
     */
    class ApiException extends Exception
    {
        /** @var string[] Список соответствия кодов и текстов ошибок */
        private const array ERROR_MESSAGES = [
            ErrorCodes::API_METHOD_DOES_NOT_EXIST => 'Вызываемый метод не существует.',
            ErrorCodes::API_METHOD_NOT_SPECIFIED => 'Не указан метод.',
        ];

        public function __construct(int $code)
        {
            $message = self::ERROR_MESSAGES[$code] ?? '';

            parent::__construct($message, $code);
        }
    }
