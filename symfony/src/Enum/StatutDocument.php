<?php

namespace App\Enum;

enum StatutDocument: string
{
    case BROUILLON = 'brouillon';
    case VALIDE = 'valide';
    case PUBLIE = 'publie';
    case ARCHIVE = 'archive';
}

