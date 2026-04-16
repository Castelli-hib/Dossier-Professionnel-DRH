<?php

namespace App\Enum;

enum Direction: string
{
    case CABINET = 'Cabinet du Maire';
    case DGS = 'Direction Générale des Services';
    case CTM = 'Direction des Services Technique';
    case RH = 'Ressources Humaines';
    case FINANCES = 'Finances et Achat public';
    case DSI = 'Systèmes d’Information';
    case ADMIN = 'Administration Générale et Juridique';
    case EDUC = 'Education / Enfance et Jeunesse';
    case COMM = 'Communication / Événementiel';
    case CASS = 'Direction de la Culture /Action Sociale et Solidarité';
    case URBA = 'Urabanisme et Patrimoine . Voierie';
    case SPM = 'Direction Sécurité et Police Municipale';
    case MAR = 'Direction Maritime et portuaire';
    case RISK = 'Direction transversales et Grands Projets';
}