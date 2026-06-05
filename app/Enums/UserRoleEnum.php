<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case MITRA = 'mitra';
    case PESERTA = 'peserta';
}
