<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'information' => 'required|min:3',
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

        return redirect()->route('cities.index')->withMessage('City added successfully');
    }

    public function update(Request $request, City $city)
    {
        $this->validate($request, [
        'name' => 'required|min:3',
        'information' => 'required|min:3',
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


        return redirect()->route('cities.index')->withMessage('City updated successfully');
    }

    public function destroy(City $city)
    {
        if (!$city) {
            return abort('404');
        }
        if ($city->types()->cursor()->count()){
            if ($city->types()->cursor()->count()){
                foreach ($city->types()->cursor() as $type) {
                    File::delete(public_path().$type->imageUrl);
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

                }
            }
        }
        File::delete(public_path().$city->imageUrl);
        $city->delete();
        return redirect()->route('cities.index')->withMessage('City deleted successfully');
    }

}
