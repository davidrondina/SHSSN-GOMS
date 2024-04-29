<?php

namespace App\Enums;

enum UserRole: string
{
    case AD = 'admin';
    case CO = 'counselor';
    case FA = 'faculty';
    case ST = 'student';
}
