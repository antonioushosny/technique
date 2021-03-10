@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('admin::lang.aboutProject') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.metatags.index') }}">{{ __('admin::lang.metatags') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('admin::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('admin::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.metatags.update', $metatag->metatags_id) }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
          	@include('admin::admin.metatags.form')
	          <div class="card-footer">
              @can('view metatags')
  	            <a href="{{ route('admin.metatags.index') }}" class="btn btn-sm btn-secondary">
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
