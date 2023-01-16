@extends('admin.admin_master')
@section('admin')


<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Change Password  </h4>
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
                    
                    <form method="post" action="{{ route('update.password') }}" >
                        @csrf

                    <div class="row mb-3">
                        <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                            <input name="old_password" class="form-control" type="password" value=""  id="old_password">
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input name="new_password" class="form-control" type="password" value=""  id="new_password">
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input name="confirm_password" class="form-control" type="password" value=""  id="confirm_password">
                        </div>
                    </div>
                    <!-- end row -->




                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Change Password">
                    </form>



                </div>
            </div>
        </div> <!-- end col -->
</div>







@endsection 