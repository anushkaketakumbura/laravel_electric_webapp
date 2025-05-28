@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Testimonial</h1>
</div>

<div class="px-4 py-4">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Testimonial
    </button>

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


<!-- Start Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Testimonial</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="/saveTestimonial" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="tt_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="tt_name" name="tt_name"
                            placeholder="Enter Name">
                    </div>

                    <!-- Profession -->
                    <div class="mb-3">
                        <label for="tt_profession" class="form-label">Profession</label>
                        <input type="text" class="form-control" id="tt_profession" name="tt_profession"
                            placeholder="Enter Profession">
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="tt_description" class="form-label"><Datag></Datag>Description</label>
                        <input type="text" class="form-control" id="tt_description" name="tt_description" placeholder="Enter Description">
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="tt_imageUpload" class="form-label">Image Upload</label>
                        <input type="file" class="form-control" id="tt_imageUpload" name="tt_image">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Modal -->



<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All Testimonial
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Profession</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testimonials as $testimonial )
                    <tr>
                        <td>{{$testimonial->name}}</td>
                        <td>{{$testimonial->profession}}</td>
                        <td> <img src="{{asset ('storage/'.$testimonial->image)}}" alt="" width="100"> </td>
                        <td>{{$testimonial->description}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TestimonialModal{{ $testimonial->id }}">Edit Testimonial </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $testimonial->id }}">Delete </button>
                           
                            {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Modal{{ $slider->id }}">Delete</button> --}}
                            {{-- <a href="/deleteTestimonial/{{$testimonial->id}}" class="btn btn-danger">Delete</a> --}}

                        </td>
                    </tr>

                    <!-- Start Modal -->
                    <div class="modal fade" id="TestimonialModal{{ $testimonial->id }}" tabindex="-1" aria-labelledby="TestimonialModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="TestimonialModalLabel">Edit Testimonial {{ $testimonial->id }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="/TestimonialUpdate" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="testimonial_id" value="{{ $testimonial->id }}">
                                    <div class="modal-body">
                                        
                                        <!-- Name -->
                                        <div class="mb-3">
                                            <label for="tt_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="tt_name" name="tt_name" value="{{ $testimonial->name }}">
                                        </div>
                                        <!-- Profession -->
                                        <div class="mb-3">
                                            <label for="tt_profession" class="form-label">Profession</label>
                                            <input type="text" class="form-control" id="tt_profession" name="tt_profession" value="{{ $testimonial->profession }}">
                                        </div>
                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label for="tt_description" class="form-label"><Datag></Datag>Description</label>
                                            <input type="text" class="form-control" id="tt_description" name="tt_description" value="{{ $testimonial->description }}">
                                        </div>
                                        <!-- Image Upload -->
                                        <div class="mb-3">
                                            <label for="tt_imageUpload" class="form-label">Image Upload</label>
                                            <input type="file" class="form-control" id="tt_imageUpload" name="tt_image">
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
                    <div class="modal fade" id="DeleteModal{{ $testimonial->id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete Testimonial {{$testimonial->id}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Are you sure you want to delete Testimonial: {{ $testimonial->id }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="/deleteTestimonial/{{$testimonial->id}}" class="btn btn-danger">Delete</a>
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


@endsection