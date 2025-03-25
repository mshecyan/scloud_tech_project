<?php

    namespace src\DataAccess\Entities;

    use src\DataAccess\Entities\Abstractions\AbstractEntity;

    /**
     * Модель сущности "Контактные данные"
     *
     * @author n.mshecyan
     */
    class Contact extends AbstractEntity
    {
        /** @var string Название таблицы */
        protected const string TABLE_NAME = 'contacts';

        /** @var string Имя */
        protected string $name;

        /** @var string Почта */
        protected string $email;

        /** @var string|null Телефон */
        protected ?string $phone = null;

        /** @var string|null Имя файла фото */
        protected ?string $photo = null;

        public function __construct()
        {
            parent::__construct();
        }

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
         * Изменение имени
         *
         * @return self Текущий объект
         */
        public function setName(string $name): self
        {
            $this->name = $name;

            return $this;
        }

        /**
         * Получение почты
         *
         * @return string Почта
         */
        public function getEmail(): string
        {
            return $this->email;
        }

        /**
         * Изменение почты
         *
         * @return self Текущий объект
         */
        public function setEmail(string $email): self
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Получение телефона
         *
         * @return string|null Телефон
         */
        public function getPhone(): ?string
        {
            return $this->phone;
        }

        /**
         * Изменение телефона
         *
         * @return self Текущий объект
         */
        public function setPhone(?string $phone): self
        {
            $this->phone = $phone;

            return $this;
        }

        /**
         * Получение фото
         *
         * @return string|null Имя фойла фото
         */
        public function getPhoto(): ?string
        {
            return $this->photo;
        }

        /**
         * Изменение фото
         *
         * @return self Текущий объект
         */
        public function setPhoto(?string $photo): self
        {
            $this->photo = $photo;

            return $this;
        }
    }