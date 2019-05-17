<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'Tbl_Posts';
    public $PK_Po_Id = 'Po_Id';
    public $FK_Co_Id = 'Po_Co_Id';
    public $FK_Us_Id = 'Po_Us_Id';
    public $timestamps = true;

    public function getUser(){
        return $this->belongsTo('App\SimpleUser','Po_Us_Id');
    }
    public function getCountry(){
        return $this->belongsTo('App\Country','Po_Co_Id');
    }
}
