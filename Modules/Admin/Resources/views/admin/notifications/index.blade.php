@extends('admin::layouts.master')

@section('main')
  <main class="main">
  	
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('admin::lang.notifications') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('admin::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.notifications.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create notifications')
	                	<a href="{{ route('admin.notifications.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
                <div class="form-group col-12 col-md-1 text-center">
                </div>
                <div class="form-group col-12 col-md-4 text-center">
                  <input class="form-control" type="text" name="text" placeholder="{{ __('admin::lang.desc') }}" value="{{ old('text') }}">
                </div>

                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="date" name="notifications_start" value="{{ old('notifications_start') }}">
                </div>

                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="date" name="notifications_end" value="{{ old('notifications_end') }}">
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
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('admin::lang.locale') }}</strong></div>
          		<div class="col-12 col-md-4 text-center"><strong>{{ __('admin::lang.desc') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.notifications_start') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.notifications_end') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
				@forelse ($notifications as $notification)
					@php
						$f = true;
					@endphp
        	@foreach ($notification->translations->sortBy('locale') as $notificationTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $notification->notifications_id }}</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $notificationTrans->locale }}</div>
		          			</div>
		          		</div>

		          		<div class="col-12 col-md-4 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.desc') }}</strong></div>
		          				<div class="col-8 col-md-12">{!! substr($notificationTrans->notifications_text, 0, 50) !!}</div>
		          			</div>
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.notifications_start') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $notification->notifications_start }}</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.notifications_end') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $notification->notifications_end }}</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-2">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
		          					<form method="POST" action="{{ route('admin.notifications.destroy', $notification->notifications_id) }}">
		          						@csrf
		          						@method('DELETE')
		          						@can('view notifications')
				          					<a href="{{ route('admin.notifications.show', [$notification->notifications_id, 'activeLocale' => $notificationTrans->locale]) }}" 
				          						class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
		          						@endcan
		          						@can('update notifications')
				          					<a href="{{ route('admin.notifications.edit', [$notification->notifications_id, 'activeLocale' => $notificationTrans->locale]) }}" 
				          						class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
		          						@endcan
			          					@if ($f)
			          						@can('delete notifications')
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

				{{ $notifications->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
