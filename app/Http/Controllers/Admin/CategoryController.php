<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

       return response()->json([
           'categories'=>$categories
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
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'status' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = slugify($request->name);
        $category->status = $request->status;
        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activeCategory()
    {
        $categories = Category::where('status',1)->get();

       return response()->json([
           'categories'=>$categories
       ],200);
        
    }
    public function activeTopCategory()
    {
        $categories = Category::where('status',1)->get();

       return response()->json([
           'categories'=>$categories
       ],200);
        
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
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
        $category = Category::find($request->id);
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$request->id,
            'status' => 'required',
        ]);
        $category->name = $request->name;
        $category->slug = slugify($request->name);
        $category->status = $request->status;
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
    public function removeItems(Request $request){
        $sl = 0;
        foreach($request->data as $row){
            $category = Category::find($row);
            $category->delete();
            $sl++;
        }
        $success = $sl > 0 ? true: false;
        return response()->json(['success'=>$success,'total'=> $sl ], 200);
    }
    public function changeStatus(Request $request){
        $sl = 0;
        foreach($request->data as $row){
            $category = Category::find($row);
            $category->status = $request->status;
            $category->save();
            $sl++;
        }
        $success = $sl > 0 ? true: false;
        return response()->json(['success'=>$success,'total'=> $sl ], 200);
    }
}
