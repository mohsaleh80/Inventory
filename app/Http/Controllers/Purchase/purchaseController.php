<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class purchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
       // $purchases = Purchase::latest()->get();

        return view('backend.purchase.purchase_all')->with('purchases',$purchases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();

        return view('backend.purchase.purchase_add',compact('suppliers','units','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $request->validate([           
                            'purchase_no'=> 'required',    
                            ],
                            [
                           'purchase_no.required' => 'You have to add purchase no to your purchase',
                          ]);
        // Validation
        if ($request->category_id == null) {

            $notification = array(
             'message' => 'Sorry you do not select any item', 
             'alert-type' => 'error'
         );
         return redirect()->back( )->with($notification);

         //Insert Data
         } else {
            
            $count_category = count($request->category_id);
        for ($i=0; $i < $count_category; $i++) { 
            
            $purchase = new Purchase();

            $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
            $purchase->purchase_no = $request->purchase_no[$i];
            $purchase->supplier_id = $request->supplier_id[$i];
            $purchase->category_id = $request->category_id[$i];

            $purchase->product_id = $request->product_id[$i];
            $purchase->buying_qty = $request->buying_qty[$i];
            $purchase->unit_price = $request->unit_price[$i];
            $purchase->buying_price = $request->buying_price[$i];
            $purchase->description = $request->description[$i];

            $purchase->created_by = Auth::user()->id;
            $purchase->status = '0';
            $purchase->save();
        } // end foreach

         }//End Else

         $notification = array(
            'message' => 'Data Save Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('purchase.all')->with($notification); 


    }//End Store method

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

        //
        $purchase = Purchase::findorFail($id);

        $purchase->delete();

        $notification = array(
            'message' => 'Purchase deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('purchase.all')->with($notification);
    } // end Method

    public function PurchasePending(){

        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
       
        return view('backend.purchase.purchase_pending',compact('allData'));

    }// End Method 



    public function PurchaseApprove($id){

        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){

            Purchase::findOrFail($id)->update([
                'status' => '1',
            ]);

             $notification = array(
                'message' => 'Status Approved Successfully', 
                'alert-type' => 'success'
                );

            return redirect()->route('purchase.all')->with($notification); 

        }

    }// End Method 

}
