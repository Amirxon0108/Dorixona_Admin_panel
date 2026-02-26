@extends('admin.layouts.app')
@section('title', 'purchase_items')

@section('content')


<div class="container-fluid">
      <!-- start page title -->
      <div class="row">
       <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">
          DataTables
         </h4>
         <div class="page-title-right">
          <ol class="breadcrumb m-0">
           <li class="breadcrumb-item">
            <a href="javascript: void(0);">
             Tables
            </a>
           </li>
           <li class="breadcrumb-item active">
            DataTables
           </li>
          </ol>
         </div>
        </div>
       </div>
      </div>
      <!-- end page title -->
      <div class="row">
       <div class="col-12">
        <div class="card">
         <div class="card-header">
          <h4 class="card-title">
           Default Datatable
          </h4>
          <p class="card-title-desc">
            <a href="{{ route('purchase_item.create') }}">Yangi qo'shish</a>           
          </p>
         </div>
         <div class="card-body">
          <table class="table table-bordered dt-responsive nowrap w-100" id="datatable">
           <thead>
            <tr>
            
             <th>
              Purchase No
             </th>
             <th>
             Medicine
             </th>
             
              <th>
             Soni 
             </th>
             <th>
            
            Yaroqlilik muddati
             </th>
            <th>
             Kelgan narxi
             </th>
             <th>
             description
             </th>
             <th>
             Seriya raqami
             </th>
             <th>
             Action
             </th>
             
            
            </tr>
           </thead>
           <tbody>
            @foreach ($purchase_items as $purchase_item)
            <tr>
             <td>
              {{ $purchase_item->purchase->purchase_no ?? 'Noma\'lum' }}
             </td>
            
             <td>
             {{ $purchase_item->medicine->name ?? 'Noma\'lum' }}
             </td>
             <td>
              {{ $purchase_item->quantity }}
             </td>
             <td>
              {{ $purchase_item->expiry_date }}
             </td>
             <td>
              {{ $purchase_item->unit_price }}
             </td>
             <td>
              {{ $purchase_item->description }}
             </td>
             <td>
              {{ $purchase_item->batch_no }}
             </td>
             
             <td>
                <a href="{{ route('purchase_item.edit', $purchase_item->id) }}">edit</a> <br>
            <a href="{{ route('purchase_item.show', $purchase_item->id) }}">ko'rish</a>

            <form action="{{ route('purchase_item.destroy', $purchase_item->id) }}"  method ="POST">
              @csrf
              @method('DELETE').
              <input type="submit" value="ochir">
            </form>
             </td>
             @endforeach
            </tr>
            
            
            
           </tbody>
          </table>
         </div>
        </div>
       </div>
       <!-- end col -->
      </div>
      <!-- end row -->
       
     </div>
@endsection