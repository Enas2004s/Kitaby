@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>
<p style="color:#6b7280; margin-bottom:24px;">
    General overview of Kitaby platform statistics.
</p>

<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:20px;">

    <div style="background:#eef4ff; padding:24px; border-radius:16px; border:1px solid #d7e3ff;">
        <h3>Users</h3>
        <p style="font-size:32px; font-weight:bold; color:#1d4ed8;">{{ $users }}</p>
    </div>

    <div style="background:#f0fdf4; padding:24px; border-radius:16px; border:1px solid #bbf7d0;">
        <h3>Books</h3>
        <p style="font-size:32px; font-weight:bold; color:#15803d;">{{ $books }}</p>
    </div>

    <div style="background:#fff7ed; padding:24px; border-radius:16px; border:1px solid #fed7aa;">
        <h3>Categories</h3>
        <p style="font-size:32px; font-weight:bold; color:#c2410c;">{{ $categories }}</p>
    </div>

    <div style="background:#fdf2f8; padding:24px; border-radius:16px; border:1px solid #fbcfe8;">
        <h3>Requests</h3>
        <p style="font-size:32px; font-weight:bold; color:#be185d;">{{ $requests }}</p>
    </div>

</div>

@endsection
