<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Admin Dashboard</h2>
    </x-slot>

    <div class="row my-4">
        {{-- Access Info Card --}}
        <div class="col-12 mb-4">
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-fill-check me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 62.5 62.5 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z"/>
                </svg>
                Welcome, <strong class="ms-1">{{ Auth::user()->name }}</strong>! You are logged in as <strong class="ms-1">Admin</strong>.
            </div>
        </div>

        {{-- User Info Card --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <strong>Your Account</strong>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p class="mb-0">
                        <strong>Role:</strong>
                        <span class="badge bg-danger">{{ ucfirst(Auth::user()->role) }}</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Admin Tools Card --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white">
                    <strong>Admin Tools</strong>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <a href="{{ route('categories.index') }}">📁 Manage Categories</a>
                        </li>
                        <li class="mb-2">📦 Manage Products</li>
                        <li class="mb-2">👥 Manage Users</li>
                        <li class="mb-2">🧾 View Orders</li>
                    </ul>
                    <small class="text-muted">(Coming soon)</small>
                </div>
            </div>
        </div>

        {{-- Stats Card --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-dark text-white">
                    <strong>Quick Stats</strong>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Total Users:</strong> {{ \App\Models\User::count() }}</p>
                    <p class="mb-0"><strong>Admin Users:</strong> {{ \App\Models\User::where('role', 'admin')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
