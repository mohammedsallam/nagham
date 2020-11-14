<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class CityController extends Controller
{


    protected $view = 'admin.cities.';

    public function index()
    {
        $cities = City::select('id', 'name', 'information', 'imageUrl')->get();
        return view($this->view.'index', compact('cities'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|min:3',
        'information' => 'required|min:3',
//        'type' => 'required|string|min:3',
        'imageUrl' => 'required|image|mimes:jpg,png,jpeg',
        ], [], []);



        $imageName = 'city_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
        $imagePath = '/uploads/'.$imageName;
        $request->imageUrl->move(public_path('uploads'), $imageName);

        $city = City::create([
        'name' => $request->name,
        'information' => $request->information,
        'imageUrl' => $imagePath
        ]);

//        Type::create([
//        'city_id' => $city->id,
//        'type' => $request->type
//        ]);

        return redirect()->route('cityIndex')->withMessage('City added successfully');
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


    public function update(Request $request, City $city)
    {
        $this->validate($request, [
        'name' => 'required|min:3',
        'information' => 'required|min:3',
//        'type' => 'required|string|min:3',
        'imageUrl' => 'sometimes',
        ], [], []);

        $city->update($request->except(['imageUrl']));

        if ($request->imageUrl){
            if ($city->imageUrl){
                if (fileExists(public_path().$city->imageUrl)){
                    File::delete(public_path().$city->imageUrl);
                }

                $imageName = 'city_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
                $imagePath = '/uploads/'.$imageName;
                $request->imageUrl->move(public_path('uploads'), $imageName);
                $city->update(['imageUrl' => $imagePath]);

            } else {
                $imageName = 'city_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
                $imagePath = '/uploads/'.$imageName;
                $request->imageUrl->move(public_path('uploads'), $imageName);
                $city->update(['imageUrl' => $imagePath]);
            }
        }


        return redirect()->route('cityIndex')->withMessage('City updated successfully');
    }


    public function delete(City $city)
    {
        if (!$city) {
            return abort('404');
        }
        if ($city->types()->cursor()->count()){
            foreach ($city->types()->cursor() as $type) {
                File::delete(public_path().$type->imageUrl);
            }
        }
        File::delete(public_path().$city->imageUrl);
        $city->delete();
        return redirect('/city')->withMessage('City deleted successfully');
    }

}
