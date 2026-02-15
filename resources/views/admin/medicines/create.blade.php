@extends('admin.layouts.app')
@section('title','Medicine Create')
@section('content')
<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Add New Medicine</h5>
        </div>
        @if(session('success'))
        <div class="form-label">
            <h3>
        {{ session('success') }}
            </h3>
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('medicine.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Medicine Name *</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Generic Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Generic Name *</label>
                        <input type="text" name="generic_name"
                               class="form-control @error('generic_name') is-invalid @enderror"
                               value="{{ old('generic_name') }}">
                        @error('generic_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Barcode -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Barcode *</label>
                        <input type="text" name="barcode"
                               class="form-control @error('barcode') is-invalid @enderror"
                               value="{{ old('barcode') }}">
                        @error('barcode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity *</label>
                        <input type="number" name="quantity"
                               class="form-control @error('quantity') is-invalid @enderror"
                               value="{{ old('quantity') }}">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sell Price -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sell Price *</label>
                        <input type="number" step="0.01" name="sell_price"
                               class="form-control @error('sell_price') is-invalid @enderror"
                               value="{{ old('sell_price') }}">
                        @error('sell_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buy Price -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Buy Price *</label>
                        <input type="number" step="0.01" name="buy_price"
                               class="form-control @error('buy_price') is-invalid @enderror"
                               value="{{ old('buy_price') }}">
                        @error('buy_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="category_id">Kategoriyani tanlang</label>
                        <select class="form-select" name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">Kategoriyani tanlang </option>
                            
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Expiry Date -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Expiry Date *</label>
                        <input type="date" name="expiry_date"
                               class="form-control @error('expiry_date') is-invalid @enderror"
                               value="{{ old('expiry_date') }}">
                        @error('expiry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status *</label>
                        <select name="is_active"
                                class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Medicine Image</label>
                        <input type="file" name="image"
                               class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('medicine.index') }}" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">
                        Save Medicine
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection