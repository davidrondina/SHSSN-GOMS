<?php
namespace App\Enums;

enum UserRejectionReason: string
{
    case NS = 'No Student Record';
    case LP = 'Invalid Image Proof';
    case OT = 'Other';
}
