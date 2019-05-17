<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleUser extends Model
{
    public $PK_Us_Id = 'Us_Id';
    public $FK_Co_Id = 'Us_Co_Id';
    public $Us_Name = 'Us_Name';

    public function getCountry(){
        return $this->belongsTo('App\Country','Us_Co_Id');
    }

    public function getPosts(){
        return $this->hasMany(Post::class,'Po_Us_Id','Us_Id');
    }
}
