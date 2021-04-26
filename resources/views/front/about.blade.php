@extends('layouts.app')

@section('metatag')

    <title>{{ getMetaByKey('about') ? getMetaByKey('about')->translate()->metatags_title : __('admin::lang.aboutus') }}</title>

    <meta name="description" content="{{ getMetaByKey('about') ? getMetaByKey('about')->translate()->metatags_desc : '' }}">

@endsection

@section('content')

 

 
{{-- Breadcrumb Section --}}
    <div class="container p-0">
        <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('home')}}" class=" color-bluish "> {{ __('admin::lang.home') }}</a> </li>
        <li class="breadcrumb-item "><a href="" class=" color-greyish-brown"> {{ __('admin::lang.aboutus') }} </a> </li>
        </ol>
	</div>
{{-- End BreadCrumb --}}


<section class="container about-details mt-2 mt-md-2 ">
    
	<h4 class="fb-800 sycamore-color mb-2 mb-md-4 text-center d-none">
		{!! $aboutText->translate()->infos_title !!}
	</h4>
	

	<div class="fb-500 gray-color">
		{!! $aboutText->translate()->infos_desc !!}
	</div>

</section>



@endsection
