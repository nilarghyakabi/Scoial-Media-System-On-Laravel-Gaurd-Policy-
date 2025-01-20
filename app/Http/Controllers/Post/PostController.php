<?php

namespace App\Http\Controllers\Post;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function view()
    {
    $posts = Post::with('user')->get();

    // dd($posts);
    return view('post.view', compact('posts'));
    }

    public function form(){
        return view('post.form');

    }

    public function store(Request $request){
        $request->validate([
            'caption'=> 'required|string|max:300',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $postData =[
            'caption'=> $request->caption,
            'user_id'=>auth()->id(),
        ];
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $postData['image'] = $imagePath;
        }
        Post::create($postData);

        return redirect()->route('post.view')->with('success', 'Post created successfully');
    }

    public function edit($id){
        $post = Post::findOrFail($id);
    
    Gate::authorize('edit', $post);

    return view('post.edit', compact('post'));

    }

    public function update(Request $request, $id){
        $post= Post::findorFail($id);

        $request->validate([
            'caption' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $postData =[
            'caption' =>$request->caption,
        ];
        if ($request->hasFile('image')) {
            
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $postData['image'] = $imagePath;
        }

        $post->update($postData);
        return redirect()->route('post.view')->with('success', 'Post updated successfully');
    }

    public function delete($id){
        

        $post=Post::findorFail($id);
        Gate::authorize('delete',$post);
        
        $post->delete();

        return redirect()->route('post.view')->with('success','Post deleted');
    }
}
