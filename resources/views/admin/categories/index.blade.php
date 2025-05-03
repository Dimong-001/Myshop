@extends('admin.layouts.default')

@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Category Management</h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add New Category</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" width="50">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editCategoryModal"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}"
                                data-slug="{{ $category->slug }}"
                                data-is_active="{{ $category->is_active }}"
                                data-image="{{ asset($category->image) }}">
                                Edit
                            </button>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="text" name="name" class="form-control mb-3" placeholder="Category Name" required>
                <input type="text" name="slug" class="form-control mb-3" placeholder="Slug">
                <input type="file" name="image" class="form-control mb-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="is_active" value="1" checked class="custom-control-input" id="activeAdd">
                    <label class="custom-control-label" for="activeAdd">Active</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="editCategoryForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_id" name="id">
                <input type="text" id="edit_name" name="name" class="form-control mb-3" required>
                <input type="text" id="edit_slug" name="slug" class="form-control mb-3">
                <div id="current_image_preview" class="mb-2"></div>
                <input type="file" name="image" class="form-control mb-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" id="edit_is_active" name="is_active" class="custom-control-input">
                    <label class="custom-control-label" for="edit_is_active">Active</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#editCategoryModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const modal = $(this);

        const id = button.data('id');
        const name = button.data('name');
        const slug = button.data('slug');
        const isActive = button.data('is_active');
        const image = button.data('image');

        modal.find('#edit_id').val(id);
        modal.find('#edit_name').val(name);
        modal.find('#edit_slug').val(slug);
        modal.find('#edit_is_active').prop('checked', isActive);

        const imageTag = image ? `<img src="${image}" class="img-thumbnail" width="100">` : 'No image';
        modal.find('#current_image_preview').html(imageTag);

        $('#editCategoryForm').attr('action', `/admin/categories/${id}`);
    });
</script>
@endpush
