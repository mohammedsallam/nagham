<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class ContentController extends Controller
{

    protected $view = 'admin.contents.';


    public function index()
    {
//        if ($type->id){
//            $contents = $type->contents()->cursor();
//        } else {
//            $contents = Content::cursor();
//        }
        $contents = Content::cursor();
        $types = Type::pluck('id', 'name');
        return view($this->view.'index', compact('contents', 'types'));
    }

    public function store(Request $request)
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

        return redirect()->route('contents.index')->withMessage('Content added successfully');
    }
    public function show($type)
    {
        $type = Type::find($type);
        $contents = $type->contents()->cursor();
        $types = Type::pluck('id', 'name');
        return view($this->view.'index', compact('contents', 'types'));
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


        return redirect()->route('contents.index')->withMessage('Content updated successfully');
    }


    public function destroy(Content $content)
    {
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

        File::delete(public_path().$content->imageUrl);
        $content -> delete();
        return redirect()->route('contents.index')->withMessage('Content deleted successfully');
    }


}
