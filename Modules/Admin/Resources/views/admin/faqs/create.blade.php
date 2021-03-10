@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.faqs.index') }}">{{ __('admin::lang.faqs') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('admin::lang.create') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('admin::lang.create') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.faqs.store') }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@include('admin::admin.faqs.form')
	          <div class="card-footer">
              @can('view faqs')
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-secondary">
                  <i class="fa fa-arrow-left"></i>
                </a>
              @endcan
              <button class="btn btn-sm btn-success" type="submit">
                <i class="fa fa-save"></i>
              </button>
	          </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection
