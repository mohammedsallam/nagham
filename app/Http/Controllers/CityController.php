<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CityController extends Controller
{

  public function index()
  {
    $cities = City::select('id', 'name', 'information', 'imageUrl')->get();
    return view('admin.web.city', compact('cities'));
  }

  public function create(Request $request)
  {
    $city = new City();
    $city->name = $request->name;
    $imageName = 'city' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
    $city->imageUrl = $imageName;
    $request->imageUrl->move(public_path('images'), $imageName);
    $city->information = $request->information;
    $city->save();

    return redirect('/city');
  }


  public function store(Request $request)
  {
    //
  }


  public function show($id)
  {
    //
  }


  public function edit($id)
  {
    //
  }


  public function update(Request $request)
  {
    $oldcity = City::find($request->id);
    $oldcity->name = $request->name;
    if ($request->imageUrl) {
      $imageName = 'city' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
      $oldcity->imageUrl = $imageName;
      $request->imageUrl->move(public_path('images'), $imageName);
    }

    $oldcity->information = $request->information;
    $oldcity->save();

    return redirect('/city');
  }


  public function delete($id)
  {
    $oldcity = City::find($id);
    if (!$oldcity)
      return abort('404');

    $oldcity->types()->delete();
    $oldcity->delete();
    return redirect('/city');
  }

  // public function citiesHasTypes()
  // {
  //   return $city = City::whereHas('cities')->get();

  // }

  // public function citiesNotHasTypes()
  // {
  // }
}
