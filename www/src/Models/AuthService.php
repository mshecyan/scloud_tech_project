<?php

    namespace src\Models;

    use src\Models\Abstractions\{IAuthService, IUsersService};
    use src\Models\Shared\Exceptions\{AuthException, ErrorCodes};

    /**
     * Сервис работы с авторизацией
     *
     * @author n.mshecyan
     */
    class AuthService implements IAuthService
    {
        /** @var IUsersService Объект сервиса работы с пользователями */
        private IUsersService $userService;

        public function __construct(IUsersService $userService)
        {
            $this->userService = $userService;
        }

        /**
         * Авторизация пользователя
         *
         * @param string $login Логин
         * @param string $password Пароль
         *
         * @return bool Признак успешного выполнения
         * @throws AuthException
         */
        public function authorize(string $login, string $password): bool
        {
            $user = $this->userService->getUserByLogin($login);
            if ($user === null || !password_verify($password, $user->getPasswordHash())) {
                throw new AuthException(ErrorCodes::INVALID_LOGIN_OR_PASSWORD);
            }

            $_SESSION['login'] = $user->getLogin();
            $_SESSION['userId'] = $user->getId();
            $_SESSION['isAuth'] = true;

            return true;
        }

        /**
         * Выход из системы
         *
         * @return bool Признак успешного выполнения
         */
        public function logout(): bool
        {
            if ($_SESSION['isAuth'] !== true) {
                return false;
            }

            $_SESSION = [];
            session_destroy();

            return true;
        }

        /**
         * Получение статуса авторизации
         *
         * @return bool Статус авторизации
         */
        public function isAuthorized(): bool
        {
            return $_SESSION['isAuth'] === true;
        }
    }
