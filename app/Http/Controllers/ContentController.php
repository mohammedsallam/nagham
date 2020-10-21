<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Type;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    protected $view = 'admin.contents.';


    public function index($type_id)
  {
     $type= Type::find($type_id);
     $contents= $type -> contents;
     return view($this->view.'index' ,compact('contents'));
  }
      public function create(Request $request)
    {
     $content = new Content();
     $content->name = $request->name;
     $content->information = $request->information;
     $imageName='content'. time() . '.' .$request->imageUrl->getClientOriginalExtension() ;
     $content->imageUrl = $imageName;
     $request->imageUrl->move(public_path('images'), $imageName );
     $content->save();
     return redirect('/content');
    }

      public function show($id)
    {

    }

      public function edit($id)
    {

    }

      public function update(Request $request )
    {
       $oldcontent = Content::find($request-> id);
       $oldcontent->name = $request->name;
       $oldcontent->information = $request->information;
       if($request->imageUrl){
        $imageName='content'. time() . '.' .$request->imageUrl->getClientOriginalExtension() ;
        $oldcontent->imageUrl = $imageName;
        $request->imageUrl->move(public_path('images'), $imageName );
       }

       $oldcontent->save();

       return redirect('/content');
    }

      public function delate($id)

    {
      $oldcontent = Content::find($id);
      $oldcontent -> delete();
      return redirect('/content');
    }
}
