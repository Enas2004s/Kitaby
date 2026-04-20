<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitaby</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #eef2f7;
            color: #1f2937;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #cfd8e3;
            padding: 18px 34px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo a {
            font-size: 24px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .logo span {
            color: #111827;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .nav-links a {
            color: #374151;
            padding: 8px 14px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 14px;
        }

        .nav-links a:hover {
            background-color: #e8eefc;
            color: #1d4ed8;
        }

        .logout-form {
            display: inline;
        }

        .logout-btn {
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background-color: #b91c1c;
        }

        .page-container {
            width: 96%;
            max-width: 1450px;
            margin: 22px auto 30px;
            min-height: 78vh;
        }

        .content-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 34px;
            border: 1px solid #d7dee8;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #cfd8e3;
            background-color: #ffffff;
            margin-top: 0;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 16px 20px;
            }

            .page-container {
                width: 94%;
            }

            .content-card {
                padding: 22px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <a href="{{ route('home') }}">Kita<span>by</span></a>
        </div>

        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('categories.index') }}">Categories</a>
            <a href="{{ route('books.index') }}">Books</a>

            @auth
                <a href="{{ route('books.create') }}">Add Book</a>
                <a href="{{ route('book-requests.index') }}">Book Requests</a>
                <a href="{{ route('books.my') }}">My Books</a>
                <a href="{{ route('book-requests.my') }}">My Requests</a>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <div class="page-container">
        <div class="content-card">
            @yield('content')
        </div>
    </div>

    <footer class="footer">
        Kitaby Platform © 2026 | Share books, support students, and learn together.
    </footer>

</body>
</html>
