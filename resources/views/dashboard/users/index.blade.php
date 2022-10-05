@extends('layouts.dashboard.master')
@section('title')
    {{ __('site.users') }}
@endsection
@section('content')
    <div class="row">

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{ __('site.create') }}</h4>

                    <p>{{ __('site.create.p') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('users.create') }}" class="small-box-footer">More<i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        {{-- <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h4>{{__('site.edit')}}</h4>

            <p>{{__('site.edit.p')}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-edit"></i>
          </div>
          <a href="#" class="small-box-footer">More<i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> --}}
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{ __('site.list') }}</h4>

                    <p>{{ __('site.list.p') }} </p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>

                <a href="{{ route('users.list') }}" class="small-box-footer">More <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        {{-- <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h4>{{__('site.delete')}}</h4>

          <p>{{__('site.delete.p')}}</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> --}}
        <!-- ./col -->
    </div>
@endsection
