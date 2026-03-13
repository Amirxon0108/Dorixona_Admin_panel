@extends('admin.layouts.app')
@section('title', 'Xaridlar ro\'yxati')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Xaridlar</h4>
                <a href="{{ route('sale.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Yangi xarid qo'shish
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="datatable">
                        <thead class="table-light">
                            <tr>
            <th>Invoice</th>
            <th>User</th>
            <th>Total</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->invoice_number }}</td>
            <td>{{ $sale->user->name ?? 'N/A' }}</td>
            <td>{{ number_format($sale->total_amount,2) }}</td>
            <td>{{ $sale->payment_method }}</td>
            <td>{{ $sale->status }}</td>
            <td>{{ $sale->created_at->format('d.                                                                                                                                                                                                                                      m.Y H:i') }}</td>
            <td>
                <a href="{{ route('sale.show', $sale->id) }}" class="btn btn-sm btn-info">Ko‘rish</a>
                <a href="{{ route('sale.destroy', $sale->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">O‘chirish  </a>
            </td>
        </tr>
        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $sales->links() }}   
            </div>
        </div>
    </div>
</div>
@endsection