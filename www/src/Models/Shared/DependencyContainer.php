<?php

    namespace src\Models\Shared;

    use ReflectionException;
    use ReflectionMethod;
    use src\Models\Abstractions\{IAuthService, IContactsService, IPermissionsService, IUsersService};
    use src\Models\{AuthService, ContactsService, PermissionsService, UsersService};
    use src\Models\Shared\Exceptions\{AppException, ErrorCodes};

    /**
     * Класс для создания экземпляров класса с зависимостями
     *
     * @author n.mshecyan
     */
    class DependencyContainer
    {
        /** @var string[] Список зависимостей */
        private const array DEPENDENCY_LIST = [
            IContactsService::class => ContactsService::class,
            IAuthService::class => AuthService::class,
            IPermissionsService::class => PermissionsService::class,
            IUsersService::class => UsersService::class,
        ];

        /**
         * Создание экземпляра класса со всеми зависимостями
         *
         * @param string $className Имя класса создаваемого объекта
         *
         * @return mixed Экземпляр класса
         * @throws AppException|ReflectionException
         */
        public static function createScope(string $className): mixed
        {
            if (!class_exists($className)) {
                throw new AppException(ErrorCodes::CLASS_DOES_NOT_EXIST);
            }

            $constructParameters = (new ReflectionMethod($className, '__construct'))->getParameters();
            $dependencies = [];

            foreach ($constructParameters as $parameter) {
                $parameterType = $parameter->getType()->getName();
                $dependencyClassName = self::DEPENDENCY_LIST[$parameterType];
                if (empty($dependencyClassName)) {
                    throw new AppException(ErrorCodes::DEPENDENCY_NOT_FOUND);
                }

                $dependencies[] = self::createScope($dependencyClassName);
            }

            return new $className(...$dependencies);
        }
    }
