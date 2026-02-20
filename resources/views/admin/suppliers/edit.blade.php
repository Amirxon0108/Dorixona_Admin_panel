@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Edit supplier</h5>
        </div>  
         @if(session()->has('error'))  <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
        </div>
    </div>
@endif
@if(session()->has(key: 'success'))  <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-primary">
                {!! session('success') !!}
            </div>
        </div>
    </div>
@endif

        <div class="card-body">

            <form action="{{ route('supplier.update', $supplier->id) }}"
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
                                   value="{{ $supplier->name }}">
                        </div>

                        <div class="mb-3">
                            <label>Tarkibi</label>
                            <input type="text" name="phone"
                                   class="form-control"
                                   value="{{ $supplier->phone }}">
                        </div>
                        <div class="mb-3">
                            <label>Tavsifi</label>
                            <input type="text" name="address" class="form-control"
                             value="{{ old('address', $supplier->address) }}">
                        </div>

                         <a href="{{ route('supplier.index') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                        <button type="submit" class="btn btn-primary">
                            Update supplier
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
