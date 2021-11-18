@extends('layouts.app')

@section('metatag')
	<title>{{ getMetaByKey('home') ? getMetaByKey('home')->translate()->metatags_title : __('admin::lang.siteTitle') }}</title>
	<meta name="description" content="{{ getMetaByKey('home') ? getMetaByKey('home')->translate()->metatags_desc :''}}">
 @endsection

@section('content')
@include('includes.banner')

<!-- last news section  -->
<section class="py-5 text-center container ">
	<div class="row py-lg-5">
      	<div class="col-lg-6 col-md-8 text-left">
        	<h1 class="fw-light">{{__('lang.lastNews')}}</h1>
		</div>
		<div class="col-lg-4 col-md-4 text-right">
			<a href="{{route('news')}}" class="">{{__('lang.more')}}</a>
		</div>
	</div>
	<!-- <div class="row  ">
      	<div class="col-lg-6 col-md-8 mx-auto">
        	<p class="fw-light">{{__('lang.descNews')}}</p>
		</div>
	</div> -->
	<div class="row">
		@foreach($last_news as $new)
			<div class="col-md-3 col-sm-6 col-12 py-2">
				<div class="  ">
					<img src="{{$new->news_image ? asset($new->images_url($new->news_image, 'medium')) : asset('img/no-image.png') }}" class="card-img-top" alt="..." height="300px">
					<div class="card-body bg-pale-grey-dark text-left color-marine">
						<span class="card-title"><a href="{{route('news.show',$new->news_id)}}" class="color-marine">{{$new->news_title}}</a></h5>
						<!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
					 
					</div>
					<div class="card-footer d-none">
					<a href="{{route('news.show',$new->news_id)}}" class="">{{__('lang.more')}}</a>
					</div>
				</div>
			</div>
		@endforeach		 
	</div>
</section>

 <!-- last videos section  -->
<section class="container-fluid bg-white-two color-marine">
	<div class="py-5 text-center container">
		<div class="row py-lg-5">
			<div class="col-lg-6 col-md-8 mx-auto">
				<h1 class="fw-light">{{__('lang.lastVideos')}}</h1>
				<a href="{{route('videos')}}" class="fw-light">{{__('lang.more')}}</a>
			</div>
		</div>
		<div class="row">
			@foreach($videos as $video)
				<div class="col-md-4 col-sm-6 col-12 py-2">
					<div class="card shadow-sm">
						<iframe width="100%" height="315" allowfullscreen="true" src="{{$video->videos_url}}"> </iframe>
						<div class="py-2 bg-pale-grey-dark color-marine">
							<h5 class="card-title color-marine">{{$video->videos_title}}</h5>
						</div>
					</div>
				</div>
			@endforeach		 
		</div>
	</div>
</section>

<!-- last Phones section  -->
<section class="py-5 text-center container ">
	<div class="row py-lg-5">
      	<div class="col-lg-6 col-md-8 mx-auto">
        	<h1 class="fw-light">{{__('lang.lastPhones')}}</h1>
		</div>
	</div>
	<div class="row">
		@foreach($phones as $phone)
			<div class="col-md-4 col-sm-6 col-12 py-2">
				<div class="card shadow-sm">
					<img src="{{$phone->phones_image ? asset($phone->images_url($phone->phones_image, 'medium')) : asset('img/no-image.png') }}" class="card-img-top" alt="..." height="300px">
					<div class="card-body bg-pale-grey color-marine">
						<h5 class="card-title color-marine">{{$phone->phones_title}}</h5>					 
					</div>
					<div class="card-footer text-center bg-red">
					<a href="{{route('comparisons',['phones_id'=>$phone->phones_id])}}" class="color-white">
					<i class="fa fa-balance-scale" aria-hidden="true"></i>
						{{__('lang.addToCompare')}}
					</a>
					</div>
				</div>
			</div>
		@endforeach		 
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

 
 
