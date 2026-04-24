@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

<div class="container-fluid">

    <div class="mb-4">
        <h2 style="font-weight: bold;">Admin Dashboard</h2>
        <p style="color:#6b7280;">
            Overview of Kitaby platform statistics and management shortcuts.
        </p>
    </div>

    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $users }}</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $books }}</h3>
                    <p>Books</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $categories }}</h3>
                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $requests }}</h3>
                    <p>Book Requests</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Quick Management</h3>
        </div>

        <div class="card-body">
            <a href="{{ route('books.index') }}" class="btn btn-primary mb-2">
                Manage Books
            </a>

            <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-2">
                Manage Categories
            </a>

            <a href="{{ route('book-requests.index') }}" class="btn btn-success mb-2">
                Manage Requests
            </a>
        </div>
    </div>

</div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@endsection