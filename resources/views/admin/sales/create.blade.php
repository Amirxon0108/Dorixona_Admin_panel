@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bx bx-error-circle me-1"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bx bx-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- CHAP: Qidiruv + Savat --}}
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center gap-2 py-3">
                    <i class="bx bx-cart fs-5 text-primary"></i>
                    <h5 class="mb-0">Yangi Savdo</h5>
                </div>
                <div class="card-body">

                    @livewire('search')

                    <div class="table-responsive mt-3">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Dori</th>
                                    <th class="text-end">Narx</th>
                                    <th class="text-center" style="width:190px">Miqdor</th>
                                    <th class="text-end">Jami</th>
                                    <th style="width:50px"></th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                                <tr id="empty-row">
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="bx bx-package fs-1 d-block mb-2 opacity-50"></i>
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

                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <h5 class="mb-0">
                            <i class="bx bx-receipt me-1 text-success"></i>To'lov
                        </h5>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <strong id="display-subtotal">0.00 so'm</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">QQS (12%)</span>
                            <strong id="display-qqs">0.00 so'm</strong>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Chegirma (so'm)</label>
                            <input
                                type="number"
                                name="discount"
                                id="discount"
                                class="form-control"
                                value="0"
                                min="0"
                                oninput="renderCart()"
                            >
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Jami</span>
                            <strong class="fs-5 text-success" id="display-total">0.00 so'm</strong>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">To'lov usuli</label>
                            <div class="d-flex gap-2">
                                <input type="radio" class="btn-check" name="payment_method"
                                       id="cash" value="cash" checked>
                                <label class="btn btn-outline-success flex-fill" for="cash">
                                    <i class="bx bx-money me-1"></i>Naqd
                                </label>

                                <input type="radio" class="btn-check" name="payment_method"
                                       id="card" value="card">
                                <label class="btn btn-outline-primary flex-fill" for="card">
                                    <i class="bx bx-credit-card me-1"></i>Karta
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted">Izoh (ixtiyoriy)</label>
                            <textarea name="note" class="form-control" rows="2"
                                      placeholder="Qo'shimcha izoh..."></textarea>
                        </div>

                        <div id="hidden-inputs"></div>

                        <button type="submit" class="btn btn-success w-100 btn-lg"
                                id="submitBtn" disabled>
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
let cart = [];

// ─────────────────────────────────────────────────────────────
// Livewire 3: $this->dispatch('add-to-cart', id:, name:, price:, stock:)
// JS'ga native CustomEvent sifatida keladi.
//
// Named params  → e.detail = { id, name, price, stock }
// Array syntax  → e.detail = [{ id, name, price, stock }]   (eski usul)
// Ikkalasini ham qo'llab-quvvatlaymiz:
// ─────────────────────────────────────────────────────────────
window.addEventListener('add-to-cart', function (e) {
    const detail = (Array.isArray(e.detail) ? e.detail[0] : e.detail) || {};

    const id    = detail.id;
    const name  = detail.name;
    const price = parseFloat(detail.price);
    const stock = parseInt(detail.stock);

    if (!id || !name || isNaN(price) || isNaN(stock)) {
        console.error('[add-to-cart] Noto\'g\'ri ma\'lumot:', detail);
        return;
    }

    addToCart(id, name, price, stock);
});

// ─────────────────────────────────────────────────────────────
// Cart funksiyalari
// ─────────────────────────────────────────────────────────────
function addToCart(id, name, price, stock) {
    const existing = cart.find(item => item.id == id);

    if (existing) {
        if (existing.quantity + 1 > existing.stock) {
            alert(`"${name}": omborda faqat ${existing.stock} dona bor!`);
            return;
        }
        existing.quantity++;
    } else {
        cart.push({ id, name, price, quantity: 1, stock });
    }

    renderCart();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    renderCart();
}

function changeQty(index, delta) {
    const item   = cart[index];
    const newQty = item.quantity + delta;

    if (newQty < 1) return;

    if (newQty > item.stock) {
        alert(`Omborda faqat ${item.stock} dona bor!`);
        return;
    }

    item.quantity = newQty;
    renderCart();
}

function manualQty(index, value) {
    const item = cart[index];
    let qty = parseInt(value);

    if (isNaN(qty) || qty < 1) qty = 1;

    if (qty > item.stock) {
        alert(`Omborda faqat ${item.stock} dona bor!`);
        qty = item.stock;
    }

    item.quantity = qty;
    renderCart();
}

function renderCart() {
    const tbody    = document.getElementById('cart-table-body');
    const discount = parseFloat(document.getElementById('discount').value) || 0;

    tbody.innerHTML = '';

    if (!cart.length) {
        tbody.innerHTML = `
            <tr id="empty-row">
                <td colspan="5" class="text-center text-muted py-5">
                    <i class="bx bx-package fs-1 d-block mb-2 opacity-50"></i>
                    Savatcha bo'sh
                </td>
            </tr>`;
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('hidden-inputs').innerHTML = '';
        updateTotals(0, discount);
        return;
    }

    let subtotal     = 0;
    let hiddenInputs = '';

    cart.forEach((item, index) => {
        const lineTotal = item.price * item.quantity;
        subtotal += lineTotal;

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <div class="fw-semibold">${escapeHtml(item.name)}</div>
                <small class="text-muted">${fmt(item.price)} / dona</small>
            </td>
            <td class="text-end text-nowrap">${fmt(item.price)}</td>
            <td>
                <div class="input-group input-group-sm justify-content-center">
                    <button type="button"
                            onclick="changeQty(${index}, -1)"
                            class="btn btn-outline-danger">−</button>
                    <input type="number"
                           value="${item.quantity}"
                           min="1"
                           max="${item.stock}"
                           onchange="manualQty(${index}, this.value)"
                           class="form-control text-center px-1"
                           style="max-width:58px">
                    <button type="button"
                            onclick="changeQty(${index}, 1)"
                            class="btn btn-outline-success">+</button>
                </div>
            </td>
            <td class="text-end text-nowrap fw-semibold">${fmtDec(lineTotal)}</td>
            <td class="text-center">
                <button type="button"
                        onclick="removeFromCart(${index})"
                        class="btn btn-sm btn-outline-danger"
                        title="O'chirish">
                    <i class="bx bx-trash"></i>
                </button>
            </td>`;

        tbody.appendChild(tr);

        hiddenInputs += `
            <input type="hidden" name="medicines[${index}][id]"      value="${item.id}">
            <input type="hidden" name="medicines[${index}][quantity]" value="${item.quantity}">
        `;
    });

    document.getElementById('hidden-inputs').innerHTML = hiddenInputs;
    document.getElementById('submitBtn').disabled = false;
    updateTotals(subtotal, discount);
}

function updateTotals(subtotal, discount) {
    const qqs   = subtotal * QQS_RATE;
    const total = Math.max(0, subtotal + qqs - discount);

    document.getElementById('display-subtotal').textContent = fmtDec(subtotal);
    document.getElementById('display-qqs').textContent      = fmtDec(qqs);
    document.getElementById('display-total').textContent    = fmtDec(total);
}

// ─────────────────────────────────────────────────────────────
// Yordamchi funksiyalar
// ─────────────────────────────────────────────────────────────
function fmt(n) {
    return Number(n).toLocaleString() + " so'm";
}

function fmtDec(n) {
    return Number(n).toLocaleString(undefined, { minimumFractionDigits: 2 }) + " so'm";
}

function escapeHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}
</script>
@endsection