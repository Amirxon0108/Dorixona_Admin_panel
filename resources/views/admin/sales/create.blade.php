@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <i class="bx bx-error-circle me-1"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">

    {{-- CHAP: Qidiruv + Savat --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bx bx-cart fs-5"></i>
                <h5 class="mb-0">Yangi Savdo</h5>`
            </div>
            <div class="card-body">

                {{-- Qidiruv --}}
                <div class="position-relative mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" id="search" class="form-control form-control-lg"
                            placeholder="Dori nomi bo'yicha qidiring..." autofocus autocomplete="off">
                    </div>
                    <ul id="results" class="list-group shadow-sm position-absolute w-100"
                        style="z-index:999; top:100%; display:none; max-height:260px; overflow-y:auto;"></ul>
                </div>

                {{-- Savat jadvali --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Dori</th>
                                <th class="text-end">Narx</th>
                                <th class="text-center" style="width:180px">Miqdor</th>
                                <th class="text-end">Jami</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart-table-body">
                            <tr id="empty-row">
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bx bx-package fs-3 d-block mb-1"></i>
                                    Savatcha bo'sh
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- O'NG: To'lov panel --}}
    <div class="col-lg-4">
        <form method="POST" action="{{ route('sale.store') }}" id="saleForm">
        @csrf

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bx bx-receipt me-1"></i>To'lov</h5>
            </div>
            <div class="card-body">

                {{-- Hisoblar --}}
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <strong id="display-subtotal">0.00 so'm</strong>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">QQS (12%)</span>
                    <strong id="display-qqs">0.00 so'm</strong>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Chegirma (so'm)</label>
                    <input type="number" name="discount" id="discount"
                        class="form-control" value="0" min="0" oninput="updateCart()">
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold fs-5">Jami</span>
                    <strong class="fs-5 text-success" id="display-total">0.00 so'm</strong>
                </div>

                {{-- To'lov usuli --}}
                <div class="mb-3">
                    <label class="form-label text-muted">To'lov usuli</label>
                    <div class="d-flex gap-2">
                        <input type="radio" class="btn-check" name="payment_method" id="cash" value="cash" checked>
                        <label class="btn btn-outline-success flex-fill" for="cash">
                            <i class="bx bx-money me-1"></i>Naqd
                        </label>

                        <input type="radio" class="btn-check" name="payment_method" id="card" value="card">
                        <label class="btn btn-outline-primary flex-fill" for="card">
                            <i class="bx bx-credit-card me-1"></i>Karta
                        </label>
                    </div>
                </div>

                {{-- Izoh --}}
                <div class="mb-3">
                    <label class="form-label text-muted">Izoh (ixtiyoriy)</label>
                    <textarea name="note" class="form-control" rows="2" placeholder="..."></textarea>
                </div>

                {{-- Yashirin inputlar --}}
                <div id="hidden-inputs"></div>

                <button type="submit" class="btn btn-success w-100 btn-lg" id="submitBtn" disabled>
                    <i class="bx bx-check-circle me-1"></i>Savdoni yakunlash
                </button>

            </div>
        </div>

        </form>
    </div>

</div>
</div>

<script>
const QQS_RATE = 0.12;
let medicines = @json($medicines);
let cart = [];
let selectedIndex = -1;

const searchInput = document.getElementById('search');
const resultsList = document.getElementById('results');

searchInput.addEventListener('input', function(){
    const kw = this.value.toLowerCase().trim();
    resultsList.innerHTML = '';

    if(!kw){ resultsList.style.display = 'none'; return; }

    const filtered = medicines.filter(m => m.name.toLowerCase().includes(kw)).slice(0,10);

    if(!filtered.length){
        resultsList.innerHTML = '<li class="list-group-item text-muted text-center">Topilmadi</li>';
        resultsList.style.display = 'block';
        return;
    }

    filtered.forEach((m, i) => {
        const li = document.createElement('li');
        li.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center item';
        li.dataset.id    = m.id;
        li.dataset.name  = m.name;
        li.dataset.price = m.sell_price;
        li.dataset.stock = m.quantity;
        li.innerHTML = `
            <span>${m.name}</span>
            <span class="badge ${m.quantity < 10 ? 'bg-warning text-dark' : 'bg-success'}">${m.quantity} dona</span>
        `;
        resultsList.appendChild(li);
    });

    resultsList.style.display = 'block';
    selectedIndex = -1;
});

searchInput.addEventListener('keydown', function(e){
    const items = resultsList.querySelectorAll('.item');
    if(!items.length) return;

    if(e.key === 'ArrowDown'){ e.preventDefault(); selectedIndex = (selectedIndex + 1) % items.length; }
    if(e.key === 'ArrowUp')  { e.preventDefault(); selectedIndex = (selectedIndex - 1 + items.length) % items.length; }

    items.forEach((el,i) => el.classList.toggle('active', i === selectedIndex));

    if(e.key === 'Enter' && selectedIndex >= 0){
        const el = items[selectedIndex];
        addToCart(el.dataset.id, el.dataset.name, el.dataset.price, el.dataset.stock);
        this.value = '';
        resultsList.style.display = 'none';
        selectedIndex = -1;
    }
});
in
document.addEventListener('click', e => {
    if(!e.target.closest('#search') && !e.target.closest('#results')){
        resultsList.style.display = 'none';
    }
    if(e.target.classList.contains('item')){
        addToCart(e.target.dataset.id, e.target.dataset.name, e.target.dataset.price, e.target.dataset.stock);
        searchInput.value = '';
        resultsList.style.display = 'none';
        selectedIndex = -1;
    }
});

function addToCart(id, name, price, stock){
    const existing = cart.find(i => i.id == id);
    if(existing){
        if(existing.quantity + 1 > existing.stock){
            alert(`${name}: omborda yetarli emas!`); return;
        }
        existing.quantity++;
    } else {
        cart.push({ id, name, price: parseFloat(price), quantity: 1, stock: parseInt(stock) });
    }
    updateCart();
}

function removeFromCart(index){ cart.splice(index, 1); updateCart(); }

function changeQty(index, change){
    const item = cart[index];
    const newQty = item.quantity + change;
    if(newQty < 1) return;
    if(newQty > item.stock){ alert('Omborda yetarli emas!'); return; }
    item.quantity = newQty;
    updateCart();
}

function manualQty(index, value){
    const item = cart[index];
    let qty = parseInt(value);
    if(isNaN(qty) || qty < 1) qty = 1;
    if(qty > item.stock){ alert('Omborda yetarli emas!'); qty = item.stock; }
    item.quantity = qty;
    updateCart();
}

function updateCart(){
    const tbody   = document.getElementById('cart-table-body');
    const emptyRow = document.getElementById('empty-row');
    const discount = parseFloat(document.getElementById('discount').value) || 0;

    tbody.innerHTML = '';

    if(!cart.length){
        tbody.innerHTML = `<tr id="empty-row"><td colspan="5" class="text-center text-muted py-4">
            <i class="bx bx-package fs-3 d-block mb-1"></i>Savatcha bo'sh</td></tr>`;
        document.getElementById('submitBtn').disabled = true;
        updateTotals(0, discount);
        document.getElementById('hidden-inputs').innerHTML = '';
        return;
    }

    let subtotal = 0;
    let hiddenInputs = '';

    cart.forEach((item, index) => {
        const sub = item.price * item.quantity;
        subtotal += sub;

        tbody.innerHTML += `
<tr>
    <td>
        <div class="fw-500">${item.name}</div>
        <small class="text-muted">${item.price.toLocaleString()} so'm / dona</small>
    </td>
    <td class="text-end">${item.price.toLocaleString()}</td>
    <td>
        <div class="input-group input-group-sm">
            <button type="button" onclick="changeQty(${index},-1)" class="btn btn-outline-danger">−</button>
            <input type="number" value="${item.quantity}" min="1" max="${item.stock}"
                onchange="manualQty(${index}, this.value)"
                class="form-control text-center" style="max-width:60px">
            <button type="button" onclick="changeQty(${index},1)" class="btn btn-outline-success">+</button>
        </div>
    </td>
    <td class="text-end fw-500">${sub.toLocaleString(undefined,{minimumFractionDigits:2})} so'm</td>
    <td class="text-center">
        <button type="button" onclick="removeFromCart(${index})" class="btn btn-sm btn-outline-danger">
            <i class="bx bx-trash"></i>
        </button>
    </td>
</tr>`;

        hiddenInputs += `
            <input type="hidden" name="medicines[${index}][id]" value="${item.id}">
            <input type="hidden" name="medicines[${index}][quantity]" value="${item.quantity}">
        `;
    });

    document.getElementById('hidden-inputs').innerHTML = hiddenInputs;
    document.getElementById('submitBtn').disabled = false;
    updateTotals(subtotal, discount);
}

function updateTotals(subtotal, discount){
    const qqs   = subtotal * QQS_RATE;
    const total = Math.max(0, subtotal + qqs - discount);

    document.getElementById('display-subtotal').textContent = subtotal.toLocaleString(undefined,{minimumFractionDigits:2}) + " so'm";
    document.getElementById('display-qqs').textContent      = qqs.toLocaleString(undefined,{minimumFractionDigits:2}) + " so'm";
    document.getElementById('display-total').textContent    = total.toLocaleString(undefined,{minimumFractionDigits:2}) + " so'm";
}
</script>
@endsection