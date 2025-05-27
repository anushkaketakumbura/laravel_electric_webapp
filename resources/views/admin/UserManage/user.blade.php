@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Users</h1>
</div>

<div>
        @if (@session('Success'))
        <div class="alert alert-success alert-dismisible fade show" role="alert">
            {{ session('Success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    
    @endif
    
</div>

    <!-- Button trigger modal -->
    <div class="px-4 py-4">

        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New User
        </button>

    </div>
   

    <!-- Start Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="/saveUser" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    
                <!-- User Name -->
                    <div class="mb-3">
                        <label for="user_name" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter User Name">
                    </div>

                     <!-- User Email -->
                    <div class="mb-3">
                        <label for="user_email" class="form-label">User Email</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter User Email">
                    </div>


                    <!-- User Password -->
                    <div class="mb-3">
                        <label for="user_password" class="form-label">User Password</label>
                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter User password">
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- End Modal -->

@endsection