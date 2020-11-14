<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone1', 'phone2', 'phone3', 'emailFacebook', 'emailInstagram', 'location',
        'link', 'notes', 'imageUrlLocation', 'imageUrl1', 'imageUrl2', 'imageUrl3', 'content_id'
    ];

    //realation
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function hasoneRrlation()
    {
        $content = Content::with(['details' => function ($q) {
            $q->select('name', 'imageUrl', 'information', 'content_id');
        }]);
        return response()->json($content);
    }
}
