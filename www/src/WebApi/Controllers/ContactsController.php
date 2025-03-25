<?php

    namespace src\WebApi\Controllers;

    use src\Models\Abstractions\{IContactsService, IPermissionsService};
    use src\Models\{Collection, ContactsService, Shared\Exceptions\AppException, Shared\Exceptions\SanitizeException};
    use src\Models\Enums\UserRole;
    use src\Models\Shared\Sanitization;

    /**
     * Контроллер API-методов для работы с контактными данными
     *
     * @author n.mshecyan
     */
    class ContactsController
    {
        /** @var IContactsService Объект сервиса работы с контактными данными */
        private IContactsService $contactsService;

        /** @var IPermissionsService Объект сервиса работы с правами пользователя */
        private IPermissionsService $permissionsService;

        public function __construct(IContactsService $contactsService, IPermissionsService $permissionsService)
        {
            $this->contactsService = $contactsService;
            $this->permissionsService = $permissionsService;
        }

        /**
         * Добавление контактных данных
         *
         * @return bool Признак успешного выполнения
         * @throws SanitizeException|AppException
         */
        public function addContacts(): bool
        {
            $name = Sanitization::forString($_POST['name'] ?? '');
            $email = Sanitization::forEmail($_POST['email'] ?? '');

            $phone = !empty($_POST['phone'])
                ? Sanitization::forPhone($_POST['phone'])
                : null;

            $photo = !empty($_FILES['photo']) && $_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE
                ? Sanitization::forImageFile($_FILES['photo'])
                : null;

            if (!$this->contactsService->addContact($name, $email, $phone, $photo)) {
                return false;
            }

            setcookie('contactsWasSent', true, time() + 1440, '/');

            return true;
        }

        /**
         * Получение общего количество контактных данных
         *
         * @return int Количество контактных данных
         */
        public function getContactsCount(): int
        {
            $this->permissionsService->checkAuthAndPermissionsOrThrow(UserRole::Admin);

            return $this->contactsService->getContactsCount();
        }

        /**
         * Получение контактных данных
         *
         * @return Collection Коллекция контактных данных
         * @throws SanitizeException
         */
        public function getContactList(): Collection
        {
            $this->permissionsService->checkAuthAndPermissionsOrThrow(UserRole::Admin);

            $page = Sanitization::forNumber($_REQUEST['page'] ?? 1);
            $limit = ContactsService::DEFAULT_ITEMS_PER_PAGE;
            $offset = ($page - 1) * $limit;

            return $this->contactsService->getContactList($offset, $limit);
        }

        /**
         * Удаление контактных данных
         *
         * @return bool Признак успешного выполнения
         * @throws SanitizeException
         */
        public function deleteContact(): bool
        {
            $this->permissionsService->checkAuthAndPermissionsOrThrow(UserRole::Admin);

            $contactId = Sanitization::forNumber($_POST['id'], 1);

            return $this->contactsService->deleteContact($contactId);
        }

        /**
         * Проверка наличия отправленных контактных данных
         *
         * @return bool Признак отправленных контактных данных
         */
        public function checkContactsAlreadySent(): bool
        {
            return isset($_COOKIE['contactsWasSent']);
        }
    }
