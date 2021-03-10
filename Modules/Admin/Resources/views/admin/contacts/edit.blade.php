@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('admin::lang.connectWithUs') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.contacts.index') }}">{{ __('admin::lang.contacts') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('admin::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('admin::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.contacts.update', $contact->contacts_id) }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
          	@include('admin::admin.contacts.form')
	          <div class="card-footer">
              @can('view contacts')
  	            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-secondary">
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
