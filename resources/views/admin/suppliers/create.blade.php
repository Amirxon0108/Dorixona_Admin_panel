 @extends('admin.layouts.app')
@section('title','Supplier Create')
@section('content')
<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Add New Supplier</h5>
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
        </div>

        <div class="card-body">
            <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Supplier Name *</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                   

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomer</label>
                        <input name="phone"  type="text"
                                  class="form-control @error('number') is-invalid @enderror">{{ old('number') }}</textarea>
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address</label>
                        <input name="address"  type="text"
                                  class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('supplier.index') }}" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">
                        Save Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection