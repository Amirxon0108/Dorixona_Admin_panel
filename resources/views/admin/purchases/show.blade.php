@extends('admin.layouts.app')
@section('title', 'Xarid ma\'lumotlari')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Xarid tafsilotlari: #{{ $purchase->purchase_no }}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Yetkazib beruvchi:</strong>
                            <span>{{ $purchase->supplier->name ?? 'Aniqlanmagan' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Qabul qilib oluvchi:</strong>
                            <span>{{ $purchase->user->name ?? 'Aniqlanmagan' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Olingan sana:</strong>
                            <span>{{ $purchase->purchase_date }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Jami summa:</strong>
                            <span class="badge bg-success rounded-pill">{{ number_format($purchase->total_amount, 0, '.', ' ') }} so'm</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Tavsif:</strong>
                            <p class="mt-2 text-muted">{{ $purchase->description ?? 'Tavsif mavjud emas' }}</p>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('purchase.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Orqaga
                        </a>
                        <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-primary px-4">
                            <i class="fas fa-edit"></i> Tahrirlash
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection