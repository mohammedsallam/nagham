<?php

namespace App\Http\Controllers;

use App\Models\Details;
use Illuminate\Http\Request;

class DetailsController extends Controller
{

    protected $view = 'admin.details.';

    public function index()
    {
      $details=Details::all();
        return view($this->view.'index',compact('details'));
    }

      public function create(Request $request)
    {
      $details = new Details();

     $details->name = $request->name;
     $details->information = $request->information;
     $imageName='details'. time() . '.' .$request->imageUrl->getClientOriginalExtension() ;
     $details->imageUrl = $imageName;
     $request->imageUrl->move(public_path('images'), $imageName );
     $details->save();
     return redirect('/details');
    }
      public function show($id)
    {

    }

      public function edit($id)
    {

    }

    public function update(Request $request )
    {
       $olddetails = Details::find($request-> id);
       $olddetails->name = $request->name;
       $olddetails->information = $request->information;
       if($request->imageUrl){
        $imageName='details'. time() . '.' .$request->imageUrl->getClientOriginalExtension() ;
        $olddetails->imageUrl = $imageName;
        $request->imageUrl->move(public_path('images'), $imageName );
       }
       $olddetails->save();

       return redirect('/details');
    }


    public function delate($id)

    {
      $olddetails = Details::find($id);
      $olddetails -> delete();
      return redirect('/details');
    }

}
