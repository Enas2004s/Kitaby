@extends('layouts.app')

@section('title', 'Book Details')

@section('content')

    <style>
        .book-details-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 34px;
            align-items: start;
        }

        .details-image-box {
            background-color: #f8fafc;
            border: 1px solid #d7dee8;
            border-radius: 20px;
            overflow: hidden;
            min-height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .details-image-box img {
            width: 100%;
            height: 100%;
            max-height: 520px;
            object-fit: cover;
        }

        .no-book-image {
            color: #94a3b8;
            font-size: 17px;
        }

        .details-content h1 {
            font-size: 40px;
            color: #111827;
            margin-bottom: 16px;
        }

        .details-description {
            font-size: 17px;
            color: #5b6472;
            line-height: 1.9;
            margin-bottom: 24px;
        }

        .details-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .info-card {
            background-color: #f8fafc;
            border: 1px solid #d7dee8;
            border-radius: 14px;
            padding: 16px;
        }

        .info-card strong {
            display: block;
            margin-bottom: 6px;
            color: #111827;
            font-size: 15px;
        }

        .info-card span {
            color: #4b5563;
            font-size: 15px;
        }

        .details-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        .btn-main,
        .btn-light,
        .btn-danger,
        .btn-pdf {
            display: inline-block;
            padding: 11px 16px;
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
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: bold;
            background-color: #e5e7eb;
            color: #374151;
            margin-bottom: 20px;
        }

        .request-form-inline,
        .delete-form-inline {
            display: inline;
        }

        @media (max-width: 950px) {
            .book-details-wrapper {
                grid-template-columns: 1fr;
            }

            .details-info {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="book-details-wrapper">
        <div class="details-image-box">
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image">
            @else
                <div class="no-book-image">No Image Available</div>
            @endif
        </div>

        <div class="details-content">
            <h1>{{ $book->title }}</h1>

            <div class="status-badge">
                {{ ucfirst($book->status) }}
            </div>

            <p class="details-description">
                {{ $book->description }}
            </p>

            <div class="details-info">
                <div class="info-card">
                    <strong>Author</strong>
                    <span>{{ $book->author ?: 'Not specified' }}</span>
                </div>

                <div class="info-card">
                    <strong>Type</strong>
                    <span>{{ $book->type }}</span>
                </div>

                <div class="info-card">
                    <strong>Category</strong>
                    <span>{{ $book->category->name }}</span>
                </div>

                <div class="info-card">
                    <strong>Owner</strong>
                    <span>{{ $book->user ? $book->user->name : 'Unknown' }}</span>
                </div>
            </div>

            <div class="details-actions">
                @if($book->file)
                    <a href="{{ asset('storage/' . $book->file) }}" target="_blank" class="btn-pdf">Open PDF File</a>
                @endif

                @if($book->type == 'book')
                    @auth
                        @if(auth()->id() != $book->user_id)
                            <form action="{{ route('book-requests.store') }}" method="POST" class="request-form-inline">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="btn-main">Request Book</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-light">Login to Request</a>
                    @endauth
                @endif

                @auth
                    @if(auth()->id() == $book->user_id)
                        <a href="{{ route('books.edit', $book->id) }}" class="btn-light">Edit</a>

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="delete-form-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>

@endsection
