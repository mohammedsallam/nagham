<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Details;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class DetailsController extends Controller
{

    protected $view = 'admin.details.';


    public function index(Content $content)
    {
        if ($content->id){
            $details = $content->details;
        } else {
            $details = Details::cursor();
        }

        $contents = Type::pluck('id', 'name');
        return view($this->view.'index', compact('contents', 'details'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'phone1' => 'required|numeric',
            'phone2' => 'required|numeric',
            'phone3' => 'required|numeric',
            'emailFacebook' => 'required|url',
            'emailInstagram' => 'required|url',
            'location' => 'required',
            'link' => 'required',
            'notes' => 'required|min:3',
            'imageUrlLocation' => 'required',
            'imageUrl' => 'required',
        ], [], []);

        $imageName = 'content_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
        $imagePath = '/uploads/'.$imageName;
        $request->imageUrl->move(public_path('uploads'), $imageName);

        Content::create([
            'name' => $request->name,
            'information' => $request->information,
            'type_id' => $request->type_id,
            'imageUrl' => $imagePath,
        ]);

        return redirect('/content');
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
            'type_id' => 'required',
            'imageUrl' => 'sometimes',
        ], [], []);

        $content = Content::find($id);

        $content->update($request->except(['imageUrl']));

        if ($request->imageUrl){
            if ($content->imageUrl){
                if (fileExists(public_path().$content->imageUrl)){
                    File::delete(public_path().$content->imageUrl);
                }

                $imageName = 'content_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
                $imagePath = '/uploads/'.$imageName;
                $request->imageUrl->move(public_path('uploads'), $imageName);
                $content->update(['imageUrl' => $imagePath]);

            } else {
                $imageName = 'content_' . time() . '.' . $request->imageUrl->getClientOriginalExtension();
                $imagePath = '/uploads/'.$imageName;
                $request->imageUrl->move(public_path('uploads'), $imageName);
                $content->update(['imageUrl' => $imagePath]);
            }
        }


        return redirect('/content');
    }


    public function delete($id)
    {
        $oldContent = Content::find($id);
        File::delete(public_path().$oldContent->imageUrl);
        $oldContent -> delete();
        return redirect('/content');
    }


}
