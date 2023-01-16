<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Spatie\FlareClient\View;

class stockController extends Controller
{
    //

    public function StockReport(){

        $products = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.pdf.stock_report_pdf',compact('products'));

    } // End Method


    public function StockSupplierReport(){
        
        $suppliers = Supplier::all();
        $categories = Category::all();

        return View('backend.stock.stock_supplier_report')
                    ->with('categories',$categories)
                    ->with('suppliers',$suppliers);

    } // End Method

    public function SupplierWisePdf(Request $request){

        $products  = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')
                            ->where('supplier_id',$request->supplier_id)->get();

        return view('backend.pdf.supplier_wise_report_pdf',compact('products'));

    } // End Method

}
