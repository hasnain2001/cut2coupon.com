@extends('admin.layouts.app')
@section('title', 'Create category')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Create Category</h4>
                <p class="text-muted font-13 mb-4">
                    Create a new category by filling out the form below.
                </p>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Category Slug/Url</label>
                        <input type="text" name="slug" id="slug" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="meta_tag" id="meta_tag">
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword">
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="4" style="resize: none;"></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png, .gif, .webp">
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label><br>
                        <input type="radio" name="status" id="enable" checked value="1">&nbsp;<label for="enable">Active</label>
                        <input type="radio" name="status" id="disable" value="0">&nbsp;<label for="disable">inActive</label>
                    </div>
                    <div class="form-group">
                        <label for="top_category">Top Order</label>
                        <input type="checkbox" name="top_category" id="top_category" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </form>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->
<script>
    // Filter non-alphabetic characters in the 'name' input field and auto-fill 'slug'
    const inputOne = document.getElementById('name');
    const textOnlyInput = document.getElementById('slug');

    inputOne.addEventListener('input', () => {
        const value = inputOne.value;
        // Filter out non-alphabetic characters and update slug automatically
        const filteredValue = value.replace(/[^A-Za-z\s]/g, '');
        textOnlyInput.value = filteredValue;

        // Automatically check slug existence after auto-filling
        checkSlugExistence(filteredValue);
    });

    </script>
@endsection
