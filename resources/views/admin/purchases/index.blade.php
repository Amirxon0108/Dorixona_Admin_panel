@extends('admin.layouts.app')
@section('title', 'Xaridlar ro\'yxati')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Xaridlar</h4>
                <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-sm">
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
                                <th>Yetkazib beruvchi</th>
                                <th>Qabul qilib oluvchi</th>
                                <th>Nomer</th>
                                <th>Sana</th>
                                <th>Jami</th>
                                <th>Tavsif</th>
                                <th class="text-center">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->supplier->name ?? 'Noma\'lum' }}</td>
                                <td>{{ $purchase->user->name ?? 'Noma\'lum' }}</td>
                                <td>{{ $purchase->purchase_no }}</td>
                                <td>{{ $purchase->purchase_date }}</td>
                                <td>{{ number_format($purchase->total_amount, 2) }}</td>
                                <td>{{ $purchase->description }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('purchase.show', $purchase->id) }}" class="btn btn-sm btn-info text-white">Ko'rish</a>
                                        <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-sm btn-warning text-white">Tahrir</a>
                                        
                                        <form action="{{ route('purchase.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('O\'chirmoqchimisiz?');">
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