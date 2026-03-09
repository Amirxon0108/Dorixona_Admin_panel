@extends('admin.layouts.app')
@section('title', 'Kategoriyalar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kategoriyalar</h4>
                <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Yangi qo'shish
                </a>
            </div>
        </div>
    </div>

    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if(session('success')) <div class="alert alert-primary">{{ session('success') }}</div> @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th>Nomi</th>
                                <th>Parent ID</th>
                                <th>Slug</th>
                                <th class="text-center">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parent_id ?? 'Asosiy' }}</td>
                                <td>{{ $category->slug }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-sm btn-info text-white">Ko'rish</a>
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                        
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('O\'chirmoqchimisiz?');">
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