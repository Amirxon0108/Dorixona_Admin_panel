@extends('admin.layouts.app')
@section('title', 'Kategoriya qo\'shish')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0">Yangi kategoriya qo'shish</h5>
        </div>

        <div class="card-body">
            {{-- Xabarlar --}}
            @if(session('error')) <div class="alert alert-danger">{!! session('error') !!}</div> @endif
            @if(session('success')) <div class="alert alert-primary">{!! session('success') !!}</div> @endif

            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategoriya nomi *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug *</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ona kategoriya (ixtiyoriy)</label>
                        <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                            <option value="">-- Asosiy kategoriya --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('category.index') }}" class="btn btn-outline-secondary me-2">Bekor qilish</a>
                    <button type="submit" class="btn btn-primary px-4">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection