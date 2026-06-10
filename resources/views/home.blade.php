<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel Ecommerce') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .product-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            height: 200px;
            object-fit: cover;
        }

        .price-tag {
            font-size: 1.25rem;
            font-weight: 700;
            color: #28a745;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-inline-block align-text-top me-2 text-primary" viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
                LaravelEcommerce
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex align-items-center">
                    @if (Route::has('login'))
                        @auth
                            <span class="navbar-text me-3 text-dark">
                                Hello, <strong>{{ Auth::user()->name }}</strong>
                                <span class="badge bg-secondary ms-1">{{ ucfirst(Auth::user()->role) }}</span>
                            </span>

                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm px-3">Log Out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-secondary me-2">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary px-3">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Our Products</h1>
            <p class="text-muted">Browse our collection of quality products</p>
        </div>

        <!-- Show error message if exists -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100 product-card border-0 shadow-sm">
                            <!-- Product Image -->
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top product-image">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center product-image">
                                    <span class="text-white">No Image</span>
                                </div>
                            @endif

                            <!-- Product Card Body -->
                            <div class="card-body d-flex flex-column">
                                <!-- Category -->
                                @if($product->category)
                                    <span class="badge bg-secondary mb-2">{{ $product->category->name }}</span>
                                @endif

                                <!-- Product Name -->
                                <h5 class="card-title fw-bold">{{ $product->name }}</h5>

                                <!-- Description (truncated) -->
                                <p class="card-text text-muted small">
                                    {{ Str::limit($product->description, 80) }}
                                </p>

                                <!-- Price -->
                                <div class="price-tag mb-3">${{ number_format($product->price, 2) }}</div>

                                <!-- View Details Button -->
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary mt-auto">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
        @else
            <!-- No Products Message -->
            <div class="text-center py-5">
                <h4 class="text-muted">No products available yet.</h4>
                <p class="text-muted">Please check back later.</p>
            </div>
        @endif
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>