<?php

namespace App\Enums;

enum RoleEnum: string {
    case User = 'User';
    case Blogger = 'Blogger';
    case Admin = 'Admin';
}
