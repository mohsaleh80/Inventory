@extends('admin.admin_master')

@section('admin')


        <div class="row">

            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{ (!empty($adminData->image))? asset($adminData->image) : asset('backend/assets/images/users/avatar-1.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Name : {{$adminData->name}}</h4>
                        <h4 class="card-title">Email : {{$adminData->email}}</h4>
                        <h4 class="card-title">Description </h4>
                        <p class="card-text">This is a wider card with supporting text below as a
                            natural lead-in to additional content. This content is a little bit
                            longer.</p>
                        <p class="card-text">
                            <small class="text-muted">Last updated {{$adminData->updated_at}}</small>
                        </p>

                        <a href="{{route('edit.profile')}}" class="btn btn-info btn-rounded waves-effect waves-light">Update Profile</a>
                    </div>
                </div>
            </div>
<!--
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img img-fluid" src="{{ asset('backend/assets/images/small/img-6.jpg') }}" alt="Card image">
                    <div class="card-img-overlay">
                        <h4 class="card-title text-white">Card title</h4>
                        <p class="card-text text-light">This is a wider card with supporting text below as a
                            natural lead-in to additional content. This content is a little bit
                            longer.</p>
                        <p class="card-text">
                            <small class="text-white">Last updated 3 mins ago</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text">This is a wider card with supporting text below as a
                            natural lead-in to additional content. This content is a little bit
                            longer.</p>
                        <p class="card-text">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </p>
                    </div>
                    <img class="card-img-bottom img-fluid" src="{{ asset('backend/assets/images/small/img-7.jpg') }}" alt="Card image cap">
                </div>
            </div>            

            

        -->

        </div> <!-- Row -->
        
@endsection