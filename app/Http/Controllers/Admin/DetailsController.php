<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class DetailsController extends Controller
{

    protected $view = 'admin.details.';


    public function index()
    {
//        if ($content->id){
//            $details = $content->detail->get();
//        } else {
//            $details = Detail::cursor();
//        }
        $details = Detail::cursor();
        $contents = Content::pluck('id', 'name');
        return view($this->view.'index', compact('contents', 'details'));
    }

    public function store(Request $request)
    {
        $content = Content::find($request->content_id);
        $contentHasDetail = $content->detail;
        if ($contentHasDetail){
            return back()->withMessage('Content has detail before');
        }
        $this->validate($request, [
            'content_id' => 'required',
            'name' => 'required|min:3',
            'location' => 'required',
            'link' => 'required',
            'notes' => 'required|min:3',
            'emailFacebook' => 'required|url',
            'emailInstagram' => 'sometimes|url',
            'phone1' => 'required|numeric',
            'phone2' => 'sometimes|numeric',
            'phone3' => 'sometimes|numeric',
            'imageUrlLocation' => 'sometimes',
            'imageUrl1' => 'required',
            'imageUrl2' => 'sometimes',
            'imageUrl3' => 'sometimes',
        ], [], []);

        $data = $request->except(['imageUrlLocation', 'imageUrl1', 'imageUrl2', 'imageUrl3']);

        $imageName = 'content__image_1' . time() . '.' . $request->imageUrl1->getClientOriginalExtension();
        $data['imageUrl1'] = '/uploads/'.$imageName;
        $request->imageUrl1->move(public_path('uploads'), $imageName);

        if ($request->imageUrlLocation){
            $imageName = 'content_location_image' . time() . '.' . $request->imageUrlLocation->getClientOriginalExtension();
            $data['imageUrlLocation'] = '/uploads/'.$imageName;
            $request->imageUrlLocation->move(public_path('uploads'), $imageName);
        }
        if ($request->imageUrl2){
            $imageName = 'content__image_2' . time() . '.' . $request->imageUrl2->getClientOriginalExtension();
            $data['imageUrl2'] = '/uploads/'.$imageName;
            $request->imageUrl2->move(public_path('uploads'), $imageName);
        }
        if ($request->imageUrl3){
            $imageName = 'content__image_3' . time() . '.' . $request->imageUrl3->getClientOriginalExtension();
            $data['imageUrl3'] = '/uploads/'.$imageName;
            $request->imageUrl3->move(public_path('uploads'), $imageName);
        }

        Detail::create($data);

        return redirect()->route('details.index')->withMessage('Detail added successfully');
    }
    public function show($content)
    {
        $content = Content::find($content);
        $details = $content->detail ? $content->detail->get() : null;
        $contents = Content::pluck('id', 'name');
        return view($this->view.'index', compact('contents', 'details'));
    }


    public function update(Request $request, Detail $detail)
    {
        $this->validate($request, [
            'content_id' => 'required',
            'name' => 'required|min:3',
            'location' => 'required',
            'link' => 'required',
            'notes' => 'required|min:3',
            'emailFacebook' => 'required|url',
            'emailInstagram' => 'sometimes|url',
            'phone1' => 'required|numeric',
            'phone2' => 'sometimes|numeric',
            'phone3' => 'sometimes|numeric',
            'imageUrlLocation' => 'sometimes',
            'imageUrl1' => 'sometimes',
            'imageUrl2' => 'sometimes',
            'imageUrl3' => 'sometimes',
        ], [], []);

        $data = $request->except(['imageUrlLocation', 'imageUrl1', 'imageUrl2', 'imageUrl3']);

        if ($request->imageUrlLocation){

            if (fileExists(public_path().$detail->imageUrlLocation)){
                File::delete(public_path().$detail->imageUrlLocation);
            }

            $imageName = 'content_location_image' . time() . '.' . $request->imageUrlLocation->getClientOriginalExtension();
            $data['imageUrlLocation'] = '/uploads/'.$imageName;
            $request->imageUrlLocation->move(public_path('uploads'), $imageName);
        }

        if ($request->imageUrl1){

            if (fileExists(public_path().$detail->imageUrl1)){
                File::delete(public_path().$detail->imageUrl1);
            }
            $imageName = 'content__image_1' . time() . '.' . $request->imageUrl1->getClientOriginalExtension();
            $data['imageUrl1'] = '/uploads/'.$imageName;
            $request->imageUrl1->move(public_path('uploads'), $imageName);
        }
        if ($request->imageUrl2){

            if (fileExists(public_path().$detail->imageUrl2)){
                File::delete(public_path().$detail->imageUrl2);
            }
            $imageName = 'content__image_2' . time() . '.' . $request->imageUrl2->getClientOriginalExtension();
            $data['imageUrl2'] = '/uploads/'.$imageName;
            $request->imageUrl2->move(public_path('uploads'), $imageName);
        }
        if ($request->imageUrl3){

            if (fileExists(public_path().$detail->imageUrl3)){
                File::delete(public_path().$detail->imageUrl3);
            }
            $imageName = 'content__image_3' . time() . '.' . $request->imageUrl3->getClientOriginalExtension();
            $data['imageUrl3'] = '/uploads/'.$imageName;
            $request->imageUrl3->move(public_path('uploads'), $imageName);
        }

        $detail->update($data);

        return redirect()->route('details.index')->withMessage('Detail updated successfully');
    }


    public function destroy(Detail $detail)
    {
        if (fileExists(public_path().$detail->imageUrlLocation)){
            File::delete(public_path().$detail->imageUrlLocation);
        }
        if (fileExists(public_path().$detail->imageUrl1)){
            File::delete(public_path().$detail->imageUrl1);
        }
        if (fileExists(public_path().$detail->imageUrl2)){
            File::delete(public_path().$detail->imageUrl2);
        }
        if (fileExists(public_path().$detail->imageUrl3)){
            File::delete(public_path().$detail->imageUrl3);
        }
        $detail -> delete();
        return redirect()->route('details.index')->withMessage('Detail deleted successfully');
    }


}
