<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Edit Product</h2>
    </x-slot>

    <div class="container-fluid p-4">
        {{-- Back Button --}}
        <div class="mb-3">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">&larr; Back to Products</a>
        </div>

        {{-- Edit Form --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
                <strong>Edit Product</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image Path</label>
                        <input type="text" name="image" id="image" class="form-control" value="{{ old('image', $product->image) }}" placeholder="e.g., products/sample.jpg">
                        <small class="text-muted">Enter the path to the image (e.g., products/image.jpg). Place images in storage/app/public/</small>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>