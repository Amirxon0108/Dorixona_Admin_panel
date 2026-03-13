@extends('admin.layouts.app')
@section('title', 'Xarid ma\'lumotlari')

@section('content')
<div class="container">

<div class="d-flex justify-content-between mb-3">
    <h2>Invoice: {{ $sale->invoice_number }}</h2>

    <button onclick="window.print()" class="btn btn-success">
        Print Receipt
    </button>
</div>

<div class="card">
<div class="card-body">

<div class="row mb-3">

<div class="col-md-6">
    <strong>Seller:</strong> {{ $sale->user->name ?? 'N/A' }} <br>
    <strong>Date:</strong> {{ $sale->created_at->format('d M Y H:i') }}
</div>

<div class="col-md-6 text-end">
    <strong>To'lov Turi:</strong> @if(  ucfirst($sale->payment_method) == 'Cash') <span class="badge bg-primary">Naqd</span> @elseif(ucfirst($sale->payment_method) == 'Card') <span class="badge bg-success">Karta</span> @elseif(ucfirst($sale->payment_method) == 'Transfer')  <span class="badge bg-success">Tansfer</span> 
    @endif
     <br>
    <strong>To'lov Holati:</strong>  @if($sale->status == 'paid') <span class="badge bg-success">To'langan</span> @elseif($sale->status == 'pending') <span class= "badge bg-warning">Qarz</span> @elseif($sale->status == 'cancelled') <span class="badge bg-danger">Qaytarib berildi</span> @endif
</div>

</div>

<table class="table table-bordered">

<thead>
<tr>
    <th>#</th>
    <th>Medicine</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Subtotal</th>
</tr>
</thead>

<tbody>

@foreach($sale->items as $index => $item)

<tr>
    <td>{{ $index+1 }}</td>

    <td>
        {{ $item->medicine->name ?? 'Deleted medicine' }}
    </td>

    <td>
        {{ number_format($item->unit_price,2) }}
    </td>

    <td>
        {{ $item->quantity }}
    </td>

    <td>
        {{ number_format($item->unit_price * $item->quantity,2) }}
    </td>
</tr>

@endforeach

</tbody>

</table>


<div class="row">

<div class="col-md-6">
    <strong>Note:</strong><br>
    {{ $sale->note ?? 'No note' }}
</div>

<div class="col-md-6">

<table class="table">

<tr>
    <th>Sub Total</th>
    <td>{{ number_format($sale->sub_total,2) }}</td>
</tr>

<tr>
    <th>Discount</th>
    <td>{{ number_format($sale->discount,2) }}</td>
</tr>

<tr>
    <th>Total</th>
    <td>
        <strong>{{ number_format($sale->total_amount,2) }}</strong>
    </td>
</tr>

</table>

</div>

</div>

</div>
</div>

<a href="{{ route('sale.index') }}" class="btn btn-secondary mt-3">
    Back
</a>

</div>
@endsection