<?php

    namespace src\DataAccess\Enums;

    /**
     * Варианты направлений сортировки выборки
     *
     * @author n.mshecyan
     */
    enum OrderDirection: string
    {
        /** @var string По возрастанию */
        case ASC = 'ASC';

        /** @var string По убыванию */
        case DESC = 'DESC';
    }
