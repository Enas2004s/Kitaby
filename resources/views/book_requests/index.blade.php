@extends('layouts.app')

@section('title', 'Book Requests')

@section('content')

    <style>
        .requests-header {
            margin-bottom: 28px;
        }

        .requests-header h1 {
            font-size: 36px;
            color: #111827;
            margin-bottom: 10px;
        }

        .requests-header p {
            color: #6b7280;
            font-size: 17px;
        }

        .requests-grid {
            display: grid;
            gap: 20px;
        }

        .request-card {
            background-color: #ffffff;
            border: 1px solid #d7dee8;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .request-title {
            font-size: 20px;
            font-weight: bold;
            color: #111827;
        }

        .request-meta {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.8;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: bold;
            width: fit-content;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .request-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-approve,
        .btn-reject {
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-approve {
            background-color: #16a34a;
            color: white;
        }

        .btn-approve:hover {
            background-color: #15803d;
        }

        .btn-reject {
            background-color: #dc2626;
            color: white;
        }

        .btn-reject:hover {
            background-color: #b91c1c;
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

    <div class="requests-header">
        <h1>Book Requests</h1>
        <p>Manage requests from students who want your books.</p>
    </div>

    @if($requests->count())
        <div class="requests-grid">
            @foreach($requests as $request)
                <div class="request-card">

                    <div class="request-title">
                        {{ $request->book->title }}
                    </div>

                    <div class="request-meta">
                        <strong>Requested By:</strong> {{ $request->user->name }} <br>
                        <strong>Book Owner:</strong> You <br>
                        <strong>Type:</strong> {{ $request->book->type }}
                    </div>

                    <div class="status-badge
                        @if($request->status == 'pending') status-pending
                        @elseif($request->status == 'approved') status-approved
                        @else status-rejected
                        @endif">
                        {{ ucfirst($request->status) }}
                    </div>

                    @if($request->status == 'pending')
                        <div class="request-actions">
                            <form action="{{ route('book-requests.approve', $request->id) }}" method="POST">
                                @csrf
                                <button class="btn-approve">Approve</button>
                            </form>

                            <form action="{{ route('book-requests.reject', $request->id) }}" method="POST">
                                @csrf
                                <button class="btn-reject">Reject</button>
                            </form>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <h2>No requests yet</h2>
            <p>No one has requested your books yet. Once they do, you will see them here.</p>
        </div>
    @endif

@endsection
