@extends('layouts.dashboard.master')
@section('title')
{{ __('site.users') }}
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('site.list') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">All Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if (auth()->user()->hasPermission('users_create'))
                        <h3 class="card-title"><a class="btn btn-primary btn-sm" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> {{ __('site.create') }}</a></h3>
                        @else
                        <h3 class="card-title disabled"><a class="btn btn-primary btn-sm disabled " href="#"><i class="fa fa-plus"></i> {{ __('site.create') }}</a></h3>

                        @endif
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" value="{{ request()->search }}" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>firs_name</th>
                                    <th>Last_name</th>
                                    <th>Image</th>
                                    <th>email</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td> <img src="{{$user->image_path}}" style="width:100px" class="img-thumbnail"> </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('users_update'))

                                        <a class="btn btn-info btn-sm" href="{{ route('users.edit', $user) }}">
                                            <i class="fa fa-edit"></i> {{ __('site.edit') }}</a>
                                        @else

                                        <a class="btn btn-info btn-sm disabled" href="#">
                                            <i class="fa fa-edit"></i>
                                            {{ __('site.edit') }}</a>

                                        @endif

                                        @if (auth()->user()->hasPermission('users_delete'))

                                        <form style="display: inline-block" method="post" action="{{route('users.delete',$user)}}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> @lang('site.delete')
                                            </button>

                                        </form>
                                        @else
                                        <form style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm disabled">
                                                <i class="fa fa-trash"></i> @lang('site.delete')
                                            </button>

                                        </form>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->appends(request()->query())->links() }}

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->
@endsection
