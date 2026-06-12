<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Order Details - #{{ $order->id }}</h2>
    </x-slot>

    <div class="container-fluid p-4">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            {{-- Order Info --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Order Information</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p class="mb-2"><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                        <p class="mb-0"><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
                    </div>
                </div>
            </div>

            {{-- Customer Info --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Name:</strong> {{ $order->user->name }}</p>
                        <p class="mb-0"><strong>Email:</strong> {{ $order->user->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Update Status --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Update Status</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="status" class="form-label">Current Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Update Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Order Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>${{ number_format($order->total_price, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Back to Orders --}}
        <div class="mt-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                &larr; Back to All Orders
            </a>
        </div>
    </div>
</x-app-layout>