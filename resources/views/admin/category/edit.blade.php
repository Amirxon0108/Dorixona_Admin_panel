@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Edit Category</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('category.update', $category->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    

                    <div class="col-md-8">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   value="{{ $category->name }}">
                        </div>

                        <div class="mb-3">
                            <label>Tarkibi</label>
                            <input type="text" name="slug"
                                   class="form-control"
                                   value="{{ $category->slug }}">
                        </div>
                        <div class="mb-3">
                            <label>Tavsifi</label>
                            <input type="text" name="parent_id" class="form-control"
                             value="{{ old('parent_id', $category->parent_id) }}">
                        </div>

                         <a href="{{ route('category.index') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                        <button type="submit" class="btn btn-primary">
                            Update Category
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
function previewImage(event) {
    document.getElementById('preview').src =
        URL.createObjectURL(event.target.files[0]);
}
</script>

@endsection
