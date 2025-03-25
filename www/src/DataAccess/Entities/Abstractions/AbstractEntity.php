<?php

    namespace src\DataAccess\Entities\Abstractions;

    use PDO;
    use src\DataAccess\{Database, Filter};
    use src\Models\Collection;
    use src\Models\Shared\Exceptions\AppException;

    /**
     * Абстрактный класс для представления сущности базы данных
     *
     * @author n.mshecyan
     */
    abstract class AbstractEntity implements IDatabaseEntity
    {
        /** @var string Имя таблицы */
        protected const string TABLE_NAME = '';

        /** @var PDO Объект подключения к базе данных */
        protected PDO $dbObject;

        /** @var int Идентификатор сущности */
        protected int $id = 0;

        /** @var string Дата создания сущности */
        protected string $created;

        protected function __construct()
        {
            $this->dbObject = Database::getInstance();
        }

        /**
         * Подготовка SQL-запроса для добавления записи в базу данных
         *
         * @param string[] $fieldNames Имена полей таблицы
         *
         * @return string Подготовленный SQL-запрос
         */
        private function prepareInsertSQL(array $fieldNames): string
        {
            $bindParams = array_map(fn ($elem): string => ":{$elem}", $fieldNames);

            return
                'INSERT INTO ' . static::TABLE_NAME .
                ' (' . implode(', ', $fieldNames) . ') VALUES
                  (' . implode(', ', $bindParams) . ')';
        }

        /**
         * Подготовка SQL-запроса для изменения записи в базе данных
         *
         * @param string[] $fieldNames Имена полей таблицы
         * @param int $id Идентификатор изменяемой записи
         *
         * @return string Подготовленный SQL-запрос
         */
        private function prepareUpdateSQL(array $fieldNames, int $id): string
        {
            $bindParams = array_map(fn ($elem): string => "{$elem} = :{$elem}", $fieldNames);

            return 'UPDATE ' . static::TABLE_NAME . ' SET ' . implode(', ', $bindParams) . ' WHERE id = ' . $id;
        }

        /**
         * Получение полей таблицы
         *
         * @return string[] Список полей
         */
        private function getColumns(): array
        {
            $sql = 'SELECT column_name FROM information_schema.columns WHERE table_name = :tableName';

            $statement = Database::getInstance()->prepare($sql);
            $statement->execute([':tableName' => static::TABLE_NAME]);

            return $statement->fetchAll(PDO::FETCH_COLUMN);
        }

        /**
         * Сохранение изменений сущности
         *
         * @return bool Признак успешного выполнения
         */
        public function save(): bool
        {
            $tableColumns = $this->getColumns();
            $protectedColumns = array_keys(get_class_vars(self::class));
            $setColumns = array_diff($tableColumns, $protectedColumns);

            $sql = $this->id === 0
                ? $this->prepareInsertSQL($setColumns)
                : $this->prepareUpdateSQL($setColumns, $this->id);

            $bindValues = array_flip($setColumns);
            foreach ($setColumns as $columnName) {
                $bindValues[$columnName] = $this->$columnName;
            }

            $statement = Database::getInstance()->prepare($sql);
            $statement->execute($bindValues);

            return $statement->rowCount() !== 0;
        }

        /**
         * Получение сущности по идентификатору
         *
         * @param int $id Идентификатор сущности
         *
         * @return static|null Объект сущности
         */
        public static function getById(int $id): ?static
        {
            $sql = 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = :id';

            $statement = Database::getInstance()->prepare($sql);
            $statement->execute([':id' => $id]);

            $entity = $statement->fetchObject(static::class);

            return is_a($entity, static::class) ? $entity : null;
        }

        /**
         * Удаление сущности
         *
         * @param int $id Идентификатор сущности
         *
         * @return bool Признак успешного выполнения
         */
        public static function delete(int $id): bool
        {
            $sql = 'DELETE FROM ' . static::TABLE_NAME . ' WHERE id = :id';

            $statement = Database::getInstance()->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            return $statement->rowCount() !== 0;
        }

        /**
         * Получение сущностей по заданному фильтру
         *
         * @param Filter|null $filter Объект фильтра
         *
         * @return Collection Коллекция сущностей
         * @throws AppException
         */
        public static function select(?Filter $filter = null): Collection
        {
            $sql = 'SELECT * FROM ' . static::TABLE_NAME . ' ' . ($filter?->prepareSql() ?? '');

            $statement = Database::getInstance()->prepare($sql);
            $statement->execute($filter?->getWhereBindValues());

            $result = new Collection(static::class);
            while ($entity = $statement->fetchObject(static::class)) {
                $result->add($entity);
            }

            return $result;
        }

        /**
         * Получение общего количества сущностей
         *
         * @return int Количество сущностей
         */
        public static function getCount(): int
        {
            $sql = 'SELECT COUNT(*) AS count FROM ' . static::TABLE_NAME;

            $statement = Database::getInstance()->prepare($sql);
            $statement->execute();

            return $statement->fetchColumn() ?? 0;
        }

        /**
         * Получение идентификатора сущности
         *
         * @return int Идентификатор сущности
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * Получение даты создания сущности
         *
         * @return string Дата создания
         */
        public function getCreated(): string
        {
            return $this->created;
        }
    }
