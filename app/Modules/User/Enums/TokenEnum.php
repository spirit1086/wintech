<?php
namespace App\Modules\User\Enums;

enum TokenEnum: string
{
    case REFRESH_TOKEN = 'refresh-token';
    case ACCESS_TOKEN = 'access-token';
}
