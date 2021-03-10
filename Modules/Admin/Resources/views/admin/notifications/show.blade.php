@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.notifications.index') }}">{{ __('admin::lang.notifications') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('admin::lang.show') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ __('admin::lang.show') }}
          </div>
          <div class="card-body">
            
            <ul class="list-group">
            
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.id') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $notification->notifications_id }}</div>
                </div>
              </li>
            
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.desc') }}</strong></div>
                  <div class="col-12 col-md-10">{!! $notification->translate(old('activeLocale', $locale))->notifications_text !!}</div>
                </div>
              </li>
            
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.notifications_start') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $notification->notifications_start }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.notifications_end') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $notification->notifications_end }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view notifications')
              <a href="{{ route('admin.notifications.index') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update notifications')
              <a href="{{ route('admin.notifications.edit', [$notification->notifications_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-sm btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
