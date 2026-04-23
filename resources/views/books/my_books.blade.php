@extends('layouts.app')

@section('title', 'My Books')

@section('content')

    <style>
        .my-books-header {
            margin-bottom: 28px;
        }

        .my-books-header h1 {
            font-size: 36px;
            color: #111827;
            margin-bottom: 10px;
        }

        .my-books-header p {
            color: #6b7280;
            font-size: 17px;
        }

        .my-books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
            gap: 24px;
        }

        .my-book-card {
            border: 1px solid #d7dee8;
            border-radius: 18px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
            display: flex;
            flex-direction: column;
        }

        .my-book-image {
            width: 100%;
            height: 220px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .my-book-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .my-book-no-image {
            color: #94a3b8;
            font-size: 15px;
        }

        .my-book-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }

        .my-book-title {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 4px;
        }

        .my-book-meta {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.8;
        }

        .my-book-description {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.8;
        }

        .my-book-actions {
            margin-top: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding-top: 12px;
        }

        .btn-main,
        .btn-light,
        .btn-danger,
        .btn-pdf {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-main {
            background-color: #1d4ed8;
            color: white;
        }

        .btn-main:hover {
            background-color: #1e40af;
        }

        .btn-light {
            background-color: #eef2ff;
            color: #1e3a8a;
        }

        .btn-light:hover {
            background-color: #dbeafe;
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-pdf {
            background-color: #e0f2fe;
            color: #075985;
        }

        .btn-pdf:hover {
            background-color: #bae6fd;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: bold;
            background-color: #e5e7eb;
            color: #374151;
            width: fit-content;
        }

        .empty-state {
            text-align: center;
            padding: 70px 20px;
            border: 1px dashed #cbd5e1;
            border-radius: 18px;
            background-color: #f8fafc;
        }

        .empty-state h2 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #1f2937;
        }

        .empty-state p {
            color: #6b7280;
            font-size: 17px;
        }

        .inline-form {
            display: inline;
        }
    </style>

    <div class="my-books-header">
        <h1>My Books</h1>
        <p>Manage the books and study materials you have added to Kitaby.</p>
    </div>

    @if($books->count())
        <div class="my-books-grid">
            @foreach($books as $book)
                <div class="my-book-card">
                    <div class="my-book-image">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image">
                        @else
                            <div class="my-book-no-image">No Image Available</div>
                        @endif
                    </div>

                    <div class="my-book-content">
                        <div class="my-book-title">{{ $book->title }}</div>

                        <div class="my-book-meta">
                            <strong>Author:</strong> {{ $book->author ?: 'Not specified' }} <br>
                            <strong>Type:</strong> {{ $book->type }} <br>
                            <strong>Category:</strong> {{ $book->category->name }}
                        </div>

                        <div class="status-badge">
                            {{ ucfirst($book->status) }}
                        </div>

                        <div class="my-book-description">
                            {{ \Illuminate\Support\Str::limit($book->description, 120) }}
                        </div>

                        <div class="my-book-actions">
                            <a href="{{ route('books.show', $book->id) }}" class="btn-main">View Details</a>

                            @if($book->file)
                                <a href="{{ asset('storage/' . $book->file) }}" target="_blank" class="btn-pdf">Open PDF</a>
                            @endif

                            <a href="{{ route('books.edit', $book->id) }}" class="btn-light">Edit</a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <h2>You have not added any books yet</h2>
            <p>Start building your library by adding your first book or study material.</p>
        </div>
    @endif

@endsection
