@extends('layouts.dashboard.master')
@section('title')
{{ __('site.create') }}
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('site.create') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('site.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item "><a href="{{ route('users.index') }}">{{ __('site.users') }}</a>
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card card-primary card-responsive">

    <!-- /.card-header -->
    @include('partials._errors')
    <!-- form start -->
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body card-responsive">
            <div class="form-group">
                <label for="first_name">@lang('site.first_name') </label>
                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" id="first_name" placeholder="@lang('site.first_name')">
            </div>
            <div class="form-group">
                <label for="last_name">@lang('site.last_name') </label>
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" id="last_name" placeholder="@lang('site.last_name')">
            </div>
            <div class="form-group">
                <label for="image">@lang('site.image') </label>
                <input type="file" class="form-control image"  name="image" placeholder="@lang('site.image')">

                <img src="{{ asset('uploads/user_images/default.png') }}" style="width:100px; height:100px;" class="img-thumbnail image-preview">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">@lang('site.email') </label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="exampleInputEmail1" autocomplete="false" placeholder="@lang('site.email')">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword1">@lang('site.password')</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="@lang('site.password')">
            </div>
            <div class="form-group">
                <label for="password_confirmation">@lang('site.password_confirmation')</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="@lang('site.password_confirmation')">
            </div>
            <!-- /.card-body -->
            <div class="form-group">
                <!-- END ALERTS AND CALLOUTS -->
                <h5 class="mt-4 mb-2">Select Permissions</h5>

                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        @php
                        $models=['users','profile','categories','products'];
                        @endphp
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">Tabs</h3>
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach ($models as $index=>$model)

                                    <li class="nav-item {{ $index==0 ? 'active' : ''}}"><a class="nav-link " href="#{{ $model }}" data-toggle="tab">{{ $model }}</a></li>
                                    @endforeach

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach ($models as $index=>$model)

                                    <div class="tab-pane {{ $index = 0 ? 'active' : '' }}" id="{{ $model }}">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="permissions[]" type="checkbox" id="customCheckbox1{{ $model }}" value="{{ $model }}_create">
                                            <label for="customCheckbox1{{ $model }}" class="custom-control-label">Create {{ $model }}</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="permissions[]" type="checkbox" id="customCheckbox2{{ $model }}" value="{{ $model }}_read">
                                            <label for="customCheckbox2{{ $model }}" class="custom-control-label">Read {{ $model }}</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="permissions[]" type="checkbox" id="customCheckbox3{{ $model }}" value="{{ $model }}_update">
                                            <label for="customCheckbox3{{ $model }}" class="custom-control-label">Update {{ $model }}</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="permissions[]" type="checkbox" id="customCheckbox4{{ $model }}" value="{{ $model }}_delete">
                                            <label for="customCheckbox4{{ $model }}" class="custom-control-label">Delete {{ $model }}</label>
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- ./card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>

<!-- Main content -->
@endsection
