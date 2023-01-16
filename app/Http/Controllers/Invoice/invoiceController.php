<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Product;
use App\Models\customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allData = Invoice::where('status','1')->orderBy('date','desc')->orderBy('id','desc')->get();
            
        return view('backend.invoice.invoice_all',compact('allData'));
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
        $customers = customer::all();

        $invoice_data = Invoice::orderBy('id','desc')->first();
        if ($invoice_data == null) {

            $invoice_no = 1;

         }else{

             $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
             $invoice_no = $invoice_data+1;

         }

         $date = date('Y-m-d');

        return view('backend.invoice.invoice_add',compact('suppliers','units','categories',
                                                           'customers','invoice_no','date'));
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

          //Validation
            $request->validate([           
                           'invoice_no'=> 'required', 
                           'supplier_id'=> 'required', 
                           'category_id'=> 'required', 
                           'product_id'=> 'required', 
                           'customer_id'=> 'required',
                           'paid_status'=> 'required'
                        ],
                        [
                           'invoice_no.required' => 'You have to add Invoice no to your invoice',
                           'supplier_id.required' => 'You have to add Supplier to your invoice',
                           'category_id.required' => 'You have to add Product to your invoice',
                           'product_id.required' => 'You have to add Product to your invoice',
                           'customer_id.required' => 'You have to add Customer to your invoice', 
                           'paid_status.required' => 'You have to add Payment Status to your invoice'
                        ]
                      ); 

            // Validation
            if ($request->category_id == null) {

                            $notification = array(
                            'message' => 'Sorry you do not select any item', 
                            'alert-type' => 'error'
                            );
            return redirect()->back( )->with($notification);
                        
        } else {

            if ($request->paid_amount >= $request->estimated_amount) {

                    $notification = array(
                    'message' => 'Sorry Paid Amount is Maximum the total price', 
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
 
             } else {
               //Saving Data to tables

               $invoice = new Invoice();
               $invoiceno = $request->invoice_no[0];
               $invoice->invoice_no = $invoiceno;
               $date = $request->date[0];
               $invoice->date = date('Y-m-d',strtotime($date));
               $invoice->description = $request->description;
               $invoice->status = '0';
               $invoice->created_by = Auth::user()->id; 

               DB::transaction(function() use($request,$invoice){
                
                    if ($invoice->save()) {

                        $count_category = count($request->category_id);
                            for ($i=0; $i < $count_category ; $i++) { 

                                $invoice_details = new InvoiceDetail();
                                $date = $request->date[0];
                                $invoice_details->date = date('Y-m-d',strtotime($date));
                                $invoice_details->invoice_id = $invoice->id;
                                $invoice_details->category_id = $request->category_id[$i];
                                $invoice_details->product_id = $request->product_id[$i];
                                $invoice_details->selling_qty = $request->selling_qty[$i];
                                $invoice_details->unit_price = $request->sell_price[$i];
                                $invoice_details->selling_price = $request->selling_price[$i];
                                $invoice_details->description = $request->description_detail[$i];
                                $invoice_details->status = '1'; 
                                $invoice_details->save(); 
                            }
                           
                            //Save new customer or get existing customer
                            if ($request->customer_id == '0') {
                                $customer = new Customer();
                                $customer->name = $request->name;
                                $customer->mobile_no = $request->mobile_no;
                                $customer->email = $request->email;
                                $customer->save();
                                $customer_id = $customer->id;
                            } else{
                                $customer_id = $request->customer_id;
                            } 
                        

                            $payment = new Payment();
                            $payment_details = new PaymentDetail();

                            $payment->invoice_id = $invoice->id;
                            $payment->customer_id = $customer_id;
                            $payment->paid_status = $request->paid_status;
                            if($request->discount_percent == null){
                                $payment->discount_percent = '0';
                            }else{
                                $payment->discount_percent = $request->discount_percent;
                            }
                            if($request->discount_amount == null){
                                $payment->discount_amount = '0';
                            }else{
                                $payment->discount_amount = $request->discount_amount;
                            }
                           // $payment->discount_amount = $request->discount_amount;
                            $payment->total_amount = $request->estimated_amount;


                            if ($request->paid_status == 'full_paid') {

                                $payment->paid_amount = $request->estimated_amount;
                                $payment->due_amount = '0';
                                $payment_details->current_paid_amount = $request->estimated_amount;

                            } elseif ($request->paid_status == 'full_due') {

                                $payment->paid_amount = '0';
                                $payment->due_amount = $request->estimated_amount;
                                $payment_details->current_paid_amount = '0';

                            }elseif ($request->paid_status == 'partial_paid') {

                                $payment->paid_amount = $request->paid_amount;
                                $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                                $payment_details->current_paid_amount = $request->paid_amount;
                            }
                            $payment->save();

                            $payment_details->invoice_id = $invoice->id; 
                            $date = $request->date[0];
                            $payment_details->date = date('Y-m-d',strtotime($date));
                            $payment_details->save();

                    }// end if ($invoice->save())

                }); // End transaction
 
 
 
             } //end inner if

          

        }//end outer if

           
        $notification = array(
            'message' => 'Invoice Data Inserted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending.list')->with($notification);
                        

    } //end method

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
        $invoice = Invoice::findorFail($id);
        $invoice->delete();

        InvoiceDetail::where('invoice_id',$invoice->id)->delete(); 
        Payment::where('invoice_id',$invoice->id)->delete(); 
        PaymentDetail::where('invoice_id',$invoice->id)->delete(); 

        $notification = array(
            'message' => 'Invoice deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function InvoicePendingList(){

        $allData = Invoice::where('status','0')->orderBy('date','desc')->orderBy('id','desc')->get();
            
        return view('backend.invoice.invoice_pending_list',compact('allData'));
    }//end Method

    public function InvoiceShow($id){

        $invoice = Invoice::findOrFail($id);
        $payment = Payment::where('invoice_id',$invoice->id)->first();
        $invoice_details= InvoiceDetail::where('invoice_id',$invoice->id)->get();

        return view('backend.invoice.invoice_approve',compact('invoice','payment','invoice_details'));

    }

    public function InvoiceApprove(Request $request, $id){

        $invoice = Invoice::findOrFail($id);
        $count_product = count($request->product_id);       
 
        try {
            DB::beginTransaction();
            
            for ($i=0; $i < $count_product ; $i++) { 
            
                
                $product = Product::where('id',$request->product_id[$i] )->first();
                $after_selling_qty = ((float)($product->quantity))-((float)($request->selling_qty[$i]));
                $product->quantity = $after_selling_qty;
                
                $product->save();
                
            }
            
            $invoice->updated_by = Auth::user()->id;
            $invoice->status = '1';
            $invoice->save();            
       
           DB::commit();

        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
        }

        

        $notification = array(
            'message' => 'Invoice Approve Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending.list')->with($notification);

    }//End Method


    public function PrintInvoiceList(){

        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();

           return view('backend.invoice.print_invoice_list',compact('allData'));

        } // End Method


        public function PrintInvoice($id){

            $invoice = Invoice::findOrFail($id);
            $invoice_details= InvoiceDetail::where('invoice_id',$invoice->id)->get();
            $payment = Payment::where('invoice_id',$invoice->id)->first();

            return view('backend.pdf.invoice_pdf',compact('invoice','invoice_details','payment'));
    
        } // End Method


        public function DailyInvoiceReport(){

            return view('backend.invoice.daily_invoice_report');

        } // End Method


        public function DailyInvoicePdf(Request $request){

            $start_date = date('Y-m-d',strtotime($request->start_date));
            $end_date = date('Y-m-d',strtotime($request->end_date));
            $allData = Invoice::whereBetween('date',[$start_date,$end_date])
                                ->where('status','1')
                                ->orderBy('date','desc')->get();
    
    
            
            return view('backend.pdf.daily_invoice_report_pdf',compact('allData','start_date','end_date'));
        } // End Method


}
