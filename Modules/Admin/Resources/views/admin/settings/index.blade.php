@extends('admin::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item  active">{{ __('admin::lang.settings') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.settings.index') }}">{{ __('admin::lang.general_data') }}</a>
      </li>
      <!-- <li class="breadcrumb-item  active">{{ __('admin::lang.show') }}</li> -->
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
                    <div class="col-12 col-md-4"><strong>{{ __('admin::lang.website_status') }}</strong></div>
                    <div class="col-12 col-md-8">
                      @if(getSettingByKey('website_status') == '1')
                        <strong class="text-success">
                          {{ __('admin::lang.active') }}
                        </strong>
                        
                      @else
                        <strong class="text-success">
                          {{ __('admin::lang.stopped') }}
                        </strong>
                      @endif
                      
                    </div>
                  </div>
                </li>

                <li class="list-group-item">
                  <div class="row">
                    <div class="col-12 col-md-4"><strong>{{ __('admin::lang.website_lang') }}</strong></div>
                    <div class="col-12 col-md-8">
                      <span class="text-primary">
                        {{ __('admin::lang.'. getSettingByKey('website_lang'))  }}
                      </span>
                    </div>
                  </div>
                </li>

  
            </ul>
          </div>
          <div class="card-footer">
            
            @can('update settings')
              <a href="{{ route('admin.settings.edit') }}" class="btn btn-sm btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
