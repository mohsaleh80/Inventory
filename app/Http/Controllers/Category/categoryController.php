<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::latest()->get();

        return view('backend.category.categories_all')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.category_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name'=> 'required|regex:/(^[A-Za-z0-9 ]+$)+/|unique:categories,name',
            
        ]);

        $category= new Category();
         
        $category->name = $request->name;
        $category->created_by = Auth::user()->id;
         // default 1 otherwise 0
        if($request->status == 0){ $category->status =0;}

        $category->save();

        $notification = array(
            'message' => 'Category added Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);

        return view('backend.category.category_edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'=> 'required|regex:/(^[A-Za-z0-9 ]+$)+/',

        ]);

        $category = Category::findorFail($id);

        $category->name =$request->name;
        $category->status =(is_null($request->status) ? 0:1);
        $category->updated_by = Auth::user()->id;



        $category->save();

        $notification = array(
            'message' => 'Category updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findorFail($id);

        $category->delete();

        $notification = array(
            'message' => 'Category deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);
    }
}
