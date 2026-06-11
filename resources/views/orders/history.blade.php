<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order History - {{ config('app.name', 'Laravel Ecommerce') }}</title>

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

        .order-item-image {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .status-badge {
            font-size: 0.85rem;
            padding: 0.35rem 0.65rem;
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
        <h2 class="mb-4">Order History</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($orders->count() > 0)
            <!-- Orders List -->
            @foreach($orders as $order)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <h6 class="mb-0">Order #{{ $order->id }}</h6>
                                <small class="text-muted">{{ $order->created_at->format('F j, Y g:i A') }}</small>
                            </div>
                            <div class="col-md-4 text-center">
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark status-badge">Pending</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-info status-badge">Processing</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success status-badge">Completed</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger status-badge">Cancelled</span>
                                @endif
                            </div>
                            <div class="col-md-4 text-md-end">
                                <strong class="text-success">${{ number_format($order->total_price, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3">Product</th>
                                        <th class="py-3">Price</th>
                                        <th class="py-3">Quantity</th>
                                        <th class="py-3">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    @if($item->product->image)
                                                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="order-item-image me-3">
                                                    @else
                                                        <div class="bg-secondary d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                            <span class="text-white small">No Image</span>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">${{ number_format($item->price, 2) }}</td>
                                            <td class="py-3">{{ $item->quantity }}</td>
                                            <td class="py-3">${{ number_format($item->getSubtotal(), 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Empty Orders -->
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" class="text-muted mb-4" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                    <h4 class="text-muted mb-3">No orders yet</h4>
                    <p class="text-muted mb-4">You haven't placed any orders yet.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Start Shopping</a>
                </div>
            </div>
        @endif
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>