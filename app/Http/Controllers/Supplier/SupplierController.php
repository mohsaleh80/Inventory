<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\supplierCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

       // $allSuplliers = Supplier::all();
        $suppliers = Supplier::latest()->get();

        return view('backend.supplier.supplier_all')->with('suppliers',$suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = DB::table('categories')
                           ->where('status', '=', '1')
                           ->get();
        return view('backend.supplier.supplier_add')
                    ->with('categories',$categories);
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
            'name'=> 'required|regex:/(^[A-Za-z0-9 ]+$)+/|unique:suppliers,name',
            'mobile_no'=> 'required|numeric|digits:10',
            'email'=> 'required|email:rfc,dns',
            'address' =>'required|regex:/([- ,\/0-9a-zA-Z]+)/'
        ]);

        $supplier = new Supplier();

         //upload Image
         $filename="";
         if($request->file('upload-image')){
             $file= $request->file('upload-image');
             $filename= date('YmdHi')."_".$file->getClientOriginalName();
             $file-> move(public_path('backend/assets/images/suppliers'), $filename);
            // Image::make($file)->resize(200,200)->save('backend/assets/images/customers'.$filename);
             // save to DB
             $supplier['logo_image']= 'backend/assets/images/suppliers/'.$filename;
         }

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->address = $request->address;
        $supplier->created_by = Auth::user()->id;
         // default 1 otherwise 0
        if($request->status == 0){ $supplier->status =0;}

        $supplier->save();

        //Supplier_Categories
        $categories = Category::all();
       // $supplierInserted = DB::table('suppliers')
                       //     ->where('name', '=', $request->name)
                        //    ->get();
        

        //ddd($supplierInserted);
        
        foreach($categories as $category){
         
         if (! array_key_exists($category->name,$request->Category) )
             {
                $supplierCategory = new supplierCategory();
                $supplierCategory->supplier_id = $supplier->id;
                $supplierCategory->category_id = $category->id;
                $supplierCategory->category_name = $category->name;
                $supplierCategory->status = '0';
                $supplierCategory->save();
             }else {
                $supplierCategory = new supplierCategory();
                $supplierCategory->supplier_id = $supplier->id;
                $supplierCategory->category_id = $category->id;
                $supplierCategory->category_name = $category->name;
                $supplierCategory->status = '1';
                $supplierCategory->save();
             }
            
             
        }
        
        

        $notification = array(
            'message' => 'Supplier added Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);
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
        $supplier = Supplier::findorFail($id);
        $categories = DB::table('categories')
                           ->where('status', '=', '1')
                           ->get();
        //$supplierCategories = supplierCategory::where('supplier_id',$id);
        $supplierCategories= DB::table('supplier_categories')
                                ->where('supplier_id', '=', $id)
                                ->get();

                                
       

        return view('backend.supplier.supplier_edit')
                             ->with('supplier',$supplier)
                             ->with('categories',$categories)
                             ->with('supplierCategories',$supplierCategories);
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
            'name'=> 'required|regex:/(^[A-Za-z0-9 ]+$)+/|unique:suppliers,name,'.$request->id,
            'mobile_no'=> 'required|numeric|digits:10',
            'email'=> 'required|email:rfc,dns',
            'address' =>'required|regex:/([- ,\/0-9a-zA-Z]+)/'
        ]);

        $supplier = Supplier::findorFail($id);

        $supplier->name =$request->name;
        $supplier->email =$request->email;
        $supplier->mobile_no =$request->mobile_no;
        $supplier->address =$request->address;
        $supplier->status =(is_null($request->status) ? 0:1);
        $supplier->updated_by = Auth::user()->id;
        
        //upload Image
        $filename="";
        if($request->file('upload-image')){
            $file= $request->file('upload-image');
            $filename= date('YmdHi')."_".$file->getClientOriginalName();
            $file-> move(public_path('backend/assets/images/suppliers'), $filename);
           // Image::make($file)->resize(200,200)->save('backend/assets/images/suppliers'.$filename);
            // save to DB
            $supplier['logo_image']= 'backend/assets/images/suppliers/'.$filename;
        }

        $supplier->save();

        $categories = Category::all();
       // $supplierInserted = DB::table('suppliers')
                       //     ->where('name', '=', $request->name)
                        //    ->get();
        

        //ddd($supplierInserted);
        
        foreach($categories as $category){
         
         if (! array_key_exists($category->name,$request->Category) )
             {
                $supplierCategory = supplierCategory::where('supplier_id', '=', $supplier->id)
                                        ->where('category_id', '=', $category->id)
                                        ->first();
                //$supplierCategory->supplier_id = $supplier->id;
               // $supplierCategory->category_id = $category->id;
               // $supplierCategory->category_name = $category->name;
                $supplierCategory->status = '0';
                $supplierCategory->save();
             }else {
                $supplierCategory = supplierCategory::where('supplier_id', '=', $supplier->id)
                                        ->where('category_id', '=', $category->id)
                                        ->first();
                                       
               // $supplierCategory->supplier_id = $supplier->id;
               // $supplierCategory->category_id = $category->id;
               // $supplierCategory->category_name = $category->name;
                $supplierCategory->status = '1';
                $supplierCategory->save();
             }
            
             
        }

        $notification = array(
            'message' => 'Supplier updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);
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

        $supplier = Supplier::findorFail($id);

        $supplier->delete();

        $notification = array(
            'message' => 'Supplier deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);
    }
}
