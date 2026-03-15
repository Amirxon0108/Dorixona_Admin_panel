@extends('admin.layouts.app')

@section('content')

<h1>New Sale</h1>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('sale.store') }}">
@csrf
<input aria-describedby="date1" class="form-control flatpickr-input" data-input="" type="text"/>



</select>
<!-- Product selection -->
<div class="mb-3">
    <label for="medicine-select">Select Medicine</label>
    <div class="input-group">
       <select id="medicine-select" class="form-control medicine-search">
            <option value="">-- Select Medicine --</option>
            @foreach($medicines as $medicine)
                <option value="{{ $medicine->id }}" data-price="{{ $medicine->sell_price }}" data-quantity="{{ $medicine->quantity }}">
                    {{ $medicine->name }} ({{ $medicine->quantity }} in stock)
                </option>
            @endforeach
        </select>
        <input type="number" id="medicine-qty" class="form-control" value="1" min="1" style="width: 100px;">
        <button type="button" class="btn btn-success" id="add-to-cart">Add</button>
    </div>
</div>

<!-- Cart table -->
<table class="table table-bordered" id="cart-table">
    <thead>
        <tr>
            <th>Medicine</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="cart-table-body">
        <!-- Dynamic rows will be added here -->
    </tbody>
</table>

<h4>Total: <span id="total">0.00</span></h4>

<!-- Discount and payment -->
<div class="mb-3">
    <label>Discount</label>
    <input type="number" name="discount" class="form-control" value="0" min="0">
</div>

<div class="mb-3">
    <label>Payment Method</label>
    <select name="payment_method" class="form-control">
        <option value="cash">Cash</option>
        <option value="card">Card</option>
        <option value="transfer">Transfer</option>
    </select>
</div>

<div class="mb-3">
    <label>Note</label>
    <textarea name="note" class="form-control"></textarea>
</div>

<button type="submit" class="btn btn-primary mt-3">Complete Sale</button>
</form>

<!-- JS for dynamic cart -->
<script>
let cart = [];

// Add medicine to cart
document.getElementById('add-to-cart').addEventListener('click', function() {
    const select = document.getElementById('medicine-select');
    const qtyInput = document.getElementById('medicine-qty');
    const id = select.value;
    const name = select.options[select.selectedIndex]?.text;
    const price = parseFloat(select.options[select.selectedIndex]?.dataset.price || 0);
    const stock = parseInt(select.options[select.selectedIndex]?.dataset.quantity || 0);
    const quantity = parseInt(qtyInput.value);

    if(!id) return alert('Please select a medicine');
    if(quantity < 1) return alert('Quantity must be at least 1');
    if(quantity > stock) return alert('Quantity exceeds stock');

    // Check if already in cart
    let existing = cart.find(item => item.id == id);
    if(existing){
        existing.quantity += quantity;
    } else {
        cart.push({id, name, price, quantity});
    }

    updateCart();
});
$(document).ready(function(){

    $('.medicine-search').select2({
        placeholder: "Dori qidirish...",
        allowClear: true
    });

});

// Remove from cart
function removeFromCart(index){
    cart.splice(index,1);
    updateCart();
}

// Update cart table and total
function updateCart(){
    const tbody = document.getElementById('cart-table-body');
    tbody.innerHTML = '';
    let total = 0;

    cart.forEach((item,index)=>{
        const subtotal = item.price * item.quantity;
        total += subtotal;

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.name}</td>
            <td>${item.price.toFixed(2)}</td>
            <td>${item.quantity}</td>
            <td>${subtotal.toFixed(2)}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">Remove</button></td>
            <input type="hidden" name="medicines[${index}][id]" value="${item.id}">
            <input type="hidden" name="medicines[${index}][quantity]" value="${item.quantity}">
        `;
        tbody.appendChild(tr);
    });

    document.getElementById('total').innerText = total.toFixed(2);
}
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection