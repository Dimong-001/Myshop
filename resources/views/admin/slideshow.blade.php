@extends('admin.layouts.default')
@section('content')
<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
       <h1>Slideshow</h1>
       <div class="text-right my-3">
            <a href="{{ route('slideshow.createslideshow') }}" class="btn btn-lg btn-success shadow-sm rounded-pill px-4">
                <i class="bi bi-plus-circle"></i> Add New Slideshow
            </a>
        </div>
        <!-- begin row -->
        <div class="row editable-wrapper">
            <div class="col-lg-12 ">
            @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn btn-danger btn-sm ms-auto" data-bs-dismiss="alert" aria-label="Close">
                    &times;
                </button>
            </div>
            @endif

            @if(session('error'))
                <div id="error-alert" class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn btn-sm btn-sm ms-auto" data-bs-dismiss="alert" aria-label="Close">
                    &times;
                </button>
                </div>
            @endif

                <div class="card card-statistics">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Text</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slideshows as $slideshow)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/images/demos/demo-3/slider/thumbnail/' . ($slideshow->image ?? 'default.jpg')) }}" 
                                                alt="{{ $slideshow->title ?? 'Image' }}"
                                                width="50" height="50" class="img-thumbnail">
                                        </td>
                                        <td>{{ $slideshow->title ?? 'No Title' }}</td>
                                        <td>{{ $slideshow->subtitle ?? 'No Subtitle' }}</td>
                                        <td>{{ $slideshow->text ?? 'No Text' }}</td>
                                        <td><a href="{{ $slideshow->link ?? '#' }}" target="_blank">Visit Link</a></td>
                                        <td class="table-action">
                                            <!-- Delete Button -->
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $slideshow->id }}">
                                                Delete
                                            </a>
                                            <a href="{{ route('slideshow.enable_disable', $slideshow->id) }}" class="btn btn-sm {{ $slideshow->show ? 'btn-success' : 'btn-danger' }}">
                                                <i class="bi {{ $slideshow->show ? 'bi-eye' : 'bi-eye-slash' }}"></i>
                                            </a>
                                            <a href="{{ route('slideshow.move_up', $slideshow->id) }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-arrow-up"></i> 
                                            </a>

                                            <!-- Move Down Button -->
                                            <a href="{{ route('slideshow.move_down', $slideshow->id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-arrow-down"></i> 
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal (Move it Inside the Loop) -->
                                    <div class="modal fade" id="deleteModal{{ $slideshow->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $slideshow->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $slideshow->id }}">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this slideshow?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <!-- Delete Link -->
                                                    <a href="{{ route('slideshow.delete', $slideshow->id) }}" class="btn btn-danger">Yes, Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- Place All Modals Outside the Loop -->
                    @foreach($slideshows as $slideshow)
                        <div class="modal fade" id="deleteModal{{ $slideshow->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $slideshow->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $slideshow->id }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this slideshow?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <!-- Delete Link -->
                                        <a href="{{ route('slideshow.delete', $slideshow->id) }}" class="btn btn-danger">Yes, Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->    
    </div>
    <!-- end container-fluid -->
</div>

@endsection