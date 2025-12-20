@php
    use App\Models\Permission;
    use App\Models\UserPermission;
    use Illuminate\Support\Facades\Auth;

    $loggedInUser = Auth::user();
    $isSuperAdmin = $loggedInUser->role_id == 1 ? 1 : 0;

    $rolePermissions = Permission::where('role_id', $loggedInUser->role_id)
                        ->pluck('module')
                        ->toArray();

    $userPermissions = UserPermission::where('user_id', $loggedInUser->id)
                          ->pluck('module')
                          ->toArray();

    $permissions = array_unique(array_merge($rolePermissions, $userPermissions));
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <div class="mdi mdi-close close-menu "></div>
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img src="{{ asset('assets/img/branding/main-logo.png') }}" height="130" width="250" alt="">
        </a>
    </div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ in_array(Route::current()->getName(), ['dashboard']) ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        
        @if(in_array('Role', $permissions) || $isSuperAdmin)
        <li class="menu-item {{ in_array(Route::current()->getName(), ['role.index']) ? 'active' : '' }}">
            <a href="{{ route('role.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Role">Role</div>
            </a>
        </li>
        @endif

        @if(in_array('User', $permissions) || $isSuperAdmin)
        <li class="menu-item {{ in_array(Route::current()->getName(), ['user.index']) ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="User">User</div>
            </a>
        </li>
        @endif
        <li class="menu-item">
            <a href="{{ route('logout') }}" class="menu-link"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons mdi mdi-logout"></i>
                <div data-i18n="Logout">Logout</div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</aside>