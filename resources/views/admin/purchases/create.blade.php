 @extends('admin.layouts.app')
@section('title','purchases Create')
@section('content')
<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Add New purchases</h5>
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
            <form action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Yetkazib beruvchi *</label>
                     <select class="form-select" name="supplier_id" id="supplier_id" class="form-control @error('purchase_id') is-invalid @enderror" required>
                            <option value="">Yetkazib beruvchi * </option>
                            
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                       
                    </div>

                   

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">olgan</label>
                        <select class="form-select" name="user_id" id="supplier_id" class="form-control @error('purchase_id') is-invalid @enderror" required>
                            <option value="">Yetkazib beruvchi * </option>
                            
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                       
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kod</label>
                        <input name="purchase_no"  type="text"  
                                  class="form-control @error('purchase_no') is-invalid @enderror">{{ old('purchase_no') }}</textarea>
                        @error('purchase_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">olingan sana</label>
                        <input name="purchase_date"  type="date"
                                  class="form-control @error('purchase_date') is-invalid @enderror">{{ old('purchase_date') }}</textarea>
                        @error('purchase_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">	jami</label>
                        <input name="total_amount"  type="text"
                                  class="form-control @error('total_amount') is-invalid @enderror">{{ old('total_amount') }}</textarea>
                        @error('total_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">description</label>
                        <input name="description"  type="text"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('purchase.index') }}" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">
                        Save purchases
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection