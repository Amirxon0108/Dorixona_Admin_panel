@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Edit Medicine</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('medicine.update', $medicine->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-4 text-center mb-4">
                        <img id="preview"
                             src="{{ $medicine->image 
                                    ? asset('storage/' . $medicine->image) 
                                    : asset('assets/images/default-medicine.png') }}"
                             class="img-fluid rounded"
                             style="max-height:200px; object-fit:cover;">
                    </div>

                    <div class="col-md-8">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   value="{{ $medicine->name }}">
                        </div>

                        <div class="mb-3">
                            <label>Tarkibi</label>
                            <input type="text" name="generic_name"
                                   class="form-control"
                                   value="{{ $medicine->generic_name }}">
                        </div>
                        <div class="mb-3">
    <label>Tavsifi</label>
    <input type="text" name="description" class="form-control" value="{{ old('description', $medicine->description) }}">
</div>

<div class="mb-3">
    <label>Barcode</label>
    <input type="text" name="barcode" class="form-control" value="{{ old('barcode', $medicine->barcode) }}">
</div>

<div class="mb-3">
    <label>Buy Price</label>
    <input type="number" name="buy_price" class="form-control" value="{{ old('buy_price', $medicine->buy_price) }}">
</div>

<div class="mb-3">
    <label>Sell Price</label>
    <input type="number" name="sell_price" class="form-control" value="{{ old('sell_price', $medicine->sell_price) }}">
</div>

<div class="mb-3">
    <label>Soni</label>
    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $medicine->quantity) }}">
</div>

<div class="mb-3">
    <label>Muddati</label>
    <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $medicine->expiry_date) }}">
</div>

<div class="mb-3">
    <label class="form-label" for="category_id">Kategoriyani tanlang</label>
    <select class="form-select" name="category_id" id="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $medicine->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Status *</label>
    <select name="is_active" class="form-select">
        <option value="1" {{ $medicine->is_active == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $medicine->is_active == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>


                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image"
                                   class="form-control"
                                   onchange="previewImage(event)">
                        </div>
                         <a href="{{ route('medicine.index') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                        <button type="submit" class="btn btn-primary">
                            Update Medicine
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
function previewImage(event) {
    document.getElementById('preview').src =
        URL.createObjectURL(event.target.files[0]);
}
</script>

@endsection
