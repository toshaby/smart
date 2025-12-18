<?php

namespace App\Enums;

enum StatusEnum: string
{
    case new = 'new';
    case working = 'working';
    case processed = 'processed';
}
