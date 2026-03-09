@extends('admin.layouts.app')
@section('title', 'Dori vositasini tahrirlash')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0">Dori vositasini tahrirlash: {{ $medicine->name }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('medicine.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <img id="preview" src="{{ $medicine->image ? asset('storage/' . $medicine->image) : asset('assets/images/default-medicine.png') }}"
                             class="img-fluid rounded border shadow-sm mb-3" style="max-height: 200px; width: 100%; object-fit: cover;">
                        <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                        <small class="text-muted">Yangi rasm tanlang (ixtiyoriy)</small>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomi *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $medicine->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tarkibi (Generic Name)</label>
                                <input type="text" name="generic_name" class="form-control" value="{{ old('generic_name', $medicine->generic_name) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tavsifi</label>
                            <textarea name="description" class="form-control" rows="2">{{ old('description', $medicine->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Barcode</label>
                                <input type="text" name="barcode" class="form-control" value="{{ old('barcode', $medicine->barcode) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategoriya</label>
                                <select class="form-select" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $medicine->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kelish narxi</label>
                                <input type="number" step="0.01" name="buy_price" class="form-control" value="{{ old('buy_price', $medicine->buy_price) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Sotilish narxi</label>
                                <input type="number" step="0.01" name="sell_price" class="form-control" value="{{ old('sell_price', $medicine->sell_price) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Soni</label>
                                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $medicine->quantity) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Yaroqlilik muddati</label>
                                <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $medicine->expiry_date) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ $medicine->is_active == 1 ? 'selected' : '' }}>Faol</option>
                                    <option value="0" {{ $medicine->is_active == 0 ? 'selected' : '' }}>Nofaol</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('medicine.index') }}" class="btn btn-outline-secondary px-4">Bekor qilish</a>
                            <button type="submit" class="btn btn-primary px-4">Ma'lumotni yangilash</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection