<?php

namespace App\Enum;

enum Status: string
{
    case PAID = 'paid';
    case IN_PREPARATION = 'in_preparation';
    case READY = 'ready';
    case COMPLETE = 'complete';
}
