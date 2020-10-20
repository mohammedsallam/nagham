<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
  
  public function index($city_id)
  {
    $city= City::find($city_id);
    $types= $city -> types;
    $types = Type::select('id', 'name', 'information', 'imageUrl')->get();
    return view('admin.web.type', compact('types'));
  }
  // public function index($city_id)
  // {
  //   $city= City::find($city_id);
  //   $types= $city -> types;
  //   return view('admin.web.type' ,compact('types'));
  // }

    public function create(Request $request)
  {
    $types = new Type();

   $types->name = $request->name;
   $types->information = $request->information;
   $imageName='details'. time() . '.' .$request->imageUrl->getClientOriginalExtension() ;
   $types->imageUrl = $imageName;
   $request->imageUrl->move(public_path('images'), $imageName );
   $types->save();
   return redirect('/type');
  }
    public function show($id)
  {
    
  }

    public function edit($id)
  {
    
  }

  public function update(Request $request )
  {
     $oldtype = Type::find($request-> id);
     $oldtype->name = $request->name;
     $oldtype->information = $request->information;
     if($request->imageUrl){
      $imageName='type'. time() . '.' .$request->imageUrl->getClientOriginalExtension() ;
      $oldtype->imageUrl = $imageName;
      $request->imageUrl->move(public_path('images'), $imageName );
     }
     $oldtype->save();

     return redirect('/type');
  }

  
  public function delate($id)

  {
    $oldtype = Type::find($id);
    $oldtype -> delete();
    return redirect('/type');
  }

 
}
