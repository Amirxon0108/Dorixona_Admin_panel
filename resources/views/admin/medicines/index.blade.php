@extends('admin.layouts.app')
@section('title', 'Dori vositalari')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dori vositalari ro'yxati</h4>
                <a href="{{ route('medicine.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Yangi qo'shish
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle nowrap w-100" id="datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Rasm</th>
                                    <th>Nomi</th>
                                    <th>Tarkibi</th>
                                    <th>Kategoriya</th>
                                    <th>Narxi (K/S)</th>
                                    <th>Soni</th>
                                    <th>Status</th>
                                    <th class="text-center">Amallar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medicines as $med)
                                <tr>
                                    <td>
                                        <img src="{{ $med->image ? asset('storage/' . $med->image) : asset('assets/images/default-medicine.png') }}" 
                                             alt="Rasm" width="50" class="rounded border">
                                    </td>
                                    <td>{{ $med->name }}</td>
                                    <td>{{ $med->generic_name }}</td>
                                    <td>{{ $med->category->name ?? 'Noma\'lum' }}</td>
                                    <td>
                                        <small class="text-danger">K: {{ number_format($med->buy_price, 0) }}</small> / 
                                        <small class="text-success">S: {{ number_format($med->sell_price, 0) }}</small>
                                    </td>
                                    <td>{{ $med->quantity }}</td>
                                    <td>
                                        @if($med->is_active == 1)
                                            <span class="badge bg-success">Faol</span>
                                        @else
                                            <span class="badge bg-danger">Nofaol</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('medicine.show', $med->id) }}" class="btn btn-sm btn-info text-white">Ko'rish</a>
                                            <a href="{{ route('medicine.edit', $med->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('medicine.destroy', $med->id) }}" method="POST" onsubmit="return confirm('Haqiqatdan ham o\'chirmoqchimisiz?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
</div>
@endsection