@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Blog Post</h1>
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
            Add New Blog Post
        </button>

    </div>
   

    <!-- Start Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Blog Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="/savePosts" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    
                <!-- Title -->
                    <div class="mb-3">
                        <label for="post_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter Title">
                    </div>

                    <!-- Slug -->
                    <div class="mb-3">
                        <label for="post_slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="post_slug" name="post_slug" placeholder="Enter Slug">
                    </div>

                    <!-- Body -->
                    <div class="mb-3">
                        <label for="post_body" class="form-label">Body</label>
                        <textarea type="text" class="form-control" id="post_body" name="post_body" placeholder="Enter Body content"></textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="post_image" class="form-label">Image Upload</label>
                        <input type="file" class="form-control" id="post_image" name="post_image" >
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Blog Post</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- End Modal -->

    <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All Blog Posts
    </div>

    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Body</th>
                    <th>Date & Time</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post )
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at}}</td>
                        <td> <img src="{{asset ('storage/'.$post->image)}}" alt="" width="100"> </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postsModal{{ $post->id }}">Edit Post </button>
                            {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Modal{{ $post->id }}">Delete</button> --}}
                            <a href="/deletePosts/{{$post->id}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                    <!-- Start Modal -->
                    <div class="modal fade" id="postsModal{{ $post->id }}" tabindex="-1" aria-labelledby="postsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="postsModalLabel">Edit Blog Post {{ $post->id }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="/PostsUpdate" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="modal-body">
                                        
                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label for="post_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="post_title" name="post_title" value="{{ $post->title }}">
                                        </div>
                                        <!-- Slug -->
                                        <div class="mb-3">
                                            <label for="post_slug" class="form-label">Slug</label>
                                            <input type="text" class="form-control" id="post_slug" name="post_slug" value="{{ $post->slug }}">
                                        </div>
                                        <!-- Body -->
                                        <div class="mb-3">
                                            <label for="post_body" class="form-label">Body</label>
                                            <input type="text" class="form-control" id="post_body" name="post_body" value="{{ $post->body }}">
                                        </div>
                                        <!-- Image Upload -->
                                        <div class="mb-3">
                                            <label for="post_image" class="form-label">Image Upload</label>
                                            <input type="file" class="form-control" id="post_image" name="post_image" >
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