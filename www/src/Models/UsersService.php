<?php

    namespace src\Models;

    use src\DataAccess\Entities\User;
    use src\Models\Abstractions\IUsersService;

    /**
     * Сервис работы с пользователями
     *
     * @author n.mshecyan
     */
    class UsersService implements IUsersService
    {
        public function __construct()
        {

        }

        /**
         * Получение пользователя по идентификатору
         *
         * @param int $userId Идентификатор пользователя
         *
         * @return User|null Объект пользователя
         */
        public function getUserById(int $userId): ?User
        {
            return User::getById($userId);
        }

        /**
         * Получение пользователя по логину
         *
         * @param string $login Логин
         *
         * @return User|null Объект пользователя
         */
        public function getUserByLogin(string $login): ?User
        {
            return User::getByLogin($login);
        }
    }
