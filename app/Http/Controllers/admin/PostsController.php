<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function Index(){
        $posts= Posts::all();
        return view('admin.posts',compact('posts'));
    }

    public function storePosts(Request $request){
        $validateData = $request->validate([
            'post_title' => 'required',
            'post_slug' => 'required',
            'post_body' => 'required',
            'post_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',

        ]);

        if ($request->hasFile('post_image')){
            $imagePath = $request->file('post_image')->store('post','public');
        }

        Posts::create([
            'title' => $validateData['post_title'],
            'slug'  => $validateData['post_slug'],
            'body'  => $validateData['post_body'],
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('Success', 'Blog post Added Successfully !');
    }

    public function updatePosts(Request $request){
            $validateData = $request->validate([
                'post_title' => 'required',
                'post_slug' => 'required',
                'post_body' => 'required',
        ]);

          if ($request->hasFile('post_image')){
            $imagePath = $request->file('post_image')->store('post','public');
        }

        $update = Posts::find($request->post_id);

        $update->title = $validateData['post_title'];
        $update->slug = $validateData['post_slug'];
        $update->body = $validateData['post_body'];

        if($request->hasFile('post_image')){
            $update->image = $imagePath;
        }

        $update->save();

        return redirect()->back()->with('Success', 'Blog Post Updated Successfully !');

    }

        public function deletePosts($id){
        $delete = Posts::find($id);
        $delete->delete();

         return redirect()->back()->with('Success', 'Blog Post deleted Successfully !');
    }
}
