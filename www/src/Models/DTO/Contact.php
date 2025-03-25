<?php

    namespace src\Models\DTO;

    /**
     * DTO контактных данных
     *
     * @author n.mshecyan
     */
    class Contact
    {
        /** @var int Идентификатор контактных данных */
        public int $id;

        /** @var string Имя пользователя */
        public string $name;

        /** @var string Почта */
        public string $email;

        /** @var string|null Телефон */
        public ?string $phone;

        /** @var string|null Фото */
        public ?string $photo;

        /** @var string Дата создания */
        public string $created;
    }
