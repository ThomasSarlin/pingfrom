<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $PK_Co_Id='Co_Id';
    public $Co_Clicks='Co_Clicks';
    public $Co_Title='Co_Title';

    public function getUsers(){
        return $this -> hasMany(SimpleUser::class,'Us_Co_Id','Co_id');
    }
    public function getPosts(){
        return $this -> hasMany(Post::class,'Po_Co_Id','Co_id');
    }
}
