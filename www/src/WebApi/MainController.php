<?php

    namespace src\WebApi;

    use src\Models\Collection;
    use src\Models\Shared\DependencyContainer;
    use src\WebApi\Controllers\{AuthController, ContactsController};
    use src\Models\Shared\Exceptions\AppException;
    use src\Models\Shared\Exceptions\SanitizeException;

    /**
     * Основной контроллер API
     *
     * @author n.mshecyan
     */
    class MainController
    {
        /** @var ContactsController Контроллер для работы с контактными данными */
        private ContactsController $contactsController;

        /** @var AuthController Контроллер для работы с авторизацией */
        private AuthController $authController;

        public function __construct()
        {
            $this->contactsController = DependencyContainer::createScope(ContactsController::class);
            $this->authController = DependencyContainer::createScope(AuthController::class);
        }

        /**
         * Авторизация пользователя
         *
         * @return bool Признак успешного выполнения
         * @throws SanitizeException
         */
        public function login(): bool
        {
            return $this->authController->authorize();
        }

        /**
         * Выход из системы
         *
         * @return bool Признак успешного выполнения
         */
        public function logout(): bool
        {
            return $this->authController->logout();
        }

        /**
         * Отправка контактных данных
         *
         * @return bool Признак успешного выполнения
         * @throws SanitizeException|AppException
         */
        public function sendContacts(): bool
        {
            return $this->contactsController->addContacts();
        }

        /**
         * Получение списка контактных данных
         *
         * @return Collection Коллекция контактных данных
         * @throws SanitizeException
         */
        public function getContactList(): Collection
        {
            return $this->contactsController->getContactList();
        }

        /**
         * Удаление контактных данных
         *
         * @return bool Признак успешного выполнения
         * @throws SanitizeException
         */
        public function deleteContact(): bool
        {
            return $this->contactsController->deleteContact();
        }
    }
