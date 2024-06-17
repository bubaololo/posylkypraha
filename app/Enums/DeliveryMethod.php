<?php

namespace App\Enums;

enum DeliveryMethod: string
{
    case EMS = 'ems';
    case POST = 'post';
}