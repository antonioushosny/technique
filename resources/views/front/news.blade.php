@extends('layouts.app')

@section('metatag')
	<title>{{ getMetaByKey('news') ? getMetaByKey('news')->translate()->metatags_title :  __('admin::lang.news') }}</title>
	<meta name="description" content="{{ getMetaByKey('news') ? getMetaByKey('news')->translate()->metatags_desc :''}}">
 @endsection

@section('content')
@include('includes.banner')

<!-- last new section  -->
  

<section class="py-5 text-center container">
	<div class="row py-lg-5">
      	<div class="col-lg-6 col-md-8 mx-auto">
        	<h1 class="fw-light">{{__('admin::lang.news')}}</h1>
		</div>
	</div>
	<div class="row">
		@foreach($news as $new)
			<div class="col-md-4 col-sm-6 col-12 py-2">
				<div class="card shadow-sm">
					<img src="{{$new->news_image ? asset($new->images_url($new->news_image, 'medium')) : asset('img/no-image.png') }}" class="card-img-top" alt="..." height="300px">
					<div class="py-2 bg-pale-grey-dark color-marine">
						<h5 class="card-title"><a href="{{route('news.show',$new->news_id)}}" class="color-marine">{{$new->news_title}}</a></h5>
						<!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
					 
					</div>
					<div class="card-footer d-none">
					<a href="{{route('news.show',$new->news_id)}}" class="">{{__('lang.more')}}</a>
					</div>
				</div>
			</div>
		@endforeach		
		
	</div>
	{{ $news->links() }}
</section>

 
@endsection

 
 
