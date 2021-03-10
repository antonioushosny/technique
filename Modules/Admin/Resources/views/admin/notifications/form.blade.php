
@php
  $activeLocale = old('activeLocale', 'general');
  $activeLocale = 'general';
@endphp

<div class="card-body">
  @include('admin::layouts.includes.messages')

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
            <label class="col-md-3 col-form-label" for="notifications_start">{{ __('admin::lang.notifications_start') }}<span class="text-danger"> *</span></label>
            <div class="col-md-3">
              <input class="form-control {{ $errors->first('notifications_start') ? 'is-invalid' : '' }}" id="notifications_start" type="date" name="notifications_start" value="{{ old('notifications_start', isset($notification) ? $notification->notifications_start : '') }}">
              @if ($errors->first('notifications_start'))
                <div class="invalid-feedback">{{ $errors->first('notifications_start') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="notifications_start">{{ __('admin::lang.notifications_end') }}<span class="text-danger"> *</span></label>
            <div class="col-md-3">
              <input class="form-control {{ $errors->first('notifications_end') ? 'is-invalid' : '' }}" id="notifications_end" type="date" name="notifications_end" value="{{ old('notifications_end', isset($notification) ? $notification->notifications_end : '') }}">
              @if ($errors->first('notifications_end'))
                <div class="invalid-feedback">{{ $errors->first('notifications_end') }}</div>
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
            <p class="text-primary h6">{{ __('admin::lang.notificationDetails') }}</p>
            
            {{-- <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('admin::lang.name') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.notifications_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[notifications_name]' }}" placeholder="{{ __('admin::lang.name') }}"
                 value="{{ old($lang->locale .'.notifications_name', isset($notification) ? $notification->translate($lang->locale)->notifications_name : '') }}">
                @if ($errors->first($lang->locale .'.notifications_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.notifications_name') }}</div>
                @endif
              </div>
            </div> --}}

            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('admin::lang.notifications_text') }}<span class="text-danger"> *</span></label>
              <div class="col-md-10">
                <textarea id="{{ $lang->locale }}-ckeditor" class="form-control ckeditor {{ $errors->first($lang->locale .'.notifications_text') ? 'is-invalid' : '' }}"
                 name="{{ $lang->locale .'[notifications_text]' }}" rows="9" placeholder="{{ __('admin::lang.notifications_text') }}"
                 >{{ old($lang->locale .'.notifications_text', isset($notification) ? $notification->translate($lang->locale)->notifications_text : '') }}</textarea>
                @if ($errors->first($lang->locale .'.notifications_text'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.notifications_text') }}</div>
                @endif
              </div>
            </div>

            
          </div>

        </div>

      </div>
    @endforeach
  </div>
</div>
