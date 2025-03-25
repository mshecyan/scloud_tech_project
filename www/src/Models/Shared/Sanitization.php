<?php

    namespace src\Models\Shared;

    use src\Models\Shared\Exceptions\{AppException, ErrorCodes, SanitizeException};

    /**
     * Класс для сантизиации входных значений
     *
     * @author n.mshecyan
     */
    class Sanitization
    {
        /** @var string[] Разрешенные типы изображений */
        private const array ALLOWED_IMAGE_TYPES = [
            'image/jpg',
            'image/jpeg',
            'image/png'
        ];

        /** @var int Максимальный размер файла изображения */
        private const int MAX_IMAGE_FILE_SIZE = 2000000;

        /**
         * Санитизация строкового значения
         *
         * @param mixed $value Входное значение
         * @param int|null $minLength Минимальна длина строки
         * @param int|null $maxLength Максимальная длина строки
         *
         * @return string Санитизированная строка
         * @throws SanitizeException
         */
        public static function forString(mixed $value, ?int $minLength = null, ?int $maxLength = null): string
        {
            if (empty($value) || !is_string($value)) {
                throw new SanitizeException(ErrorCodes::SANITIZE_INVALID_VALUE_TYPE);
            }

            if (
                !is_null($minLength) && strlen($value) < $minLength
                || !is_null($maxLength) && strlen($value) > $maxLength
            ) {
                throw new SanitizeException(ErrorCodes::SANITIZE_INCORRECT_STRING_LENGTH);
            }

            $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            if ($value === false) {
                throw new SanitizeException(ErrorCodes::SANITIZE_STRING_CONTAINS_INVALID_CHARS);
            }

            return trim(strip_tags($value));
        }

        /**
         * Санитизация числового значения
         *
         * @param mixed $value Входное значение
         * @param int|null $minNumber Нижний предел диапазона
         * @param int|null $maxNumber Верхний предел диапазона
         *
         * @return int Санитизированное число
         * @throws SanitizeException
         */
        public static function forNumber(
            mixed $value,
            ?int $minNumber = null,
            ?int $maxNumber = null
        ): int
        {
            if (!is_numeric($value)) {
                throw new SanitizeException(ErrorCodes::SANITIZE_INVALID_VALUE_TYPE);
            }

            $value = intval($value);
            if (
                !is_null($minNumber) && $value < $minNumber
                || !is_null($maxNumber) && strlen($value) > $maxNumber
            ) {
                throw new SanitizeException(ErrorCodes::SANITIZE_INCORRECT_NUMBER_RANGE);
            }

            return $value;
        }

        /**
         * Санитизация электронной почты
         *
         * @param mixed $value Электронная почта
         *
         * @return string Санитизированная электронная почта
         * @throws SanitizeException
         */
        public static function forEmail(mixed $value): string
        {
            $value = self::forString($value);

            $value = filter_var($value, FILTER_SANITIZE_EMAIL);
            if ($value === false) {
                throw new SanitizeException(ErrorCodes::SANITIZE_INCORRECT_EMAIL);
            }

            return $value;
        }

        /**
         * Санитизация телефона
         *
         * @param mixed $value Телефон
         *
         * @return string Санитизированный телефон
         * @throws SanitizeException
         */
        public static function forPhone(mixed $value): string
        {
            $value = self::forString($value);

            if (preg_match_all('/(\d+)+/', $value, $matches) === false) {
                throw new SanitizeException(ErrorCodes::SANITIZE_INCORRECT_PHONE);
            }

            $value = implode('', current($matches));
            if (empty($value)) {
                throw new SanitizeException(ErrorCodes::SANITIZE_INCORRECT_PHONE);
            }

            return $value;
        }

        /**
         * Санитизация файла изображения
         *
         * @param array $file Файл
         *
         * @return string Имя файла, сохраненного во временной директории
         * @throws SanitizeException|AppException
         */
        public static function forImageFile(array $file): string
        {
            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new AppException(ErrorCodes::FILE_UPLOAD_ERROR);
            }

            if ($file['size'] > self::MAX_IMAGE_FILE_SIZE) {
                throw new AppException(ErrorCodes::UPLOADED_FILE_TOO_BIG);
            }

            if (!in_array(mime_content_type($file['tmp_name']), self::ALLOWED_IMAGE_TYPES, true)) {
                throw new SanitizeException(ErrorCodes::SANITIZE_NOT_ALLOWED_UPLOAD_FILE_TYPE);
            }

            return $file['tmp_name'];
        }
    }
