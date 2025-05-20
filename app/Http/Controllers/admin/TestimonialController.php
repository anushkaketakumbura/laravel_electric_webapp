<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function Index(){

        $testimonials = Testimonial::all();

        return view('admin.home.testimonial',compact('testimonials'));
    }

    public function storeTestimonial(Request $request){
        $validateData = $request->validate([
            'tt_name'          => 'required|string|max:255',
            'tt_profession'    => 'required|string|max:255',
            'tt_description'   => 'required|string|max:255',
            'tt_image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',

         
        ]);

        if ($request->hasFile('tt_image')){
            $imagePath =$request->file('tt_image')->store('testimonial','public');
        }

         Testimonial::create([
            'name' => $validateData['tt_name'],
            'profession' => $validateData['tt_profession'],
            'description' => $validateData['tt_description'],
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('Success', 'Testimonial Added Successfully !');
    }

    public function updateTestimonial(Request $request){
        $validateData = $request->validate([
            'tt_name'          => 'required|string|max:255',
            'tt_profession'    => 'required|string|max:255',
            'tt_description'   => 'required|string|max:255',
            // 'tt_image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

          if ($request->hasFile('tt_image')){
            $imagePath =$request->file('tt_image')->store('testimonial','public');
        }

        $update = Testimonial::find($request->testimonial_id);

        $update->name = $validateData['tt_name'];
        $update->profession = $validateData['tt_profession'];
        $update->description = $validateData['tt_description'];
        
         if($request->hasFile('tt_image')){
            $update->image =$imagePath;
        }

        $update->save();

        return redirect()->back()->with('Success', 'Testimonial Updated Successfully !');
    }

       public function deleteTestimonial($id){
        $delete = Testimonial::find($id);
        $delete->delete();

         return redirect()->back()->with('Success', 'Testimonial deleted Successfully !');
    }
}
