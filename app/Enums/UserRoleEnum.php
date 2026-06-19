<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case MITRA = 'mitra';
    case PROMOTOR = 'promotor';
}
