<?php

    namespace src\WebApi\Controllers;

    use src\Models\Abstractions\IAuthService;
    use src\Models\Shared\Exceptions\SanitizeException;
    use src\Models\Shared\Sanitization;

    /**
     * Контроллер API-методов авторизации
     *
     * @author n.mshecyan
     */
    class AuthController
    {
        /** @var IAuthService Объект сервиса работы с авторизацией */
        private IAuthService $authService;

        public function __construct(IAuthService $authService)
        {
            $this->authService = $authService;
        }

        /**
         * Авторизация пользователя
         *
         * @return bool Признак успешного выполнения
         * @throws SanitizeException
         */
        public function authorize(): bool
        {
            $login = Sanitization::forString($_POST['login'] ?? '');
            $password = Sanitization::forString($_POST['password'] ?? '');

            return $this->authService->authorize($login, $password);
        }

        /**
         * Выход из системы
         *
         * @return bool Признак успешного выполнения
         */
        public function logout(): bool
        {
            setcookie(session_name(), '', -1, '/');

            return $this->authService->logout();
        }

        /**
         * Получение статуса авторизации
         *
         * @return bool Статус авторизации
         */
        public function isAuthorized(): bool
        {
            return $this->authService->isAuthorized();
        }
    }
