@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Contact Messages</h1>
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

<div class="container mt-5">
    <div class="row">
        <div classs="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Project</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->sender_name }}</td>
                            <td>{{ $contact->sender_email }}</td>
                            <td>{{ $contact->sender_phone }}</td>
                            <td>{{ $contact->sender_subject }}</td>
                            <td>{{ $contact->sender_message }}</td>
                            <td>{{ $contact->sender_project }}</td>
                            <td>
                                <a href="/admin/contact/{{ $contact->id }}" class="btn btn-primary">Reply</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $contact->id }}">Delete </button>
                            </td>
                        </tr>

                          <!-- Delete Modal -->
                    <div class="modal fade" id="DeleteModal{{ $contact->id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete Contact {{$contact->id}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Are you sure you want to delete contact: {{ $contact->id }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="/contact/{{$contact->id}}/delete" class="btn btn-danger">Delete</a>
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