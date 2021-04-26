@extends('layouts.app')

@section('metatag')

    <title>{{ getMetaByKey('terms_of_use') ? getMetaByKey('terms_of_use')->translate()->metatags_title : __('admin::lang.termsConditions') }}</title>

    <meta name="description" content="{{ getMetaByKey('terms_of_use') ? getMetaByKey('terms_of_use')->translate()->metatags_desc : '' }}">

@endsection

@section('content')




{{-- Breadcrumb Section --}}
    <div class="container p-0">
        <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('home')}}" class="  color-bluish"> {{ __('admin::lang.home') }}</a> </li>
        <li class="breadcrumb-item  "><a href="" class=" color-greyish-brown">   {{ __('admin::lang.termsConditions') }} </a> </li>
        </ol>
	</div>
{{-- End BreadCrumb --}}


<section class="container about-details mt-2 mt-md-2 ">

	<h4 class="fb-800 sycamore-color mb-2 mb-md-4 text-center d-none">
		{!! $terms->translate()->infos_title !!}
	</h4>


	<div class="fb-500 gray-color">
		{!! $terms->translate()->infos_desc !!}
	</div>

</section>



@endsection
