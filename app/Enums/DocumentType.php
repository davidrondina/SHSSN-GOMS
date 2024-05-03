<?php
namespace App\Enums;

enum DocumentType: string
{
    case GM = 'Good Moral';
    case PN = 'Promissory Note';
    case DF = 'Dropping Form';
    case FG = 'Failing Grades';
}
