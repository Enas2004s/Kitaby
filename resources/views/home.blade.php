@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <style>
        .hero-section {
            display: grid;
            grid-template-columns: 1.15fr 0.95fr;
            gap: 36px;
            align-items: center;
            margin-bottom: 60px;
        }

        .hero-text h1 {
            font-size: 58px;
            line-height: 1.2;
            margin-bottom: 18px;
            color: #1d4ed8;
            max-width: 700px;
        }

        .hero-text p {
            font-size: 24px;
            color: #5b6472;
            margin-bottom: 26px;
            max-width: 760px;
            line-height: 1.7;
        }

        .hero-links {
            margin-top: 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .hero-links p {
            margin: 0;
            font-size: 16px;
            color: #4b5563;
        }

        .hero-links a {
            color: #1d4ed8;
            font-weight: bold;
        }

        .hero-links a:hover {
            text-decoration: underline;
        }

        .hero-image img {
            width: 100%;
            max-width: 540px;
            display: block;
            margin: auto;
            border-radius: 18px;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            margin-bottom: 14px;
            color: #111827;
        }

        .section-subtitle {
            text-align: center;
            color: #6b7280;
            max-width: 850px;
            margin: 0 auto 35px;
            font-size: 18px;
            line-height: 1.8;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
            margin-bottom: 55px;
        }

        .feature-card {
            background: #ffffff;
            border: 1px solid #d7dee8;
            border-radius: 16px;
            padding: 28px 22px;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
        }

        .feature-card h3 {
            font-size: 24px;
            margin-bottom: 14px;
            color: #111827;
        }

        .feature-card p {
            color: #6b7280;
            font-size: 17px;
            line-height: 1.8;
        }

        .cta-box {
            background: linear-gradient(135deg, #dbe7f6, #eaf1fb);
            border-radius: 18px;
            padding: 38px 30px;
            text-align: center;
            border: 1px solid #d2dae6;
        }

        .cta-box h2 {
            font-size: 34px;
            margin-bottom: 14px;
            color: #1e3a8a;
        }

        .cta-box p {
            color: #475569;
            margin-bottom: 0;
            font-size: 18px;
            line-height: 1.8;
        }

        @media (max-width: 1100px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-text h1 {
                font-size: 48px;
            }

            .hero-text p {
                font-size: 21px;
            }
        }

        @media (max-width: 900px) {
            .hero-section {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text h1,
            .hero-text p {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-links {
                align-items: center;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 30px;
            }

            .hero-text h1 {
                font-size: 40px;
            }

            .hero-text p {
                font-size: 19px;
            }
        }
    </style>

    <section class="hero-section">
        <div class="hero-text">
            <h1>Share Books, Support Students, and Learn Together</h1>

            <p>
                Kitaby is a student-centered platform designed to help university students exchange physical books, share PDF files,
                and access study materials more easily in a simple and organized way.
            </p>

            <div class="hero-links">
                @guest
                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                    <p>New to Kitaby? <a href="{{ route('register') }}">Register now</a></p>
                @else
                    <p>You are logged in. You can now explore the platform through the navigation bar above.</p>
                @endguest
            </div>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/Kitaby.png') }}" alt="Kitaby Platform">
        </div>
    </section>

    <section>
        <h2 class="section-title">What Makes Kitaby Helpful?</h2>
        <p class="section-subtitle">
            Our platform is built to make educational resources more accessible, affordable, and easier to share among students.
        </p>

        <div class="features-grid">
            <div class="feature-card">
                <h3>Book Exchange</h3>
                <p>Students can share and request physical books with a clear and organized request system.</p>
            </div>

            <div class="feature-card">
                <h3>PDF Materials</h3>
                <p>Upload useful digital materials and allow other students to view or download them easily.</p>
            </div>

            <div class="feature-card">
                <h3>Smart Requests</h3>
                <p>Book owners can manage incoming requests by approving or rejecting them directly inside the platform.</p>
            </div>

            <div class="feature-card">
                <h3>Student Support</h3>
                <p>Kitaby encourages collaboration and helps reduce the financial burden of study resources.</p>
            </div>
        </div>
    </section>

    <section class="cta-box">
        <h2>Kitaby Is More Than a Platform</h2>
        <p>
            It is a simple idea built to support students, encourage sharing, and make access to study materials easier for everyone.
        </p>
    </section>

@endsection
