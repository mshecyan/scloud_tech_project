<?php

    namespace src\Models\Shared\Exceptions;

    use Exception;

    /**
     * Класс ошибок при работе с правами пользователя
     *
     * @author n.mshecyan
     */
    class PermissionException extends Exception
    {
        /** @var string[] Список соответствия кодов и текстов ошибок */
        private const array ERROR_MESSAGES = [
            ErrorCodes::ACCESS_DENIED => 'Недостаточно прав для выполнения метода.',
        ];

        public function __construct(int $code)
        {
            $message = self::ERROR_MESSAGES[$code] ?? '';

            parent::__construct($message, $code);
        }
    }
