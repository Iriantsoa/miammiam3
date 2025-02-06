<?php

namespace App\Enum;

enum StatusPlat: string
{
    case WAITING = 'waiting';
    case cooking = 'cooking';
    case cooked = 'cooked';
    case delivered = 'delivered';
}
