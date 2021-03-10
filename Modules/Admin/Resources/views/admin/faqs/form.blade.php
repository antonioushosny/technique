
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
            <label class="col-md-3 col-form-label" for="faqs_position">{{ __('admin::lang.position') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('faqs_position') ? 'is-invalid' : '' }}" id="faqs_position" type="text" name="faqs_position"
               placeholder="{{ __('admin::lang.position') }}" value="{{ old('faqs_position', isset($faq) ? $faq->faqs_position : 1) }}">
              @if ($errors->first('faqs_position'))
                <div class="invalid-feedback">{{ $errors->first('faqs_position') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label">{{ __('admin::lang.status') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9 col-form-label">
              @php
                $status = old('faqs_status', isset($faq) ? $faq->faqs_status : 1);
              @endphp
              <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="active" type="radio" value="1" name="faqs_status" {{ $status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="active">{{ __('admin::lang.active') }}</label>
              </div>
              <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="stopped" type="radio" value="0" name="faqs_status" {{ $status == 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="stopped">{{ __('admin::lang.stopped') }}</label>
              </div>
              @if ($errors->first('faqs_status'))
                <div class="invalid-feedback">{{ $errors->first('faqs_status') }}</div>
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
            <p class="text-primary h6">{{ __('admin::lang.faqDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('admin::lang.title') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.faqs_title') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[faqs_title]' }}" placeholder="{{ __('admin::lang.title') }}"
                 value="{{ old($lang->locale .'.faqs_title', isset($faq) ? $faq->translate($lang->locale)->faqs_title : '') }}">
                @if ($errors->first($lang->locale .'.faqs_title'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.faqs_title') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('admin::lang.desc') }}<span class="text-danger"> *</span></label>
              <div class="col-md-9">
                <textarea id="{{ $lang->locale }}-ckeditor" class="form-control ckeditor {{ $errors->first($lang->locale .'.faqs_desc') ? 'is-invalid' : '' }}"
                 name="{{ $lang->locale .'[faqs_desc]' }}" rows="9" placeholder="{{ __('admin::lang.desc') }}"
                 >{{ old($lang->locale .'.faqs_desc', isset($faq) ? $faq->translate($lang->locale)->faqs_desc : '') }}</textarea>
                @if ($errors->first($lang->locale .'.faqs_desc'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.faqs_desc') }}</div>
                @endif
              </div>
            </div>
          </div>

        </div>

      </div>
    @endforeach
  </div>
</div>
