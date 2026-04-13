<!-- ========== Left Sidebar Start ========== -->
         <div class="vertical-menu">
            <div class="h-100" data-simplebar="">
               <!--- Sidemenu -->
               <div id="sidebar-menu">
                  <!-- Left Menu Start -->
                  <ul class="metismenu list-unstyled" id="side-menu">
                     <li class="menu-title" data-key="t-menu">
                        Menu
                     </li>
                     @cannot('isVisitor')
                     <li>
                        <a href="/">
                        <i data-feather="home">
                        </i>
                        <span data-key="t-dashboard">
                        Ma'lumotlar
                        </span>
                        </a>
                     </li>

                     @endcan
@cannot('isVisitor')
                     <li>
                        <a href="{{ route('medicine.index') }}">
                           <i data-feather="package"></i>
                           <span data-key="t-medicines">Medicinalar</span>
                        </a>
                     </li>

                     @endcan
                     @cannot('isVisitor')
                     <li>
                        <a href="{{ route('sale.index') }}">
                           <i data-feather="package"></i>
                           <span data-key="t-medicines">Sale</span>
                        </a>
                     </li>

                     @endcan 
                     @cannot('isVisitor')
                     <li>
                        <a href="{{ route('category.index') }}">
                           <i data-feather="grid"></i>
                           <span data-key="t-categories">Dori Kategoriyalari</span>
                        </a>
                     </li>
                     @endcan 
                           @cannot('isVisitor')
                       
                     <li>
                        <a href="{{ route('purchase.index') }}">
                           <i data-feather="shopping-cart"></i>
                           <span data-key="t-purchase-history">Ombor tarixi</span>
                        </a>
                     </li>
                     @endcan
                     @cannot('isVisitor')
                     <li>
                        <a href="{{ route('purchase_item.index') }}">
                           <i data-feather="layers"></i>
                           <span data-key="t-purchase-items">Omborga kelgan narsalar</span>
                        </a>
                     </li>
@endcan
                     @cannot('isVisitor')
                     <li>
                        <a href="{{ route('supplier.index') }}">
                           <i data-feather="truck"></i>
                           <span data-key="t-suppliers">Yetkazib beruvchilar</span>
                        </a>
                     </li>
@endcan
                     @can('isAdmin')
                     <li>
                        <a href="{{ route('users.table') }}">
                           <i data-feather="users"></i>
                           <span data-key="t-users">Sotuvchilar(Users)</span>
                        </a>
                     </li>
@endcan
                     @can('isAdmin')
                     <li>
                        <a href="#">
                           <i data-feather="file-text"></i>
                           <span data-key="t-documents">Hujjatlar</span>
                        </a>
                     </li>
@endcan
                     @can('isAdmin')
                     <li>
                        <a href="#">
                           <i data-feather="activity"></i>
                           <span data-key="t-logs">Loglar</span>
                        </a>
                     </li>
                     @endcan
                     
               </div>
               <!-- Sidebar -->
            </div>
         </div>
         <!-- Left Sidebar End -->