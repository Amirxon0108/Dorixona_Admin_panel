@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 text-center">

                    <img src="{{ $purchase_item->image 
                            ? asset('storage/' . $purchase_item->image) 
                            : asset('assets/images/default-purchase_item.png') }}"
                         class="img-fluid rounded"
                         style="max-height:250px; object-fit:cover;">

                </div>

                <div class="col-md-8">

                    <h4>{{ $purchase_item->medicine->name }}</h4>
                    <p><strong>Generic:</strong> {{ $purchase_item->purchase->purchase_no }}</p>
                    <p><strong>Buy Price:</strong> {{ number_format($purchase_item->unit_price, 0, '.', ' ') }} so'm</p>
                    <p><strong>Quantity:</strong> {{ $purchase_item->quantity }} ta</p>
                    <p><strong>Expiry:</strong> {{ $purchase_item->expiry_date }}</p>
                    <p><strong>Batch No:</strong> {{ $purchase_item->batch_no }}</p>
                    <p><strong>Description:</strong> {{ $purchase_item->description }}</p>
                                    
                    </p>
                    <a href="{{ route('purchase_item.index') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                    <a href="{{ route('purchase_item.edit', $purchase_item->id) }}"
                       class="btn btn-primary mt-3">
                        Edit purchase_item
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
