<?php

namespace App\Http\Controllers\default;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\supplierCategory;
use App\Models\Product;

class defaultController extends Controller
{
    //
    public function GetCategory(Request $request){

        $supplier_id = $request->supplier_id;
        // dd($supplier_id);
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        //supplierCategory::where('supplier_id','=',$supplier_id)->where('status','=','1')->get();
        //Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
    } // End Mehtod 


    //
    public function GetProduct(Request $request){

        $supplier_id = $request->supplier_id;
        $category_id = $request->category_id;
       // ddd($supplier_id);
        // dd($supplier_id);
        $allProduct = Product::where('supplier_id',$supplier_id)
                               ->where('category_id',$category_id)
                               ->get();
        
        return response()->json($allProduct);
    } // End Mehtod 


     //
     public function GetUnit(Request $request){

        $supplier_id = $request->supplier_id;
        $category_id = $request->category_id;
        $product_id = $request->product_id;
        // dd($supplier_id);
        $unit = Product::with(['unit'])->select('unit_id','cost_price','sell_price','quantity')->where('supplier_id',$supplier_id)
                                                          ->where('category_id',$category_id)
                                                          ->where('id',$product_id)
                                                          ->get();
                                                       
       
        return response()->json($unit);
    } // End Mehtod 
}
