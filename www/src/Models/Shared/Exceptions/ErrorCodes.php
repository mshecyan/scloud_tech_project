<?php

    namespace src\Models\Shared\Exceptions;

    /**
     * Коды ошибок
     *
     * @author n.mshecyan
     */
    class ErrorCodes
    {
        // Коды общих ошибок
        public const int CLASS_DOES_NOT_EXIST = 1;
        public const int DEPENDENCY_NOT_FOUND = 2;
        public const int INVALID_COLLECTION_ITEM_TYPE = 3;
        public const int UPLOAD_FILE_MOVE_FAILED = 4;
        public const int FILE_UPLOAD_ERROR = 5;
        public const int USER_NOT_FOUND = 6;
        public const int UPLOADED_FILE_TOO_BIG = 7;

        // Коды ошибок API
        public const int API_METHOD_NOT_SPECIFIED = 100;
        public const int API_METHOD_DOES_NOT_EXIST = 101;

        // Коды ошибок санитизации
        public const int SANITIZE_INVALID_VALUE_TYPE = 200;
        public const int SANITIZE_INCORRECT_STRING_LENGTH = 201;
        public const int SANITIZE_STRING_CONTAINS_INVALID_CHARS = 202;
        public const int SANITIZE_INCORRECT_NUMBER_RANGE = 203;
        public const int SANITIZE_INCORRECT_EMAIL = 204;
        public const int SANITIZE_INCORRECT_PHONE = 205;
        public const int SANITIZE_NOT_ALLOWED_UPLOAD_FILE_TYPE = 206;

        // Коды ошибок прав доступа
        public const int ACCESS_DENIED = 300;

        // Коды ошибок авторизации
        public const int UNAUTHORIZED_ERROR = 401;
        public const int INVALID_LOGIN_OR_PASSWORD = 402;
    }
