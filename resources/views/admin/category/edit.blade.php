@extends('admin.layouts.app')
@section('title', 'Kategoriyani tahrirlash')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0">Kategoriyani tahrirlash: {{ $category->name }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        {{-- Kategoriya nomi --}}
                        <div class="mb-3">
                            <label class="form-label">Kategoriya nomi *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $category->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-3">
                            <label class="form-label">Slug (URL uchun) *</label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" 
                                   value="{{ old('slug', $category->slug) }}" required>
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Parent ID --}}
                        <div class="mb-3">
                            <label class="form-label">Parent ID (Ota kategoriya)</label>
                            <input type="number" name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" 
                                   value="{{ old('parent_id', $category->parent_id) }}">
                            <small class="text-muted">Agar asosiy kategoriya bo'lsa, bo'sh qoldiring yoki 0 kiriting.</small>
                            @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('category.index') }}" class="btn btn-outline-secondary px-4">Bekor qilish</a>
                            <button type="submit" class="btn btn-primary px-4">Yangilash</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection