
@php
  $activeLocale = old('activeLocale', 'general');
  $activeLocale = 'general';
@endphp
<div class="card-body">
	@include('admin::layouts.includes.messages')
  <div class="row">
    <div class="col-lg-9">
      
         {{-- Tabs --}}
        <ul class="nav nav-tabs" id="langsTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link {{ $activeLocale == 'general' ? 'active' : '' }}" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">
            {{ __('admin::lang.general') }}</a>
          </li>
          @foreach ($langs as $lang)
            <li class="nav-item">
              <a class="nav-link {{ $activeLocale == $lang->locale ? 'active' : '' }}" id="{{ $lang->locale }}-tab" data-toggle="tab" href="#{{ $lang->locale }}"
                role="tab" aria-controls="{{ $lang->locale }}" aria-selected="false">
                {{ __('admin::lang.'. $lang->locale) }}
              </a>
            </li>
          @endforeach
        </ul>

        {{-- Tabs Content --}}
        <div class="tab-content" id="langsTabsContent">
          <div class="tab-pane fade {{ $activeLocale == 'general' ? 'show active' : '' }}" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="row">
              <div class="col-lg-9">
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="advertisements_name">{{ __('admin::lang.name') }}<span class="text-danger"> *</span></label>
                  <div class="col-md-9">
                    <input class="form-control {{ $errors->first('advertisements_name') ? 'is-invalid' : '' }}" id="advertisements_name" type="text" name="advertisements_name" placeholder="{{ __('admin::lang.name') }}"
                     value="{{ old('advertisements_name', isset($advertisement) ? $advertisement->advertisements_name : '') }}">
                    @if ($errors->first('advertisements_name'))
                      <div class="invalid-feedback">{{ $errors->first('advertisements_name') }}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="advertisements_url">{{ __('admin::lang.link') }}<span class="text-danger">  </span></label>
                  <div class="col-md-9">
                    <input class="form-control {{ $errors->first('advertisements_url') ? 'is-invalid' : '' }}" id="advertisements_url" type="text" name="advertisements_url" placeholder="{{ __('admin::lang.link') }}"
                     value="{{ old('advertisements_url', isset($advertisement) ? $advertisement->advertisements_url : '') }}">
                    @if ($errors->first('advertisements_url'))
                      <div class="invalid-feedback">{{ $errors->first('advertisements_url') }}</div>
                    @endif
                  </div>
                </div>
               
 
                <div class="form-group row" id="advertisements_color_div">
                  <label class="col-md-3 col-form-label" for="advertisements_color">{{ __('admin::lang.advertisements_color') }}<span class="text-danger"> *</span></label>
                  <div class="col-md-9">
                     <input class="form-control {{ $errors->first('advertisements_color') ? 'is-invalid' : '' }}" id="advertisements_color" type="color" name="advertisements_color" placeholder="{{ __('admin::lang.advertisements_color') }}"
                     value="{{ old('advertisements_color', isset($advertisement) ? $advertisement->advertisements_color : '') }}">
                    @if ($errors->first('advertisements_color'))
                      <div class="invalid-feedback">{{ $errors->first('advertisements_color') }}</div>
                    @endif
                  </div>
                </div>

            

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">{{ __('admin::lang.status') }}<span class="text-danger"> *</span></label>
                  <div class="col-md-9 col-form-label">
                    @php
                      $status = old('advertisements_status', isset($advertisement) ? $advertisement->advertisements_status : 1);
                    @endphp
                    <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" id="active" type="radio" value="1" name="advertisements_status" {{ $status == 1 ? 'checked' : '' }}>
                      <label class="form-check-label" for="active">{{ __('admin::lang.active') }}</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" id="stopped" type="radio" value="0" name="advertisements_status" {{ $status == 0 ? 'checked' : '' }}>
                      <label class="form-check-label" for="stopped">{{ __('admin::lang.stopped') }}</label>
                    </div>
                    @if ($errors->first('advertisements_status'))
                      <div class="invalid-feedback">{{ $errors->first('advertisements_status') }}</div>
                    @endif
                  </div>
                </div>

              </div>
            </div>
          </div>
          {{-- Languages Tabs --}}
          @foreach ($langs as $lang)
            <div class="tab-pane fade {{ $activeLocale == $lang->locale ? 'show active' : '' }}" id="{{ $lang->locale }}" role="tabpanel" aria-labelledby="{{ $lang->locale }}-tab">

              <div class="row">

                <div class="col-lg-9">

                  <div class="form-group row d-none"  id="{{ $lang->locale }}-advertisements_text_div" >
                    <label class="col-md-3 col-form-label" for="advertisements_text">{{ __('admin::lang.advertisements_text') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9">
                      <textarea class="form-control {{ $errors->first($lang->locale .'.advertisements_text') ? 'is-invalid' : '' }} " rows="5" name="{{ $lang->locale .'[advertisements_text]' }}" id="{{ $lang->locale .'[advertisements_text]' }}" placeholder="" >{{old('advertisements_text',  isset($advertisement) ? $advertisement->translate($lang->locale)->advertisements_text : '')}}</textarea>

                      @if ($errors->first($lang->locale .'.advertisements_text'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.advertisements_text') }}</div>
                      @endif
                    </div>
                  </div>

                </div>

              </div>

              <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="advertisements_img">{{ __('admin::lang.img') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9">
                      @include('admin::layouts.includes.imagePreview', ['name' => $lang->locale .'[advertisements_img]', 'value' => isset($advertisement) ? $advertisement->translate($lang->locale)->advertisements_img : null])
                      @if ($errors->first($lang->locale .'.advertisements_img'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.advertisements_img') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="advertisements_img">{{ __('admin::lang.mobile_img') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9">
                      @include('admin::layouts.includes.imagePreview', ['name' => $lang->locale .'[advertisements_mobile_img]', 'value' => isset($advertisement) ? $advertisement->translate($lang->locale)->advertisements_mobile_img : null])
                      @if ($errors->first($lang->locale .'.advertisements_mobile_img'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.advertisements_mobile_img') }}</div>
                      @endif
                    </div>
                </div>
                
 

            </div>
          @endforeach
        </div>

       
    </div>
  </div>
</div>

 