@extends('admin.layouts.app')
@section('title', 'Ta\'minotchilar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Ta'minotchilar ro'yxati</h4>
                <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Yangi qo'shish
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
                                <th>Nomi</th>
                                <th>Telefon</th>
                                <th>Manzil</th>
                                <th class="text-center">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-sm btn-info text-white">Ko'rish</a>
                                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-warning text-white">Tahrir</a>
                                        
                                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?');">
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