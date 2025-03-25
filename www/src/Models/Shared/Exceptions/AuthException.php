<?php

    namespace src\Models\Shared\Exceptions;

    use Exception;

    /**
     * Класс ошибок при работе с авторизацией
     *
     * @author n.mshecyan
     */
    class AuthException extends Exception
    {
        /** @var string[] Список соответствия кодов и текстов ошибок */
        private const array ERROR_MESSAGES = [
            ErrorCodes::UNAUTHORIZED_ERROR => 'Не авторизован.',
            ErrorCodes::INVALID_LOGIN_OR_PASSWORD => 'Неверный логин или пароль.',
        ];

        public function __construct(int $code)
        {
            $message = self::ERROR_MESSAGES[$code] ?? '';

            parent::__construct($message, $code);
        }
    }
