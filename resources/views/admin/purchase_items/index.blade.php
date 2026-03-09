@extends('admin.layouts.app')
@section('title', 'Omborga kelgan mahsulotlar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Omborga kelgan mahsulotlar</h4>
                <a href="{{ route('purchase_item.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Yangi qo'shish
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th>Purchase No</th>
                                <th>Dori nomi</th>
                                <th>Soni</th>
                                <th>Yaroqlilik muddati</th>
                                <th>Kelgan narxi</th>
                                <th>Seriya raqami</th>
                                <th class="text-center">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase_items as $purchase_item)
                            <tr>
                                <td>{{ $purchase_item->purchase->purchase_no ?? 'Noma\'lum' }}</td>
                                <td>{{ $purchase_item->medicine->name ?? 'Noma\'lum' }}</td>
                                <td>{{ $purchase_item->quantity }}</td>
                                <td>{{ $purchase_item->expiry_date }}</td>
                                <td>{{ number_format($purchase_item->unit_price, 2) }}</td>
                                <td>{{ $purchase_item->batch_no }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('purchase_item.show', $purchase_item->id) }}" class="btn btn-sm btn-info text-white">Ko'rish</a>
                                        <a href="{{ route('purchase_item.edit', $purchase_item->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                        
                                        <form action="{{ route('purchase_item.destroy', $purchase_item->id) }}" method="POST" onsubmit="return confirm('O\'chirmoqchimisiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">O'chirish</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection