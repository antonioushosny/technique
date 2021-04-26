
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
                  <label class="col-md-3 col-form-label" for="videos_url">{{ __('admin::lang.videos_url') }}<span class="text-danger"> *</span></label>
                  <div class="col-md-9">
                    <input class="form-control {{ $errors->first('videos_url') ? 'is-invalid' : '' }}" id="videos_url" type="text" name="videos_url" placeholder="{{ __('admin::lang.videos_url') }}" value="{{old('videos_url',isset($video) ? $video->videos_url : '')}}">
                      @if ($errors->first('videos_url'))
                        <div class="invalid-feedback">{{ $errors->first('videos_url') }}</div>
                      @endif
                  </div>
                </div>
   
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">{{ __('admin::lang.status') }}<span class="text-danger"> *</span></label>
                  <div class="col-md-9 col-form-label">
                    @php
                      $status = old('videos_status', isset($video) ? $video->videos_status : 'active');
                    @endphp
                    <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" id="active" type="radio" value="active" name="videos_status" {{ $status == 'active' ? 'checked' : '' }}>
                      <label class="form-check-label" for="active">{{ __('admin::lang.active') }}</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" id="stopped" type="radio" value="stop" name="videos_status" {{ $status == 'stop' ? 'checked' : '' }}>
                      <label class="form-check-label" for="stopped">{{ __('admin::lang.stopped') }}</label>
                    </div>
                    @if ($errors->first('videos_status'))
                      <div class="invalid-feedback">{{ $errors->first('videos_status') }}</div>
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

                  <div class="form-group row"  id="{{ $lang->locale }}-videos_title" >
                    <label class="col-md-3 col-form-label" for="videos_title">{{ __('admin::lang.videos_title') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9">
                    
                      <input class="form-control {{ $errors->first($lang->locale .'.videos_title') ? 'is-invalid' : '' }}" id="{{ $lang->locale .'[videos_title]' }}" type="text" name="{{ $lang->locale .'[videos_title]' }}" placeholder="{{ __('admin::lang.videos_title') }}"   value="{{old($lang->locale .'[videos_title]',isset($video) ? $video->translate($lang->locale)->videos_title : '')}}">

                      @if ($errors->first($lang->locale .'.videos_title'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.videos_title') }}</div>
                      @endif
                    </div>
                  </div>

 
                </div>

              </div>
 
            </div>
          @endforeach
        </div>

       
    </div>
  </div>
</div>

 