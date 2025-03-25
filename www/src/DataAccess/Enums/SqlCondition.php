<?php

    namespace src\DataAccess\Enums;

    /**
     * Варианты условий сравнения
     *
     * @author n.mshecyan
     */
    enum SqlCondition: string
    {
        /** @var string Входит в массив */
        case In = 'IN';

        /** @var string Равно */
        case Equal = '=';

        /** @var string Больше */
        case Greater = '>';

        /** @var string Больше или равно */
        case GreaterOrEqual = '>=';

        /** @var string Меньше */
        case Less = '<';

        /** @var string Меньше или равно */
        case LessOrEqual = '<=';
    }
