@include('layouts.dashboard.head')
@include('layouts.dashboard.nav')
@include('layouts.dashboard.main_sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
    <!-- /.content -->
    </div>
<!-- /.content-wrapper -->
@include('layouts.dashboard.footer')
