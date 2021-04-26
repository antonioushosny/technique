@extends('layouts.app')


@section('metatag')

	<title>{{ getMetaByKey('contactus') ? getMetaByKey('contactus')->translate()->metatags_title : __('admin::lang.contactus') }}</title>

	<meta name="description" content="{{ getMetaByKey('contactus') ? getMetaByKey('contactus')->translate()->metatags_desc : '' }}">

@endsection 

@section('content')
 

 {{-- Breadcrumb Section --}}
    <div class="container p-0">
        <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('home')}}" class=" color-bluish"> {{ __('admin::lang.home') }}</a> </li>
	    <li class="breadcrumb-item  "><a href="" class=" color-greyish-brown">  {{ __('admin::lang.contactus') }} </a> </li>
        </ol>
	</div>
{{-- End BreadCrumb --}}


<section class="container projects-list my-2 ">
 
		<div class="row"> 
			<div class="col-md-12 col-12">
				{!! $contacts->contacts_text !!}
			</div>
			<div class="col-md-12 col-12  ">
				  {!! $contacts->contacts_address  !!}  
			</div>
			<div class="col-md-12 col-12  ">
			  <i class="fa fa-mobile" aria-hidden="true"></i> {{ $contacts->contacts_mobiles }}	 
			</div>

			 
 
		</div>
</section>

<section class="container projects-list mt-5">

		<!-- <h4 class="fb-700 gray-color text-center">
			@if( Route::currentRouteName() == 'complaint' )
				{!! getInfoByKey('contact_us') ? getInfoByKey('contact_us')->translate()->infos_desc : __('lang.clientsContactUss') !!}
			@elseif(Route::currentRouteName() == 'suggest')
				{!! getInfoByKey('suggestions') ? getInfoByKey('suggestions')->translate()->infos_desc : __('lang.clientsSuggestions') !!}
			@else
				{{ __('admin::lang.contactus') }}
			@endif
		</h4> -->


		@if (session('status'))
			<div class="alert alert-success text-sm-center">
				<button class="close" type="button" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h6>{{ session('status') }}</h6>
			</div>
		@endif

		@include('includes.errors')

		<form action="{{ route('postcontactus') }}" method="post" class="mt-5">
			@csrf

  
		  <div class="form-group row">

		  	<label for="contact_us_name" class="col-sm-2 fb-700 col-form-label">
		  		{{ __('lang.name') }} *
		  	</label>

		  	<div class="col-sm-10">
				<input class="form-control {{ $errors->first('contact_us_name') ? 'is-invalid' : '' }}"
					id="contact_us_name" type="text" name="contact_us_name"
					placeholder="{{ __('lang.name') }}" value="{{ old('contact_us_name') }}"
				>

	          @if ($errors->first('contact_us_name'))
	            <div class="invalid-feedback">{{ $errors->first('contact_us_name') }}</div>
	          @endif
		    </div>

		  </div>
		  <div class="form-group row">

		  	<label for="contact_us_phone" class="col-sm-2 fb-700 col-form-label">
		  		{{ __('lang.phone') }} *
		  	</label>

		  	<div class="col-sm-10">
				<input class="form-control price-number {{ $errors->first('contact_us_phone') ? 'is-invalid' : '' }}"
					id="contact_us_phone" type="text" name="contact_us_phone"
					placeholder="{{ __('lang.phone') }}" value="{{ old('contact_us_phone') }}"
				>

	          @if ($errors->first('contact_us_phone'))
	            <div class="invalid-feedback">{{ $errors->first('contact_us_phone') }}</div>
	          @endif
		    </div>

		  </div>

		  <div class="form-group row">

		  	<label for="contact_us_email" class="col-sm-2 fb-700 col-form-label">
		  		{{ __('lang.email') }}
		  	</label>

		  	<div class="col-sm-10">
				<input class="form-control {{ $errors->first('contact_us_email') ? 'is-invalid' : '' }}"
					id="contact_us_email" type="text" name="contact_us_email"
					placeholder="{{ __('lang.email') }}" value="{{ old('contact_us_email') }}"
				>

	          @if ($errors->first('contact_us_email'))
	            <div class="invalid-feedback">{{ $errors->first('contact_us_email') }}</div>
	          @endif
		    </div>

		  </div>

		  <div class="form-group row">

		  	<label for="contact_us_message" class="col-sm-2 fb-700 col-form-label">
		  		{{ __('lang.text') }} *
		  	</label>

		  	<div class="col-sm-10">
				<textarea name="contact_us_message" id="text" rows="5"
					class="form-control {{ $errors->first('contact_us_message') ? 'is-invalid' : '' }}"
					placeholder="{{ __('lang.text') }}">{{ old('contact_us_message') }}</textarea>
		        @if ($errors->first('contact_us_message'))
		            <div class="invalid-feedback">{{ $errors->first('contact_us_message') }}</div>
		        @endif
		    </div>

		  </div>


		  <div class="form-group row">

		  	<label for="contact_us_message" class="col-sm-2 fb-700 col-form-label"></label>


		  	<div class="col-sm-10">
		  		<span class="float-right sycamore-color fb-700 mb-2">
		  			{{-- {{ __('lang.filledMust') }} --}}
		  		</span>
		  		<button type="submit" class="btn btn-success float-none float-md-{{ $dir == 'rtl' ? 'left' : 'right' }} ">
		  			{{ __('lang.send') }}
				  </button>
				  
				  
		    </div>

		  </div>


		</form>

		</div>



</section>



@endsection
@section('script')
<script type="text/javascript">
	$(".price-number").keydown(function (e) {
				console.log(e.keyCode)
			    // Allow: backspace, delete, tab, escape, enter and .
			    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190,110]) !== -1 ||
			         // Allow: Ctrl+A
			        (e.keyCode == 65 && e.ctrlKey === true) || 
			         // Allow: home, end, left, right
			        (e.keyCode >= 35 && e.keyCode <= 39)) {
			             // let it happen, don't do anything
			             return;
			    }
			    // Ensure that it is a number and stop the keypress
			    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			        e.preventDefault();
			    }
			});
</script>
@endsection