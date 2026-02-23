@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Edit purchase</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('purchase.update', $purchase->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Supplier -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Yetkazib beruvchi *</label>
                        <select name="supplier_id"
                                class="form-select @error('supplier_id') is-invalid @enderror"
                                required>
                            <option value="">Tanlang</option>

                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id', $purchase->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- User -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Olgan shaxs *</label>
                        <select name="user_id"
                                class="form-select @error('user_id') is-invalid @enderror"
                                required>
                            <option value="">Tanlang</option>

                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $purchase->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Purchase No -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kod</label>
                        <input type="text"
                               name="purchase_no"
                               value="{{ old('purchase_no', $purchase->purchase_no) }}"
                               class="form-control @error('purchase_no') is-invalid @enderror">

                        @error('purchase_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Purchase Date -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Olingan sana</label>
                        <input type="date"
                               name="purchase_date"
                               value="{{ old('purchase_date', $purchase->purchase_date) }}"
                               class="form-control @error('purchase_date') is-invalid @enderror">

                        @error('purchase_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Total Amount -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jami</label>
                        <input type="text"
                               name="total_amount"
                               value="{{ old('total_amount', $purchase->total_amount) }}"
                               class="form-control @error('total_amount') is-invalid @enderror">

                        @error('total_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description</label>
                        <input type="text"
                               name="description"
                               value="{{ old('description', $purchase->description) }}"
                               class="form-control @error('description') is-invalid @enderror">

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <a href="{{ route('purchase.index') }}"
                   class="btn btn-light me-3">
                    Back
                </a>

                <button type="submit" class="btn btn-primary">
                    Update purchase
                </button>

            </form>

        </div>
    </div>

</div>
@endsection 