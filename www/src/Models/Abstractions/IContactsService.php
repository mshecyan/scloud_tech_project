<?php

    namespace src\Models\Abstractions;

    use src\Models\Collection;

    /**
     * Интерфейс сервиса для работы с контактными данными
     *
     * @author n.mshecyan
     */
    interface IContactsService
    {
        /**
         * Добавление контактных данных
         *
         * @param string $name Имя пользователя
         * @param string $email Почта
         * @param string|null $phone Телефон
         * @param string|null $photo Фото
         *
         * @return bool Признак успешного выполнения
         */
        public function addContact(string $name, string $email, ?string $phone = null, ?string $photo = null): bool;

        /**
         * Удаление контактных данных
         *
         * @param string $contactId Идентификатор контактных данных
         *
         * @return bool Признак успешного выполнения
         */
        public function deleteContact(string $contactId): bool;

        /**
         * Получение контактных данных
         *
         * @param int $offset Смещение выборки
         * @param string $limit Количество выбираемых записей
         *
         * @return Collection Коллекция контактных данных
         */
        public function getContactList(int $offset, string $limit): Collection;

        /**
         * Получение общего количество контактных данных
         *
         * @return int Количество контактных данных
         */
        public function getContactsCount(): int;
    }
