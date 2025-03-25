<?php

    namespace src\WebApi;

    use src\Models\Shared\Exceptions\{ApiException,
        AppException,
        AuthException,
        PermissionException,
        SanitizeException};
    use Throwable;

    /**
     * Класс для работы с результатом выполнения API-запросов
     *
     * @author n.mshecyan
     */
    class Response
    {
        /**
         * Вывод результата успешного выполнения запроса
         *
         * @param mixed $responseData Выводимые данные
         * @return void
         */
        public static function outputSuccess(mixed $responseData): void
        {
            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode(
                [
                    'success' => true,
                    'data' => $responseData
                ],
                JSON_UNESCAPED_UNICODE
            );
        }

        /**
         * Вывод результата неуспешного выполнения запроса
         *
         * @param Throwable $exception Выброшенное исключение
         * @return void
         */
        public static function outputError(Throwable $exception): void
        {
            header('Content-Type: application/json');

            $message = $exception->getMessage();
            switch ($exception) {
                case $exception instanceof ApiException:
                case $exception instanceof AppException:
                case $exception instanceof SanitizeException:
                    http_response_code(400);
                    break;
                case $exception instanceof AuthException:
                    http_response_code(401);
                    break;
                case $exception instanceof PermissionException:
                    http_response_code(403);
                    break;
                default:
                    http_response_code(500);
                    $message = 'Произошла внутренняя ошибка.';
            }

            echo json_encode(
                [
                    'success' => false,
                    'error' => [
                        'message' => $message,
                        'code' => $exception->getCode(),
                    ]
                ],
                JSON_UNESCAPED_UNICODE
            );
        }
    }
