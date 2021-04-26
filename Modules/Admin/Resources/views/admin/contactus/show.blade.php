@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('admin::lang.connectWithUs') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.contactus.index') }}">{{ __('admin::lang.contactus') }}</a>
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
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_name }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.phone') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_phone }}</div>
                </div>
              </li>
               <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.email') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_email }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.message') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_message }}</div>
                </div>
              </li>
             
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">
                      @if ($contactus->contact_us_status == '0')
                        <span class="p-2 badge badge-warning">{{ __('admin::lang.new') }}</span>
                      @else
                        <span class="p-2 badge badge-secondary">{{ __('admin::lang.done') }}</span>
                      @endif
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            @can('view contactus')
              <a href="{{ route('admin.contactus.index') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
