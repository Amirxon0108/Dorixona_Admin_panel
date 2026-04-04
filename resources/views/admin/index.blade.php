@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')

               <div class="container-fluid">
                  <!-- start page title -->
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">
                              Dashboard
                           </h4>
                           <div class="page-title-right">
                              <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">
                                    Dashboard
                                    </a>
                                 </li>
                                 <li class="breadcrumb-item active">
                                    Dashboard
                                 </li>
                              </ol>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end page title -->
                  <div class="row">
                     <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-secondary small fw-bold mb-1">Bugungi Savdo</p>
                        <h3 class="mb-0 fw-bold">{{ number_format($dailySales, 0, '.', ' ') }} so'm</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-shopping-cart text-primary fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
               <div class="d-flex justify-content-between align-items-center">
                     <div>
                        <p class="text-uppercase text-secondary small fw-bold mb-1">Bugungi Balans</p>
                        <h3 class="mb-0 fw-bold {{ $dailyprofit >= 0 ? 'text-success' : 'text-danger' }}">
                           {{ number_format($dailyprofit, 0, '.', ' ') }} so'm
                        </h3>
                     </div>
                     <div class="p-3 rounded-circle {{ $dailyprofit >= 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10">
                        <i class="fas {{ $dailyprofit >= 0 ? 'fa-chart-line' : 'fa-chart-pie' }} {{ $dailyprofit >= 0 ? 'text-success' : 'text-danger' }} fa-lg"></i>
                     </div>
               </div>
            </div>
         </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-secondary small fw-bold mb-1">Haftalik O'sish</p>
                        <h4 class="mb-0 fw-bold">
                            @if($weeklyChange > 0)
                                <span class="text-success"><i class="fas fa-arrow-up"></i> {{ number_format($weeklyChange, 1) }}%</span>
                            @elseif($weeklyChange < 0)
                                <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ number_format(abs($weeklyChange), 1) }}%</span>
                            @else
                                <span class="text-muted">0%</span>
                            @endif
                        </h4>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-calendar-week text-warning fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-secondary small fw-bold mb-1">Oylik Jami Savdo</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ number_format($monthlySales, 0, '.', ' ') }} so'm</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-wallet text-info fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold">Savdolar Taqqoslovi</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless">
                            <thead class="text-secondary small text-uppercase">
                                <tr>
                                    <th>Davr</th>
                                    <th>Savdo Summasi</th>
                                    <th>Holat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-medium">Shu hafta</td>
                                    <td class="fw-bold">{{ number_format($currentWeekSales, 0, '.', ' ') }} so'm</td>
                                    <td><span class="badge bg-light text-primary rounded-pill px-3">Joriy</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">O'tgan hafta</td>
                                    <td class="fw-bold">{{ number_format($lastWeekSales, 0, '.', ' ') }} so'm</td>
                                    <td><span class="badge bg-light text-secondary rounded-pill px-3">Yopilgan</span></td>
                                </tr>
                                <tr class="border-top">
                                    <td class="fw-medium">Shu oy</td>
                                    <td class="fw-bold">{{ number_format($currentMonthSales, 0, '.', ' ') }} so'm</td>
                                    <td><span class="badge bg-soft-info text-info rounded-pill px-3">Davom etmoqda</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">O'tgan oy</td>
                                    <td class="fw-bold">{{ number_format($lastMonthSales, 0, '.', ' ') }} so'm</td>
                                    <td><span class="badge bg-light text-secondary rounded-pill px-3">Yopilgan</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-dark text-white h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-bold mb-4">Oylik Xulosa</h5>
                        <div class="mb-3">
                            <small class="text-light opacity-75">Jami Xaridlar:</small>
                            <h4 class="fw-bold text-danger">- {{ number_format($monthlyPurchases, 0, '.', ' ') }} so'm</h4>
                        </div>
                        <div class="mb-3">
    <small class="text-light opacity-75">oylik foyda:</small>
    <h2 class="fw-bold {{ $monthlyprofit >= 0 ? 'text-success' : 'text-danger' }}">
        {{ $monthlyprofit > 0 ? '+' : '' }} {{ number_format($monthlyprofit, 0, '.', ' ') }} so'm
    </h2>
</div>
                                    
                    <div class="mt-4">
                        <button class="btn btn-primary w-100 rounded-3 py-2 fw-bold">Batafsil Hisobot <i class="fas fa-chevron-right ms-2 small"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
                   
                 
                  
                  <!-- end row -->
               </div>
               <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script> document.write(new Date().getFullYear())</script> © StarCode Kh.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block"> Design &amp; Custom by
                                <a class="text-decoration-underline" href="https://www.admintem.com/" target="_blank">admintem.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
         </div>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
         <!-- end main content-->
      </div>
      <!-- END layout-wrapper -->
    @endsection