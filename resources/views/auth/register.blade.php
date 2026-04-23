@extends('layouts.app')

@section('title', 'Register')

@section('content')

    <style>
        .auth-wrapper {
            max-width: 560px;
            margin: 10px auto;
        }

        .auth-card {
            background-color: #ffffff;
            border: 1px solid #d7dee8;
            border-radius: 22px;
            padding: 34px 30px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-header h1 {
            font-size: 34px;
            color: #111827;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.8;
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

        .auth-form {
            display: grid;
            gap: 20px;
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

        .form-group input {
            padding: 13px 14px;
            border: 1px solid #cfd8e3;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            background-color: #fff;
        }

        .form-group input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.08);
        }

        .auth-actions {
            margin-top: 6px;
        }

        .btn-register {
            width: 100%;
            padding: 13px 18px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            background-color: #1d4ed8;
            color: white;
        }

        .btn-register:hover {
            background-color: #1e40af;
        }

        .auth-footer {
            text-align: center;
            margin-top: 22px;
            font-size: 15px;
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
                <h1>Create Account</h1>
                <p>Join Kitaby and start sharing books, PDF files, and study materials with other students.</p>
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

            <form action="{{ route('register.store') }}" method="POST" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="auth-actions">
                    <button type="submit" class="btn-register">Register</button>
                </div>
            </form>

            <div class="auth-footer">
                Already have an account?
                <a href="{{ route('login') }}">Login here</a>
            </div>
        </div>
    </div>

@endsection
