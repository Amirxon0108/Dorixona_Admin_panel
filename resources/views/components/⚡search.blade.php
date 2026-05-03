<?php

use Livewire\Component;
use App\Models\Medicine;

new class extends Component
{
    public $medicines = [];
    public $query = '';

    public function updatedQuery()
    {
        if (trim($this->query) === '') {
            $this->medicines = [];
            return;
        }

        $this->medicines = Medicine::where('quantity', '>', 0)
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->query . '%')
                  ->orWhere('generic_name', 'like', '%' . $this->query . '%')
                  ->orWhere('barcode', 'like', '%' . $this->query . '%');
            })
            ->limit(10)
            ->get();
    }

    // ✅ stock qo'shildi, named params bilan dispatch
    public function addToCart($id, $name, $price, $stock)
    {
        $this->dispatch('add-to-cart',
            id:    $id,
            name:  $name,
            price: $price,
            stock: $stock,
        );

        $this->query     = '';
        $this->medicines = [];
    }
};
?>

<div>
    <div class="position-relative mb-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="bx bx-search text-muted"></i>
            </span>
            <input
                type="text"
                wire:model.live.debounce.200ms="query"
                class="form-control form-control-lg border-start-0 ps-0"
                placeholder="Dori nomi, generik nomi yoki barkod..."
                autofocus
                autocomplete="off"
            >
        </div>

        @if(count($medicines))
            <ul
                class="list-group position-absolute w-100 shadow mt-1"
                style="z-index:1050; max-height:280px; overflow-y:auto;"
            >
                @foreach($medicines as $medicine)
                    {{-- ✅ 4-argument: id, name, price, quantity(stock) --}}
                    <li
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        wire:click="addToCart({{ $medicine->id }}, '{{ addslashes($medicine->name) }}', {{ $medicine->sell_price }}, {{ $medicine->quantity }})"
                        style="cursor:pointer;"
                    >
                        <div>
                            <div class="fw-semibold">{{ $medicine->name }}</div>
                            @if($medicine->generic_name)
                                <small class="text-muted">{{ $medicine->generic_name }}</small>
                            @endif
                        </div>
                        <div class="text-end">
                            <div class="text-success fw-semibold">
                                {{ number_format($medicine->sell_price) }} so'm
                            </div>
                            <span class="badge {{ $medicine->quantity < 10 ? 'bg-warning text-dark' : 'bg-success' }}">
                                {{ $medicine->quantity }} dona
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>