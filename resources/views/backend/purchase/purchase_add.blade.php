@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Purchase </h4>
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
                    
                    <form method="post" action="" >
                        @csrf
                        <!-- 
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="form-group col-sm-10">
                                <input name="name" class="form-control" type="text" value="{{old('name')}}"  id="name">
                            </div>
                        </div>
                        end row -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label"></label>

                                <div class="col-md-4 ">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Purchase No</label>
                                        <input class="form-control example-date-input" name="purchase_no" type="text"  id="purchase_no">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Date</label>
                                        <input class="form-control example-date-input" name="date" type="date"  id="date">
                                    </div>
                                </div>

                                
                        </div>    

                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label"></label>
                            
                            <div class="col-md-4">
                                <label class="form-label">Supplier Name </label>
                                <select name="supplier_id" id="supplier_id"  class="form-select select2" aria-label="Default select example">
                                    <option selected=""></option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                                    </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Category Name </label>
                                <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                            
                                </select>
                            </div>
                            
                        </div>
                     <!-- end row -->


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label ">Product Name </label>
                                    <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                        
                                            
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label class="form-label">Unit Name </label>
                                    <input type="text" class="form-control example-date-input" id="unit_id" name="unit_id" readonly>
                                   <input type="hidden" class="form-control example-date-input" id="unit_price" name="unit_price" readonly>
                                    <!--<select name="unit_id" class="form-select" aria-label="Default select example">
                                        <option selected=""></option>
                                        @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                    </select> -->
                                </div>    
                            </div>

                            <div class="col-md-2">
                                <div class="md-2">
                                    <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>
                                   <!-- <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Add More">-->
                                    <i class="btn btn-primary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> &nbsp;&nbsp;Add </i>
                                </div>
                            </div>
                        </div>
                
                            
                    </form>



                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('purchase.add') }}" id="myForm">
                        @csrf
                        <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Product Name </th>
                                    <th>Quantity</th>
                                    <th>Unit Price </th>
                                    <th>Description</th>
                                    <th>Total Price</th>
                                    <th>Action</th> 
            
                                </tr>
                            </thead>
            
                            <tbody id="addRow" class="addRow">
            
                            </tbody>
            
                            <tbody>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>
                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                                    </td>
                                    <td></td>
                                </tr>
            
                            </tbody>                
                        </table><br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" style="float: right" id="storeButton"> Save Purchase </button>
            
                        </div>
            
                    </form>
            
                    </div> <!-- End card-body -->
         </div>
    </div> <!-- end col -->
</div>

<script id="document-template" type="text/x-handlebars-template">

    <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{date}}">
            <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
            <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
    
        <td>
            <input type="hidden" name="category_id[]" value="@{{category_id}}">
            @{{ category_name }}
        </td>
    
         <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{ product_name }}
        </td>
    
         <td>
            <input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]" value=""> 
        </td>
    
        <td>
            <input type="number" class="form-control unit_price text-right" name="unit_price[]" value="@{{unit_price}}" readonly> 
        </td>
    
     <td>
            <input type="text" class="form-control" name="description[]"> 
        </td>
    
         <td>
            <input type="number" class="form-control buying_price text-right" name="buying_price[]" value="0" readonly> 
        </td>
    
         <td>
            <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
        </td>
    
        </tr>
    
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on("click",".addeventmore", function(){
                
                //Reading input Values

                var date = $('#date').val();
                var purchase_no = $('#purchase_no').val();
                var supplier_id = $('#supplier_id').val();
                var category_id  = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();
                var unit_price= $('#unit_price').val();;
                //Validating

                if(date == ''){
                    $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                if(purchase_no == ''){
                    $.notify("Purchase No is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                if(supplier_id == ''){
                    $.notify("Supplier is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                if(category_id == ''){
                    $.notify("Category is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                if(product_id == ''){
                    $.notify("Product Field is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }

                var source = $("#document-template").html();
                var tamplate = Handlebars.compile(source);

                var data = {
                                    date:date,
                                    purchase_no:purchase_no,
                                    supplier_id:supplier_id,
                                    category_id:category_id,
                                    category_name:category_name,
                                    product_id:product_id,
                                    product_name:product_name,
                                    unit_price :unit_price
                                };

                    var html = tamplate(data);
                    $("#addRow").append(html); 
            });

            $(document).on("click",".removeeventmore",function(event){
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
             });

             $(document).on('keyup click','.unit_price,.buying_qty', function(){
                    var unit_price = $(this).closest("tr").find("input.unit_price").val();
                    var qty = $(this).closest("tr").find("input.buying_qty").val();
                    var total = unit_price * qty;
                    $(this).closest("tr").find("input.buying_price").val(total);
                    totalAmountPrice();
                });

                function totalAmountPrice(){
                            var sum = 0;
                            $(".buying_price").each(function(){
                                var value = $(this).val();
                                if(!isNaN(value) && value.length != 0){
                                    sum += parseFloat(value);
                                }
                            });
                            $('#estimated_amount').val(sum);
                        }    


        });
    </script>

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

<!-- Validation on submit -->
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
<!--  Get Categories -->
<script type="text/javascript">
    $(function(){
        $(document).on('change','#supplier_id',function(){
            var supplier_id = $(this).val();
            $.ajax({
                url:"{{ route('get-category') }}",
                type: "GET",
                data:{supplier_id:supplier_id},
                success:function(data){
                    var html = '<option value="">Select Category</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.category_id+' "> '+v.category.name+'</option>';
                    });
                    $('#category_id').html(html);
                }
            })
        });
    });
</script>

<!--  Get Products -->
<script type="text/javascript">
    $(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            var supplier_id = document.getElementById('supplier_id').value;
            
            $.ajax({
                url:"{{ route('get-product') }}",
                type: "GET",
               // data:'{"category_id":"'+category_id+'","supplier_id":"'+supplier_id+'"}',
                  data:{category_id:category_id, supplier_id: supplier_id},
                success:function(data){
                    var html = '<option value="">Select Product</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        });
    });
</script>

<!--  Get Unit and Price -->
<script type="text/javascript">
    $(function(){
        $(document).on('change','#product_id',function(){
            var product_id = $(this).val();
            var supplier_id = document.getElementById('supplier_id').value;
            var category_id = document.getElementById('category_id').value;
            
            $.ajax({
                url:"{{ route('get-unit') }}",
                type: "GET",
               // data:'{"category_id":"'+category_id+'","supplier_id":"'+supplier_id+'"}',
                  data:{product_id: product_id, category_id:category_id, supplier_id: supplier_id},
                success:function(data){
                    // var html = '<option value="">Select Product</option>';
                    
                     $.each(data,function(key,v){
                        document.getElementById('unit_id').value=v.unit.name;
                        document.getElementById('unit_price').value=v.cost_price;
                    });
                    
                    
                }
            })
        });
    });
</script>


@endsection 