<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SampleController extends Controller
{
    public function index()
    {
        $viewData = Sample::paginate(2); //get();

        return view('sampleview.index',compact('viewData'));
    }

    public function create()
    {
        return view('sampleview.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:255|string',
            'description'=>'required',
            'email' => 'required|email|unique:sample,email',
            'is_active'=>'nullable|boolean', // Validate the checkbox as a boolean
            'gender' => 'required|in:male,female,other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $path=null;
        $filename=null;


        if ($request->has('profile_picture')) {
            $file = $request->file('profile_picture');
            $extension=$file->getClientOriginalExtension();

            $filename=time().'.'.$extension;

            $path='uploads/sample/';
            $file->move($path, $filename);
        }

        #Adding Data to DB
        #Model::
        Sample::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'description'=>$request->description,
          //  'profile_picture'=>$path.$filename,
            'profile_picture'=> $path ? $path . $filename : null,
            'is_active'=>$request->has('is_active')? 1 : 0,

        ]);

        return redirect('sample/create')->with('status','Sample Data Addded');
    }

    public function edit(int $id)
    {

        $editData = Sample::findOrFail($id); //If ID found->displays NOTFound->404 errror
        //return $editData;
        return view('sampleview.edit', compact('editData'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name'=> 'required|max:255|string',
            'description'=>'required',
            'is_active'=>'nullable|boolean', // Validate the checkbox as a boolean
            'gender' => 'required|in:male,female,other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path=null;
        $filename=null;

        $samples = Sample::findOrFail($id);

        if ($request->has('profile_picture')) {
            $file = $request->file('profile_picture');
            $extension=$file->getClientOriginalExtension();

            $filename=time().'.'.$extension;

            $path='uploads/sample/';
            $file->move($path, $filename);

            if(File::exists($samples->profile_picture))
            {
                File::delete($samples->profile_picture);

            }
        }

        $samples->update([
            'name'=> $request->name,
            'gender'=>$request->gender,
            'description'=>$request->description,
            'profile_picture'=> $path ? $path . $filename : null,
            'is_active'=>$request->has('is_active')? 1 : 0,
        ]);

        return redirect()->back()->with('status','Data Updated');
    }

    public function destroy(int $id)
    {
        $deleteData = Sample::findOrFail($id);

        if(File::exists($deleteData->profile_picture)){
            File::delete($deleteData->profile_picture);
        }

        $deleteData->delete();

        return response()->json(['success'=>'Record Deleted Successfully!']);
    }
}
