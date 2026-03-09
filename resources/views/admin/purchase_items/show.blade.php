@extends('admin.layouts.app')
@section('title', 'Mahsulot tafsilotlari')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Mahsulot tafsilotlari: {{ $purchase_item->medicine->name ?? 'Noma\'lum' }}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ $purchase_item->image ? asset('storage/' . $purchase_item->image) : asset('assets/images/default-purchase_item.png') }}"
                         class="img-fluid rounded border"
                         alt="Mahsulot rasmi"
                         style="max-height: 250px; object-fit: cover;">
                </div>

                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Xarid raqami (No):</strong> <span>{{ $purchase_item->purchase->purchase_no ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Kelgan narxi:</strong> <span class="text-success fw-bold">{{ number_format($purchase_item->unit_price, 0, '.', ' ') }} so'm</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Soni:</strong> <span>{{ $purchase_item->quantity }} ta</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Yaroqlilik muddati:</strong> <span>{{ $purchase_item->expiry_date }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Seriya raqami:</strong> <span>{{ $purchase_item->batch_no }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Tavsif:</strong>
                            <p class="mt-2 text-muted">{{ $purchase_item->description ?? 'Tavsif mavjud emas' }}</p>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('purchase_item.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Orqaga
                        </a>
                        <a href="{{ route('purchase_item.edit', $purchase_item->id) }}" class="btn btn-primary px-4">
                            <i class="fas fa-edit"></i> Tahrirlash
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection