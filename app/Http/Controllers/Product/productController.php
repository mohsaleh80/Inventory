<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $products = Product::latest()->get();

        return view('backend.product.product_all')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $suppliers = Supplier::where('status', '1')->orderBy('created_at', 'DESC')->get();
        $categories = Category::where('status', '1')->orderBy('created_at', 'DESC')->get();
        $units = Unit::where('status', '1')->orderBy('created_at', 'DESC')->get();
        

        return view('backend.product.product_add')
                               ->with('suppliers',$suppliers)
                               ->with('categories',$categories)
                               ->with('units',$units);
                               
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //|regex:/(^[A-Za-z0-9 ]+$)+/
        $request->validate([
            'name'=> 'required|unique:products,name',
            'supplier_id'=> 'required|numeric',
            'unit_id'=> 'required|numeric',
            'category_id'=> 'required|numeric',
            'quantity'=> 'required|numeric|gt:-1',
            'cost_price'=> 'numeric|gt:-1',
            'sell_price'=> 'numeric|gt:-1',
            
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->supplier_id= $request->supplier_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->cost_price = $request->cost_price;
        $product->sell_price = $request->sell_price;
        $product->created_by = Auth::user()->id;
         // default 1 otherwise 0
        if($request->status == 0){ $product->status =0;}

        $product->save();

        $notification = array(
            'message' => 'Product added Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
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
        $product = Product::findorFail($id);

        $categories = Category::where('status', '1')->orderBy('created_at', 'DESC')->get();
        $units = Unit::where('status', '1')->orderBy('created_at', 'DESC')->get();
        $suppliers = Supplier::where('status', '1')->orderBy('created_at', 'DESC')->get();

        return view('backend.product.product_edit')
                               ->with('product',$product)
                               ->with('categories',$categories)
                               ->with('units',$units)
                               ->with('suppliers',$suppliers);
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

        $product = Product::findorFail($id);
        
        //|regex:/(^[A-Za-z0-9 ]+$)+/
        $request->validate([
            'name'=> 'required|unique:products,name,'.$request->id,
            'supplier_id'=> 'required|numeric',
            'unit_id'=> 'required|numeric',
            'category_id'=> 'required|numeric',
            'quantity'=> 'required|numeric|gt:-1',
            'cost_price'=> 'numeric|gt:-1',
            'sell_price'=> 'numeric|gt:-1',
            
        ]);

        

        $product->name = $request->name;
        $product->supplier_id= $request->supplier_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->cost_price = $request->cost_price;
        $product->sell_price = $request->sell_price;
        $product->created_by = Auth::user()->id;
         // default 1 otherwise 0
         $product->status =(is_null($request->status) ? 0:1);

        $product->save();

        $notification = array(
            'message' => 'Product updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
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
        $product = Product::findorFail($id);

        $product->delete();

        $notification = array(
            'message' => 'Supplier deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    }
}
