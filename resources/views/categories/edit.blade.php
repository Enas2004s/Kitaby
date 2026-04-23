@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

    <style>
        .form-page-header {
            margin-bottom: 28px;
        }

        .form-page-header h1 {
            font-size: 36px;
            color: #111827;
            margin-bottom: 10px;
        }

        .form-page-header p {
            color: #6b7280;
            font-size: 17px;
        }

        .form-wrapper {
            max-width: 800px;
        }

        .error-box {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 16px 18px;
            border-radius: 14px;
            margin-bottom: 22px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .category-form {
            display: grid;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: bold;
            color: #111827;
            font-size: 15px;
        }

        .form-group input,
        .form-group textarea {
            padding: 13px 14px;
            border: 1px solid #cfd8e3;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            background-color: #fff;
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.08);
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 6px;
        }

        .btn-save,
        .btn-cancel {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-save {
            background-color: #1d4ed8;
            color: white;
        }

        .btn-save:hover {
            background-color: #1e40af;
        }

        .btn-cancel {
            background-color: #eef2ff;
            color: #1e3a8a;
        }

        .btn-cancel:hover {
            background-color: #dbeafe;
        }
    </style>

    <div class="form-wrapper">
        <div class="form-page-header">
            <h1>Edit Category</h1>
            <p>Update the selected category information and save your changes.</p>
        </div>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="category-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Update Category</button>
                <a href="{{ route('categories.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>

@endsection
