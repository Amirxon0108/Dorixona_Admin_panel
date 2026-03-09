@extends('admin.layouts.app')
@section('title', 'Ta\'minotchi ma\'lumotlari')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Ta'minotchi ma'lumotlari</h5>
        </div>
        
        <div class="card-body">
            {{-- Xabarlar qismi --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Nomi:</strong>
                            <span>{{ $supplier->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Telefon:</strong>
                            <span>{{ $supplier->phone }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Manzil:</strong>
                            <span>{{ $supplier->address }}</span>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Orqaga
                        </a>
                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary px-4">
                            <i class="fas fa-edit"></i> Tahrirlash
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection