<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $tabel ='types';
    protected $fillable =['name', 'imageUrl', 'information', 'city_id'];

    public function city()
    {
        $this -> belongsTo('App\Models\City', 'city_id', 'id');
        
    }

    public function types()
    {
         $this -> hasMany('App\Models\Content', 'type_id', 'id');
    }
}
