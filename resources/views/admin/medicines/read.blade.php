@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 text-center">

                    <img src="{{ $medicine->image 
                            ? asset('storage/' . $medicine->image) 
                            : asset('assets/images/default-medicine.png') }}"
                         class="img-fluid rounded"
                         style="max-height:250px; object-fit:cover;">

                </div>

                <div class="col-md-8">

                    <h4>{{ $medicine->name }}</h4>
                    <p><strong>Generic:</strong> {{ $medicine->generic_name }}</p>
                    <p><strong>Barcode:</strong> {{ $medicine->barcode }}</p>
                    <p><strong>Sell Price:</strong> {{ $medicine->sell_price }} som</p>
                    <p><strong>Buy Price:</strong> {{ $medicine->buy_price }} som</p>
                    <p><strong>Quantity:</strong> {{ $medicine->quantity }}</p>
                    <p><strong>Expiry:</strong> {{ $medicine->expiry_date }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-{{ $medicine->is_active ? 'success' : 'danger' }}">
                            {{ $medicine->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                    <a href="{{ route('medicine.index') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                    <a href="{{ route('medicine.edit', $medicine->id) }}"
                       class="btn btn-primary mt-3">
                        Edit Medicine
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
