@extends('layouts.app')

@section('metatag')
	<title>{{ getMetaByKey('phones') ? getMetaByKey('phones')->translate()->metatags_title :  __('admin::lang.phones') }}</title>
	<meta name="description" content="{{ getMetaByKey('phones') ? getMetaByKey('phones')->translate()->metatags_desc :''}}">
 @endsection

@section('content')
@include('includes.banner')

<!-- last phone section  -->
  

<section class="py-5 text-center container">
	<div class="row py-lg-5">
      	<div class="col-lg-6 col-md-8 mx-auto">
        	<h1 class="fw-light">{{__('admin::lang.phones')}}</h1>
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
					<a href="{{route('comparisons',['phones_id'=>$phone->phones_id])}}" class="color-white">{{__('lang.addToCompare')}}</a>
					</div>
				</div>
			</div>
		@endforeach		 
		
	</div>
	{{ $phones->links() }}
</section>

 
@endsection

 
 
