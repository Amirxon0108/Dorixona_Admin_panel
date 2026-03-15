@extends('admin.layouts.app')
@section('title', 'Xarid ma\'lumotlari')

@section('content')



   <!-- Left Sidebar End -->
   <!-- ============================================================== -->
   <!-- Start right Content here -->
   <!-- ============================================================== -->
   
     <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
       <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">
          Invoice Detail
         </h4>
         <div class="page-title-right">
          <ol class="breadcrumb m-0">
           <li class="breadcrumb-item">
            <a href="javascript: void(0);">
             Invoices
            </a>
           </li>
           <li class="breadcrumb-item active">
            Invoice Detail
           </li>
          </ol>
         </div>
        </div>
       </div>
      </div>
      <!-- end page title -->
      <div class="row">
       <div class="col-lg-12">
        <div class="card">
         <div class="card-body">
          <div class="invoice-title">
           <div class="d-flex align-items-start">
            <div class="flex-grow-1">
             <div class="mb-4">
              <img alt="" height="24" src="{{ asset('assets/images/logo-sm.svg')}}"/>
              <span class="logo-txt">
              AmirDev
              </span>
             </div>
            </div>
            <div class="flex-shrink-0">
             <div class="mb-4">
              <h4 class="float-end font-size-16">
               Invoice {{ $sale->invoice_number }}
              </h4>
             </div>
            </div>
           </div>
           <p class="mb-1">
            Uzbekistan, Tashkent
           </p>
           <p class="mb-1">
            <i class="mdi mdi-email align-middle me-1">
            </i>
           amirxonmatchanov07@gmail.com
           </p>
           <p>
            <i class="mdi mdi-phone align-middle me-1">
            </i>
            +998 94 768 70 08
           </p>
          </div>
          <hr class="my-4"/>
          <div class="row">
           <div class="col-sm-6">
            <div>
             <h5 class="font-size-15 mb-2">
              Sotuvchi: 
             </h5>
            <h5 class="font-size-14 mb-">
              {{ $sale->user->name ?? 'N/A' }}
             </h5>
            <div class="mt-4">
              <h5 class="font-size-15">
               To'lov holati:
              </h5>
              <p class="mb-1">  
               @if(  ucfirst($sale->status) == 'Paid') <span class="badge bg-success">To'langan</span> @elseif(ucfirst($sale->status) == 'Pending') <span class="badge bg-warning">Kutilmoqda</span>@elseif(ucfirst($sale->status) == 'Cancelled')  <span class="badge bg-danger">Bekor qilingan</span>@endif
              </p>
              
             </div>
            </div>
           </div>
           <div class="col-sm-6">
            <div>
             <div>
              <h5 class="font-size-15">
              Sana:
              </h5>
              <p>
               {{ $sale->created_at->format('d M Y H:i') }}
              </p>
             </div>
             <div class="mt-4">
              <h5 class="font-size-15">
               To'lov Usuli:
              </h5>
              <p class="mb-1">
               @if(  ucfirst($sale->payment_method) == 'Cash') <span class="badge bg-primary">Naqd</span> @elseif(ucfirst($sale->payment_method) == 'Card') <span class="badge bg-success">Karta</span> @elseif(ucfirst($sale->payment_method) == 'Transfer')  <span class="badge bg-success">Tansfer</span> 
    @endif
              </p>
              </div>
              
            </div>
           </div>
          </div>
          <div class="py-2 mt-3">
           <h5 class="font-size-15">
            Harid qilingan dorilar:
           </h5>
          </div>
          <div class="p-4 border rounded">
           <div class="table-responsive">
            <table class="table table-nowrap align-middle mb-0">
             <thead>
              <tr>
               <th style="width: 70px;">
                No.
               </th>
               <th>
                Item
               </th>
               <th>
                Item Price
               </th>
               <th>
                Quantity
               </th>
               <th class="text-end" style="width: 120px;">
                Price
               </th>
              </tr>
             </thead>
             <tbody>
                @foreach($sale->items as $index => $item)
              <tr>
               <th scope="row">
                {{ $index+1 }}
               </th>
               <td>
                <h5 class="font-size-15 mb-1">
                {{ $item->medicine->name ?? 'Deleted medicine' }}
                <p class="font-size-13 text-muted mb-0">
                {{ $item->medicine->category->name ?? 'Deleted category' }}
                </p>
                </h5>
                </td>
                <td>
                <p class="font-size-13 text-muted mb-0">
                {{ number_format($item->unit_price,2) }}
                </p>
                </td>
                <td>
                <p class="font-size-13 text-muted mb-0">
                {{ $item->quantity}}
                </p>
               </td>
               <td class="text-end">
                {{ number_format($item->unit_price * $item->quantity,2)  }} som
               </td>
              </tr>
              @endforeach
              <tr>
               <th class="border-0 text-end" colspan="2" scope="row">
                Tax QQS 12%
               </th>
               <td class="border-0 text-end">
                {{ number_format($sale->total_amount/100*12) }}
               </td>
              </tr>
              <tr>
               <th class="border-0 text-end" colspan="2" scope="row">
                Sub Total
               </th>
               <td class="border-0 text-end">
                {{ number_format($sale->sub_total, 2) }} som
               </td>
              </tr>
              <tr>
               <th class="border-0 text-end" colspan="2" scope="row">
                Discount
               </th>
               <td class="border-0 text-end">
                {{ number_format($sale->discount, 2) }} som
               </td>
              </tr>
              <tr>
               <th class="border-0 text-end" colspan="2" scope="row">
                Total
               </th>
               <td class="border-0 text-end">
                <h4 class="m-0">
                 {{ number_format($sale->total_amount + $sale->total_amount/100*12) }} som
                </h4>
               </td>
              </tr>
             
            </tbody>
            </table>
           </div>
          </div>
          <div class="d-print-none mt-3">
           <div class="float-end">
            <a class="btn btn-success waves-effect waves-light me-1" href="javascript:window.print()">
             <i class="fa fa-print">
             </i>
            </a>
            <a class="btn btn-primary w-md waves-effect waves-light" href="#">
             Send
            </a>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <!-- end row -->
     </div>
     <!-- container-fluid -->
    </div>
  
@endsection