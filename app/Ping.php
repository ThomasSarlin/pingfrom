<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    protected $table = 'pings';
    public $timestamps = true;
}
