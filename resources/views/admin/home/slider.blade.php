@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Slider Manager</h1>
</div>

<div class="px-4 py-4">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New Slide
    </button>

    @if (session('Success'))
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Slider</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" action="/saveSlider" enctype="multipart/form-data">
        @csrf

        <div class="modal-body">
            
           <!-- Top Sub Heading -->
            <div class="mb-3">
                <label for="topSubHeading" class="form-label">Top Sub Heading</label>
                <input type="text" class="form-control" id="topSubHeading" name="top_sub_heading" placeholder="Enter Top Sub Heading">
            </div>

            <!-- Heading -->
            <div class="mb-3">
                <label for="heading" class="form-label">Heading</label>
                <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Heading">
            </div>

             <!-- Bottom Sub Heading -->
            <div class="mb-3">
                <label for="bottomSubHeading" class="form-label">Bottom Sub Heading</label>
                <input type="text" class="form-control" id="bottomSubHeading" name="bottom_sub_heading" placeholder="Enter Bottom Sub Heading">
            </div>

             <!-- Image Upload -->
            <div class="mb-3">
                <label for="imageUpload" class="form-label">Image Upload</label>
                <input type="file" class="form-control" id="imageUpload" name="image" >
            </div>

             <!-- More Info Link -->
            <div class="mb-3">
                <label for="moreInfoLink" class="form-label">More Info Link</label>
                <input type="url" class="form-control" id="moreInfoLink" name="more_info_link" placeholder="Enter Link" >
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Slider</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Modal -->

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
    </div>

    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>top_sub_heading</th>
                    <th>heading</th>
                    <th>bottom_sub_heading</th>
                    <th>image_link</th>
                    <th>more_info_link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliders as $slider )
                    <tr>
                        <td>{{$slider->top_sub_heading}}</td>
                        <td>{{$slider->heading}}</td>
                        <td>{{$slider->bottom_sub_heading}}</td>
                        <td> <img src="{{asset ('storage/'.$slider->image_link)}}" alt="" width="100"> </td>
                        <td>{{$slider->more_info_link}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal{{ $slider->id }}">Edit Slide </button>
                            {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Modal{{ $slider->id }}">Delete</button> --}}
                            <a href="/deleteSlider/{{$slider->id}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                    <!-- Start Modal -->
                    <div class="modal fade" id="slideModal{{ $slider->id }}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="slideModalLabel">Edit Slide {{ $slider->id }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="/sliderUpdate" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                                    <div class="modal-body">
                                        
                                        <!-- Top Sub Heading -->
                                        <div class="mb-3">
                                            <label for="topSubHeading" class="form-label">Top Sub Heading</label>
                                            <input type="text" class="form-control" id="topSubHeading" name="top_sub_heading" value="{{ $slider->top_sub_heading }}">
                                        </div>
                                        <!-- Heading -->
                                        <div class="mb-3">
                                            <label for="heading" class="form-label">Heading</label>
                                            <input type="text" class="form-control" id="heading" name="heading" value="{{ $slider->heading }}">
                                        </div>
                                        <!-- Bottom Sub Heading -->
                                        <div class="mb-3">
                                            <label for="bottomSubHeading" class="form-label">Bottom Sub Heading</label>
                                            <input type="text" class="form-control" id="bottomSubHeading" name="bottom_sub_heading" value="{{ $slider->bottom_sub_heading }}">
                                        </div>
                                        <!-- Image Upload -->
                                        <div class="mb-3">
                                            <label for="imageUpload" class="form-label">Image Upload</label>
                                            <input type="file" class="form-control" id="imageUpload" name="image" >
                                        </div>
                                        <!-- More Info Link -->
                                        <div class="mb-3">
                                            <label for="moreInfoLink" class="form-label">More Info Link</label>
                                            <input type="url" class="form-control" id="moreInfoLink" name="more_info_link" value="{{ $slider->more_info_link }}" >
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

@endsection