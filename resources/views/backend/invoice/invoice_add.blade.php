@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Invoice</h4>
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
                                        <label for="example-text-input" class="form-label">Invoice No</label>
                                        <input class="form-control example-text-input" name="invoice_no" type="text"  id="invoice_no" readonly style="background-color: skyblue; color:white" value="{{$invoice_no}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Date</label>
                                        <input class="form-control example-date-input" name="date" type="date"  id="date" value="{{$date}}">
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

                            <div class="col-md-2">
                                <div class="md-2">
                                    <label class="form-label">Unit Name </label>
                                    <input type="text" class="form-control example-date-input" id="unit_id" name="unit_id" readonly>
                                   <input type="hidden" class="form-control example-date-input" id="sell_price" name="sell_price" readonly>
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
                                    <label class="form-label">Stock QTY </label>
                                    <input type="number" class="form-control example-date-input" id="current_stock_qty" name="current_stock_qty" readonly>
                                   
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
                    <form method="POST" action="{{ route('invoice.add') }}" id="myForm">
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
                                        <td colspan="4"> Discount</td>
                                        <td>
                                            <input type="number" name="discount_percent" id="discount_percent" class="form-control discount_amount" placeholder="Percent %"  >
                                        </td>
                                        <td>
                                        <input type="text" name="discount_amount" id="discount_amount" class="form-control discount_amount" placeholder="Discount Amount"  >
                                        </td>
                                </tr>
                                <tr>
                                    <td colspan="5">Grand Total
                                    </td>
                                    <td>
                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                                    </td>
                                    <td></td>
                                </tr>
            
                            </tbody>                
                        </table><br>

                        

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label> Paid Status </label>
                                <select name="paid_status" id="paid_status" class="form-select">
                                    <option value="">Select Status </option>
                                    <option value="full_paid">Full Paid </option>
                                    <option value="full_due">Full Due </option>
                                    <option value="partial_paid">Partial Paid </option>
            
                                </select>

                                <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display:none;">
                            </div>

                            <div class="form-group col-md-9">
                                <label> Customer Name  </label>
                                    <select name="customer_id" id="customer_id" class="form-select select2">
                                        <option value="">Select Customer </option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->mobile_no }}</option>
                                        @endforeach
                                         <option value="0">New Customer </option>
                                    </select>
                            </div> 
                             <!-- // end row --> <br>
                        </div><br>

                        <!-- Hide Add Customer Form -->
                        <div class="row new_customer" style="display:none">
                                
                            <div class="form-group col-md-4">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Write Customer Name">
                            </div>

                            <div class="form-group col-md-4">
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Write Customer Mobile No">
                            </div>

                            <div class="form-group col-md-4">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Write Customer Email">
                            </div>
                        </div><br>
                        <!-- End Hide Add Customer Form -->
                        
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea name="description" class="form-control" id="description" placeholder="Write Description Here"></textarea>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info" style="float: right" id="storeButton"> Save Invoice </button>
            
                        </div>
            
                    </form>
            
                    </div> <!-- End card-body -->
         </div>
    </div> <!-- end col -->
</div>

<script id="document-template" type="text/x-handlebars-template">

    <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{date}}">
            <input type="hidden" name="invoice_no[]" value="@{{invoice_no}}">
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
            <input type="number" min="1" class="form-control selling_qty text-right" name="selling_qty[]" value=""> 
        </td>
    
        <td>
            <input type="number" class="form-control sell_price text-right" name="sell_price[]" value="@{{sell_price}}" readonly> 
        </td>
    
     <td>
            <input type="text" class="form-control" name="description_detail[]"> 
        </td>
    
         <td>
            <input type="number" class="form-control selling_price text-right" name="selling_price[]" value="0" readonly> 
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
                var invoice_no = $('#invoice_no').val();
                var supplier_id = $('#supplier_id').val();
                var category_id  = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();
                var sell_price= $('#sell_price').val();;
                //Validating

                if(date == ''){
                    $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                if(invoice_no == ''){
                    $.notify("Invoice No is Required" ,  {globalPosition: 'top right', className:'error' });
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
                                    invoice_no:invoice_no,
                                    supplier_id:supplier_id,
                                    category_id:category_id,
                                    category_name:category_name,
                                    product_id:product_id,
                                    product_name:product_name,
                                    sell_price :sell_price
                                };

                    var html = tamplate(data);
                    $("#addRow").append(html); 
            });

            $(document).on("click",".removeeventmore",function(event){
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
             });

             $(document).on('keyup click','.sell_price,.selling_qty', function(){
                    var sell_price = $(this).closest("tr").find("input.sell_price").val();
                    var qty = $(this).closest("tr").find("input.selling_qty").val();

                    var stock = +document.getElementById('current_stock_qty').value;
                    
                    if(qty  > stock){

                       // alert('Quantity Excedded limit in Stock');
                       $(this).closest("tr").find("input.selling_qty").val('0');
                       $(this).closest("tr").find("input.selling_price").val('0');
                       $.notify("Quantity Excedded limit in Stock'" ,  {globalPosition: 'top right', className:'error' });
                                     
                    }else{

                        var total = sell_price * qty;
                        $(this).closest("tr").find("input.selling_price").val(total);
                        //totalAmountPrice();
                        $('#discount_amount').trigger('keyup');
                    }
                   
                });

                $(document).on('keyup change','#discount_amount',function(){
                        totalAmountPrice();
                    });

                $(document).on('keyup change','#discount_percent',function(){
                    
                    var sum = 0;
                            $(".selling_price").each(function(){
                                var value = $(this).val();
                                if(!isNaN(value) && value.length != 0){
                                    sum += parseFloat(value);
                                }
                            });

                    var amountWithoutDiscount = sum;
                    var discount_percent = parseFloat($('#discount_percent').val());

                    if(!isNaN(discount_percent) && discount_percent.length != 0 && $('#discount_percent').val() >= 0){

                            if(discount_percent > 50){
                            
                                $('#discount_amount').val('0') ;
                                $('#discount_percent').val('0') 
                                $('#estimated_amount').val(sum);
                                $.notify("Discount Exceeded limit" ,  {globalPosition: 'top right', className:'error' });

                            }else{

                                var discount_amount = amountWithoutDiscount * (discount_percent/100);

                                $('#discount_amount').val(discount_amount) ;
                                sum -= parseFloat(discount_amount);
                                $('#estimated_amount').val(sum);
                            }
                        }

                        if( $('#discount_percent').val() === '' || $('#discount_percent').val() < 0){
                                $('#discount_amount').val('0') ;
                                $('#discount_percent').val('0') 
                                $('#estimated_amount').val(sum);
                        }
                    });    

                function totalAmountPrice(){
                            var sum = 0;
                            $(".selling_price").each(function(){
                                var value = $(this).val();
                                if(!isNaN(value) && value.length != 0){
                                    sum += parseFloat(value);
                                }
                            });

                            var amountWithoutDiscount = sum;
                            var discount_amount = parseFloat($('#discount_amount').val());

                            if(!isNaN(discount_amount) && discount_amount.length != 0){
                                  if(discount_amount > amountWithoutDiscount){
                                     
                                    $('#discount_amount').val('0') 
                                    $('#estimated_amount').val(sum);
                                    $.notify("Discount Exceeded limit" ,  {globalPosition: 'top right', className:'error' });

                                  }else{
                                    sum -= parseFloat(discount_amount);
                                  }
                                    
                                }
                            
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
                        document.getElementById('sell_price').value=v.sell_price;
                        document.getElementById('current_stock_qty').value=v.quantity;
                    });
                    
                    
                }
            })
        });
    });
</script>

<script type="text/javascript">

    $(document).on('change','#paid_status', function(){
        var paid_status = $(this).val();
        if (paid_status == 'partial_paid') {
            $('.paid_amount').show();
        }else{
            $('.paid_amount').hide();
        }
    });
</script>    

<script type="text/javascript">
       //use document.ready because of using class2
        $(document).ready(function(){
            $(document).on('change','#customer_id', function(){
                var customer_id = $(this).val();
                
                
                
                if (customer_id == "0") {
                    $('.new_customer').show();
                }else{
                    $('.new_customer').hide();
                }
            });
        });
</script>


@endsection 