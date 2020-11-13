<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class ContentController extends Controller
{

    protected $view = 'admin.contents.';


    public function index(Type $type)
    {
        if ($type->id){
            $contents = $type->contents()->cursor();
        } else {
            $contents = Content::cursor();
        }

        $types = Type::pluck('id', 'name');
        return view($this->view.'index', compact('contents', 'types'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'information' => 'required|min:3',
            'type_id' => 'required',
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

    public function update(Request $request, Content $content)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'information' => 'required|min:3',
            'type_id' => 'required',
            'imageUrl' => 'sometimes',
        ], [], []);

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
