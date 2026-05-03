
<div class="vertical-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
 
                <li class="menu-title">Ana Menyu</li>
 
                {{-- Dashboard --}}
                
                <li>
                    <a href="{{ route('index') }}">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
       
 
                {{-- Medicines --}}
                
                <li>
                    <a href="{{ route('medicine.index') }}">
                        <i data-feather="package"></i>
                        <span>Medicinalar</span>
                    </a>
                </li>
             
 
                {{-- Sales --}}
                
                <li>
                    <a href="{{ route('sale.index') }}">
                        <i data-feather="shopping-bag"></i>
                        <span>Savdolar</span>
                    </a>
                </li>
             
 
                {{-- Categories --}}
                
                <li>
                    <a href="{{ route('category.index') }}">
                        <i data-feather="grid"></i>
                        <span>Kategoriyalar</span>
                    </a>
                </li>
             
 
                <li class="menu-divider"></li>
                <li class="menu-title">Ombor</li>
 
                {{-- Purchase history --}}
                
                <li>
                    <a href="{{ route('purchase.index') }}">
                        <i data-feather="shopping-cart"></i>
                        <span>Ombor tarixi</span>
                    </a>
                </li>
             
 
                {{-- Purchase items --}}
                
                <li>
                    <a href="{{ route('purchase_item.index') }}">
                        <i data-feather="layers"></i>
                        <span>Kelgan mahsulotlar</span>
                    </a>
                </li>
             
 
                {{-- Suppliers --}}
                
                <li>
                    <a href="{{ route('supplier.index') }}">
                        <i data-feather="truck"></i>
                        <span>Yetkazib beruvchilar</span>
                    </a>
                </li>
             
 
                {{-- Admin-only section --}}
                @can('isAdmin')
                <li class="menu-divider"></li>
                <li class="menu-title">Boshqaruv</li>
 
                <li>
                    <a href="{{ route('users.table') }}">
                        <i data-feather="users"></i>
                        <span>Sotuvchilar</span>
                    </a>
                </li>
 
                
 
                <li>
                    <a href="{{ route('logs.index') }}">
                        <i data-feather="activity"></i>
                        <span>Loglar</span>
                    </a>
                </li>
                @endcan
 
            </ul>
        </div>
            </div>
         </div>
         <!-- Left Sidebar End -->