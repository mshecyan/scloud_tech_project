<?php

    /** Точка входа Web API */

    require_once $_SERVER['DOCUMENT_ROOT'] . '/../init.php';

    use src\WebApi\MainController;
    use src\Models\Shared\Exceptions\{ApiException, ErrorCodes};
    use src\WebApi\Response;

    try {
        $method = $_REQUEST['method'] ?? '';
        if (empty($method)) {
            throw new ApiException(ErrorCodes::API_METHOD_NOT_SPECIFIED);
        }
        if (!method_exists(MainController::class, $method)) {
            throw new ApiException(ErrorCodes::API_METHOD_DOES_NOT_EXIST);
        }

        $result = (new MainController())->$method();
        Response::outputSuccess($result);
    } catch (Throwable $exception) {
        Response::outputError($exception);
    }
