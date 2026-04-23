@extends('layouts.app')

@section('title', 'Edit Book')

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
            max-width: 900px;
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

        .book-form {
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
        .form-group textarea,
        .form-group select {
            padding: 13px 14px;
            border: 1px solid #cfd8e3;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            background-color: #fff;
        }

        .form-group textarea {
            min-height: 130px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.08);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-hint {
            font-size: 13px;
            color: #6b7280;
        }

        .current-file-box {
            background-color: #f8fafc;
            border: 1px solid #d7dee8;
            border-radius: 12px;
            padding: 12px 14px;
            color: #475569;
            font-size: 14px;
        }

        .current-file-box a {
            color: #1d4ed8;
            font-weight: bold;
        }

        .current-file-box a:hover {
            text-decoration: underline;
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

        @media (max-width: 800px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="form-wrapper">
        <div class="form-page-header">
            <h1>Edit Book</h1>
            <p>Update the book details and make any changes you need.</p>
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

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="book-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="title">Book Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}">
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type">
                        <option value="">Select Type</option>
                        <option value="book" {{ old('type', $book->type) == 'book' ? 'selected' : '' }}>Book</option>
                        <option value="pdf" {{ old('type', $book->type) == 'pdf' ? 'selected' : '' }}>PDF</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="">Select Status</option>
                        <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ old('status', $book->status) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="image">Book Image</label>
                    <input type="file" id="image" name="image">
                    @if($book->image)
                        <div class="current-file-box">
                            Current image:
                            <a href="{{ asset('storage/' . $book->image) }}" target="_blank">View Image</a>
                        </div>
                    @endif
                    <span class="form-hint">Leave it empty if you do not want to change the image.</span>
                </div>

                <div class="form-group">
                    <label for="file">PDF File</label>
                    <input type="file" id="file" name="file">
                    @if($book->file)
                        <div class="current-file-box">
                            Current file:
                            <a href="{{ asset('storage/' . $book->file) }}" target="_blank">Open PDF</a>
                        </div>
                    @endif
                    <span class="form-hint">Leave it empty if you do not want to change the file.</span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Update Book</button>
                <a href="{{ route('books.show', $book->id) }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>

@endsection
