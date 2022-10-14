    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 ">

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('dashboard/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">

                    <a href="#" class="d-block">{{ auth()->user()->first_name }}</a>

                    <a href="#" class="d-block">Welcome back</a>

                </div>
            </div>

            <div class="sidebar-menu" data-weight="tree">
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
                @if(auth()->user()->hasPermission('categories_read'))
                <li style="list-style-type:none">
                    <a href="{{ route('categories.index') }}"><i class="fa fa-th"></i>
                        <span>{{ __('site.categories') }}</span>
                    </a>
                </li>
                @endif
            </div>

        </div>
        <!-- /.sidebar -->
    </aside>
