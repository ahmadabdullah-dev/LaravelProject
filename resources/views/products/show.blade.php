<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - {{ config('app.name', 'Laravel Ecommerce') }}</title>

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

        .product-image {
            max-height: 500px;
            object-fit: contain;
        }

        .price-tag {
            font-size: 2rem;
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
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.view') }}">Cart</a>
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
        <!-- Back Button -->
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mb-4">
            &larr; Back to Products
        </a>

        <!-- Product Details Card -->
        <div class="card border-0 shadow-sm">
            <div class="row g-0">
                <!-- Product Image -->
                <div class="col-md-6">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top product-image w-100">
                    @else
                        <div="bg-secondary d-flex align-items-center justify-content-center" style="height: 500px;">
                            <span class="text-white">No Image Available</span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="col-md-6">
                    <div class="card-body p-4">
                        <!-- Category -->
                        @if($product->category)
                            <span class="badge bg-secondary mb-3">{{ $product->category->name }}</span>
                        @endif

                        <!-- Product Name -->
                        <h2 class="card-title fw-bold mb-3">{{ $product->name }}</h2>

                        <!-- Price -->
                        <div class="price-tag mb-4">${{ number_format($product->price, 2) }}</div>

                        <!-- Description -->
                        <h5 class="fw-bold">Description</h5>
                        <p class="card-text text-muted mb-4">
                            {{ $product->description ?: 'No description available.' }}
                        </p>

                        <!-- Stock Info -->
                        <div class="mb-4">
                            @if($product->stock > 0)
                                <span class="badge bg-success">In Stock ({{ $product->stock }} available)</span>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </div>

                        <!-- Add to Cart Button -->
                        @auth
                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-lg px-5" @if($product->stock <= 0) disabled @endif>
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">Login to Add to Cart</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>