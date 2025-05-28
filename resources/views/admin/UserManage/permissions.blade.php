@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Permissions</h1>
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
            Add New Permissions
        </button>

    </div>
   

    <!-- Start Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Permissions</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="/savePermission" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    
                <!-- Name -->
                    <div class="mb-3">
                        <label for="permission_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="permission_name" name="permission_name" placeholder="Enter Permission Name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Permission</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- End Modal -->

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            All Permission
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Permission Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission )
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postsModal{{ $permission->id }}">Edit permission </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $permission->id }}">Delete </button>
                            </td>
                        </tr>

                        <!-- Start Modal -->
                        <div class="modal fade" id="postsModal{{ $permission->id }}" tabindex="-1" aria-labelledby="postsModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="postsModalLabel">Edit Permission {{ $permission->id }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form method="POST" action="/PermissionUpdate" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                        <div class="modal-body">
                                            
                                            <!-- Name -->
                                            <div class="mb-3">
                                                <label for="permission_name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="permission_name" name="permission_name" value="{{ $permission->name }}">
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
                    <div class="modal fade" id="DeleteModal{{ $permission->id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete Permission - {{ $permission->name }} (id: {{$permission->id}})</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Are you sure you want to delete permission: {{ $permission->name }} (id: {{ $permission->id }})
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="/deletePermission/{{$permission->id}}" class="btn btn-danger">Delete</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete Modal -->
                                
                    @endforeach
                            
                </tbody>
            </table>
        </div>
    </div>
    
</div>

@endsection