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
                  <div class="col-12 col-md-10">{{ $contact->contacts_id }}</div>
                </div>
              </li>
            
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.address') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contact->translate(old('activeLocale', $locale))->contacts_address }}</div>
                </div>
              </li>
            
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.facebook') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contact->contacts_facebook }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.twitter') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contact->contacts_twitter }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.instagram') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contact->contacts_instagram }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.snapchat') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contact->contacts_snapchat }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.whatsapp') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contact->contacts_whatsapp }}</div>
                </div>
              </li>
             
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('admin::lang.desc') }}</strong></div>
                  <div class="col-12 col-md-10">{!!  $contact->translate(old('activeLocale', $locale))->contacts_text !!}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view contactus')
              <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update contactus')
              <a href="{{ route('admin.contacts.edit', [$contact->contacts_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-sm btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
