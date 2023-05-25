<div class="flex sidebar">

    <div class="w-full flex justify-start ">
        {{-- Sidebar Title --}}
        <div class="mx-auto">
            Sistema<strong>POS</strong>
        </div>  
    </div>

    {{-- LINKS --}}
    {{-- use Alpine to hide titles and expand icons when side bar collapse or expand --}}
    <div class="flex mt-2">
        <div class="">
            <ul class="w-full">
                {{-- Companies --}}
                <li>
                    <a href="{{ route('admin.companies.index') }}" >
                        <i class="fas fa-info-circle"></i>
                            <div>Empresa</div>
                    </a>
                </li> 
                {{-- Branch Offices --}}
                <li class=" border-b border-sky-800">
                    <a href="{{ route('admin.branchoffices.index') }}" >
                        <i class="fas fa-store-alt" ></i>
                        <div>Sucursales</div> 
                    </a>
                </li>
                {{-- Users --}} 
                <li>
                    <a href="{{ route('admin.users.index') }}" >
                        <i class="fas fa-fw fa-user-check"  ></i>
                        <div>Usuarios</div>
                    </a>
                </li>
                {{-- Roles --}}
                <li>
                    <a href="{{ route('admin.roles.index') }}" >
                        <i class="far fa-check-square"></i>
                        <div>Permisos</div>
                    </a>
                </li>
                {{-- Clients --}}
                <li>
                    <a href="{{ route('admin.clients.index') }}" >
                        <i class="fas fa-fw fa-users" ></i>
                        <div>Clientes</div> 
                    </a>
                </li>
                {{-- Providers --}}
                <li>
                    <a href="{{ route('admin.providers.index') }}" >
                        <i class="fas fa-box-open" ></i>
                        <div>Proveedores</div> 
                    </a>
                </li>
                {{-- Brands --}}
                <li>
                    <a href="{{ route('admin.brands.index') }}" >
                        <i class="fas fa-copyright"></i>
                        <div>Marcas</div> 
                    </a>
                </li>
                {{-- Categories --}}
                <li>
                    <a href="{{ route('admin.categories.index') }}" >
                        <i class="fas fa-th-large"></i>
                        <div>Categorías</div> 
                    </a>
                </li>
                {{-- Products --}}
                <li>
                    <a href="{{ route('admin.products.index') }}" >
                        <i class="fa fa-bars" ></i>
                        <div>Productos</div> 
                    </a>
                </li>
                {{-- Cash Registers --}}
                <li>  
                    <a href="{{ route('admin.cash-registers.index') }}" >
                        <i class="fas fa-cash-register"></i>
                        <div>Cajas</div> 
                    </a>
                </li>
                {{-- Cashouts --}}
                <li>  
                    <a href="{{ route('admin.cashouts.index') }}" >
                        <i class="fas fa-cash-register"></i>
                        <div>Cortes de Caja</div> 
                    </a>
                </li>
                {{-- POS --}}
                <li>
                    <a href="{{ route('admin.pos') }}" >
                        <i class="fas fa-shopping-cart"></i>
                        <div>POS</div>
                    </a>
                </li>
                {{-- Sales --}}
                <li>  
                    <a href="{{ route('admin.sales.index') }}" >
                        <i class="fas fa-hand-holding-usd"></i>
                        <div>Ventas</div> 
                    </a>
                </li>
            </ul>
        </div>
        
    </div>
</div>