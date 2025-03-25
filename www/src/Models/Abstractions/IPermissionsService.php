<?php

    namespace src\Models\Abstractions;

    use src\Models\Enums\UserRole;

    /**
     * Интерфейс сервиса работы с правами пользователя
     *
     * @author n.mshecyan
     */
    interface IPermissionsService
    {
        /**
         * Проверка авторизации и прав
         *
         * @param UserRole $needRole Требуемая роль
         *
         * @return void
         */
        public function checkAuthAndPermissionsOrThrow(UserRole $needRole): void;
    }
