@extends('admin::layouts.master')

@section('main')
  <main class="main">
  	
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('admin::lang.aboutProject') }}</li>
      <li class="breadcrumb-item  active"> {{ __('admin::lang.aboutus') }}</li>
    </ol> 
	{{-- end Breadcrumb Section --}}

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('admin::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.infos.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center"></div>
                <div class="form-group col-12 col-md-1 text-center">
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="text" name="key" placeholder="{{ __('admin::lang.title') }}" value="{{ old('key') }}">
                </div>
                <div class="form-group col-12 col-md-4 text-center">
                  <input class="form-control" type="text" name="value" placeholder="{{ __('admin::lang.desc') }}" value="{{ old('value') }}">
                </div>
                <div class="form-group col-12 col-md-2 text-center">
				      <select class="form-control" name="status">
				        <option value="">{{ __('admin::lang.selectStatus') }}</option>
				        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('admin::lang.active') }}</option>
				        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('admin::lang.stopped') }}</option>
				      </select>
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                	<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                	<button type="button" class="btn btn-secondary btn-sm search-reset"><i class="fa fa-ban"></i></button>
                </div>
              </div>
              <!-- /.row-->
            </form>
          </div>
        </div>

      	{{-- Header Section --}}
        <div class="card d-none d-md-block">
          <div class="card-header">
          	<div class="row">
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('admin::lang.id') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('admin::lang.position') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('admin::lang.locale') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('admin::lang.title') }}</strong></div>
          		<div class="col-12 col-md-4 text-center"><strong>{{ __('admin::lang.desc') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
		@forelse ($infos as $info)
			@php
				$f = true;
			@endphp
			
        	@foreach ($info->translations->sortBy('locale') as $infoTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $info->infos_id }}</div>
			          			</div>
		          			@endif
		          		</div>
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.position') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $info->infos_position }}</div>
			          			</div>
		          			@endif
		          		</div>
		          		<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $infoTrans->locale }}</div>
		          			</div>
		          		</div>
		          		<div class="col-12 col-md-1 text-md-center">
		          			@if ($f)
		          				<div class="row mb-2 mb-md-0">
				          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.title') }}</strong></div>
				          				<div class="col-8 col-md-12">{{ $info->infos_key }}</div>
		          				</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-4 text-md-center">
	          				<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.title') }}</strong></div>
		          				<div class="col-8 col-md-12">{!! substr($infoTrans->infos_title, 0, 40) !!}</div>
	          				</div>
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.status') }}</strong></div>
			          				<div class="col-8 col-md-12">
			          					@if ($info->infos_status)
			          						<span class="badge badge-warning">{{ __('admin::lang.active') }}</span>
			          					@else
			          						<span class="badge badge-secondary">{{ __('admin::lang.stopped') }}</span>
			          					@endif
			          				</div>
			          			</div>
		          			@endif
		          		</div>
		          		<div class="col-12 col-md-2">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
		          						@can('view infos')
				          					<a href="{{ route('admin.infos.show', [$info->infos_id, 'activeLocale' => $infoTrans->locale]) }}" 
				          						class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
		          						@endcan
		          						@can('update infos')
				          					<a href="{{ route('admin.infos.edit', [$info->infos_id, 'activeLocale' => $infoTrans->locale]) }}" 
				          						class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
		          						@endcan
		          					
		          				</div>
		          			</div>
		          		</div>
		          	</div>
		          </div>
		        </div>
		        @php
		        	$f = false;
		        @endphp
        	@endforeach
		@empty
	        <div class="card">
	          <div class="card-body text-center text-danger">
	          	{{ __('admin::lang.noData') }}
	          </div>
	        </div>
		@endforelse

				{{ $infos->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
