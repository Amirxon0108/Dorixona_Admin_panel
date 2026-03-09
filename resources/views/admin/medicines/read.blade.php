 @extends('admin.layouts.app')
@section('title', 'Dori vositasi tafsilotlari')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Dori vositasi: {{ $medicine->name }}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <img src="{{ $medicine->image ? asset('storage/' . $medicine->image) : asset('assets/images/default-medicine.png') }}"
                         class="img-fluid rounded border shadow-sm"
                         style="max-height: 250px; width: 100%; object-fit: cover;">
                </div>

                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><strong>Tarkibi:</strong> <span>{{ $medicine->generic_name }}</span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Barcode:</strong> <code>{{ $medicine->barcode }}</code></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Kategoriya:</strong> <span>{{ $medicine->category->name ?? 'Noma\'lum' }}</span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Sotilish narxi:</strong> <span class="text-success">{{ number_format($medicine->sell_price, 0) }} som</span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Kelish narxi:</strong> <span class="text-danger">{{ number_format($medicine->buy_price, 0) }} som</span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Qoldiq soni:</strong> <span>{{ $medicine->quantity }}</span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Yaroqlilik muddati:</strong> <span>{{ $medicine->expiry_date }}</span></li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Status:</strong>
                            <span class="badge {{ $medicine->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $medicine->is_active ? 'Faol' : 'Nofaol' }}
                            </span>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('medicine.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-arrow-left"></i> Orqaga
                        </a>
                        <a href="{{ route('medicine.edit', $medicine->id) }}" class="btn btn-primary px-4">
                            <i class="fas fa-edit"></i> Tahrirlash
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection