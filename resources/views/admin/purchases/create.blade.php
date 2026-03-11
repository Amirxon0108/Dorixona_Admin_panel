@extends('admin.layouts.app')
@section('title', 'Yangi xarid qo\'shish')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0">Yangi xarid qo'shish</h5>
        </div>

        <div class="card-body">
            {{-- Xabarlar --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-primary">{{ session('success') }}</div>
            @endif

            <form action="{{ route('purchase.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Yetkazib beruvchi *</label>
                        <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                            <option value="">Tanlang...</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Qaul qiluvchi *</label>
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                            <option value="">Tanlang...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                 
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">To'lov Turi *</label>
                        <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                            <option value="">Tanlang...</option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Naqd pul</option>
                            <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Plastik karta</option>
                            <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>O'tkazma</option>
                        </select>
                        @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">To'lov Holati *</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="">Tanlang...</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>To'langan</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Qarz</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Bekor qilindi</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kod (Nomer)</label>
                        <input type="text" name="purchase_no" class="form-control @error('purchase_no') is-invalid @enderror" value="{{ old('purchase_no') }}">
                        @error('purchase_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Olingan sana</label>
                        <input type="date" name="purchase_date" class="form-control @error('purchase_date') is-invalid @enderror" value="{{ old('purchase_date') }}">
                        @error('purchase_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jami summa</label>
                        <input type="number" step="0.01" name="total_amount" class="form-control @error('total_amount') is-invalid @enderror" value="{{ old('total_amount') }}">
                        @error('total_amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tavsif</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('purchase.index') }}" class="btn btn-outline-secondary me-2">Bekor qilish</a>
                    <button type="submit" class="btn btn-primary px-4">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection