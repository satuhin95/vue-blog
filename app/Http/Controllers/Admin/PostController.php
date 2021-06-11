<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user','category')->get();

        return response()->json([
            'posts'=>$posts
        ],200);
    }
    public function getAllPost()
    {
        return Post::with('user','category')->where('status',POST::ACTIVE_POST)->paginate(4);
        // $posts = Post::with('user','category')->where('status',POST::ACTIVE_POST)->get();

        // return response()->json([
        //     'posts'=>$posts
        // ],200);
    }

    public function getPost($slug){
        $post = Post::where('slug',$slug)->with('user','category')->first();
        return response()->json($post);
    }
    public function getCategoryPost($slug){
       
        $category = Category::where('slug',$slug)->first();

        $posts = Post::with('user','category')->where('category_id',$category->id)->where('status',POST::ACTIVE_POST)->get();
        return response()->json([
            'posts'=>$posts
        ],200);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = explode(';',$request->image);
        $file1 = explode('/', $file[0]);
         $ext = end($file1);
         $file_name = date('Y_hisa'). "." .$ext;

        $this->validate($request, [
            'title' => 'required|unique:posts',
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        $post = new Post();
        $post->user_id = Auth()->user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = slugify($request->title);
        $post->content = $request->content;
        $post->image = $file_name;
        $post->status = $request->status;
        $post->save();
        if($request->image){
          Image::make($request->image)->resize(730, 480)->save(public_path('upload/image/') . $file_name);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required|unique:posts,title,'.$request->id,
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        $post =  Post::find($request->id);
        if($post->image !== $request->image){
            $file = explode(';',$request->image);
        $file1 = explode('/', $file[0]);
         $ext = end($file1);
         $file_name = date('Y_hisa'). "." .$ext;
         Image::make($request->image)->resize(500, 250)->save(public_path('upload/image/') . $file_name);
         $img =  $post->image;
         $path = public_path('upload/image/') . $img;
        if(file_exists($path)){
         unlink($path);
        }
        $post->image = $file_name;
        }
       
        $post->user_id = Auth()->user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = slugify($request->title);
        $post->content = $request->content;
        $post->status = $request->status;
        $post->save();
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // file delete 
        $file_name =  $post->image;
        $path = public_path('upload/image/') . $file_name;
       if(file_exists($path)){
        unlink($path);
       }
    
        $post->delete();
    }
    public function removeItems(Request $request){
        $sl = 0;
        foreach($request->data as $row){
            $post = Post::find($row);
            // file delete 
            $file_name =  $post->image;
            $path = public_path('upload/image/') . $file_name;
           if(file_exists($path)){
            unlink($path);
           }

            $post->delete();
            $sl++;
        }
        $success = $sl > 0 ? true: false;
        return response()->json(['success'=>$success,'total'=> $sl ], 200);
    }
    public function changeStatus(Request $request){
        $sl = 0;
        foreach($request->data as $row){
            $post = Post::find($row);
            $post->status = $request->status;
            $post->save();
            $sl++;
        }
        $success = $sl > 0 ? true: false;
        return response()->json(['success'=>$success,'total'=> $sl ], 200);
    }
}
