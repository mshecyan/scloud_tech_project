<?php

    namespace src\Models;

    use src\DataAccess\Entities\Contact;
    use src\DataAccess\Enums\OrderDirection;
    use src\DataAccess\Filter;
    use src\Models\Abstractions\IContactsService;
    use src\Models\Shared\Exceptions\{AppException, ErrorCodes};

    /**
     * Сервис для работы с контактными данными
     *
     * @author n.mshecyan
     */
    class ContactsService implements IContactsService
    {
        /** @var int Стандартное количество выбираемых записей */
        public const int DEFAULT_ITEMS_PER_PAGE = 10;

        public function __construct()
        {

        }

        /**
         * Добавление контактных данных
         *
         * @param string $name Имя пользователя
         * @param string $email Почта
         * @param string|null $phone Телефон
         * @param string|null $photo Фото
         *
         * @return bool Признак успешного выполнения
         * @throws AppException
         */
        public function addContact(string $name, string $email, ?string $phone = null, ?string $photo = null): bool
        {
            $contact = (new Contact())
                ->setName($name)
                ->setEmail($email)
                ->setPhone($phone);

            if (!empty($photo)) {
                $photoFilename = uniqid();
                $photoSavePath = BACKEND_MEDIA_DIR . $photoFilename;
                if (!move_uploaded_file($photo, $photoSavePath)) {
                    throw new AppException(ErrorCodes::UPLOAD_FILE_MOVE_FAILED);
                }
                $contact->setPhoto($photoFilename);
            }

            return $contact->save();
        }

        /**
         * Удаление контактных данных
         *
         * @param string $contactId Идентификатор контактных данных
         *
         * @return bool Признак успешного выполнения
         */
        public function deleteContact(string $contactId): bool
        {
            return Contact::delete($contactId);
        }

        /**
         * Получение контактных данных
         *
         * @param int $offset Смещение выборки
         * @param string $limit Количество выбираемых записей
         *
         * @return Collection Коллекция контактных данных
         * @throws AppException
         */
        public function getContactList(int $offset = 0, string $limit = self::DEFAULT_ITEMS_PER_PAGE): Collection
        {
            $filter = (new Filter())
                ->orderBy('created', OrderDirection::DESC)
                ->offset($offset)
                ->limit($limit);

            $contactList = Contact::select($filter);
            $result = new Collection(DTO\Contact::class);
            foreach ($contactList as $contact) {
                $contactDto = new DTO\Contact();
                $contactDto->id = $contact->getId();
                $contactDto->name = $contact->getName();
                $contactDto->email = $contact->getEmail();
                $contactDto->phone = $contact->getPhone();
                $contactDto->photo = $contact->getPhoto();
                $contactDto->created = date('d.m.Y H:i:s', strtotime($contact->getCreated()));

                $result->add($contactDto);
            }

            return $result;
        }

        /**
         * Получение общего количество контактных данных
         *
         * @return int Количество контактных данных
         */
        public function getContactsCount(): int
        {
            return Contact::getCount();
        }
    }
