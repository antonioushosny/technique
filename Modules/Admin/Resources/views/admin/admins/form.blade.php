
<div class="card-body">
	@include('admin::layouts.includes.messages')
  <div class="row">
    <div class="col-lg-9">
      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="name">{{ __('admin::lang.name') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name" type="text" name="name" placeholder="{{ __('admin::lang.name') }}"
           value="{{ old('name', isset($admin) ? $admin->name : '') }}">
          @if ($errors->first('name'))
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="email">{{ __('admin::lang.email') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" id="email" type="email" name="email" placeholder="{{ __('admin::lang.email') }}"
           value="{{ old('email', isset($admin) ? $admin->email : '') }}">
          @if ($errors->first('email'))
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="password">{{ __('admin::lang.password') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" id="password" type="password" name="password" placeholder="{{ __('admin::lang.password') }}">
          @if ($errors->first('password'))
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="password_confirmation">{{ __('admin::lang.confirmPassword') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" type="password"
           name="password_confirmation" placeholder="{{ __('admin::lang.confirmPassword') }}">
          @if ($errors->first('password_confirmation'))
            <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
          @endif
        </div>
      </div>
      @can('create admins')
      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="admins_position">{{ __('admin::lang.position') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('admins_position') ? 'is-invalid' : '' }}" id="admins_position" type="text" name="admins_position"
           placeholder="{{ __('admin::lang.position') }}" value="{{ old('admins_position', isset($admin) ? $admin->admins_position : 1) }}">
          @if ($errors->first('admins_position'))
            <div class="invalid-feedback">{{ $errors->first('admins_position') }}</div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="roles">{{ __('admin::lang.roles') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <select class="form-control select2 {{ $errors->first('roles') ? 'is-invalid' : '' }}" id="roles" name="roles[]"
           placeholder="{{ __('admin::lang.roles') }}" multiple>
            <option value=""></option>
            @foreach ($roles as $role)
              <option value="{{ $role->name }}" {{ isset($admin) && $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
          </select>
          @if ($errors->first('roles'))
            <div class="invalid-feedback">{{ $errors->first('roles') }}</div>
          @endif
        </div>
      </div>
    
      <div class="form-group row d-none">
        <label class="col-md-3 col-form-label">{{ __('admin::lang.type') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9 col-form-label">
          @php
            $type = old('admins_type', isset($admin) ? $admin->admins_type : 'admin');
          @endphp
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="admin" type="radio" value="admin" name="admins_type" {{ $type == 'admin' ? 'checked' : '' }}>
            <label class="form-check-label" for="admin">{{ __('admin::lang.admin') }}</label>
          </div>
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="storekeeper" type="radio" value="storekeeper" name="admins_type" {{ $type == 'storekeeper' ? 'checked' : '' }}>
            <label class="form-check-label" for="storekeeper">{{ __('admin::lang.storekeeper') }}</label>
          </div>
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="delegate" type="radio" value="delegate" name="admins_type" {{ $type == 'delegate' ? 'checked' : '' }}>
            <label class="form-check-label" for="delegate">{{ __('admin::lang.delegate') }}</label>
          </div>

          @if ($errors->first('admins_type'))
            <div class="invalid-feedback">{{ $errors->first('admins_type') }}</div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label">{{ __('admin::lang.status') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9 col-form-label">
          @php
            $status = old('admins_status', isset($admin) ? $admin->admins_status : 1);
          @endphp
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="active" type="radio" value="1" name="admins_status" {{ $status == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="active">{{ __('admin::lang.active') }}</label>
          </div>
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="stopped" type="radio" value="0" name="admins_status" {{ $status == 0 ? 'checked' : '' }}>
            <label class="form-check-label" for="stopped">{{ __('admin::lang.stopped') }}</label>
          </div>
          @if ($errors->first('admins_status'))
            <div class="invalid-feedback">{{ $errors->first('admins_status') }}</div>
          @endif
        </div>
      </div>
      @else
        <input   type="hidden" name="admins_position" value="{{ isset($admin) ? $admin->admins_position : ''}}">
        <input   type="hidden" name="admins_type" value="{{ isset($admin) ? $admin->admins_type : ''}}">
        <input   type="hidden" name="admins_status" value="{{ isset($admin) ? $admin->admins_status : ''}}">

      
       @endcan
    </div>
  </div>
</div>