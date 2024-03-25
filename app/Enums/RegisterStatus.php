<?php

namespace App\Enums;

enum RegisterStatus: string
{
    case VERIFIED = 'Verified';
    case UNVERIFIED = 'Unverified';
}
