@extends('admin::layouts.master')

@section('main') 
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item"> <a href="{{ route('admin.phones.index') }}">{{ __('admin::lang.phones') }}</a></li>
      <li class="breadcrumb-item  active">{{ __('admin::lang.comparisons') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('admin::lang.comparisons') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.phones.saveComparisons') }}" method="post" enctype="multipart/form-data">
          	@csrf
            <input type="hidden" name="phones_id" value="{{$phone->phones_id}}">
            @php
              $activeLocale = old('activeLocale', 'general');
              $activeLocale = 'general';
            @endphp
            <div class="card-body">
              @include('admin::layouts.includes.messages')
              <div class="row">
                <div class="col-lg-12">
                  
                   

                    {{-- Tabs Content --}}
                    <div class="tab-content" id="langsTabsContent">
                      <div class="tab-pane fade {{ $activeLocale == 'general' ? 'show active' : '' }}" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="row card-header">
                  
                            <label class="col-md-4 col-form-label"> <strong>{{ __('admin::lang.comparisons_title') }}</strong> </label>
                            <label class="col-md-4 col-form-label"> <strong> {{ __('admin::lang.phones_comparisons_text_ar') }}</strong></label>
                            <label class="col-md-4 col-form-label"> <strong>{{ __('admin::lang.phones_comparisons_text_en') }}</strong></label>

                        </div>
                        @foreach($comparisons as $comparison)
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group row">
                              <input type="hidden" name="comparisons_id[]" value="{{$comparison->comparisons_id}}">
                              <label class="col-md-4 col-form-label">{{ $comparison->comparisons_title }}<span class="text-danger"> *</span></label>
                              <div class="col-md-4">
                                
                                <textarea  class="form-control {{ $errors->first('phones_comparisons_text_ar') ? 'is-invalid' : '' }}"   name="phones_comparisons_text_ar[]" placeholder="{{ __('admin::lang.phones_comparisons_text_ar') }}"  rows="3">{{ old('phones_comparisons_text_ar[]', getPhoneComparison($phone->phones_id,$comparison->comparisons_id) ? getPhoneComparison($phone->phones_id,$comparison->comparisons_id)->translate('ar')->phones_comparisons_text : '') }}</textarea>
                                @if ($errors->first('phones_comparisons_text_ar'))
                                  <div class="invalid-feedback">{{ $errors->first('phones_comparisons_text_ar') }}</div>
                                @endif
                              </div>
                              <div class="col-md-4">
                              <textarea  class="form-control {{ $errors->first('phones_comparisons_text_en') ? 'is-invalid' : '' }}"   name="phones_comparisons_text_en[]" placeholder="{{ __('admin::lang.phones_comparisons_text_en') }}"  rows="3">{{ old('phones_comparisons_text_en[]', getPhoneComparison($phone->phones_id,$comparison->comparisons_id) ? getPhoneComparison($phone->phones_id,$comparison->comparisons_id)->translate('en')->phones_comparisons_text : '') }}</textarea>
                                  @if ($errors->first('phones_comparisons_text_en'))
                                    <div class="invalid-feedback">{{ $errors->first('phones_comparisons_text_en') }}</div>
                                  @endif
                              </div>
                            </div>

                          </div>
                        </div>
                        @endforeach
                      </div>
                      
                    </div>

                  
                </div>
              </div>
            </div>
            <div class="card-footer text-center">
            @can('view phones')
                <a href="{{ route('admin.phones.index') }}" class="btn btn-sm btn-secondary">
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
