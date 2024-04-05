<?php

namespace App\Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'user_wallet';
    protected $fillable = ['user_id'];
}
