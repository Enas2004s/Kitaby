@extends('layouts.app')

@section('content')

    <style>
        .categories-header {
            margin-bottom: 28px;
        }

        .categories-header h1 {
            font-size: 36px;
            color: #111827;
            margin-bottom: 10px;
        }

        .categories-header p {
            color: #6b7280;
            font-size: 17px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 22px;
        }

        .category-card {
            background-color: #ffffff;
            border: 1px solid #d7dee8;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .category-title {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
        }

        .category-description {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.9;
            flex: 1;
        }

        .category-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 6px;
        }

        .btn-light,
        .btn-danger {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
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

        .inline-form {
            display: inline;
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
    </style>

    <div class="categories-header">
        <h1>All Categories</h1>
        <p>Explore the main categories that organize books and study materials on Kitaby.</p>
    </div>

    @if($categories->count())
        <div class="categories-grid">
            @foreach($categories as $category)
                <div class="category-card">
                    <div class="category-title">{{ $category->name }}</div>

                    <div class="category-description">
                        {{ $category->description ?: 'No description available for this category.' }}
                    </div>

                    @auth
                        <div class="category-actions">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn-light">Edit</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </div>
                    @endauth
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <h2>No categories available yet</h2>
            <p>There are no categories added right now. Please check back later.</p>
        </div>
    @endif

@endsection
