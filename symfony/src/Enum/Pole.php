<?php

namespace App\Enum;

enum Pole: string
{
    case POPULATION = 'Population';
    case DEVELOPPEMENT = 'Développement';
    case TERRITOIRE = 'Territoire';
    case RESSOURCES = 'Ressources';
    case ADMIN = 'Administration';
}
