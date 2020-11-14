<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $fillable =['name', 'imageUrl', 'information','type_id'];

    //realation
public function detail()
{
    return $this->hasOne(Detail::class);
}

public function type()
{
    $this -> belongsTo(Type::class, 'type_id', 'id');

}

}
