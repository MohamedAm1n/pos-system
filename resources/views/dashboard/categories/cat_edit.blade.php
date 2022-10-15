@extends('layouts.dashboard.master')
@section('title')
{{ __('site.edit.cat') }}
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('site.edit.cat') }}</h1>
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
    <form action="{{ route('categories.update',$category) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-body card-responsive">
            <div class="form-group">
                <label for="cat_name">@lang('site.categories') </label>
                <input type="text" class="form-control" name="cat_name" required 
                value="{{ old('cat_name') }}" id="cat_name">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Edit Category</button>
            </div>
        </div>
    </form>
</div>

<!-- Main content -->
@endsection
