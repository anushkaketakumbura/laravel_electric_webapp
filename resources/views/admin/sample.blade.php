@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Slider</h1>
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

@endsection