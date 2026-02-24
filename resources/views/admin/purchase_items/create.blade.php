@extends('admin.layouts.app')
@section('title','Purchase Items Create')
@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Add New Purchase Item</h5>
        </div>

        <div class="card-body">
            {{-- Xatoliklar yoki muvaffaqiyat xabarlari --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-primary">{{ session('success') }}</div>
            @endif

            <form action="{{ route('purchase_item.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Purchase No (Hujjat) *</label>
                        <select class="form-select @error('purchase_id') is-invalid @enderror" name="purchase_id" required>
                            <option value="">Tanlang...</option>
                            @foreach($purchases as $purchase)
                                <option value="{{ $purchase->id }}" {{ old('purchase_id') == $purchase->id ? 'selected' : '' }}>
                                    {{ $purchase->purchase_no }} ({{ $purchase->supplier->name ?? 'Noma\'lum' }})
                                </option>
                            @endforeach
                        </select>
                        @error('purchase_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Medicine (Dori vositasi) *</label>
                        <select class="form-select @error('medicine_id') is-invalid @enderror" name="medicine_id" required>
                            <option value="">Tanlang...</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}" {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>
                                    {{ $medicine->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('medicine_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Soni (Quantity) *</label>
                        <input name="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required>
                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kelgan narxi (Unit Price) *</label>
                        <input name="unit_price" type="number" step="0.01" class="form-control @error('unit_price') is-invalid @enderror" value="{{ old('unit_price') }}" required>
                        @error('unit_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Yaroqlilik muddati</label>
                        <input name="expiry_date" type="date" class="form-control @error('expiry_date') is-invalid @enderror" value="{{ old('expiry_date') }}">
                        @error('expiry_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Seriya raqami (Batch No)</label>
                        <input name="batch_no" type="text" class="form-control @error('batch_no') is-invalid @enderror" value="{{ old('batch_no') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tavsif (Description)</label>
                        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('purchase_item.index') }}" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Add Item & Update Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection