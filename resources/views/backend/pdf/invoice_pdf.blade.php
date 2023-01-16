@extends('admin.admin_master')

@section('admin')



  <!-- start page title -->
  <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Invoice</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-16"><strong class="text-info">Invoice No </strong> # {{$invoice->invoice_no}} </h4>
                            <h3>
                                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo" height="24"/> Inventory MS
                            </h3>
                        </div>
                        <hr>
                      
                        <div class="row">
                            <div class="col-6 mt-4">
                                <address class="text-info">
                                    <strong>Inventory MS<br>
                                    Nablus, Palestine<br>
                                    admin@mohsaleh80.com </strong>
                                </address>
                            </div>
                            <div class="col-6 mt-4 text-end">
                                <address>
                                    <strong class='text-info'>Invoice Date:</strong><br>
                                    {{date('d-m-Y',strtotime($invoice->date))}}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="p-2">
                                <h3 class="font-size-16"><strong>Order summary</strong></h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table  table-info" width="100%">
                                        <tbody>
                                            <tr>
                                                <td><p> Customer Info </p></td>
                                                <td><p> Name: <strong> {{ $payment['customer']['name']  }} </strong> </p></td>
                                                <td><p> Mobile: <strong> {{ $payment['customer']['mobile_no']  }} </strong> </p></td>
                                               <td><p> Email: <strong> {{ $payment['customer']['email']  }} </strong> </p></td>                
                                            </tr>
                                
                                             <tr>
                                             <td></td>
                                              <td colspan="3"><p> Description : <strong> {{ $invoice->description  }} </strong> </p></td>
                                             </tr>
                                        </tbody>
                                
                                     </table>

                                    <table  class="table  table-info" width="100%">
                                        <thead >
                                            <tr>
                                                <th class="text-center">Sl</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Product Name</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Unit Price </th>
                                                <th class="text-center">Total Price</th>
                                                
                                            </tr>
                            
                                        </thead>
                                         <tbody>
                                             @foreach($invoice_details as $key => $details)
                                             <tr >
                                                 
             
                                                 <td class="text-center">{{ $key+1 }}</td>
                                                 <td class="text-center">{{ $details['category']['name'] }}</td>
                                                 <td class="text-center">{{ $details['product']['name'] }}</td>
                                                 <td class="text-center">{{ $details['product']['unit']['name'] }}</td>
                                                 <td class="text-center">{{ $details->selling_qty }}</td>
                                                 <td class="text-center">{{ $details->unit_price }}</td>
                                                 <td class="text-center">{{ $details->selling_price }}</td>
                                                 
                                             </tr>
                                               
                                             @endforeach
                                             
                                             @php
                                                     $sub_total = $payment->total_amount + $payment->discount_amount;
                                             @endphp
                                             <tr>
                                                 <td colspan="6"> Sub Total </td>
                                                 <td class="text-center"> {{ $sub_total }} </td>
                                             </tr> 
                                             <tr>
                                                     <td colspan="6"> Percent Discount </td>
                                                     <td class="text-center"> {{ $payment->discount_percent }}% </td>
                                             </tr>
                                             <tr>
                                                     <td colspan="6"> Discount </td>
                                                     <td class="text-center"> {{ $payment->discount_amount }} </td>
                                             </tr>
                                             <tr>
                                                     <td colspan="6"> Grand Amount </td>
                                                     <td class="text-center">{{ $payment->total_amount }}</td>
                                             </tr>
                                             <tr style="background-color: white">
                                                 <td colspan="6" style="background-color: white"> </td>
                                                 <td class="text-center" style="background-color: white"> </td>
                                             </tr>    
                                             <tr>
                                                 <td colspan="6"> Paid Amount </td>
                                                 <td class="text-center" >{{ $payment->paid_amount }} </td>
                                             </tr>
             
                                             <tr>
                                                 <td colspan="6"> Due Amount </td>
                                                 <td class="text-center"> {{ $payment->due_amount }} </td>
                                             </tr>
                                            
                                                 
                                             
                                                 
                                         </tbody>
                                         
                                     </table>
                                </div>

                                <div class="d-print-none">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                       <!-- <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Send</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection