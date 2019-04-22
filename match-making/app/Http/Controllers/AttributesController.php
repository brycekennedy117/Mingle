<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Postcode;
use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\Models\UserAttributes;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;

class AttributesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (Auth::user()->Attributes != null) {
            return redirect()->back();
        }
        return view('attributes');

    }

    public function store(Request $request)
    {


        UserAttributes::create([
            'user_id' => Auth::user()->id,
            'openness' => $request['openness']/10,
            'conscientiousness' => $request['conscientiousness']/10,
            'extraversion' => $request['extraversion']/10,
            'agreeableness' => $request['agreeableness']/10,
            'neuroticism' => $request['neuroticism']/10,
            'postcode' => (int)$request['postcode-id'],
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'interested_in' => $request['interested_in'],
            'image_url' =>  $request['image_url'] ? $request['image_url'] : "https://profiles.utdallas.edu/img/default.png"

        ]);
        return redirect('dashboard');
    }

    //public function pictureUpload(Request $request)
    //{
    //    $image= $request->file('image');
    //    $input['imagename']=time().'.'.$image->getClientOriginalExtension();
    //    $destinationPath=public_path('/avatars/');
    //    $image->move($destinationPath,$input['imagename']);
    //    return back()->with("Picture uploaded");

    //}

    #public function showAvatar(Request $request)
   # {

           // $image=$request->file('image');
           // $filename = time().'.'.$image->getClientOriginalExtension();
           // $destinationPath=public_path('/avatars/');
           // $image->move($destinationPath,$filename);



            #return view('profile')->with('image', $att);
     #   }

    public function showAvatar(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);
        $file = $request->file('file');

        if ($file->isValid()) {
            $name = $file->getClientOriginalName();
            $key = 'documents/' . $name;
            Storage::disk('s3')->put($key, file_get_contents($file));
            $url = Storage::disk('s3')->url('documents/' . $name);

            $id = Auth::user()->id;

            $attr = UserAttributes::all()
            ->where('user_id', '==', $id)->first();
            $attr->image_url = $url;
            $attr->save();
            echo $id." ".$url;
        }

        #return back();
    }




    public function suburbs(Request $request) {
        $postcode = $request['postcode'];
        $suburbs = Postcode::all()->where('postcode', $postcode);
        return $suburbs;
    }
}
