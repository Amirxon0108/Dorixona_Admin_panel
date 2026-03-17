@extends('admin.layouts.app')

@section('content')

<h1>New Sale</h1>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('sale.store') }}">
@csrf

<!-- 🔍 SEARCH -->
<div class="mb-3">
    <input type="text" id="search" class="form-control" placeholder="Dori qidirish..." autofocus>
</div>

<ul id="results" class="list-group mb-3"></ul>

<!-- 🛒 CART -->
<table class="table table-bordered">
<thead>
<tr>
<th>Medicine</th>
<th>Price</th>
<th>Qty</th>
<th>Subtotal</th>
<th></th>
</tr>
</thead>

<tbody id="cart-table-body"></tbody>
</table>

<h4>Total: <span id="total">0.00</span></h4>

<!-- Discount -->
 <label for="discount">Discount</label>
<input type="number"  name="discount" class="form-control mt-2" value="0">

<!-- Payment -->
 <label for="payment_method">Payment Method</label> 
<select name="payment_method" class="form-control mt-2">
<option value="cash">Cash</option>
<option value="card">Card</option>
</select>

<button class="btn btn-primary mt-3">Complete Sale</button>

</form>

<script>

let medicines = @json($medicines);
let cart = [];
let selectedIndex = -1;

// 🔍 SEARCH
document.getElementById('search').addEventListener('input', function(){

    let keyword = this.value.toLowerCase();

    let filtered = medicines.filter(m =>
        m.name.toLowerCase().includes(keyword)
    );

    let html = '';

    filtered.slice(0,10).forEach((m,index)=>{

        html += `
        <li class="list-group-item item"
            data-id="${m.id}"
            data-name="${m.name}"
            data-price="${m.sell_price}"
            data-stock="${m.quantity}">
            
            ${m.name} (${m.quantity} dona)
        </li>
        `;
    });

    document.getElementById('results').innerHTML = html;
    selectedIndex = -1;

});

// ⬇⬆ ENTER
document.getElementById('search').addEventListener('keydown', function(e){

    let items = document.querySelectorAll('.item');

    if(e.key === "ArrowDown"){
        selectedIndex++;
        if(selectedIndex >= items.length) selectedIndex = 0;
    }

    if(e.key === "ArrowUp"){
        selectedIndex--;
        if(selectedIndex < 0) selectedIndex = items.length - 1;
    }

    items.forEach((el,i)=>{
        el.classList.remove('active');
        if(i === selectedIndex){
            el.classList.add('active');
        }
    });

    if(e.key === "Enter" && items[selectedIndex]){

        let m = items[selectedIndex];

        addToCart(
            m.dataset.id,
            m.dataset.name,
            m.dataset.price,
            m.dataset.stock
        );

        this.value = '';
        document.getElementById('results').innerHTML = '';
        selectedIndex = -1;
    }

});

// CLICK
document.addEventListener('click', function(e){

    if(e.target.classList.contains('item')){
        addToCart(
            e.target.dataset.id,
            e.target.dataset.name,
            e.target.dataset.price,
            e.target.dataset.stock
        );
    }

});

// ADD TO CART
function addToCart(id,name,price,stock){

    let existing = cart.find(i => i.id == id);

    if(existing){

        if(existing.quantity + 1 > stock){
            alert("Omborda yetarli emas!");
            return;
        }

        existing.quantity += 1;

    } else {

        cart.push({
            id,
            name,
            price: parseFloat(price),
            quantity: 1,
            stock: parseInt(stock)
        });

    }

    updateCart();
}

// REMOVE
function removeFromCart(index){
    cart.splice(index,1);
    updateCart();
}

// CHANGE QTY (+ -)
function changeQty(index, change){

    let item = cart[index];

    let newQty = item.quantity + change;

    if(newQty < 1) newQty = 1;

    if(newQty > item.stock){
        alert("Omborda yetarli emas!");
        return;
    }

    item.quantity = newQty;

    updateCart();
}

// MANUAL INPUT
function manualQty(index, value){

    let item = cart[index];

    let qty = parseInt(value);

    if(isNaN(qty) || qty < 1) qty = 1;

    if(qty > item.stock){
        alert("Omborda yetarli emas!");
        qty = item.stock;
    }

    item.quantity = qty;

    updateCart();
}

// UPDATE CART UI
function updateCart(){

    let tbody = document.getElementById('cart-table-body');
    tbody.innerHTML = "";

    let total = 0;

    cart.forEach((item,index)=>{

        let subtotal = item.price * item.quantity;
        total += subtotal;

        tbody.innerHTML += `
<tr>
<td>${item.name}</td>

<td>${item.price}</td>

<td style="width:160px">
<div class="d-flex">

<button type="button" onclick="changeQty(${index}, -1)" class="btn btn-sm btn-danger">-</button>

<input type="number" 
value="${item.quantity}" 
min="1"
onchange="manualQty(${index}, this.value)"
class="form-control text-center mx-1">

<button type="button" onclick="changeQty(${index}, 1)" class="btn btn-sm btn-success">+</button>

</div>
</td>

<td>${subtotal.toFixed(2)}</td>

<td>
<button onclick="removeFromCart(${index})" class="btn btn-danger btn-sm">X</button>
</td>

<input type="hidden" name="medicines[${index}][id]" value="${item.id}">
<input type="hidden" name="medicines[${index}][quantity]" value="${item.quantity}">

</tr>
`;
    });

    document.getElementById('total').innerText = total.toFixed(2);
}

</script>

@endsection