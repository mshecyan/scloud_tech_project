<?php

    namespace src\Models;

    use src\Models\Abstractions\{IAuthService, IPermissionsService, IUsersService};
    use src\Models\Enums\UserRole;
    use src\Models\Shared\Exceptions\{AuthException, ErrorCodes, PermissionException};

    /**
     * Сервис работы с правами пользователя
     *
     * @author n.mshecyan
     */
    class PermissionsService implements IPermissionsService
    {
        /** @var IAuthService Объект сервиса работы с авторизацией */
        private IAuthService $authService;

        /** @var IUsersService Объект сервиса работы с пользователями */
        private IUsersService $usersService;

        public function __construct(IAuthService $authService, IUsersService $usersService)
        {
            $this->authService = $authService;
            $this->usersService = $usersService;
        }

        /**
         * Проверка авторизации и прав
         *
         * @param UserRole $needRole Требуемая роль
         *
         * @throws AuthException|PermissionException
         * @return void
         */
        public function checkAuthAndPermissionsOrThrow(UserRole $needRole): void
        {
            if (!$this->authService->isAuthorized()) {
                throw new AuthException(ErrorCodes::UNAUTHORIZED_ERROR);
            }

            $user = $this->usersService->getUserById($_SESSION['userId']);
            if ($user?->getRole() !== $needRole) {
                throw new PermissionException(ErrorCodes::ACCESS_DENIED);
            }
        }
    }
