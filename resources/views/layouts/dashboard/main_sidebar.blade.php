    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
        <img src="{{asset('dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar" >
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('dashboard/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->first_name }}</a>
        </div>
        </div>

        <div class="sidebar-menu" data-weight="tree" >
            <li style="list-style-type:none">
                <a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i>
                    <span>{{ __('site.dashboard') }}</span>
                </a>
            </li>
            @if(auth()->user()->hasPermission('users_read'))

            <li style="list-style-type:none">
                <a href="{{ route('users.index') }}"><i class="fa fa-th"></i>
                    <span>{{ __('site.users') }}</span>
                </a>
            </li>
            @endif

        </div>

    </div>
    <!-- /.sidebar -->
    </aside>
