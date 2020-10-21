<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class TypeController extends Controller
{

    protected $view = 'admin.types.';


    public function index(City $city)
  {
      if ($city->id){
          $types = $city->types()->cursor();
      } else {
          $types = Type::cursor();
      }

    $cities = City::pluck('id', 'name');
    return view($this->view.'index', compact('types', 'cities'));
  }
  // public function index($city_id)
  // {
  //   $city= City::find($city_id);
  //   $types= $city -> types;
  //   return view('admin.web.type' ,compact('types'));
  // }

    public function create(Request $request)
  {

      $this->validate($request, [
          'name' => 'required|min:3',
          'information' => 'required|min:3',
          'city_id' => 'required',
          'imageUrl' => 'required',
      ], [], []);

      $imageName = 'type_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
      $imagePath = '/uploads/'.$imageName;
      $request->imageUrl->move(public_path('uploads'), $imageName);

      Type::create([
          'name' => $request->name,
          'information' => $request->information,
          'city_id' => $request->city_id,
          'imageUrl' => $imagePath,
      ]);

   return redirect('/type');
  }
    public function show($id)
  {

  }

    public function edit($id)
  {

  }

  public function update(Request $request, $id)
  {

      $this->validate($request, [
          'name' => 'required|min:3',
          'information' => 'required|min:3',
          'city_id' => 'required',
          'imageUrl' => 'sometimes',
      ], [], []);

      $type = Type::find($id);

      $type->update($request->except(['imageUrl']));

      if ($request->imageUrl){
          if ($type->imageUrl){
              if (fileExists(public_path().$type->imageUrl)){
                  File::delete(public_path().$type->imageUrl);
              }

              $imageName = 'type_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
              $imagePath = '/uploads/'.$imageName;
              $request->imageUrl->move(public_path('uploads'), $imageName);
              $type->update(['imageUrl' => $imagePath]);

          } else {
              $imageName = 'type_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
              $imagePath = '/uploads/'.$imageName;
              $request->imageUrl->move(public_path('uploads'), $imageName);
              $type->update(['imageUrl' => $imagePath]);
          }
      }


     return redirect('/type');
  }


  public function delete($id)

  {
    $oldtype = Type::find($id);
      File::delete(public_path().$oldtype->imageUrl);
    $oldtype -> delete();
    return redirect('/type');
  }


}
