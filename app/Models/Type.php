<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable =['name', 'imageUrl', 'information', 'city_id']; // 'name', 'imageUrl', 'information',

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');

    }

    public function contents()
    {
         return $this->hasMany(Content::class, 'type_id', 'id');
    }
}
