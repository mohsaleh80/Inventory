@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Unit </h4>
                     <br>

                     @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="post" action="{{ route('unit.add') }}" id="myForm" enctype="multipart/form-data">
                        @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="form-group col-sm-10">
                            <input name="name" class="form-control" type="text" value="{{old('name')}}"  id="name">
                        </div>
                    </div>
                    <!-- end row -->

                    
                    <!-- end row -->
                     <!-- end row -->
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">status</label>
                        <div class="form-group col-sm-10" style="margin-top: 7px;">
                            
                            <input class="form-check-input" type="checkbox" value="1" 
                               id="statusCheckBox" name="status" onclick="changeLabel();" checked >
                               <label class="form-check-label" for="flexCheckDefault" id="statusLabel">
                                &nbsp; Active 
                              </label>
                        </div>    
                    </div>

                    <br> 
                    
                           <input type="submit" class="btn btn-info waves-effect waves-light" style="float: right"  value="Add Unit">
                    
                    </form>



                </div>
            </div>
        </div> <!-- end col -->
</div>



<script type="text/javascript">

function changeLabel(){
 const checkbox = document.getElementById('statusCheckBox');
 //const label = document.getElementById('statusLabel');

 checkbox.addEventListener('change', (event) => {
  if (event.currentTarget.checked) {
    document.getElementById('statusLabel').innerHTML = '&nbsp; Active';
    //alert('Active');
  } else {
    document.getElementById('statusLabel').innerHTML= '&nbsp; Inactive';
    //alert('InActive');
  }
})

}
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
               
            },
            messages :{
                name: {
                    required : 'Please Enter Unit Name',
                },
             
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>




@endsection 