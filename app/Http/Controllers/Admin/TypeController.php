<?php

namespace App\Http\Controller\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class TypeController extends Controller
{

    protected $view = 'admin.types.';


    public function index()
    {
//        if ($city->id){
//            $types = $city->types()->cursor();
//        } else {
//            $types = Type::cursor();
//        }

        $types = Type::cursor();
        $cities = City::pluck('id', 'name');
        return view($this->view.'index', compact('types', 'cities'));
    }
  // public function index($city_id)
  // {
  //   $city= City::find($city_id);
  //   $types= $city -> types;
  //   return view('admin.web.type' ,compact('types'));
  // }

    public function store(Request $request)
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

        return redirect()->route('types.index')->withMessage('Type added successfully');
    }
    public function show($city)
    {
        $city = City::find($city);
        $types = $city->types()->cursor();
        $cities = City::pluck('id', 'name');
        return view($this->view.'index', compact('types', 'cities'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, Type $type)
    {

      $this->validate($request, [
          'name' => 'required|min:3',
          'information' => 'required|min:3',
          'city_id' => 'required',
          'imageUrl' => 'sometimes',
      ], [], []);

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


     return redirect()->route('types.index')->withMessage('Type updated successfully');
    }


    public function destroy(Type $type)
    {

        if ($type->contents()->cursor()->count()){
          foreach ($type->contents()->cursor() as $content) {
              File::delete(public_path().$content->imageUrl);
              if ($content->detail){
                  if (fileExists(public_path().$content->detail->imageUrlLocation)){
                      File::delete(public_path().$content->detail->imageUrlLocation);
                  }
                  if (fileExists(public_path().$content->detail->imageUrl1)){
                      File::delete(public_path().$content->detail->imageUrl1);
                  }
                  if (fileExists(public_path().$content->detail->imageUrl2)){
                      File::delete(public_path().$content->detail->imageUrl2);
                  }
                  if (fileExists(public_path().$content->detail->imageUrl3)){
                      File::delete(public_path().$content->detail->imageUrl3);
                  }
              }
          }
        }

        File::delete(public_path().$type->imageUrl);
        $type -> delete();
        return redirect()->route('types.index')->withMessage('Type deleted successfully');
    }


}
