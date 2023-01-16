@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Product </h4>
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
                    
                    <form method="post" action="{{ route('product.add') }}" id="myForm">
                        @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="form-group col-sm-10">
                            <input name="name" class="form-control" type="text" value="{{old('name')}}"  id="name">
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Supplier Name </label>
                        <div class="col-sm-10">
                            <select name="supplier_id" class="form-select" aria-label="Default select example">
                                <option selected=""></option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                               @endforeach
                                </select>
                        </div>
                    </div>
                  <!-- end row -->

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Unit Name </label>
                    <div class="col-sm-10">
                        <select name="unit_id" class="form-select" aria-label="Default select example">
                            <option selected=""></option>
                            @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                           @endforeach
                            </select>
                    </div>
                </div>
              <!-- end row -->

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Category Name </label>
                <div class="col-sm-10">
                    <select name="category_id" class="form-select" aria-label="Default select example">
                        <option selected=""></option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                       @endforeach
                        </select>
                </div>
            </div>
         
            <div class="row mb-3">
                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                <div class="form-group col-sm-10">
                    <input name="quantity" class="form-control" type="number" value="{{old('quantity')}}"  id="quantity">
                </div>
            </div>
            <div class="row mb-3">
                <label for="cost_price" class="col-sm-2 col-form-label">Cost Price</label>
                <div class="form-group col-sm-10">
                    <input name="cost_price" class="form-control" type="number" value="{{old('cost_price')}}"  id="cost_price">
                </div>
            </div>
            <div class="row mb-3">
                <label for="sell_price" class="col-sm-2 col-form-label">Sell Price</label>
                <div class="form-group col-sm-10">
                    <input name="sell_price" class="form-control" type="number" value="{{old('sell_price')}}"  id="sell_price">
                </div>
            </div>
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
                    
                           <input type="submit" class="btn btn-info waves-effect waves-light" style="float: right"  value="Add Product">
                    
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
                 supplier_id: {
                    required : true,
                },
                 unit_id: {
                    required : true,
                },
                 category_id: {
                    required : true,
                },
                quantity: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter Your Product Name',
                },
                supplier_id: {
                    required : 'Please Select One Supplier',
                },
                unit_id: {
                    required : 'Please Select One Unit',
                },
                category_id: {
                    required : 'Please Select One Category',
                },
                quantity: {
                    required : 'Please Select Product Quantity',
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