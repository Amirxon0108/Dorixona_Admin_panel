@extends('admin.layouts.app')
@section('title','Category Create')
@section('content')
<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Add New Category</h5>
            @if(session()->has('error'))  <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
        </div>
    </div>
@endif
        </div>

        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category Name *</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                   

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input name="slug"  type="text"
                                  class="form-control @error('slug') is-invalid @enderror">{{ old('slug') }}</textarea>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Ona kategoriya (ixtiyoriy):</label>
<select class="form-control name="parent_id">
    <option value="">-- Asosiy kategoriya --</option> @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select></div>
                   
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('category.index') }}" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">
                        Save Medicine
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection