@extends('admin::layouts.master')

@section('main')
  <main class="main">
  	
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('admin::lang.aboutProject') }}</li>
	  <li class="breadcrumb-item  active"> {{ __('admin::lang.metatags') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('admin::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.metatags.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center"></div>
                <div class="form-group col-12 col-md-1 text-center">
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                	<input class="form-control" type="text" name="page" placeholder="{{ __('admin::lang.page') }}" value="{{ old('page') }}">
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="text" name="title" placeholder="{{ __('admin::lang.title') }}" value="{{ old('title') }}">
                </div>
                <div class="form-group col-12 col-md-4 text-center">
					<input class="form-control" type="text" name="desc" placeholder="{{ __('admin::lang.description') }}" value="{{ old('desc') }}">
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
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('admin::lang.page') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.title') }}</strong></div>
          		<div class="col-12 col-md-4 text-center"><strong>{{ __('admin::lang.description') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
				@forelse ($metatags as $metatag)
					@php
						$f = true;
					@endphp
        	@foreach ($metatag->translations->sortBy('locale') as $metatagTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $metatag->metatags_id }}</div>
			          			</div>
		          			@endif
		          		</div>
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.position') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $metatag->metatags_position }}</div>
			          			</div>
		          			@endif
		          		</div>
		          		<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $metatagTrans->locale }}</div>
		          			</div>
		          		</div>
		          		
		          		<div class="col-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.page') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $metatag->metatags_page }}</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.title') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $metatagTrans->metatags_title }}</div>
		          			</div>
		          		</div>
		          		<div class="col-12 col-md-4 text-md-center">
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.description') }}</strong></div>
		          					<div class="col-8 col-md-12">{!! $metatagTrans->metatags_desc !!}</div>
			          			</div>
		          		</div>
		          		<div class="col-12 col-md-2">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
		          						@can('view metatags')
				          					<a href="{{ route('admin.metatags.show', [$metatag->metatags_id, 'activeLocale' => $metatagTrans->locale]) }}" 
				          						class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
		          						@endcan
		          						@can('update metatags')
				          					<a href="{{ route('admin.metatags.edit', [$metatag->metatags_id, 'activeLocale' => $metatagTrans->locale]) }}" 
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

				{{ $metatags->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
