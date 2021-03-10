@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.faqs.index') }}">{{ __('admin::lang.faqs') }}</a>
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
                  <div class="col-12 col-md-10">{{ $faq->faqs_id }}</div>
                </div>
              </li>
            
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.title') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $faq->translate(old('activeLocale', $locale))->faqs_title }}</div>
                </div>
              </li>
            
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.desc') }}</strong></div>
                  <div class="col-12 col-md-10">{!!  $faq->translate(old('activeLocale', $locale))->faqs_desc  !!}</div>
                </div>
              </li>
            
            
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $faq->faqs_position }}</div>
                </div>
              </li>
             
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('admin::lang.status_'. $faq->faqs_status) }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view faqs')
              <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update faqs')
              <a href="{{ route('admin.faqs.edit', [$faq->faqs_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-sm btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
