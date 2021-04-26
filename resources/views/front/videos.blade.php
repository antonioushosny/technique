@extends('layouts.app')

@section('metatag')
	<title>{{ getMetaByKey('videos') ? getMetaByKey('videos')->translate()->metatags_title :  __('admin::lang.videos') }}</title>
	<meta name="description" content="{{ getMetaByKey('videos') ? getMetaByKey('videos')->translate()->metatags_desc :''}}">
 @endsection

@section('content')
@include('includes.banner')

 
<section class="py-5 text-center container">
	<div class="row py-lg-5">
      	<div class="col-lg-6 col-md-8 mx-auto">
        	<h1 class="fw-light">{{__('admin::lang.videos')}}</h1>
		</div>
	</div>
	<div class="row">
		@foreach($videos as $video)
			<div class="col-md-4 col-sm-6 col-12 py-2">
				<div class="card shadow-sm">
					<iframe width="100%" height="315" allowfullscreen="true" src="{{$video->videos_url}}"> </iframe>
					<div class="card-body bg-pale-grey-dark color-marine">
						<h5 class="card-title color-marine">{{$video->videos_title}}</h5>
					</div>
				</div>
			</div>
		@endforeach		 
		
	</div>
	{{ $videos->links() }}
</section>

 
@endsection

 
 
