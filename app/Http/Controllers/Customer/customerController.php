<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $customers = Customer::all();
       $customers = Customer::latest()->get();

        return view('backend.customer.customer_all')->with('customers',$customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.customer.customer_add');
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
            'name'=> 'required|regex:/(^[A-Za-z0-9 ]+$)+/|unique:customers,name',
            'mobile_no'=> 'required|numeric|digits:10',
            'email'=> 'required|email:rfc,dns',
            'address' =>'required|regex:/([- ,\/0-9a-zA-Z]+)/'
        ]);

        $customer = new customer();
         
        //upload Image
        $filename="";
        if($request->file('upload-image')){
            $file= $request->file('upload-image');
            $filename= date('YmdHi')."_".$file->getClientOriginalName();
            $file-> move(public_path('backend/assets/images/customers'), $filename);
           // Image::make($file)->resize(200,200)->save('backend/assets/images/customers'.$filename);
            // save to DB
            $customer['logo_image']= 'backend/assets/images/customers/'.$filename;
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->address = $request->address;
        $customer->created_by = Auth::user()->id;
         // default 1 otherwise 0
        if($request->status == 0){ $customer->status =0;}

        $customer->save();

        $notification = array(
            'message' => 'Customer added Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);
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

        $customer = Customer::findOrFail($id);

        return view('backend.customer.customer_edit')->with('customer',$customer);
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
            'mobile_no'=> 'required|numeric|digits:10',
            'email'=> 'required|email:rfc,dns',
            'address' =>'required|regex:/([- ,\/0-9a-zA-Z]+)/'
        ]);

        $customer = Customer::findorFail($id);

        $customer->name =$request->name;
        $customer->email =$request->email;
        $customer->mobile_no =$request->mobile_no;
        $customer->address =$request->address;
        $customer->status =(is_null($request->status) ? 0:1);
        $customer->updated_by = Auth::user()->id;

        //upload Image
        $filename="";
        if($request->file('upload-image')){
            $file= $request->file('upload-image');
            $filename= date('YmdHi')."_".$file->getClientOriginalName();
            $file-> move(public_path('backend/assets/images/customers'), $filename);
           // Image::make($file)->resize(200,200)->save('backend/assets/images/customers'.$filename);
            // save to DB
            $customer['logo_image']= 'backend/assets/images/customers/'.$filename;
        }

        $customer->save();

        $notification = array(
            'message' => 'customer updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);
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
        $customer = Customer::findorFail($id);

        $customer->delete();

        $notification = array(
            'message' => 'Customer deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);
    }
}
