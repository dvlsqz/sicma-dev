<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{url('static/imagenes/Isotipo.png')}}" class="img-fluid">
        </div>

        <div class="user">
            <span class="subtitle"><b>Bienvenido:</b> {{ Auth::user()->name }} {{ Auth::user()->lastname }}</span> <br> 
            <span class="subtitle"><b>Rol:</b> {{ getRoleUserArray(null, Auth::user()->role) }}</span>
            <div class="salir">
                Salir
                <a href="{{url('/logout')}}" data-toogle="tooltrip" data-placement="top" title="Salir">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permissions, 'dashboard'))
                <li>
                    <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'product_list'))
                <li>
                    <a href="{{ url('/admin/products/home/0') }}" class="lk-products_index lk-product_list lk-product_add lk-product_edit lk-product_edit_stock lk-product_edit_stock lk-product_banned lk-product_delete lk-product_search lk-product_income lk-product_egress lk-product_record lk-suppliers lk-supplier_add lk-supplier_edit lk-supplier_delete"><i class="fas fa-database"></i> Inventario/Bodega</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'kardex_list'))
                <li>
                    <a href="{{ url('/admin/kardex/all') }}" class="lk-kardex_list lk-kardex_add lk-kardex_edit lk-kardex_edit_stock lk-kardex_banned lk-kardex_delete lk-kardex_search lk-kardex_income lk-kardex_egress lk-dabs lk-dabs_add lk-dabs_show"><i class="fa fa-server"></i> Kardex Transitorio</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'equipments_list'))
                <li>
                    <a href="{{ url('/admin/equipments/all') }}" class="lk-equipments_list lk-equipment_add lk-equipment_edit lk-equipment_file lk-equipment_parts lk-equipment_transfer"><i class="fas fa-industry"></i> Equipos</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'serviceg_list'))
                <li>
                    <a href="{{ url('/admin/services_g/all') }}" class="lk-serviceg_list lk-serviceg_add lk-serviceg_edit lk-service_list lk-service_add lk-service_edit lk-environment_list lk-environment_add lk-environment_edit"><i class="fa fa-object-group"></i> Servicios y Ambientes</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'units'))
                <li>
                    <a href="{{ url('admin/maintenance_areas') }}" class="lk-maintenance_areas lk-maintenance_area_add lk-maintenance_area_edit lk-maintenance_area_delete"><i class="fas fa-hard-hat"></i> Áreas de Mantenimiento</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'units'))
                <li>
                    <a href="{{ url('admin/units') }}" class="lk-units lk-unit_add lk-unit_edit lk-unit_delete"><i class="fas fa-hospital-user"></i> Unidades</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'bitacoras'))
                <li>
                    <a href="{{ url('/admin/bitacoras') }}" class="lk-bitacoras "><i class="fas fa-clipboard-list"></i> Bitacoras</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_list'))
                <li>
                    <a href="{{ url('/admin/users/all') }}" class="lk-user_add lk-user_list lk-user_edit lk-user_permissions lk-user_assignments"><i class="fas fa-user-lock"></i> Usuarios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_info'))
                <li>
                    <a href="{{ url('/admin/user/account/info') }}" class="lk-user_add lk-user_list lk-user_edit lk-user_permissions lk-user_assignments lk-user_info lk-user_change_password"><i class="fas fa-id-card"></i> Información de Cuenta</a>
                </li>
            @endif
        </ul>
    </div>

</div>
