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
                <form name="sludeshow-form" method="post">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationServer01">Input Title</label>
                            <input type="text" name="title" class="form-control is-valid" id="validationServer01" placeholder="Title" value="Title" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationServer02">Sub Title</label>
                            <input type="text" name="subtitle" class="form-control is-valid" id="validationServer02" placeholder="Sub Title" value="Sub Title" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="input-group">
                                <input type="text" name="link" class="form-control is-invalid" placeholder="link" aria-describedby="inputGroupPrepend3" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="content" rows="4" placeholder="Enter slideshow description..."></textarea>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="toggleSwitch" name="status" onchange="toggleSwitchIcon(this)">
                            <label class="form-check-label fw-bold" id="toggleLabel" for="toggleSwitch">
                                <i class="bi bi-eye-slash"></i> Disabled
                            </label>
                        </div>
                        
                    </div>
                    <div class="mb-3 text-left">
                        <label for="imageUpload" class="form-label d-block">Update Picture</label>

                        <!-- Image Preview -->
                        <div>
                            <img id="previewImage" src="assets/images/demos/demo-3/slider/slide-5.jpg" 
                                class="img-thumbnail rounded-circle shadow-sm" 
                                width="150">
                        </div>

                        <!-- Custom Button -->
                        <label class="btn btn-primary mt-2">
                            <i class="bi bi-upload"></i> Choose Picture
                            <input type="file" id="imageUpload" name="image" class="d-none" onchange="previewFile()">
                        </label>
                    </div>
                    <button class="btn btn-primary" name="submit" type="submit">Submit form</button>
                    <button class="btn btn-primary" name="cancel type="submit">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- end container-fluid -->
</div>

@endsection