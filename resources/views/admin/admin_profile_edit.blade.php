@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Edit Profile</h4>
             <br>
             
            <form method="post" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                @csrf

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input name="name" class="form-control" type="text" value="{{ $editData->name }}"  id="example-text-input">
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">User Email</label>
                <div class="col-sm-10">
                    <input name="email" class="form-control" type="text" value="{{ $editData->email }}"  id="example-text-input">
                </div>
            </div>
            <!-- end row -->



            <div class="row mb-3">
                <label for="upload-image" class="col-sm-2 col-form-label">Profile Image </label>
                <div class="col-sm-10">
                    <input name="upload-image" class="form-control" type="file"  id="upload-image">
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->image)) ? asset($editData->image): asset('backend/assets/images/users/avatar-1.jpg') }}" alt="Profile Image">
                </div>
              </div>
            <!-- end row -->
            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
            </form>



        </div>
    </div>
</div> <!-- end col -->
</div>






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