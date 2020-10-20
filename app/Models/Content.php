<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $tabel ='contents';
    protected $fillable =['name', 'imageUrl', 'information','type_id'];

    //realation
public function details()
{
    return $this->belongsTo('App\Models\Details', 'details_id', null);
}

public function type()
{
    $this -> belongsTo('App\Models\Type', 'type_id', 'id');
    
}

}
