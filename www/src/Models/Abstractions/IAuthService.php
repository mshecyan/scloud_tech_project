<?php

    namespace src\Models\Abstractions;

    /**
     * Интерфейс сервиса работы с авторизацией
     *
     * @author n.mshecyan
     */
    interface IAuthService
    {
        /**
         * Авторизация пользователя
         *
         * @param string $login Логин
         * @param string $password Пароль
         *
         * @return bool Признак успешного выполнения
         */
        function authorize(string $login, string $password): bool;

        /**
         * Выход из системы
         *
         * @return bool Признак успешного выполнения
         */
        function logout(): bool;

        /**
         * Получение статуса авторизации
         *
         * @return bool Статус авторизации
         */
        function isAuthorized(): bool;
    }
