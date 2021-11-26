<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function HomeAbout()
    {
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeabout'));
    }


    public function AddAbout()
    {
        return view('admin.home.create');
    }


    public function StoreAbout(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|unique:home_abouts|max:255',
            ]
        );


        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' => Carbon::now(),
        ]);


        return Redirect()->route('home.about')->with('success', 'About Inserted Succesfully');
    }


    public function EditAbout($id)
    {
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit', compact('homeabout'));
    }



    public function UpdateAbout(Request $request, $id)
    {

        $update = HomeAbout::find($id)([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
        ]);


        return Redirect()->route('home.about')->with('success', 'About Updated Succesfully');
    }


    public function DeleteAbout($id){
        $delete = HomeAbout::find($id)->Delete();
        return Redirect()->back()->with('success', 'About Deleted Succesfully');
    }




    public function Portfolio(){
        $images = Multipic :: all();
        return view('admin.pages.portfolio', compact('images'));
    }
}
