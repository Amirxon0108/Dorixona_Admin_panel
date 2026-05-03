@extends('admin.layouts.app')
@section('title', 'Xaridlar ro\'yxati')

@section('content')


     <div class="container-fluid">
      <!-- start page title -->
      
       <div class="page-heading fade-up">
        <h1>Savdolar</h1>
        <p>Barcha sotuvlar va invoice'lar ro'yxati</p>
    </div>

 <div class="row g-3 mb-3">

    <div class="col-6 col-md-3">
        <div class="d-flex align-items-center p-2 border rounded">
            <i class="bx bx-receipt fs-5 text-success me-2"></i>
            <div>
                <div class="small text-muted">Jami savdolar</div>
                <div class="fw-bold">{{ $sales->total() }}</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="d-flex align-items-center p-2 border rounded">
            <i class="bx bx-check-circle fs-5 text-success me-2"></i>
            <div>
                <div class="small text-muted">To'langan</div>
                <div class="fw-bold">
                    {{ $sales->getCollection()->where('status','paid')->count() }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="d-flex align-items-center p-2 border rounded">
            <i class="bx bx-time-five fs-5 text-warning me-2"></i>
            <div>
                <div class="small text-muted">Kutilmoqda</div>
                <div class="fw-bold">
                    {{ $sales->getCollection()->where('status','pending')->count() }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="d-flex align-items-center p-2 border rounded">
            <i class="bx bx-x-circle fs-5 text-danger me-2"></i>
            <div>
                <div class="small text-muted">Bekor qilingan</div>
                <div class="fw-bold">
                    {{ $sales->getCollection()->where('status','cancelled')->count() }}
                </div>
            </div>
        </div>
    </div>

</div>
      <!-- end page title -->
      <div class="row">
       <div class="col-lg-12">
        <div class="card">
         <div class="card-body">
          <div class="row">
           <div class="col-sm">
            <div class="mb-4">
             <button class="btn btn-light waves-effect waves-light" type="button">
              <i class="bx bx-plus me-1">
              </i>
             <a href="{{ route('sale.create') }}" class="text-decoration-none"> Sotish</a>
             </button>
            </div>
           </div>
           <div class="col-sm-auto">
            <div class="d-flex align-items-center gap-1 mb-4">
             <div class="input-group datepicker-range">
              <input aria-describedby="date1" class="form-control flatpickr-input" data-input="" type="text"/>
              <button class="input-group-text" data-toggle="" id="date1">
               <i class="bx bx-calendar-event">
               </i>
              </button>
             </div>
             <div class="dropdown">
              <a aria-expanded="false" class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
               <i class="bx bx-dots-horizontal-rounded">
               </i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
               <li>
                <a class="dropdown-item" href="#">
                 Action
                </a>
               </li>
               <li>
                <a class="dropdown-item" href="#">
                 Another action
                </a>
               </li>
               <li>
                <a class="dropdown-item" href="#">
                 Something else here
                </a>
               </li>
              </ul>
             </div>
            </div>
           </div>
          </div>
          <!-- end row -->
          <div class="table-responsive">
           <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
             <tr class="bg-transparent">
              <th style="width: 30px;">
               <div class="form-check font-size-16">
                <input class="form-check-input" id="checkAll" name="check" type="checkbox"/>
                <label class="form-check-label" for="checkAll">
                </label>
               </div>
              </th>
              <th>
               QR Code
              </th>
              <th style="width: 120px;">
               Invoice ID
              </th>
              <th>
               Sana
              </th>
              <th>
              Sotuvchi
              </th>
              <th>
                Jami summa
              </th>
              <th>
               To'lov Holati
              </th>
              <th style="width: 150px;">
                 Pdf Yuklash
              </th>
              <th style="width: 90px;">
                Harakatlar
              </th>
             </tr>
            </thead>
            <tbody>
@foreach($sales as $sale)
<tr>
<td>
<div class="form-check font-size-16">
<input class="form-check-input" type="checkbox"/>
<label class="form-check-label"></label>
</div>
</td>

<td>{!! QrCode::size(80)->generate(
"Invoice: ".$sale->invoice_number.
" | Date: ".$sale->created_at.
" | Total: ".$sale->total_amount." so'm"
) !!}</td>
<td>
<a class="text-body fw-medium" href="#">
{{ $sale->invoice_number }}
</a>
</td>

<td>
{{ $sale->created_at->format('d.m.Y H:i') }}
</td>

<td>
{{ $sale->user->name ?? 'N/A' }}
</td>

<td>
{{ number_format($sale->total_amount ) }}
</td>

<td>
<div class="badge badge-soft-success font-size-12">
 @if($sale->status == 'paid')<span class="badge bg-success">To'langan</span> @elseif($sale->status == 'pending') <span class="badge bg-warning">Kutilmoqda</span>@elseif($sale->status == 'cancelled')  <span class="badge bg-danger">Bekor qilingan</span>@endif 
</div>
</td>

<td>
<button class="btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light" onclick="window.location.href='{{ route('sale.print', $sale->id) }}'">
<i class="bx bx-download label-icon"></i> Pdf
</button>
</td>

<td>
<div class="dropdown">
<button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" data-bs-toggle="dropdown">
<i class="bx bx-dots-horizontal-rounded"></i>
</button>

<ul class="dropdown-menu dropdown-menu-end">
<li>
<a class="dropdown-item" href="{{ route('sale.show', $sale->id) }}">Show</a>
</li>
<li>
<a class="dropdown-item" href="{{ route('sale.print', $sale->id) }}">Print</a>
</li>
@can("isAdmin")
<li>
<a class="dropdown-item" href="{{ route('sale.destroy', $sale->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $sale->id }}').submit();">Delete</a>
</li>
@endcan()
</ul>

</div>
</td>

</tr>
@endforeach
</tbody>
           </table>
          </div>
          {{ $sales->links() }}
          <!-- end table responsive -->
         </div>
         <!-- end card body -->
        </div>
        <!-- end card -->
       </div>
       <!-- end col -->
      </div>
      <!-- end row -->
     </div>
     <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
   @endsection