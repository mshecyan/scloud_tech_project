<?php

    namespace src\DataAccess;

    use src\DataAccess\Enums\{OrderDirection, SqlCondition};

    /**
     * Класс параметров фильтрации запроса выборки
     *
     * @author n.mshecyan
     */
    class Filter
    {
        /** @var array Список условий */
        private array $where = [];

        /** @var string|null Поле сортировки */
        private ?string $orderBy = null;

        /** @var OrderDirection Направление сортировки */
        private OrderDirection $orderDirection = OrderDirection::DESC;

        /** @var int|null Количество выбираемых записей */
        private ?int $limit = null;

        /** @var int|null Смещение выборки */
        private ?int $offset = null;

        public function __construct()
        {

        }

        /**
         * Добавление условного выражения
         *
         * @param string $fieldName Имя поля
         * @param mixed $value Значение
         * @param SqlCondition|null $condition Условие сравнения
         *
         * @return $this Текущий объект
         */
        public function where(
            string $fieldName,
            mixed $value,
            ?SqlCondition $condition = SqlCondition::Equal
        ): self
        {
            if ($condition === SqlCondition::In) {
                $value = is_array($value) ? $value : [$value];
            }

            $this->where[] = [
                'fieldName' => $fieldName,
                'value' => $value,
                'condition' => $condition->value
            ];

            return $this;
        }

        /**
         * Изменение сортировки
         *
         * @param string $fieldName Поле сортировки
         * @param OrderDirection $orderDirection Направление сортировки
         *
         * @return $this Текущий объект
         */
        public function orderBy(string $fieldName, OrderDirection $orderDirection = OrderDirection::ASC): self
        {
            $this->orderBy = $fieldName;
            $this->orderDirection = $orderDirection;

            return $this;
        }

        /**
         * Изменение количества выбираемых записей
         *
         * @param int $limit Количества выбираемых записей
         *
         * @return $this Текущий объект
         */
        public function limit(int $limit): self
        {
            $this->limit = $limit;

            return $this;
        }

        /**
         * Изменение смещения выборки
         *
         * @param int $offset Значения смещения выборки
         *
         * @return $this Текущий объект
         */
        public function offset(int $offset): self
        {
            $this->offset = $offset;

            return $this;
        }

        /**
         * Получение подготовленного SQL-запроса
         *
         * @return string SQL-запрос
         */
        public function prepareSql(): string
        {
            $termList = [];
            foreach ($this->where as $where) {
                $termList[] = "{$where['fieldName']} {$where['condition']} :{$where['fieldName']}";
            }

            $sql = '';

            if (!empty($termList)) {
                $sql = 'WHERE ' . implode(' AND ', $termList);
            }
            if (!empty($this->orderBy)) {
                $sql .= " ORDER BY {$this->orderBy} {$this->orderDirection->value}";
            }
            if ($this->offset !== null) {
                $offset = max(0, $this->offset);
                $sql .= " OFFSET {$offset}";
            }
            if ($this->limit !== null) {
                $limit = max(1, $this->limit);
                $sql .= " LIMIT {$limit}";
            }

            return $sql;
        }

        /**
         * Получение списка значений, подставляемых в условие
         *
         * @return string[] Список значений
         */
        public function getWhereBindValues(): array
        {
            $bindValues = [];
            foreach ($this->where as $where) {
                $bindValues[$where['fieldName']] = $where['value'];
            }

            return $bindValues;
        }
    }
