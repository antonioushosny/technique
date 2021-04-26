@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item"> <a href="{{ route('admin.videos.index') }}">{{ __('admin::lang.videos') }}</a></li>
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
                  <div class="col-12 col-md-10">{{ $video->videos_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $video->videos_title }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.video') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <iframe src="{{ $video->videos_url}}" frameborder="0"></iframe>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('admin::lang.'. $video->videos_status) }}</div>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            @can('view videos')
              <a href="{{ route('admin.videos.index') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update videos')
              <a href="{{ route('admin.videos.edit', $video->videos_id) }}" class="btn btn-sm btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
