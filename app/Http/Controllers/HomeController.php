<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider(){
        return view('admin.slider.create');
    }


    public function StoreSlider(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:4',
            'description'=>'required|min:10',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
         $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
        
        $last_img = 'image/slider/'.$name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Inserted Succesfully');
    }


    public function Edit($id){

        $sliders = Slider::find($id);
        return view('admin.slider.edit',  compact('sliders'));
    }

    public function Update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|min:10',
        ]);

        $old_image = $request->old_image;
        $image = $request->file('image');

        if($image){
            $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/slider/';
        $last_img = $up_location.$img_name;
        $image->move($up_location,$img_name);

        unlink($old_image);

        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Slider Updated Succesfully');

        }else{

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);
    
            return Redirect()->back()->with('success', 'Slider Updated Succesfully');

        } 
    }


    public function Delete($id){
        $sliderimage = Slider::find($id);
        $old_image = $sliderimage->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider Deleted Succesfully');

    }
}
