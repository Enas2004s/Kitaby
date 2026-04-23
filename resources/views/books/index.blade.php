@extends('layouts.app')

@section('title', 'Books')

@section('content')

    <style>
        .books-header {
            margin-bottom: 28px;
        }

        .books-header h1 {
            font-size: 36px;
            color: #111827;
            margin-bottom: 10px;
        }

        .books-header p {
            color: #6b7280;
            font-size: 17px;
        }

        .search-box {
            margin: 22px 0 35px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-box input {
            flex: 1;
            min-width: 240px;
            padding: 13px 15px;
            border: 1px solid #cfd8e3;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
        }

        .search-box button {
            padding: 13px 20px;
            background-color: #1d4ed8;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }

        .search-box button:hover {
            background-color: #1e40af;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
            gap: 24px;
        }

        .book-card {
            border: 1px solid #d7dee8;
            border-radius: 18px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
            display: flex;
            flex-direction: column;
        }

        .book-image {
            width: 100%;
            height: 220px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .book-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .book-no-image {
            color: #94a3b8;
            font-size: 15px;
        }

        .book-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }

        .book-title {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 4px;
        }

        .book-meta {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.8;
        }

        .book-description {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.8;
        }

        .book-actions {
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

        .request-form {
            display: inline;
        }
    </style>

    <div class="books-header">
        <h1>All Books</h1>
        <p>Browse available books, PDF materials, and shared study resources.</p>
    </div>

    <form action="{{ route('books.index') }}" method="GET" class="search-box">
        <input
            type="text"
            name="search"
            placeholder="Search by title, author, type, or category"
            value="{{ $search ?? '' }}"
        >
        <button type="submit">Search</button>
    </form>

    @if($books->count())
        <div class="books-grid">
            @foreach($books as $book)
                <div class="book-card">
                    <div class="book-image">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image">
                        @else
                            <div class="book-no-image">No Image Available</div>
                        @endif
                    </div>

                    <div class="book-content">
                        <div class="book-title">{{ $book->title }}</div>

                        <div class="book-meta">
                            <strong>Author:</strong> {{ $book->author ?: 'Not specified' }} <br>
                            <strong>Type:</strong> {{ $book->type }} <br>
                            <strong>Category:</strong> {{ $book->category->name }} <br>
                            <strong>Owner:</strong> {{ $book->user ? $book->user->name : 'Unknown' }}
                        </div>

                        <div class="status-badge">
                            {{ ucfirst($book->status) }}
                        </div>

                        <div class="book-description">
                            {{ \Illuminate\Support\Str::limit($book->description, 120) }}
                        </div>

                        <div class="book-actions">
                            <a href="{{ route('books.show', $book->id) }}" class="btn-main">View Details</a>

                            @if($book->file)
                                <a href="{{ asset('storage/' . $book->file) }}" target="_blank" class="btn-pdf">Open PDF</a>
                            @endif

                            @if($book->type == 'book')
                                @auth
                                    @if(auth()->id() != $book->user_id)
                                        <form action="{{ route('book-requests.store') }}" method="POST" class="request-form">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <button type="submit" class="btn-light">Request Book</button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-light">Login to Request</a>
                                @endauth
                            @endif

                            @auth
                                @if(auth()->id() == $book->user_id)
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn-light">Edit</a>

                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="request-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <h2>No books available yet</h2>
            <p>There are no books or study materials added right now. Please check back later.</p>
        </div>
    @endif

@endsection
