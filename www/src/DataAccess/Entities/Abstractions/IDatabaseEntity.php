<?php

    namespace src\DataAccess\Entities\Abstractions;

    use src\DataAccess\Filter;
    use src\Models\Abstractions\ICollection;

    /**
     * Интерфейс класса сущности базы данных
     *
     * @author n.mshecyan
     */
    interface IDatabaseEntity
    {
        /**
         * Сохранение модели
         *
         * @return bool Признак успешного выполнения
         */
        function save(): bool;

        /**
         * Получение сущности по идентификатору
         *
         * @param int $id Идентификатор записи в базе данных
         *
         * @return static|null Объект сущности
         */
        static function getById(int $id): ?static;

        /**
         * Удаление сущности
         *
         * @param int $id Идентификатор записи в базе данных
         *
         * @return bool Признак успешного выполнения
         */
        static function delete(int $id): bool;

        /**
         * Получение сущности по заданному фильтру
         *
         * @param Filter|null $filter Объект фильтра
         *
         * @return ICollection Объект коллекции
         */
        static function select(?Filter $filter = null): ICollection;
    }
