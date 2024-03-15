<?php

namespace App\Modules\Rate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $table = 'rates';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['code', 'value'];
}
