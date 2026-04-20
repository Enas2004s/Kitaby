@extends('layouts.app')

@section('content')

    <style>
        .auth-wrapper {
            max-width: 500px;
            margin: auto;
            min-height: 70vh;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            background-color: #ffffff;
            border: 1px solid #d7dee8;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .auth-header h1 {
            font-size: 30px;
            color: #111827;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: #6b7280;
            font-size: 15px;
        }

        .error-box {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-weight: bold;
            color: #111827;
            font-size: 14px;
        }

        .form-group input {
            padding: 12px 13px;
            border: 1px solid #cfd8e3;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.08);
        }

        .auth-actions {
            margin-top: 10px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #1d4ed8;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #1e40af;
        }

        .auth-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #6b7280;
        }

        .auth-footer a {
            color: #1d4ed8;
            font-weight: bold;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="auth-wrapper">
        <div class="auth-card">

            <div class="auth-header">
                <h1>Login</h1>
                <p>Access your account to manage books and requests.</p>
            </div>

            @if ($errors->any())
                <div class="error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="auth-form">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>

                <div class="auth-actions">
                    <button type="submit" class="btn-login">Login</button>
                </div>
            </form>

            <div class="auth-footer">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </div>

        </div>
    </div>

@endsection
