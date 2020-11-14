<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Detail;
use App\Models\Type;
use Illuminate\Http\Request;

class RrlationController extends Controller
{
    public function hasoneRrlation()
    {
        $content = Content::with(['details' => function ($q) {
            $q->select('name', 'imageUrl', 'information', 'content_id');
        }]);
        return response()->json($content);
    }
    public function citytype()
    {
       $d=Type::with('App\Models\cities');
      return $d -> name;
    }
}
