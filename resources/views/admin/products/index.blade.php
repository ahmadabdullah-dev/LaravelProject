<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Manage Products</h2>
    </x-slot>

    <div class="container-fluid p-4">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Add Product Button --}}
        <div class="mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                + Add New Product
            </a>
        </div>

        {{-- Products Table --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
                <strong>Products List</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>