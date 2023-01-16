@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Supplier </h4>
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
                    
                    <form method="Post" action="{{ route('supplier.update',$supplier->id) }}" id="myForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="form-group col-sm-10">
                            <input name="name" class="form-control" type="text" value="{{$supplier->name}}"  id="name">
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="form-group col-sm-10">
                            <input name="email" class="form-control" type="email" value="{{$supplier->email}}"  id="email">
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="mobile_no" class="col-sm-2 col-form-label">Mobile No</label>
                        <div class="form-group col-sm-10">
                            <input name="mobile_no" class="form-control" type="number" value="{{$supplier->mobile_no}}"  id="mobile_no">
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="form-group col-sm-10">
                            <input name="address" class="form-control" type="text" value="{{$supplier->address}}"  id="address">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="upload-image" class="col-sm-2 col-form-label">Supplier Logo </label>
                        <div class="col-sm-10">
                            <input name="upload-image" class="form-control" type="file"  id="upload-image">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                    <div class="col-sm-10">
                        <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($supplier->logo_image)) ? asset($supplier->logo_image): asset('backend/assets/images/suppliers/no_image.jpg') }}" alt="Profile Image">
                    </div>
                    </div>

                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">status</label>
                        <div class="form-group col-sm-10" style="margin-top: 7px;">
                            
                            <input class="form-check-input" type="checkbox" value="{{($supplier->status == 1)? "1":"0"}}" 
                              id="statusCheckBox" name="status" onclick="changeLabel();" {{($supplier->status == 1)? "checked":""}}>
                               <label class="form-check-label" for="flexCheckDefault" id="statusLabel">
                                {{($supplier->status == 1)? " Active":" Inactive"}}  
                              </label>
                        </div>    
                    </div>

                    <div class="row mb-3">
                        <label for="Categorie" class="col-sm-2 col-form-label">Categories</label>
                        <div class="form-group col-sm-10" style="margin-top: 7px;">
                         @if (! sizeof($supplierCategories) )
                             
                           @foreach ($categories as $category)
              
                                    <input class="form-check-input" type="checkbox" id="{{$category->id}}" name="Category[{{$category->name}}]" value="{{$category->name}}" >
                                    <label class="form-check-label" for="formCheck1">
                                        {{$category->name}}
                                    </label>
                                    <br>
   
                            @endforeach  
                         @else
                             
                        
                            @foreach ($categories as $category)
                              @foreach ($supplierCategories as $Suppcategory)
                                   @if ($category->name == $Suppcategory->category_name)
                                   <input class="form-check-input" type="checkbox" id="{{$category->id}}" name="Category[{{$category->name}}]" value="{{$category->name}}" {{($Suppcategory->status == 1)? "checked":""}}>
                                   <label class="form-check-label" for="formCheck1">
                                       {{$category->name}}
                                   </label>
                                   <br>
                                   @endif
                                   
                                @endforeach
                            @endforeach    

                        @endif   
                        </div>
                    </div>

                    <br> 
                    
                           <input type="submit" class="btn btn-info waves-effect waves-light" style="float: right"  value="Edit Supplier">
                    
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
                 mobile_no: {
                    required : true,
                },
                 email: {
                    required : true,
                },
                 address: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter Your Name',
                },
                mobile_no: {
                    required : 'Please Enter Your Mobile Number',
                },
                email: {
                    required : 'Please Enter Your Email',
                },
                address: {
                    required : 'Please Enter Your Address',
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

<script type="text/javascript">
    

    $(document).ready(function(){
        $('#upload-image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection 