@extends('admin.layouts.app')
@section('title', 'Kategoriya tafsilotlari')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Kategoriya tafsilotlari</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Nomi:</strong> <span>{{ $category->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Slug:</strong> <code>{{ $category->slug }}</code>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Parent ID:</strong> <span>{{ $category->parent_id ?? 'Asosiy kategoriya' }}</span>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('category.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-arrow-left"></i> Orqaga
                        </a>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary px-4">
                            <i class="fas fa-edit"></i> Tahrirlash
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection