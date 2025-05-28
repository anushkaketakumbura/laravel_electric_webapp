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

                     <!-- Roles -->
                <div class="mb-3">
                    <label for="user_password" class="form-label">User Roles</label>
                    <select class="form-control" name="roles[]">
                       <option value="">Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                    </select>
                 
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

    <div class="card mb-4">
        <table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Password</th>
                    <th>User Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->password}}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                    <td>
                        <a href="/editUser/{{ $user->id }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UserModal{{ $user->id }}">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $user->id }}">Delete </button>
                        {{-- <a href="/deleteUser/{{ $user->id }}" class="btn btn-danger">Delete</a> --}}
                    </td>
                </tr>

                <!-- Start Modal -->
                    <div class="modal fade" id="UserModal{{ $user->id }}" tabindex="-1" aria-labelledby="UserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="UserModalLabel">Edit User {{ $user->name }} (id: {{ $user->id }})</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="/UserUpdate" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <div class="modal-body">
                                        
                                        <!-- Name -->
                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $user->name }}">
                                        </div>
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="user_email" class="form-label">User Email</label>
                                            <input type="text" class="form-control" id="user_email" name="user_email" value="{{ $user->email }}">
                                        </div>
                                        <!-- Password -->
                                        <div class="mb-3">
                                            <label for="user_password" class="form-label"><Datag></Datag>User Password</label>
                                            <input type="text" class="form-control" id="user_password" name="user_password" placeholder="Enter New Password">
                                        </div>

                                        <!-- Roles -->
                                        <div class="mb-3">
                                            <label for="user_password" class="form-label">User Roles *</label>
                                            <select class="form-control" name="roles[]">
                                            <option value="">Select Role</option>
                                                    @foreach ($roles as $role)
                                                    <option value="{{ $role }}">{{ $role }}</option>
                                                    @endforeach
                                            </select>
                                        
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                    <!-- Delete Modal -->
                    <div class="modal fade" id="DeleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete User {{$user->name}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Are you sure you want to delete user: {{ $user->name }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="/deleteUser/{{$user->id}}" class="btn btn-danger">Delete</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete Modal -->

                @endforeach
            </tbody>
        </table>
    </div>

@endsection