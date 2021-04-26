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
        	<h1 class="fw-light">{{ $news->news_title }}</h1>
		</div>
		<div class="col-md-12">
			<img src="{{$news->news_image ? asset($news->images_url($news->news_image, 'original')) : asset('img/no-image.png') }}" class="card-img-top" alt="..." height="500px">
		</div>
		<div class="col-md-12">
			{!!  $news->news_desc !!}
		</div>
	</div>
  
</section>

 
@endsection

 
 
