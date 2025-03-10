@extends('admin.layouts.default')
@section('content')
<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
       <h1>Add new Slideshow</h1>
       <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">Server Side</h4>
                </div>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('slideshow.create') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label>Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}" required>
                </div>

                <div class="form-group">
                    <label>Text</label>
                    <textarea name="text" class="form-control" required>{{ old('text') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Link</label>
                    <input type="text" name="link" class="form-control" value="{{ old('link') }}" required>
                </div>

                <!-- Fix Toggle -->
                <input type="hidden" name="show" value="0">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="toggleSwitch" name="show" value="1" {{ old('show') == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="toggleSwitch">
                        <i class="bi {{ old('show') == 1 ? 'bi-eye' : 'bi-eye-slash' }}"></i>
                        {{ old('show') == 1 ? 'Enabled' : 'Disabled' }}
                    </label>
                </div>

                <div class="form-group">
                    <label>Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order') }}" required>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>
        </div>
    </div>
    </div>
    <!-- end container-fluid -->
</div>

@endsection