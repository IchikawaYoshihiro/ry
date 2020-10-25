<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = ['redirect_id', 'ip', 'ua'];
    public $timestamps = false;
}
