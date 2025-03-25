<?php

    namespace src\Models\Abstractions;

    use src\DataAccess\Entities\User;

    /**
     * Интерфейс сервиса работы с пользователями
     *
     * @author n.mshecyan
     */
    interface IUsersService
    {
        /**
         * Получение пользователя по идентификатору
         *
         * @param int $userId Идентификатор пользователя
         *
         * @return User|null Объект пользователя
         */
        public function getUserById(int $userId): ?User;

        /**
         * Получение пользователя по логину
         *
         * @param string $login Логин
         *
         * @return User|null Объект пользователя
         */
        public function getUserByLogin(string $login): ?User;
    }
