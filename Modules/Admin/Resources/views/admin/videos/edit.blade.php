@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item"> <a href="{{ route('admin.videos.index') }}">{{ __('admin::lang.videos') }}</a></li>
      <li class="breadcrumb-item  active">{{ __('admin::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('admin::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.videos.update', $video->videos_id) }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
          	@include('admin::admin.videos.form')
	          <div class="card-footer">
              @can('view videos')
  	            <a href="{{ route('admin.videos.index') }}" class="btn btn-sm btn-secondary">
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
