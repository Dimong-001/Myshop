@extends('admin.layouts.default')
@section('content')
<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Products Management</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                            <i class="fa fa-plus"></i> Add New Product
                        </button>
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
                                    @forelse($products ?? [] as $product)
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
                                                <button type="button" class="btn btn-sm btn-info edit-product" 
                                                        data-id="{{ $product->id }}"
                                                        data-name="{{ $product->name }}"
                                                        data-price="{{ $product->price }}"
                                                        data-description="{{ $product->description }}"
                                                        data-stock="{{ $product->stock }}"
                                                        data-is_active="{{ $product->is_active }}"
                                                        data-image="{{ $product->image }}"
                                                        data-toggle="modal" data-target="#editProductModal">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger delete-product"
                                                        data-id="{{ $product->id }}"
                                                        data-name="{{ $product->name }}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
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
                        
                        @if(isset($products) && method_exists($products, 'links'))
                            <div class="d-flex justify-content-center mt-3">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 0) }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        <small class="form-text text-muted">Upload JPG, PNG, or GIF image (max 2MB)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : 'checked' }}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_price">Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="edit_price" name="price" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="4"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_stock">Stock</label>
                        <input type="number" class="form-control" id="edit_stock" name="stock">
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_image">Product Image</label>
                        <div id="current_image_container" class="mb-2"></div>
                        <input type="file" class="form-control" id="edit_image" name="image">
                        <small class="form-text text-muted">Upload a new image to replace the existing one</small>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="edit_is_active" name="is_active" value="1">
                            <label class="custom-control-label" for="edit_is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the product: <span id="delete_product_name" class="font-weight-bold"></span>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteProductForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Edit Product
        document.querySelectorAll('.edit-product').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                const description = this.getAttribute('data-description');
                const stock = this.getAttribute('data-stock');
                const isActive = this.getAttribute('data-is_active');
                const image = this.getAttribute('data-image');

                const form = document.getElementById('editProductForm');
                form.action = `/product/${id}`;

                document.getElementById('edit_name').value = name;
                document.getElementById('edit_price').value = price;
                document.getElementById('edit_description').value = description;
                document.getElementById('edit_stock').value = stock;
                document.getElementById('edit_is_active').checked = isActive == '1';

                const imageContainer = document.getElementById('current_image_container');
                imageContainer.innerHTML = image ? `<img src="/${image}" alt="${name}" style="max-width: 200px;" class="img-thumbnail">` : '';
            });
        });

        // Delete Product
        document.querySelectorAll('.delete-product').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                document.getElementById('delete_product_name').textContent = name;
                document.getElementById('deleteProductForm').action = `/product/${id}`;

                $('#deleteProductModal').modal('show'); // ← requires jQuery + Bootstrap JS
            });
        });

    });
</script>
@endpush

