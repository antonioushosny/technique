@extends('admin::layouts.master')

@section('main')
  <main class="main">
  	
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('admin::lang.faqs') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('admin::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.faqs.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create faqs')
	                	<a href="{{ route('admin.faqs.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
                <div class="form-group col-12 col-md-1 text-center">
                </div>
                <div class="form-group col-12 col-md-6 text-center">
                  <input class="form-control" type="text" name="title" placeholder="{{ __('admin::lang.title') }}" value="{{ old('title') }}">
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
          		<div class="col-12 col-md-5 text-center"><strong>{{ __('admin::lang.title') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
				@forelse ($faqs as $faq)
					@php
						$f = true;
					@endphp
        	@foreach ($faq->translations->sortBy('locale') as $faqTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $faq->faqs_id }}</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.position') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $faq->faqs_position }}</div>
			          			</div>
		          			@endif
		          		</div>
		          		<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $faqTrans->locale }}</div>
		          			</div>
		          		</div>
		          		<div class="col-12 col-md-5 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.title') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $faqTrans->faqs_title }}</div>
		          			</div>
		          		</div>
		          		<div class="col-12 col-md-2 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.status') }}</strong></div>
			          				<div class="col-8 col-md-12">
			          					@if ($faq->faqs_status)
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
		          					<form method="POST" action="{{ route('admin.faqs.destroy', $faq->faqs_id) }}">
		          						@csrf
		          						@method('DELETE')
		          						@can('view faqs')
				          					<a href="{{ route('admin.faqs.show', [$faq->faqs_id, 'activeLocale' => $faqTrans->locale]) }}" 
				          						class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
		          						@endcan
		          						@can('update faqs')
				          					<a href="{{ route('admin.faqs.edit', [$faq->faqs_id, 'activeLocale' => $faqTrans->locale]) }}" 
				          						class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
		          						@endcan
			          					@if ($f)
			          						@can('delete faqs')
			          							<button type="submit" class="btn btn-danger btn-sm delete-form">
			          								<i class="fa fa-trash"></i>
			          							</button>
			          						@endcan
			          					@endif
		          					</form>
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

				{{ $faqs->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
