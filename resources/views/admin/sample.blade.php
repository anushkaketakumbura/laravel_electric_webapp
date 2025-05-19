@extends('admin.layouts.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Slider</h1>
</div>

<div>
        @if (@session('success'))
        <div class="alert alert-success alert-dismisible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($error->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($erros->all as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    
    @endif
    
</div>

@endsection