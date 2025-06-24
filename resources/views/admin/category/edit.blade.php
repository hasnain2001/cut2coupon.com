@extends('admin.layouts.app')
@section('title', 'edit category')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">edit Category</h4>
                <p class="text-muted font-13 mb-4">
                    edit a new category by filling out the form below.
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


            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Category Slug/Url</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}" required>
                    </div>

                    <div class="form-group">
                        <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ $category->meta_keyword }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="4" style="resize: none;">{{ $category->meta_description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select name="language_id" id="language" class="form-select">
                            <option value="">-- Select Language --</option>
                            @foreach($languages as $language)
                                <option value="{{ $language->id }}" {{ $category->language_id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label"> Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png, .gif, .webp">
                    </div>
                    @if($category->image)
                    <input type="hidden" name="previous_image" value="{{ $category->image }}">
                    <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="Current Store Image" style="max-width: 200px;">
                    @else
                    <p>No image uploaded</p>
                    @endif

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label><br>
                        <input type="radio" name="status" id="enable" value="1" {{ $category->status == 1 ? 'checked' : '' }}>
                        <label for="enable">Active</label>

                        <input type="radio" name="status" id="disable" value="0" {{ $category->status == 0 ? 'checked' : '' }}>
                        <label for="disable">inActive</label>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="top_category" id="top_category" value="1" {{ $category->top_category ? 'checked' : '' }}>
                            <label class="form-check-label" for="top_category">Featured Category</label>
                        </div>
                        <small class="text-muted">Show this category in featured sections</small>
                    </div>
                    <button type="submit" class="btn btn-primary">update Category</button>
                </form>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
