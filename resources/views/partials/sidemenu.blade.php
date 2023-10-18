<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <img src="" alt="Logo" width="60">
            <span class="menu-text fw-bolder fs-4 ms-2">Lamjaya</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if (request()->is('/')) active @endif">
            <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
            <li
                class="menu-item {{ Route::is('kecamatan.*') || Route::is('provinsi.*') || Route::is('kecamatan.*') || Route::is('pegawai.*') || Route::is('kelurahan.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-user-check"></i>
                    <div data-i18n="Layouts">Daerah</div>
                </a>

                <ul class="menu-sub">
                   
                      
                        <li class="menu-item {{ Route::is('kecamatan.*') ? 'active' : '' }}">
                            <a href="{{ route('kecamatan.index') }}" class="menu-link">
                                <div>Kecamatan</div>
                            </a>
                        </li>


                        <li class="menu-item {{ Route::is('provinsi.*') ? 'active' : '' }}">
                            <a href="{{ route('provinsi.index') }}" class="menu-link">
                                <div>provinsi</div>
                            </a>
                        </li>


                        <li class="menu-item {{ Route::is('kelurahan.*') ? 'active' : '' }}">
                            <a href="{{ route('kelurahan.index') }}" class="menu-link">
                                <div>kelurahan</div>
                            </a>
                        </li>


                        <li class="menu-item {{ Route::is('pegawai.*') ? 'active' : '' }}">
                            <a href="{{ route('pegawai.index') }}" class="menu-link">
                                <div>pegawai</div>
                            </a>
                        </li>
                        
                </ul>
            </li>
      

    </ul>
</aside>
<!-- / Menu -->
