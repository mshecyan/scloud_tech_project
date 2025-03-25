<?php

    namespace src\DataAccess;

    use PDO;

    /**
     * Класс подключения к базе данных
     *
     * @author n.mshecyan
     */
    final class Database
    {
        /** @var PDO|null Объект подключения к базе данных */
        private static ?PDO $dbObject = null;

        private function __construct()
        {

        }

        /**
         * Подключение к базе данных
         *
         * @return PDO Объект подключения к базе данных
         */
        private static function connect(): PDO
        {
            $dbConfig = parse_ini_file(CONFIGS_DIR . 'database.ini');
            $dsn = "pgsql:host={$dbConfig['Host']};port={$dbConfig['Port']};dbname={$dbConfig['DbName']}";

            return new PDO($dsn, $dbConfig['User'], $dbConfig['Password']);
        }

        /**
         * Получение объекта подключения к базе данных
         *
         * @return PDO Объект подключения к базе данных
         */
        public static function getInstance(): PDO
        {
            return self::$dbObject ??= self::connect();
        }
    }
