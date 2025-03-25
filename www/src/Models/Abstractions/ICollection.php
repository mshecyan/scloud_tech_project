<?php

    namespace src\Models\Abstractions;

    /**
     * Интерфейс коллекции объектов
     *
     * @author n.mshecyan
     */
    interface ICollection
    {
        /**
         * Добавление объекта
         *
         * @param mixed $item Добавляемый объект
         *
         * @return self Текущий объект
         */
        function add(mixed $item): self;

        /**
         * Получение первого элемента коллекции
         *
         * @return mixed Первый элемент коллекции
         */
        function first(): mixed;

        /**
         * Проверка коллекции на пустоту
         *
         * @return bool Признак пустой коллекции
         */
        public function isEmpty(): bool;
    }
