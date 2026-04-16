<?php

namespace App\Enum;

enum StatutActualite: string
{
    case BROUILLON = 'brouillon';
    case EN_VALIDATION = 'en_validation';
    case PUBLIEE = 'publiee';
    case ARCHIVEE = 'archivee';
}



