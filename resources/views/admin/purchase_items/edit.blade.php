@extends('admin.layouts.app')
@section('title', 'Kirim ma\'lumotlarini tahrirlash')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Kirim ma'lumotlarini tahrirlash</h5>
        </div>
        
        <div class="card-body">
            <form action="{{ route('purchase_item.update', $purchase_item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Dori vositasi --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dori vositasi *</label>
                        <select name="medicine_id" class="form-select @error('medicine_id') is-invalid @enderror" required>
                            <option value="">Tanlang...</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}" {{ old('medicine_id', $purchase_item->medicine_id) == $medicine->id ? 'selected' : '' }}>
                                    {{ $medicine->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('medicine_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Xarid hujjati --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Xarid hujjati (№) *</label>
                        <select name="purchase_id" class="form-select @error('purchase_id') is-invalid @enderror" required>
                            <option value="">Tanlang...</option>
                            @foreach($purchases as $purchase)
                                <option value="{{ $purchase->id }}" {{ old('purchase_id', $purchase_item->purchase_id) == $purchase->id ? 'selected' : '' }}>
                                    {{ $purchase->purchase_no }}
                                </option>
                            @endforeach
                        </select>
                        @error('purchase_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Narx va Soni --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kelgan narxi *</label>
                        <input type="number" step="0.01" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror" 
                               value="{{ old('unit_price', $purchase_item->unit_price) }}" required>
                        @error('unit_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Soni (Quantity) *</label>
                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" 
                               value="{{ old('quantity', $purchase_item->quantity) }}" required>
                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Yaroqlilik muddati</label>
                        <input type="date" name="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror" 
                               value="{{ old('expiry_date', $purchase_item->expiry_date) }}">
                        @error('expiry_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Seriya va Tavsif --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Seriya raqami</label>
                        <input type="text" name="batch_no" class="form-control @error('batch_no') is-invalid @enderror" 
                               value="{{ old('batch_no', $purchase_item->batch_no) }}">
                        @error('batch_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tavsif</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" 
                               value="{{ old('description', $purchase_item->description) }}">
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('purchase_item.index') }}" class="btn btn-outline-secondary px-4">Bekor qilish</a>
                    <button type="submit" class="btn btn-primary px-4">Ma'lumotlarni yangilash</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection