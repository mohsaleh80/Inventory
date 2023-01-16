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
                <h4 class="mb-sm-0">All Categories </h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('category.add')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">
                        Add Category
                    </a> <br> <br>

                    <h4 class="card-title">Categories Data </h4>


                    <table id="Categorydatatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $category->name }} </td>
                                    <td>   
                                        {{($category->status == 1)? "Active":"Inactive"}} 
                                        
                                     </td>
                                  
                                    <td>
                                        <a href="{{route('category.edit',$category->id)}}" class="btn btn-info sm" title="Edit Data"> 
                                            <i class="fas fa-edit"></i> 
                                        </a>
                                        <form method="post" action="{{route('category.destroy',$category->id)}}" style="display: inline" id="deleteForm">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger sm" value="" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </button>
                                            <!-- <a href="{{route('category.destroy',$category->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"> -->
                                         </form> 
                                        
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
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
        $('#Categorydatatable tfoot tr th').each(function () {
            var title = $(this).text();

            if(title !== 'Sl' && title !== 'Action' && title !== 'logo')
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });
    
        // DataTable
        var table = $('#Categorydatatable').DataTable({
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
