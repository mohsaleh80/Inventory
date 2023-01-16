@extends('admin.admin_master')


@section('styleSection')
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@endsection

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Inovice All</h4>



                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('invoice.pending.list') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fa fa-list"> Pending Invoice List </i></a> <br>  <br> 
                    
                    <h4>Invoice No: #{{ $invoice->invoice_no }} - {{ date('d-m-Y',strtotime($invoice->date)) }} </h4>
                    
                    <table class="table table-info" width="100%">
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

                     <form method="POST" action="{{route('invoice.approve',$invoice->id)}}">
                        @csrf
                        <!--<h5>Invoice Details:</h5> -->
                        <table  class="table table-info" width="100%">
                           <thead>
                               <tr>
                                   <th class="text-center">Sl</th>
                                   <th class="text-center">Category</th>
                                   <th class="text-center">Product Name</th>
                                   <th class="text-center">Current Stock</th>
                                   <th class="text-center">Quantity</th>
                                   <th class="text-center">Unit Price </th>
                                   <th class="text-center">Total Price</th>
                                   
                               </tr>
               
                           </thead>
                            <tbody>
                                @foreach($invoice_details as $key => $details)
                                <tr @if ($details->selling_qty > $details['product']['quantity'])
                                       style="color:red" 
                                    @endif>
                                    <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                    <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                    <input type="hidden" name="selling_qty[]" value="{{ $details->selling_qty }}">

                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $details['category']['name'] }}</td>
                                    <td class="text-center">{{ $details['product']['name'] }}</td>
                                    <td class="text-center">{{ $details['product']['quantity'] }}</td>
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
                                @if ($invoice->status == '0' && $details->selling_qty <= $details['product']['quantity'])
                                    <tr>
                                        <td style="background-color: white; border:none;">
                                            <button class="btn btn-success sm" title="Approved"  type="Submit">  Approve </button>
                                        </td>
                                    </tr> 
                                @endif
                                @if ($details->selling_qty > $details['product']['quantity'])
                                    <tr >
                                        <td style="background-color:white;border:none">
                                            <div class="alert alert-danger" role="alert">
                                                selling Quantity exceeded Stok Quantity
                                              </div>                                        
                                        </td>
                                    </tr> 
                                @endif
                                    
                                
                                    
                            </tbody>
                            
                        </table>

                         
               
               
               
                    </form> 

                </div> <!-- end of Card Body -->
            </div> <!-- end of Card  -->
        </div> <!-- end col -->
    </div> <!-- end row -->


<!-- Search on field -->
<script type="text/javascript">

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#Invoicedatatable tfoot tr th').each(function () {
            var title = $(this).text();
            if(title !== 'Sl' && title !== 'Action')
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });
    
        // DataTable
        var table = $('#Invoicedatatable').DataTable({
            initComplete: function () {
                // Apply the search
                this.api()
                    .columns()
                    .every(function () {
                        var that = this;
    
                        $('input', this.footer()).on('keyup change clear', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
            },
        });
    });

</script>


@endsection


