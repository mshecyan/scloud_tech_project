<?php

    namespace src\Models\Enums;

    /**
     * Варианты ролей пользователя
     *
     * @author n.mshecyan
     */
    enum UserRole: string
    {
        /** @var string Пользователь */
        case User = 'user';

        /** @var string Администратор */
        case Admin = 'admin';
    }
