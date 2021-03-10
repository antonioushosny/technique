@extends('admin::layouts.master')

@section('main')
  <main class="main">
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('admin::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('admin::lang.connectWithUs') }}</li>
	  <li class="breadcrumb-item  active"> {{ __('admin::lang.contactus') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">
      	@include('admin::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.contactus.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center"></div>
                <div class="form-group col-12 col-md-4 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('admin::lang.name') }}" value="{{ old('name') }}">
                </div>
                
 				<div class="form-group col-12 col-md-3 text-center">
						      <select class="form-control" name="status">
						        <option value="">{{ __('admin::lang.selectStatus') }}</option>
						        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('admin::lang.done') }}</option>
						        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('admin::lang.new') }}</option>
						      </select>
                </div>
                <div class="form-group col-12 col-md-2 text-center">
						      <select class="form-control" name="type">
						        <option value="">{{ __('admin::lang.selectType') }}</option>
						        <option value="2" {{ old('type') === '2' ? 'selected' : '' }}>{{ __('admin::lang.Unspecified') }}</option>
						        <option value="1" {{ old('type') === '1' ? 'selected' : '' }}>{{ __('admin::lang.Suggestion') }}</option>
						        <option value="0" {{ old('type') === '0' ? 'selected' : '' }}>{{ __('admin::lang.complaint') }}</option>
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
          		<div class="col-12 col-md-3 text-center"><strong>{{ __('admin::lang.name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.phone') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.email') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('admin::lang.type') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('admin::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('admin::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
				@forelse ($contactus as $contact)
	        <div class="card">
	          <div class="card-body">
	          	<div class="row">
	          		<div class="col-xs-12 col-md-1 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.id') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $contact->contact_us_id }}</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-3 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.name') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					
	          					<a href="{{ route('admin.contactus.show', $contact->contact_us_id) }}">
	          						{{ $contact->contact_us_name }}
	          					</a>
	          				</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.phone') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $contact->contact_us_phone }}</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.email') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $contact->contact_us_email }}</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-1 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.type') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					@if ($contact->contact_us_type == 2)
									  <span class="p-2 badge badge-warning">{{ __('admin::lang.Unspecified') }}</span>
								@elseif ($contact->contact_us_type == 1)
	          						<span class="p-2 badge badge-success">{{ __('admin::lang.Suggestion') }}</span>
	          					@else
	          						<span class="p-2 badge badge-secondary">{{ __('admin::lang.complaint') }}</span>
	          					@endif
	          				</div>
	          			</div>
	          		</div> 
					<div class="col-12 col-md-1 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.status') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					@if ($contact->contact_us_status == 0)
	          						
									<a href="{{ route('admin.contactus.edit', $contact->contact_us_id) }}" class="btn btn-success btn-sm"> <span class="p-2 ">{{ __('admin::lang.new') }}</span></a>
	          					@else
	          						<span class="p-2 badge badge-secondary">{{ __('admin::lang.done') }}</span>
	          					@endif
	          				</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('admin::lang.actions') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					<form method="POST" action="{{ route('admin.contactus.destroy', $contact->contact_us_id) }}">
		          						@csrf
		          						@method('DELETE')

	          						@can('view contactus')
			          					<a href="{{ route('admin.contactus.show', $contact->contact_us_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
	          						@endcan
	          						@can('delete contactus')
	          							<button type="submit" class="btn btn-danger btn-sm delete-form">
	          								<i class="fa fa-trash"></i>
	          							</button>
	          						@endcan
	          					</form>
	          				</div>
	          			</div>
	          		</div>
	          	</div>
	          </div>
	        </div>
				@empty
	        <div class="card">
	          <div class="card-body text-center text-danger">
	          	{{ __('admin::lang.noData') }}
	          </div>
	        </div>
				@endforelse

				{{ $contactus->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
