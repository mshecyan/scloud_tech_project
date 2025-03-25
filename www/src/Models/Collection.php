<?php

    namespace src\Models;

    use ArrayIterator;
    use IteratorAggregate;
    use JsonSerializable;
    use src\Models\Abstractions\ICollection;
    use src\Models\Shared\Exceptions\{AppException, ErrorCodes};

    /**
     * Коллекция объектов заданного типа
     *
     * @author n.mshecyan
     */
    class Collection implements ICollection, IteratorAggregate, JsonSerializable
    {
        /** @var string Тип элементов коллекции */
        private string $itemType;

        /** @var array Массив элементов */
        private array $collection;

        public function __construct(string $itemType)
        {
            $this->itemType = $itemType;
            $this->collection = [];
        }

        /**
         * Получение итератора коллекции
         *
         * @return ArrayIterator Итератор
         */
        public function getIterator(): ArrayIterator
        {
            return new ArrayIterator($this->collection);
        }

        /**
         * Получение объекта для сериализации в JSON
         *
         * @return array Объект для сериализации
         */
        public function jsonSerialize(): array
        {
            return $this->collection;
        }

        /**
         * Добавление объекта в коллекцию
         *
         * @param mixed $item Добавляемый объект
         * @param string|null $key Ключ в коллекции
         *
         * @return $this Текущий объект
         * @throws AppException
         */
        public function add(mixed $item, ?string $key = null): self
        {
            if (!($item instanceof $this->itemType)) {
                throw new AppException(ErrorCodes::INVALID_COLLECTION_ITEM_TYPE);
            }

            if (empty($key)) {
                $this->collection[] = $item;
            } else {
                $this->collection[$key] = $item;
            }

            return $this;
        }

        /**
         * Получение первого элемента в коллекции
         *
         * @return mixed Первый элемент
         */
        public function first(): mixed
        {
            $firstItemKey = array_key_first($this->collection);

            return $this->collection[$firstItemKey];
        }

        /**
         * Проверка коллекции на пустоту
         *
         * @return bool Признак пустой коллекции
         */
        public function isEmpty(): bool
        {
            return empty($this->collection);
        }
    }
