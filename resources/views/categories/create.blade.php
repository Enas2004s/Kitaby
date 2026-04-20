@extends('layouts.app')

@section('content')
    <h2>Add New Category</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label>Category Name</label>
        <br>
        <input type="text" name="name" value="{{ old('name') }}">
        <br><br>

        <label>Description</label>
        <br>
        <textarea name="description">{{ old('description') }}</textarea>
        <br><br>

        <button type="submit">Save</button>
    </form>
@endsection
