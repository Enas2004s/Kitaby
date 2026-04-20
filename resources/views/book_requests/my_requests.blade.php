@extends('layouts.app')

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
        <h1>My Requests</h1>
        <p>Track the books you have requested and see their current status.</p>
    </div>

    @if($requests->count())
        <div class="requests-grid">
            @foreach($requests as $request)
                <div class="request-card">

                    <div class="request-title">
                        {{ $request->book->title }}
                    </div>

                    <div class="request-meta">
                        <strong>Book Owner:</strong> {{ $request->book->user ? $request->book->user->name : 'Unknown' }} <br>
                        <strong>Type:</strong> {{ $request->book->type }} <br>
                        <strong>Your Request:</strong> Sent successfully
                    </div>

                    <div class="status-badge
                        @if($request->status == 'pending') status-pending
                        @elseif($request->status == 'approved') status-approved
                        @else status-rejected
                        @endif">
                        {{ ucfirst($request->status) }}
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <h2>You have not requested any books yet</h2>
            <p>Once you request a book from another student, it will appear here.</p>
        </div>
    @endif

@endsection
