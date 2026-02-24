@extends('admin.layouts.app')
@section('title', 'Purchase')
@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">
                <div class="row">

    <!-- Left side (optional image yoki icon) -->
    

    <!-- Right side info -->
    <div class="col-md-8">

        <h4>Purchase #{{ $purchase->purchase_no }}</h4>

        <p><strong>Yetkazib beruvchi:</strong> 
            {{ $purchase->supplier->name ?? '-' }}
        </p>

        <p><strong>Olgan shaxs:</strong> 
            {{ $purchase->user->name ?? '-' }}
        </p>

        <p><strong>Olingan sana:</strong> 
            {{ $purchase->purchase_date }}
        </p>

        <p><strong>Jami pachka:</strong> 
            {{ number_format($purchase->total_amount, 0, '.', ' ') }}
        </p>

        <p><strong>Description:</strong> 
            {{ $purchase->description ?? '-' }}
        </p>

        

        <a href="{{ route('purchase.index') }}"
           class="btn btn-light me-3">
            Back
        </a>

        <a href="{{ route('purchase.edit', $purchase->id) }}"
           class="btn btn-primary mt-3">
            Edit Purchase
        </a>

    </div>

</div>
            </div>

        </div>
    </div>

</div>
@endsection
