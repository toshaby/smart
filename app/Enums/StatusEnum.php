<?php

namespace App\Enums;

enum StatusEnum: string
{
    case new = 'new';
    case working = 'working';
    case processed = 'processed';

    public function getName()
    {
        $name = '';
        switch ($this->name) {
            case 'new':
                $name = 'Новый';
                break;
            case 'working':
                $name = 'В работе';
                break;
            case 'processed':
                $name = 'Обработан';
                break;
        }
        return $name;
    }
}
