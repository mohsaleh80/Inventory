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
                                    <h4 class="mb-sm-0">Inovice Pending</h4>



                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

   <!-- <a href="{{ route('invoice.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Add Inovice </i></a> <br>  <br>    -->           

                    <h4 class="card-title">Inovice Pending Data </h4>


                    <table id="Invoicedatatable" class="table table-bordered dt-responsive nowrap display"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th> 
                            <th>Invoice No </th>
                            <th>Date </th>
                            <th>Desctipion</th> 
                            <th>Amount</th> 
                            <th>Status</th> 
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        	@foreach($allData as $key => $item)
            <tr>
                <td> {{ $key+1}} </td>
                <td> {{ $item['payment']['customer']['name'] }} </td> 
                <td> {{ $item->invoice_no }} </td> 
                <td> {{ date('d-m-Y',strtotime($item->date))  }} </td> 


                 <td>  {{ $item->description }} </td> 
                 <td> {{ $item['payment']['total_amount']}} $</td> 
                 <td>     
                    @if($item->status == '0')
                        <span class="btn btn-warning">Pending</span>
                       <!-- <li class="btn btn-success"><a style="color:white;text-decoration:none" href="{{ route('purchase.pending') }}">Approve</a></li>-->
                        @elseif($item->status == '1')
                        <span class="btn btn-success">Approved</span>
                    @endif
                </td>
                <td> 
                    @if($item->status == '0')
                    <a href=" {{route('invoice.show',$item->id)}}" class="btn btn-success sm" title="Approved" >  <i class="fas fa-check-circle"></i> </a>
                   
                    <form method="post" action="{{route('invoice.destroy',$item->id)}}" style="display: inline" id="deleteForm">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger sm" value="" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </button>
                        <!-- <a href="{{route('invoice.destroy',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"> -->
                    </form> 
                 
                    @endif
                </td>

            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th> 
                                <th>Invoice No </th>
                                <th>Date </th>
                                <th>Desctipion</th>  
                                <th>Amount</th>
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


