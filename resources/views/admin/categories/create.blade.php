<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Add New Category</h2>
    </x-slot>

    <div class="container-fluid p-4">
        {{-- Back Button --}}
        <div class="mb-3">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">&larr; Back to Categories</a>
        </div>

        {{-- Create Form --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
                <strong>Create Category</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create Category</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>