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
      <li class="breadcrumb-item  active">{{ __('admin::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('admin::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.settings.update') }}" method="post">
          	@csrf
          	

            
              <div class="card-body">
                @include('admin::layouts.includes.messages')

                <div class="row">
                  <div class="col-lg-9">

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="website_lang">{{ __('admin::lang.website_lang') }}</label>
                      <div class="col-md-9">

                        <select name="website_lang" id="website_lang" class="form-control w-25">
                          
                          <option value="ar" {{ getSettingByKey('website_lang') == 'ar' ? 'selected' : ''  }}>
                            {{ __('admin::lang.ar') }}
                          </option>

                          <option value="en" {{ getSettingByKey('website_lang') == 'en' ? 'selected' : ''  }}>
                            {{ __('admin::lang.en') }}
                          </option>

                        </select>

                      </div>
                    </div>

                   
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">{{ __('admin::lang.website_status') }}</label>
                      <div class="col-md-9 col-form-label">
                        @php
                          $status = getSettingByKey('website_status');
                        @endphp
                        
                        <div class="form-check form-check-inline mr-1">
                          <input 
                            class="form-check-input" id="active" type="radio" 
                            value="1" name="website_status" {{ $status == '1' ? 'checked' : '' }}>
                          <label class="form-check-label" for="active">{{ __('admin::lang.active') }}</label>
                        </div>
                        
                        <div class="form-check form-check-inline mr-1">
                          <input class="form-check-input" id="stopped" type="radio" value="0" name="website_status" {{ $status == 0 ? 'checked' : '' }}>
                          <label class="form-check-label" for="stopped">{{ __('admin::lang.stopped') }}</label>
                        </div>

                      </div>
                    </div>
                    
    
                  </div>
                </div>
              </div>



	          <div class="card-footer">
              @can('view settings')
                <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-secondary">
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
@section('style')
<style>
.select2-container {
    width: 25% !important;
}
.select2-container .select2-selection--single {
    height:  100% !important;
}
}
</style>
@endsection
 