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
                <h4 class="mb-sm-0">All Purchases </h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('purchase.add')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">
                        Add Purchase 
                    </a> <br> <br>

                    <h4 class="card-title">Purchases Data </h4>


                    <table id="Purchasedatatable" class="table table-bordered dt-responsive nowrap display"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Purhase No</th> 
                                <th>Date </th>
                                <th>Supplier</th>
                                <th>Category</th> 
                                <th>Qty</th> 
                                <th>Product Name</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        

                        <tbody>

                            @foreach ($purchases as $key => $purchase)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $purchase->purchase_no }} </td>
                                    <td> {{  date('d-m-Y',strtotime($purchase->date))  }} </td> 
                                    <td> {{ $purchase['supplier']['name']}} </td> 
                                    <td> {{ $purchase['category']['name'] }} </td> 
                                    <td> {{$purchase->buying_qty  }}  </td>
                                    <td>  {{$purchase['product']['name']}}  </td>
                                    <td>     
                                        @if($purchase->status == '0')
                                            <span class="btn btn-warning">Pending</span>
                                           <!-- <li class="btn btn-success"><a style="color:white;text-decoration:none" href="{{ route('purchase.pending') }}">Approve</a></li>-->
                                            @elseif($purchase->status == '1')
                                            <span class="btn btn-success">Approved</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <!--
                                        <a href="{{route('purchase.edit',$purchase->id)}}" class="btn btn-info sm" title="Edit Data"> 
                                            <i class="fas fa-edit"></i> 
                                        </a>
                                        -->
                                        @if($purchase->status == '0')
                                            <form method="post" action="{{route('purchase.destroy',$purchase->id)}}" style="display: inline" id="deleteForm">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger sm" value="" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </button>
                                                <!-- <a href="{{route('product.destroy',$purchase->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"> -->
                                            </form> 
                                         @endif
                                        
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Purhase No</th> 
                                <th>Date </th>
                                <th>Supplier</th>
                                <th>Category</th> 
                                <th>Qty</th> 
                                <th>Product Name</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                      
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

<!-- Search on field -->
<script type="text/javascript">

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#Purchasedatatable tfoot tr th').each(function () {
            var title = $(this).text();
            if(title !== 'Sl' && title !== 'Action')
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });
    
        // DataTable
        var table = $('#Purchasedatatable').DataTable({
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
