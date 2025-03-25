<?php

    namespace src\DataAccess\Entities;

    use src\DataAccess\Entities\Abstractions\AbstractEntity;
    use src\DataAccess\Filter;
    use src\Models\Enums\UserRole;
    use src\Models\Shared\Exceptions\AppException;

    /**
     * Модель сущности "Пользователь"
     *
     * @author n.mshecyan
     */
    class User extends AbstractEntity
    {
        /** @var string Имя таблицы */
        protected const string TABLE_NAME = 'users';

        /** @var string Имя */
        protected string $name;

        /** @var string Логин */
        protected string $login;

        /** @var string Пароль */
        protected string $password;

        /** @var string Роль доступа */
        protected string $role;

        /**
         * Получение имени
         *
         * @return string Имя
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * Получение логина
         *
         * @return string Логин
         */
        public function getLogin(): string
        {
            return $this->login;
        }

        /**
         * Получение хеша пароля
         *
         * @return string Хеш пароля
         */
        public function getPasswordHash(): string
        {
            return $this->password;
        }

        /**
         * Получение роли
         *
         * @return UserRole Роль
         */
        public function getRole(): UserRole
        {
            return match ($this->role) {
                UserRole::User->value => UserRole::User,
                UserRole::Admin->value => UserRole::Admin,
            };
        }

        /**
         * Получение пользователя по логину
         *
         * @param string $login Логин
         *
         * @return self|null Объект пользователя
         * @throws AppException
         */
        public static function getByLogin(string $login): ?self
        {
            if (empty($login)) {
                return null;
            }

            $filter = new Filter();
            $filter->where('login', $login);
            $filter->limit(1);

            return self::select($filter)->first();
        }
    }