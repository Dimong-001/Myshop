@extends('admin.layouts.default')

@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <!-- Page header -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Products Management</h4>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add New Product
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                @if($product->image)
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>${{ number_format($product->price, 2) }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                <span class="badge badge-{{ $product->is_active ? 'success' : 'danger' }}">
                                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No products found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-3">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
