<?php

namespace App;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'id', 'name','link1','link2'
    ];

    public function products (){
        return $this->hasMany('App\Product');
    }
}
