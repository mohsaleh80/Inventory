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
                    <li class="breadcrumb-item active">Stock Report</li>
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
                            
                            <h3>
                                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo" height="24"/> Inventory MS
                            </h3>
                        </div>
                        <hr>
                        <div class="d-print-none">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                               <!-- <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Send</a> -->
                            </div>
                        </div>
                        <br><br>
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
                                    <strong class='text-info'>Report Date:</strong><br>
                                    {{date('d-m-Y H:i:s')}}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="p-2">
                                <h3 class="font-size-16"><strong>Stock Report</strong></h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    

                                    <table  class="table  table-info" width="100%">
                                        <thead >
                                            <tr>
                                                <th>Sl</th>
                                                <th>Supplier</th>
                                                <th>Category</th>
                                                <th>Product Name</th>          
                                                <th>Unit</th>
                                                <th>Quantity</th>
                                                <th>Cost price</th>
                                                <th>Sell price</th>
                                                <th>Status</th>
                                                
                                            </tr>
                            
                                        </thead>
                                         <tbody>
                                            @foreach ($products as $key => $product)
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                
                                                <td> {{ $product['supplier']['name'] }} </td>
                                                <td> {{ $product['category']['name'] }} </td>
                                                <td> {{ $product->name }} </td>   
                                                <td> {{ $product['unit']['name'] }} </td>     
                                                <td>   {{$product->quantity }}  </td>
                                                <td>   {{$product->cost_price }}  </td>
                                                <td>   {{$product->sell_price }}  </td>
                                                <td>   
                                                    {{($product->status == 1)? "Active":"Inactive"}} 
                                                    
                                                </td>
                                               
            
                                            </tr>
                                        @endforeach
                                             
                                            
                                             
                                            
                                                 
                                             
                                                 
                                         </tbody>
                                         
                                     </table>
                                     
                                     
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