<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function Index(){

        $sliders = Slider::all();

        return view('admin.home.slider', compact('sliders'));
    }

    public function storeslider(Request $request){
        $validateData = $request->validate([
            'top_sub_heading'     => 'required',
            'heading'             => 'required|string|max:255',
            'bottom_sub_heading'  => 'required|string|max:255',
            'image'               => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
            'more_info_link'      => 'nullable|url',
        ]);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('slides','public');
        }

        Slider::create([
            'top_sub_heading' => $validateData['top_sub_heading'],
            'heading' => $validateData['heading'],
            'bottom_sub_heading' => $validateData['bottom_sub_heading'],
            'image_link' => $imagePath,
            'more_info_link' => $validateData['more_info_link'],
        ]);

        return redirect()->back()->with('Success', 'Slide Added Successfully !');
    }

    public function updateslider(Request $request){
          $validateData = $request->validate([
            'top_sub_heading'     => 'required',
            'heading'             => 'required|string|max:255',
            'bottom_sub_heading'  => 'required|string|max:255',
            // 'image'               => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
            'more_info_link'      => 'nullable|url',
        ]);

         if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('slides','public');
        }

        $update = Slider::find($request->slider_id);

        $update->top_sub_heading = $validateData['top_sub_heading'];
        $update->heading = $validateData['heading'];
        $update->bottom_sub_heading = $validateData['bottom_sub_heading'];
        
         if($request->hasFile('image')){
            $update->image_link =$imagePath;
        }

        $update->more_info_link =  $validateData['more_info_link'];

        $update->save();

        return redirect()->back()->with('Success', 'Slide Updated Successfully !');

    }

    public function deleteslider($id){
        $delete = Slider::find($id);
        $delete->delete();

         return redirect()->back()->with('Success', 'Slide deleted Successfully !');
    }
}
