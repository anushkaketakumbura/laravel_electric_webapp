@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Role</h1>
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


        <!-- Button trigger modal -->
    <div class="px-4 py-4">

        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New Role
        </button>

    </div>
   

    <!-- Start Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="/saveRole" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    
                <!-- Role Name -->
                    <div class="mb-3">
                        <label for="role_name" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- End Modal -->

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            All Roles
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Role Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role )
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postsModal{{ $role->id }}">Edit role </button>
                                <a href="/PermissionToRole/{{$role->id}}" class="btn btn-info">Add Permission to Role</a>
                                <a href="/deleteRole/{{$role->id}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>

                        <!-- Start Modal -->
                        <div class="modal fade" id="postsModal{{ $role->id }}" tabindex="-1" aria-labelledby="postsModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="postsModalLabel">Edit role {{ $role->id }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form method="POST" action="/RoleUpdate" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                        <div class="modal-body">
                                            
                                            <!-- Name -->
                                            <div class="mb-3">
                                                <label for="role_name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="role_name" name="role_name" value="{{ $role->name }}">
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
                                
                    @endforeach
                            
                </tbody>
            </table>
        </div>
    </div>
    
</div>

@endsection