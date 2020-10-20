<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $tabel ='cities';
    protected $fillable =['name', 'imageUrl', 'information'];

    public function cities()
    {
         $this -> hasMany('App\Models\Type', 'city_id', 'id');
    }
}
